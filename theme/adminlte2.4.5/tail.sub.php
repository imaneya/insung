<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- jQuery 3 -->
<script src="<?php echo G5_THEME_JS_URL; ?>/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo G5_THEME_JS_URL; ?>/bootstrap.min.js"></script>
<?php
if (basename($_SERVER['SCRIPT_NAME']) == "login.php") { ?>
<!-- iCheck -->
<!--- script src="<?php echo G5_THEME_JS_URL; ?>/icheck.min.js"></script --->
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
<?php
} else { ?>
<!-- FastClick -->
<script src="<?php echo G5_THEME_JS_URL; ?>/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo G5_THEME_JS_URL; ?>/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo G5_THEME_JS_URL; ?>/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="<?php echo G5_THEME_JS_URL; ?>/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo G5_THEME_JS_URL; ?>/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="<?php echo G5_THEME_JS_URL; ?>/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo G5_THEME_JS_URL; ?>/Chart.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo G5_THEME_JS_URL; ?>/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo G5_THEME_JS_URL; ?>/demo.js"></script>
<?php } ?>


<?php if ($is_admin == 'super') {  ?><!-- <div style='float:left; text-align:center;'>RUN TIME : <?php echo get_microtime()-$begin_time; ?><br></div> --><?php }  ?>

<!-- ie6,7에서 사이드뷰가 게시판 목록에서 아래 사이드뷰에 가려지는 현상 수정 -->
<!--[if lte IE 7]>
<script>
$(function() {
    var $sv_use = $(".sv_use");
    var count = $sv_use.length;

    $sv_use.each(function() {
        $(this).css("z-index", count);
        $(this).css("position", "relative");
        count = count - 1;
    });
});
</script>
<![endif]-->

</body>
</html>
<?php echo html_end(); // HTML 마지막 처리 함수 : 반드시 넣어주시기 바랍니다. ?>