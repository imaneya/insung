<?php
$sub_menu = "200200";
include_once('./_common.php');


$g5['title'] = '팀 리스트';
include_once('../admin.head.php');
?>
<!-- 따로 수정 버튼 없이 요소 추가하고
      txt 클릭시 input 엔터시 txt -->

<div class="container_box" style="width:1000px; height1000px;">

  <div class="ceo_line">
    <div class="ceo_btn_box" style="float:right;">
      CEO
      <a class="add_btn plus" href="javascript:add_ceo()">+</a>
      <a class="del_btn minus" href="javascript:del_ceo()">-</a>
    </div>

    <div class="ceo_box" style="text-align:center;">
      <a class="ceo_1" href="<?=G5_ADMIN_URL?>/member_form.php?w=u&mb_id=team3">CEO</a>
      <a class="ceo_2" href="<?=G5_ADMIN_URL?>/member_form.php?w=u&mb_id=team3">CEO</a>
    </div>
  </div>

  <div class="team_line">
    <div class="team_btn_box" style="float:right;">
      TEAM
      <a class="add_btn plus" href="javascript:add_team()">+</a>
      <a class="del_btn minus" href="javascript:del_team()">-</a>
    </div>

    <div class="team_box" style="text-align:center; display:flex; justify-content: center; ">
      <div class="team_1">
        <a href="<?=G5_ADMIN_URL?>/member_form.php?w=u&mb_id=team3">TEAM</a>
        <a href="javascript:add_sales(1)">+</a>
        <a href="javascript:del_sales(1)">-</a>

        <div class="sales_box_1" style="text-align:center;">
          <a href="<?=G5_ADMIN_URL?>/member_form.php?w=u&mb_id=team3">SALES</a><br />
          <a href="<?=G5_ADMIN_URL?>/member_form.php?w=u&mb_id=team3">SALES</a><br />
          <a href="<?=G5_ADMIN_URL?>/member_form.php?w=u&mb_id=team3">SALES</a><br />
        </div>
      </div>

      <div class="team_2">
        <a href="<?=G5_ADMIN_URL?>/member_form.php?w=u&mb_id=team3">TEAM</a>
        <a href="javascript:add_sales(2)">+</a>
        <a href="javascript:del_sales(2)">-</a>

        <div class="sales_box_2" style="text-align:center;">
          <a href="<?=G5_ADMIN_URL?>/member_form.php?w=u&mb_id=team3">SALES</a><br />
          <a href="<?=G5_ADMIN_URL?>/member_form.php?w=u&mb_id=team3">SALES</a><br />
          <a href="<?=G5_ADMIN_URL?>/member_form.php?w=u&mb_id=team3">SALES</a><br />
        </div>
      </div>

      <div class="team_3">
        <a href="<?=G5_ADMIN_URL?>/member_form.php?w=u&mb_id=team3">TEAM</a>
        <a href="javascript:add_sales(3)">+</a>
        <a href="javascript:del_sales(3)">-</a>

        <div class="sales_box_3" style="text-align:center;">
          <a href="<?=G5_ADMIN_URL?>/member_form.php?w=u&mb_id=team3">SALES</a><br />
          <a href="<?=G5_ADMIN_URL?>/member_form.php?w=u&mb_id=team3">SALES</a><br />
          <a href="<?=G5_ADMIN_URL?>/member_form.php?w=u&mb_id=team3">SALES</a><br />
        </div>
      </div>
    </div>
  </div>
</div>

<script>
var ceo_cnt = 2;

function add_ceo(){
  ceo_cnt++;
  $('.ceo_line').append('<a class="ceo_'+ceo_cnt+'" href="<?=G5_ADMIN_URL?>/member_form.php?w=u&mb_id=team3">CEO</a>');
  $.post( "./exec/team.php", {mode:'add', no:ceo_cnt, type:'ceo'}, function( data ) {
    var obj = JSON.parse(data);
    if(obj.result_code!='OK') alert(obj.result_msg);
  });
}

function del_ceo(){
  $('.ceo_'+ceo_cnt).remove();
  $.post( "./exec/team.php", {mode:'del', no:ceo_cnt, type:'ceo'}, function( data ) {
    var obj = JSON.parse(data);
    if(obj.result_code!='OK') alert(obj.result_msg);
  });
  if(ceo_cnt!=0) ceo_cnt--;
}


var team_cnt = 3;

function add_team(){
  team_cnt++;
  $('.team_line').append('<a class="team_'+team_cnt+'" href="<?=G5_ADMIN_URL?>/member_form.php?w=u&mb_id=team3">TEAM</a>');
  $.post( "./exec/team.php", {mode:'add', no:team_cnt, type:'team'}, function( data ) {
    var obj = JSON.parse(data);
    if(obj.result_code!='OK') alert(obj.result_msg);
  });
}

function del_team(){
  $('.team_'+team_cnt).remove();
  $.post( "./exec/team.php", {mode:'del', no:team_cnt, type:'team'}, function( data ) {
    var obj = JSON.parse(data);
    if(obj.result_code!='OK') alert(obj.result_msg);
  });
  if(team_cnt!=0) team_cnt--;
}
</script>

<?php
include_once('../admin.tail.php');