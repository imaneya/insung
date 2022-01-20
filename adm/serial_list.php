<?php
$sub_menu = "400100";
include_once('./_common.php');


$g5['title'] = '시리얼 조회';
include_once('./admin.head.php');
?>
<div id="wrap" style="position:absolute; top:0px; left:0px;">
  <iframe src="http://localhost:8000/insung/bbs/board.php?bo_table=serial" width="1000" height="1000" scrolling="no" frameborder="0"></iframe>
</div>


<?php
include_once('./admin.tail.php');
