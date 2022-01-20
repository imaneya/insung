<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
	Dashboard
	<small>Version 2.0</small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="<?php echo G5_URL; ?>/"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Dashboard</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Info boxes -->
  <div class="row">
	<div class="col-md-3 col-sm-6 col-xs-12">
	  <div class="info-box">
		<span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

		<div class="info-box-content">
		  <span class="info-box-text">CPU Traffic</span>
		  <span class="info-box-number">90<small>%</small></span>
		</div>
		<!-- /.info-box-content -->
	  </div>
	  <!-- /.info-box -->
	</div>
	<!-- /.col -->
	<div class="col-md-3 col-sm-6 col-xs-12">
	  <div class="info-box">
		<span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

		<div class="info-box-content">
		  <span class="info-box-text">Likes</span>
		  <span class="info-box-number">41,410</span>
		</div>
		<!-- /.info-box-content -->
	  </div>
	  <!-- /.info-box -->
	</div>
	<!-- /.col -->

	<!-- fix for small devices only -->
	<div class="clearfix visible-sm-block"></div>

	<div class="col-md-3 col-sm-6 col-xs-12">
	  <div class="info-box">
		<span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

		<div class="info-box-content">
		  <span class="info-box-text">Sales</span>
		  <span class="info-box-number">760</span>
		</div>
		<!-- /.info-box-content -->
	  </div>
	  <!-- /.info-box -->
	</div>
	<!-- /.col -->
	<div class="col-md-3 col-sm-6 col-xs-12">
	  <div class="info-box">
		<span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

		<div class="info-box-content">
		  <span class="info-box-text">New Members</span>
		  <span class="info-box-number">2,000</span>
		</div>
		<!-- /.info-box-content -->
	  </div>
	  <!-- /.info-box -->
	</div>
	<!-- /.col -->
  </div>
  <!-- /.row -->
  
  <pre>
  게시판이 보이시면 이 글을 삭제해주시면됩니다. (index.php 88번줄 ~ 90번줄까지)
  게시판이 안보이시면 관리자모드에서 notice 또는 gallery라는 bo_table명으로 게시판을 생성해주세요.</pre>
  
  <?php echo latest('basic', 'notice', 6, 24); ?>
  <?php echo latest('pic_basic', 'gallery', 6, 24); ?>
  </div>
</section>
<!-- /.content -->

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>