<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$search_skin_url.'/style.css">', 0);

if ($stx) {
	if ($board_count) { $title_search = $stx; }
}
?>

<!-- Main content -->
<section class="content">
  <div class="error-page">
	<h2 class="headline text-aqua"> <?php echo $title_search ; ?></h2>

	<div class="error-content">
	  <h3><i class="fa fa-search text-aqua"></i> 검색 결과</h3>

	  <p>
		게시판: <strong class="sch_word"><?php echo $board_count ?>개</strong>
		게시물: <strong class="sch_word"><?php echo number_format($total_count) ?>개</strong>
	  </p>

	  <!-- 전체검색 시작 { -->
	  <form name="fsearch" onsubmit="return fsearch_submit(this);" method="get" class="search-form">
	  <input type="hidden" name="srows" value="<?php echo $srows; ?>">
	  <input type="hidden" name="sfl" id="sfl" value="wr_subject||wr_content">
	  <input type="hidden" value="and" id="sop_and" name="sop">
		
		<div class="input-group">
		  <input type="text" name="stx" id="stx" class="form-control" value="<?php echo $text_stx; ?>" placeholder="Search">
		  
		  <div class="input-group-btn">
			<button type="submit" name="submit" class="btn btn-info btn-flat" value="<?php echo $text_stx; ?>"><i class="fa fa-search"></i></button>
		  </div>
		</div>

		<script>
		function fsearch_submit(f) {
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

		f.action = "";
		return true;
		}
		</script>
		<!-- /.input-group -->
	  </form>
	</div>
	<!-- /.error-content -->
  </div>
  <!-- /.error-page -->
</section>
<!-- /.content -->
<!-- } 전체검색 끝 -->




<div class="col-xs-12" id="sch_result">

    <?php
    if ($stx) {
        if ($board_count) {
     ?>
    <ul id="sch_res_board">
        <li><a href="?<?php echo $search_query ?>&amp;gr_id=<?php echo $gr_id ?>" <?php echo $sch_all ?>>전체게시판</a></li>
        <?php echo $str_board_list; ?>
    </ul>
    <?php
        } else {
     ?>
    <div class="empty_list">검색된 자료가 하나도 없습니다.</div>
    <?php } }  ?>

    <hr>

    <?php if ($stx && $board_count) { ?><section class="sch_res_list"><?php }  ?>
    <?php
    $k=0;
    for ($idx=$table_index, $k=0; $idx<count($search_table) && $k<$rows; $idx++) {
     ?>
        <h2><a href="./board.php?bo_table=<?php echo $search_table[$idx] ?>&amp;<?php echo $search_query ?>"><?php echo $bo_subject[$idx] ?> 게시판 내 결과</a></h2>
        <ul>
        <?php
        for ($i=0; $i<count($list[$idx]) && $k<$rows; $i++, $k++) {
            if ($list[$idx][$i]['wr_is_comment'])
            {
                $comment_def = '<span class="cmt_def"><i class="fa fa-commenting-o" aria-hidden="true"></i><span class="sound_only">댓글</span></span> ';
                $comment_href = '#c_'.$list[$idx][$i]['wr_id'];
            }
            else
            {
                $comment_def = '';
                $comment_href = '';
            }
         ?>

            <li>
                <div class="sch_tit">
                    <a href="<?php echo $list[$idx][$i]['href'] ?><?php echo $comment_href ?>" class="sch_res_title"><?php echo $comment_def ?><?php echo $list[$idx][$i]['subject'] ?></a>
                    <a href="<?php echo $list[$idx][$i]['href'] ?><?php echo $comment_href ?>" target="_blank" class="pop_a"><i class="fa fa-share-square-o" aria-hidden="true"></i>새창</a>
                </div>
                <p><?php echo $list[$idx][$i]['content'] ?></p>
                <div class="sch_info">
                    <?php echo $list[$idx][$i]['name'] ?>
                    <span class="sch_datetime"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $list[$idx][$i]['wr_datetime'] ?></span>
                </div>
            </li>
        <?php }  ?>
        </ul>
        <div class="sch_more"><a href="./board.php?bo_table=<?php echo $search_table[$idx] ?>&amp;<?php echo $search_query ?>"><strong><i class="fa fa-plus-circle" aria-hidden="true"></i> <?php echo $bo_subject[$idx] ?></strong> 결과 더보기</a></div>

        <hr>
    <?php }  ?>
    <?php if ($stx && $board_count) {  ?></section><?php }  ?>

    <?php echo $write_pages ?>

</div>
