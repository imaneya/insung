<?
$mode = trim($_POST['mode']);
if(!$mode){
  $re_arr = array();
  $re_arr['result_code'] = 'ERROR';
  $re_arr['result_msg'] = '모드 값이 없습니다';

  echo json_encode($re_arr);
}

$no = $_POST['no']*1;
if(!$no){
  $re_arr = array();
  $re_arr['result_code'] = 'ERROR';
  $re_arr['result_msg'] = '번호가 없습니다';

  echo json_encode($re_arr);
}

$type = trim($_POST['type']);
if(!$type){
  $re_arr = array();
  $re_arr['result_code'] = 'ERROR';
  $re_arr['result_msg'] = '번호가 없습니다';

  echo json_encode($re_arr);
}

if($_POST['mode']=='add' || $_POST['mode']=='del'){
  $re_arr = array();
  $re_arr['result_code'] = 'OK';
  $re_arr['result_msg'] = '성공';

  echo json_encode($re_arr);

}else{
  $re_arr = array();
  $re_arr['result_code'] = 'ERROR';
  $re_arr['result_msg'] = '알수 없는 모드입니다';

  echo json_encode($re_arr);
}
?>
