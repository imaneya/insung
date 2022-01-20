<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
	<div class="pull-left image">		
	  <?php echo get_member_profile_image($member['mb_id'], '22', '22', 'User Image'); ?>
	</div>
	<div class="pull-left info">
	  <p><?php echo $member['mb_nick']; ?></p>
	  <?php if ($member['mb_id']) { ?><a href="<?php echo G5_BBS_URL; ?>/logout.php"><i class="fa fa-circle text-success"></i> Online
	  <?php } else { ?><a href="<?php echo G5_BBS_URL; ?>/login.php"><i class="fa fa-circle-thin text-gray"></i> Offline
	  <?php } ?></a>
	</div>
  </div>
  
  <!-- search form -->
  <form name="fsearchbox" method="get" action="<?php echo G5_BBS_URL ?>/search.php" onsubmit="return fsearchbox_submit(this);" class="sidebar-form">
	<input type="hidden" name="sfl" value="wr_subject||wr_content">
	<input type="hidden" name="sop" value="and">
	
	<div class="input-group input-group-sm">
	<label for="sch_stx" class="sound_only">검색어 필수</label>
	<input type="text" name="stx" id="sch_stx" maxlength="20" class="form-control" placeholder="Search...">
	<span class="input-group-btn">
		<button type="submit" id="sch_submit" value="검색" class="btn btn-flat"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">검색</span></button>
	</span>	
	</div>
  </form>

	<script>
	function fsearchbox_submit(f)
	{
	if (f.stx.value.length < 2) {
		alert("검색어는 두글자 이상 입력하십시오.");
		f.stx.select();
		f.stx.focus();
		return false;
	}

	// 검색에 많은 부하가 걸리는 경우 이 주석을 제거하세요.
	var cnt = 0;
	for (var i=0; i<f.stx.value.length; i++) {
		if (f.stx.value.charAt(i) == ' ')
			cnt++;
	}

	if (cnt > 1) {
		alert("빠른 검색을 위하여 검색어에 공백은 한개만 입력할 수 있습니다.");
		f.stx.select();
		f.stx.focus();
		return false;
	}

	return true;
	}
	</script>
  <!-- /.search form -->
  
  
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <?php
  $phpSelf = filter_input(INPUT_SERVER, 'PHP_SELF', FILTER_SANITIZE_URL);
  $path_parts = pathinfo($phpSelf);
  $basename = $path_parts['basename']; // Use this variable for action='':
  $pageName = ucfirst($path_parts['filename']);
  //echo $basename;
  //echo $pageName;
  
  $menu_AdminActive = "";
  $menu_AdminActive2 = "";  
  $menu_BoardActive = "";
  $menu_BoardActive2 = "";
  
  if ($basename != "board.php") {
	  $menu_AdminActive = "active ";
	  $menu_AdminActive2 = ' class="active"';
  }
  ?>
  <ul class="sidebar-menu" data-widget="tree">
	<?php if ($member['mb_level'] > 8) { ?>
	  <li class="<?php echo $menu_AdminActive; ?>treeview">
          <a href="#">
		  <i class="fa fa-folder"></i> <span>Settings</span>
		  <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
          </span>
		  </a>
		  <ul class="treeview-menu">
		  <?php if ($is_admin) { ?>
			<li<?php echo $menu_AdminActive2; ?>><a href="<?php echo G5_ADMIN_URL;?>" target="_blank"><i class="fa fa-gears text-blue"></i> <span>Preferences</span></a></li>
		  <?php } ?>

		
		</ul>
	</li>
	<?php } ?>
	
	<?php
	$sql = " SELECT * FROM {$g5['menu_table']}
				WHERE me_use = '1'
				  AND length(me_code) = '2'
				ORDER BY me_order, me_id ";
	$result = sql_query($sql, false);
	$gnb_zindex = 999;
	$menu_datas = array();

	for ($i=0; $row=sql_fetch_array($result); $i++) {
		$menu_datas[$i] = $row;

		$sql2 = " SELECT * FROM {$g5['menu_table']}
					WHERE me_use = '1'
					  AND length(me_code) = '4'
					  AND substring(me_code, 1, 2) = '{$row['me_code']}'
					ORDER BY me_order, me_id ";
		$result2 = sql_query($sql2);
		
		for ($k=0; $row2=sql_fetch_array($result2); $k++) {
			$menu_datas[$i]['sub'][$k] = $row2;
		}

	}

	$i = 0;
	foreach( $menu_datas as $row ) {
		if( empty($row) ) continue;
	?>
	<li class="treeview">
		<a href="#">
		<i class="fa fa-folder"></i> <span><?php echo $row['me_name']; ?></span>
		<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
        </span>
		</a>
		
		<ul class="treeview-menu">	
		<?php
		$k = 0;
		foreach( (array) $row['sub'] as $row2 ) {

			if( empty($row2) ) continue; 
		?>
			<li><a href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>"><i class="fa fa-circle-o"></i><span><?php echo $row2['me_name']; ?></span></a></li>
			
		<?php
		$k++;
		}   //end foreach $row2
		?>
		</ul>
		
	<?php
	$i++;
	}   //end foreach $row

	if ($i == 0) {  ?>
		<li class="header">메뉴 준비 중입니다.</li>
		<?php if ($is_admin) { ?> <li><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php"><i class="fa fa-cog"></i> <span>메뉴 설정 바로가기</span></a><?php } ?></li>
	<?php } ?>
	
  </ul>
</section>
<!-- /.sidebar -->
</aside>