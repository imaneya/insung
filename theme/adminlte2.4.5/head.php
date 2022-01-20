<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/head.php');
    return;
}

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
?>

<div id="hd">
<?php
// 팝업
if(defined('_INDEX_')) { // index에서만 실행
	include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
}
?>

</div>

<!-- 상단 시작 { -->
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="<?php echo G5_URL; ?>/" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>Admin</b> LTE</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b> LTE</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
	  
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
		
		<?php if ($member['mb_id']) { ?>
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success"><?php echo number_format($total_memo_noread_count); ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <?php echo number_format($total_memo_noread_count); ?> messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
				<!-- start message -->
				<?php
				$memo_noread_sql = " select * from {$g5['memo_table']} where me_recv_mb_id = '{$member['mb_id']}' and me_read_datetime = '0000-00-00 00:00:00' ";
				$memo_noread_result = sql_query($memo_noread_sql);
				for ($m=0; $memo_noread = sql_fetch_array($memo_noread_result); $m++) {
				?>
                  <li>
                    <a href="<?php echo G5_BBS_URL; ?>/memo_view.php?mb_id=<?php echo $memo_noread['me_id']; ?>&kind=recv">
                      <div class="pull-left">
						<?php echo get_member_profile_image($memo_noread['me_send_mb_id'], '20', '20', 'User Image'); ?>
                      </div>
                      <h4>
                        <?php
						$send_mb_id = get_member($memo_noread[me_send_mb_id]);
						echo $send_mb_id['mb_nick'];
						?>
                        <small><i class="fa fa-clock-o"></i>  <?php echo date('Y-m-d H:i', strtotime($memo_noread[me_send_datetime])); ?></small>
                      </h4>
                      <p><?php echo mb_strimwidth($memo_noread['me_memo'], '0', '35', '...', 'utf-8'); ?></p>
                    </a>
                  </li>
				<?php
				}
				?>
                  <!-- end message -->
                </ul>
              </li>
              <li class="footer"><a href="<?php echo G5_BBS_URL; ?>/memo.php">See All Messages</a></li>
            </ul>
          </li>
		  
		  
          <!-- Notifications: style can be found in dropdown.less -->
		  <?php
		  $notification_board_name = "notice";
		  $notification_board = "g5_write_".$notification_board_name;
		  $notice_count_sql = " SELECT COUNT(*) AS cnt FROM {$notification_board} WHERE wr_id = wr_parent AND wr_reply != 'A' ORDER BY wr_id DESC ";
		  $notice_count = sql_fetch($notice_count_sql);
		  $total_notice_count = $notice_count['cnt'];
		  ?>

          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning"><?php echo $total_notice_count; ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <?php echo $total_notice_count; ?> notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
				  <?php
				  //$notice_sql = " SELECT * FROM {$notification_board} WHERE wr_id = wr_parent AND wr_reply != 'A' ORDER BY wr_id DESC LIMIT 0, 10 ";
				  $notice_sql = " SELECT * FROM {$notification_board} WHERE wr_id = wr_parent AND wr_reply != 'A' ORDER BY wr_id DESC ";
				  $notice_result = sql_query($notice_sql);
				  for ($n = 0; $notice = sql_fetch_array($notice_result); $n++) {
				  ?>
                  <li>
                    <a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=<?php echo $notification_board_name; ?>&wr_id=<?php echo $notice['wr_id']; ?>">
                      <i class="fa fa-warning text-yellow"></i> <?php echo mb_strimwidth($notice['wr_subject'], '0', '35', '...', 'utf-8'); ?>
                    </a>
                  </li>
				  <?php
				  }
				  ?>
                </ul>
              </li>
              <li class="footer"><a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=Notice">View all</a></li>
            </ul>
          </li>
		<?php } ?>

		  
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<?php echo get_member_profile_image($member['mb_id'], '22', '22', 'User Image'); ?>
              <span class="hidden-xs"><?php echo $member['mb_nick']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
				<?php echo get_member_profile_image($member['mb_id'], '18', '18', 'User Image'); ?>

                <p>
				  <?php
				  if ($member['mb_id']) {
					  echo $member['mb_nick'] . " - " . $member['mb_name'];
					  echo "<small>Latest Login Date: " . $member['mb_today_login'] . "</small>";
				  } else {
					  echo "로그인 하십시오";
				  }
				  ?> 
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <?php if ($is_admin == 'super' || $is_auth) {  ?><a href="<?php echo G5_ADMIN_URL; ?>"><b>설정</b></a><?php } ?>
                  </div>
                  <div class="col-xs-4 text-center">
                    <?php if ($member['mb_id']) { ?><a href="<?php echo G5_BBS_URL; ?>/point.php">포인터</a><?php } ?>
                  </div>
                  <div class="col-xs-4 text-center">
                    <?php if ($member['mb_id']) { ?><a href="<?php echo G5_BBS_URL; ?>/scrap.php">스크랩</a><?php } ?>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <?php if ($member['mb_id']) { ?><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php" class="btn btn-default btn-flat">정보수정</a><?php } ?>
                </div>
                <div class="pull-right">
                  <?php if ($member['mb_id']) { ?><a href="<?php echo G5_BBS_URL; ?>/logout.php" class="btn btn-default btn-flat">로그아웃</a><?php } else { ?><a href="<?php echo G5_BBS_URL; ?>/login.php" class="btn btn-default btn-flat">로그인</a><?php } ?>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
		  <?php if ($member['mb_level'] > 9) { ?>
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
		  <?php } ?>
        </ul>
      </div>

    </nav>
  </header>
  
  <!-- aside 시작 { -->
  <?php include_once(G5_THEME_PATH."/aside.php"); ?>
  <!-- } aside 끝 -->
  
<!-- } 상단 끝 -->


<!-- 콘텐츠 시작 { -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <?php if (!defined("_INDEX_")) { ?>
      <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo get_head_title($g5['title']); ?>
        <small>&nbsp;</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo G5_URL; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<?php
		if ($bo_table) { ?>
          <li class="active"><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=<?php echo $bo_table; ?><?php echo $qstr; ?>"><?php echo get_head_title($g5['title']); ?></a></li>
		<?php } else { ?>
		  <li class="active"><a href="#"><?php echo get_head_title($g5['title']); ?></a></li>
		<?php } ?>
      </ol>
    </section>
	<?php } ?>