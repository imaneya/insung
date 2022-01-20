<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

if ($is_checkbox) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

// Page count
$startContent = 0;
$endContent = 0;
if ($total_count > 0) {
	$endContent = $board['bo_page_rows'] * $page;
	$startContent = $endContent - $board['bo_page_rows'] + 1;
}
if ($page) {
	$pre_page = $page - 1;
	$next_page = $page + 1;
}
?>

<div id="bo_list" class="col-md-12">
  <div class="box box-primary">
	<div class="box-header with-border">
	  <h3>&nbsp;</h3>
	  <!--- h3 class="box-title"><?php echo get_head_title($g5['title']); ?></h3 --->
	  <!-- 게시판 카테고리 시작 { -->
		<?php if ($is_category) { ?>
		<div id="bo_list">
			<nav id="bo_cate">
				<ul id="bo_cate_ul">
					<?php echo $category_option; ?>
				</ul>
			</nav>
		</div>
		<!-- } 게시판 카테고리 끝 -->
		<?php } ?>

	  <div class="box-tools pull-right">
		<div class="has-feedback">
			<!-- 게시판 검색 시작 { -->
			<form name="fsearch" method="get">
			<input type="hidden" name="bo_table" value="<?php echo $bo_table; ?>">
			<input type="hidden" name="sca" value="<?php echo $sca; ?>">
			<input type="hidden" name="sop" value="and">
			<input type="hidden" name="sfl" id="sfl" value="wr_subject||wr_content"<?php echo get_selected($sfl, 'wr_subject||wr_content'); ?>>
			
			<div class="input-group input-group-sm col-xs-3 pull-right">
			  <label for="stx" class="sound_only">검색어 필수</label>
			  <input type="text" name="stx" value="<?php echo stripslashes($stx); ?>" required id="stx" class="form-control" placeholder="Search the contents">
				<span class="input-group-btn">
				  <button type="submit" id="sch_submit" value="검색" class="btn btn-info btn-flat"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">검색</span></button>
				</span>
			</div>
			
			</form>
			<!-- } 게시판 검색 끝 -->
		
		</div>
	  </div>
	  <!-- /.box-tools -->
	</div>
	<!-- /.box-header -->
	
	<form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
		<input type="hidden" name="bo_table" value="<?php echo $bo_table; ?>">
		<input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
		<input type="hidden" name="stx" value="<?php echo $stx; ?>">
		<input type="hidden" name="spt" value="<?php echo $spt; ?>">
		<input type="hidden" name="sca" value="<?php echo $sca; ?>">
		<input type="hidden" name="sst" value="<?php echo $sst; ?>">
		<input type="hidden" name="sod" value="<?php echo $sod; ?>">
		<input type="hidden" name="page" value="<?php echo $page; ?>">
		<input type="hidden" name="sw" value="">

		<div class="box-body no-padding">
		  <div class="mailbox-controls">
			<?php if ($is_checkbox) { ?>
			<!-- Check all button -->
			&nbsp;<input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">&nbsp;&nbsp;
			
			<div class="btn-group">
			  <button type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value" class="btn btn-default btn-sm"><i class="fa fa-trash-o text-red"></i></button>
			  <button type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value" class="btn btn-default btn-sm"><i class="fa fa-copy text-yellow"></i></button>
			  <button type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value" class="btn btn-default btn-sm"><i class="fa fa-arrows text-yellow"></i></button>
			</div>				
			<!-- /.btn-group -->
			<?php } ?>
			
			<?php if ($list_href) { ?><a href="<?php echo $list_href; ?>" class="btn btn-default btn-sm"><i class="fa fa-list"></i></a><?php } ?>
			<?php if ($write_href) { ?><a href="<?php echo $write_href; ?>" class="btn btn-default btn-sm"><i class="fa fa-pencil text-aqua"></i></a><?php } ?>
			<div class="pull-right">
			  <?php if ($rss_href) { ?><a href="<?php echo $rss_href; ?>" class=""btn btn-default"><i class="fa fa-rss" aria-hidden="true"></i> RSS</a><?php } ?>
			  <?php if ($admin_href) { ?><a href="<?php echo $admin_href; ?>" class=""btn btn-default text-red"><i class="fa fa-user-circle text-red" aria-hidden="true"></i> <strong class="text-red">관리자</strong></a><?php } ?>
		
			  <?php echo $startContent; ?>-<?php echo $endContent; ?>/<?php echo number_format($total_count); ?>
			  <div class="btn-group">
				<a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=<?php echo $bo_table; ?>&page=<?php echo $pre_page; ?>" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
				<a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=<?php echo $bo_table; ?>&page=<?php echo $next_page; ?>" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
			  </div>
			  <!-- /.btn-group -->
			</div>
			<!-- /.pull-right -->
		  </div>
		  <div class="table-responsive mailbox-messages">
			<table class="table table-hover table-striped">
			  <tbody>
			  <?php
			  for ($i=0; $i<count($list); $i++) {
			  ?>
			  <tr>
				<?php if ($is_checkbox) { ?>
				<td><input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id']; ?>" id="chk_wr_id_<?php echo $i; ?>"></td>
				<?php } ?>
				
				<td class="mailbox-star">
				<?php
				if ($list[$i]['is_notice']) // 공지사항
					echo '<strong class="notice_icon"><i class="fa fa-bullhorn" aria-hidden="true"></i><span class="sound_only">공지</span></strong>';
				else if ($wr_id == $list[$i]['wr_id'])
					echo "<span class=\"bo_current\">열람중</span>";
				else
					echo $list[$i]['num'];
				 ?>
				<?php
				if (isset($list[$i]['icon_new'])) echo rtrim($list[$i]['icon_new']);
				if (isset($list[$i]['icon_hot'])) echo rtrim($list[$i]['icon_hot']);
				?>
				</td>
				
				<?php
				if ($is_category && $list[$i]['ca_name']) {
				?>
				<td class="mailbox-name">
				<a href="<?php echo $list[$i]['ca_name_href'] ?>" class="bo_cate_link"><?php echo $list[$i]['ca_name']; ?></a>
				</td>
				<?php } ?>
				
				<td class="mailbox-subject">
					<a href="<?php echo $list[$i]['href'] ?>">
						<?php echo $list[$i]['icon_reply']; ?>
						<?php if (isset($list[$i]['icon_secret'])) echo rtrim($list[$i]['icon_secret']); ?>
						 <?php echo $list[$i]['subject']; ?>
					</a>
				<?php if ($list[$i]['comment_cnt']) { ?><span class="cnt_cmt">+ <?php echo $list[$i]['wr_comment']; ?></span><?php } ?>
				
				<?php
				// if ($list[$i]['file']['count']) { echo '<'.$list[$i]['file']['count'].'>'; }
				if (isset($list[$i]['icon_file'])) echo rtrim($list[$i]['icon_file']);
				if (isset($list[$i]['icon_link'])) echo rtrim($list[$i]['icon_link']);
				?>
				</td>

				<td class="mailbox-name">
				<a href="<?php echo $list[$i]['ca_name_href'] ?>" class="bo_cate_link"><?php echo $list[$i]['name']; ?></a>
				</td>
				
				<td class="mailbox-star"><?php echo $list[$i]['wr_hit']; ?></td>
				
				<td class="mailbox-date"><?php echo $list[$i]['datetime2']; ?></td>
			  </tr>
			  <?php } ?>
			  <?php if (count($list) == 0) { echo '<tr><td colspan="'.$colspan.'" class="text-center">아직 등록된 게시물이 없습니다.</td></tr>'; } ?>				  
			  </tbody>
			</table>
			<!-- /.table -->
		  </div>
		  <!-- /.mail-box-messages -->
		</div>
		<!-- /.box-body -->
		
		
		<div class="box-footer no-padding">
		  <div class="mailbox-controls">
			<?php if ($is_checkbox) { ?>
			<!-- Check all button -->
			&nbsp;<input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">&nbsp;&nbsp;
			
			<div class="btn-group">
			  <button type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value" class="btn btn-default btn-sm"><i class="fa fa-trash-o text-red"></i></button>
			  <button type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value" class="btn btn-default btn-sm"><i class="fa fa-copy text-yellow"></i></button>
			  <button type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value" class="btn btn-default btn-sm"><i class="fa fa-arrows text-yellow"></i></button>
			</div>				
			<!-- /.btn-group -->
			<?php } ?>
			
			<?php if ($list_href) { ?><a href="<?php echo $list_href; ?>" class="btn btn-default btn-sm"><i class="fa fa-list"></i></a><?php } ?>
			<?php if ($write_href) { ?><a href="<?php echo $write_href; ?>" class="btn btn-default btn-sm"><i class="fa fa-pencil text-aqua"></i></a><?php } ?>
			<div class="pull-right">				  
			  <?php echo $startContent; ?>-<?php echo $endContent; ?>/<?php echo number_format($total_count); ?>
			  <div class="btn-group">
				<a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=<?php echo $bo_table; ?>&page=<?php echo $pre_page; ?>" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
				<a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=<?php echo $bo_table; ?>&page=<?php echo $next_page; ?>" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
			  </div>
			  <!-- /.btn-group -->
			</div>
			<!-- /.pull-right -->
		  </div>
		</div>
	  </div>
	  </form>
	  <!-- /. box -->		  
</div>        



<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = "./board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == "copy")
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->
