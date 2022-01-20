<?php
$sub_menu = "500200";
include_once('./_common.php');


$g5['title'] = 'A/S 조회';
include_once('../admin.head.php');
?>

<div style="max-width:1000px">
  <iframe id="iframe" src="<?=G5_BBS_URL?>/board.php?bo_table=as" width="100%" height="1000" scrolling="no" frameborder="0"></iframe>
</div>

<script>

</script>

<?php
include_once('../admin.tail.php');
