<?php
$sub_menu = "200200";
include_once('./_common.php');


$g5['title'] = '팀 리스트';
include_once('../admin.head.php');
?>
<!-- 따로 수정 버튼 없이 요소 추가하고
      txt 클릭시 input 엔터시 txt -->

<div id="team_list_con">

  <div class="line">

    <div class="btn_box">
      CEO
      <a data-type="CEO" data-val="+">+</a>
      <a data-type="CEO" data-val="-">-</a>
    </div>

    <div class="element_box">
      <a>CEO</a>
      <a>CEO</a>
    </div>

  </div>

  <div class="line">

    <div class="btn_box">
      TEAM
      <a data-type="TEAM" data-val="+">+</a>
      <a data-type="TEAM" data-val="-">-</a>
    </div>

    <div class="element_box flex_center">
      <div class="team">

        <div class="btn_box">
          <a>TEAM</a>
          <a data-type="SALES" data-val="+">+</a>
          <a data-type="SALES" data-val="-">-</a>
        </div>

        <div class="element_box">

          <div class="sales">

            <div class="btn_box">
              <a>SALES</a>
              <a data-type="COM" data-val="+">+</a>
              <a data-type="COM" data-val="-">-</a>
            </div>

            <div class="element_box">
              <div>COM</div>
              <div>COM</div>
            </div>

          </div>

          <div class="sales">

            <div class="btn_box">
              <a>SALES</a>
              <a data-type="COM" data-val="+">+</a>
              <a data-type="COM" data-val="-">-</a>
            </div>

            <div class="element_box">
              <div>COM</div>
              <div>COM</div>
            </div>

          </div>

          <div class="sales">

            <div class="btn_box">
              <a>SALES</a>
              <a data-type="COM" data-val="+">+</a>
              <a data-type="COM" data-val="-">-</a>
            </div>

            <div class="element_box">
              <div>COM</div>
              <div>COM</div>
            </div>

          </div>

        </div>
      </div>

      <div class="team">

        <div class="btn_box">
          <a>TEAM</a>
          <a data-type="SALES" data-val="+">+</a>
          <a data-type="SALES" data-val="-">-</a>
        </div>

        <div class="element_box">
        </div>

      </div>

      <div class="team">

        <div class="btn_box">
          <a>TEAM</a>
          <a data-type="SALES" data-val="+">+</a>
          <a data-type="SALES" data-val="-">-</a>
        </div>

        <div class="element_box">
        </div>

      </div>

    </div>
  </div>
</div>

<datalist id="ceo_list">
  <?
  $sql = " SELECT * from g5_member WHERE mb_id NOT IN ('admin') AND mb_id LIKE 'ceo%' ";
  $result = sql_query($sql);
  while($row = sql_fetch_array($result)){
  ?>
    <option value="<?=$row['mb_id']?>"></option>
  <?
  };
  ?>
</datalist>
<datalist id="team_list">
  <?
  $sql = " SELECT * from g5_member WHERE mb_id NOT IN ('admin') AND mb_id LIKE 'team%' ";
  $result = sql_query($sql);
  while($row = sql_fetch_array($result)){
  ?>
    <option value="<?=$row['mb_id']?>"></option>
  <?
  };
  ?>
</datalist>
<datalist id="sales_list">
  <?
  $sql = " SELECT * from g5_member WHERE mb_id NOT IN ('admin')
            AND (mb_id NOT LIKE 'ceo%' AND mb_id NOT LIKE 'team%') ";
  $result = sql_query($sql);
  while($row = sql_fetch_array($result)){
  ?>
    <option value="<?=$row['mb_id']?>"></option>
  <?
  };
  ?>
</datalist>

<script>
// $(document).ready(function(){
//  $('#team_list_con a').attr('href','javascript:void(0);');
// });

// 마우스 오버 edit, +, - 명령 팝업창 마우스 따라다님
// edit 클릭시 input 붙이고, a태그 삭제
// db 연동

$(document).on('click', 'a', function(){ //this is the function I am trying to get to work.
  var type=$(this).data('type');
  var val=$(this).data('val');
  var html=add_element(type);

  if(val=='+'){
    $(this).closest('div').next().append(html);
  }
  if(val=='-'){
    $(this).closest('div').next().children().last().remove();
  }
});

function add_element(type){
  var type=type;
  var html='';

  if(type=='CEO'){
    html+='<a>CEO</a>';
  }

  if(type=='TEAM'){
    html+='<div class="team">';

    html+=' <div class="btn_box">';
    html+='   <a>TEAM</a>';
    html+='   <a data-type="SALES" data-val="+">+</a>';
    html+='   <a data-type="SALES" data-val="-">-</a>';
    html+=' </div>';

    html+=' <div class="element_box">';
    html+=' </div>';

    html+='</div>';
  }

  if(type=='SALES'){
    html+='<div class="sales">';

    html+=' <div class="btn_box">';
    html+='   <a>SALES</a>';
    html+='   <a data-type="COM" data-val="+">+</a>';
    html+='   <a data-type="COM" data-val="-">-</a>';
    html+=' </div>';

    html+=' <div class="element_box">';
    html+=' </div>';

    html+='</div>';
  }

  if(type=='COM'){
    html+='<div class="com">';
    html+='  <a>COM</a>';
    html+='</div>';
  }

  return html;
}

</script>




<?php
include_once('../admin.tail.php');
