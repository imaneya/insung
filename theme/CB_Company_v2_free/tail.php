<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/tail.php');
    return;
}
?>

    </div>
</div>

<!-- } 콘텐츠 끝 -->

<hr>

<!-- 하단 시작 { -->
<div id="ft">

	<div id="fnb">
		<div>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=company">회사소개</a>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy">개인정보취급방침</a>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">서비스이용약관</a>
		</div>
	</div>

    <div id="ft_company_wrapper">
		<div id="ft_company">
			<p>코드브릴 | 대표자 : 홍길동 | 서울특별시 중구 세종대로 임시건물 | 사업자등록번호 : 000-00-00000</p>
			<p>TEL : 02-0000-0000 | FAX : 02-0000-0000 | E-mail : admin@codebridge.com</p>
			<p>Copyright &copy; <b>소유하신 도메인.</b> All rights reserved.<br></p>
		</div>

		<div id="ft_logo">
			<img src="<?php echo G5_THEME_IMG_URL ?>/ft_logo.png" alt="<?php echo $config['cf_title']; ?>">
		</div>
    </div>

</div>

<?php
if(G5_DEVICE_BUTTON_DISPLAY && !G5_IS_MOBILE) { ?>
<a href="<?php echo get_device_change_url(); ?>" id="device_change">모바일 버전으로 보기</a>
<?php
}

if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<!-- } 하단 끝 -->

<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>

<?php
include_once(G5_THEME_PATH."/tail.sub.php");
?>