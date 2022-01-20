<?php
$sub_menu = "400200";
include_once('./_common.php');


$g5['title'] = 'A/S 조회';
include_once('./admin.head.php');
?>
<!-- <div id="wrap" style="position:absolute; top:-190px; left:220px;">
  <iframe src="http://localhost:8000/insung/bbs/board.php?bo_table=serial" width="900" height="700" scrolling="no" frameborder="0"></iframe>
</div> -->
<div style="max-width:1000px">
  <iframe id="iframe" src="<?=G5_BBS_URL?>/board.php?bo_table=as" width="100%" height="1000" scrolling="no" frameborder="0"></iframe>
</div>

<script>

// $(".container_wr").css('height','1000px');
//
// $("#iframe").on("load", function() {
//   $("#iframe").contents().find('body').children('#hd').remove();
//   $("#iframe").contents().find('body').children('#wrapper').find('div').closest('#aside').remove();
//   $("#iframe").contents().find('body').children('#wrapper').find('h2').closest('#container_title').remove();
//   $("#iframe").contents().find('body').children('#wrapper').find('h2').closest('#container').css('margin-top',0);
//   $("#iframe").contents().find('body').children('#ft').remove();
//   setTimeout(function() {
//     $("#iframe").show();
//   }, 200);
// })


</script>

<?php
include_once('./admin.tail.php');
