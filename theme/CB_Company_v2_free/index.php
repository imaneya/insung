<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/index_head.php');
?>
<div class="main_line introduce">
	<div class="intro_box company">
		<div class="text_inner">
			<p class="subject">회사소개</p>
			<p class="content">
				항상 고객을 생각하고,<br>
				품질과 기술로 보답하겠습니다.
			</p>
			<a href="#" class="intro_btn">회사소개 바로가기</a>
		</div>
	</div>
	<div class="intro_box">
		<div class="board_inner">
			<?php
			echo latest('theme/basic', 'notice', 5, 20);
			?>
		</div>
	</div>
	<div class="intro_box customer">
		<div class="text_inner">
			<p class="subject">고객센터</p>
			<p class="content">
				<span class="center_number">02-1234-1234</span><br>
				<?php echo $config['cf_admin_email']; ?><br>
				AM 09:00 ~ PM 06:00<br>
				주말 및 공휴일 휴무
			</p>
		</div>
	</div>
	<div class="intro_box">
		<div class="board_inner">
			<?php
			echo latest('theme/basic', 'product', 5, 20);
			?>
		</div>
	</div>
</div>

<div class="main_line gallery">
	<div class="gallery_box">
		<?php
		echo latest('theme/basic', 'gallery', 4, 20);
		?>
	</div>
	<div class="news_box">
		<?php
		echo latest('theme/basic', 'news', 4, 20);
		?>
	</div>
</div>

<?php
include_once(G5_THEME_PATH.'/index_tail.php');
?>