<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>
<div class="col-md-12">
  <div class="box box-primary">
	<div class="box-header with-border">
	  <h3 class="box-title"><?php echo $g5['title']; ?></h3>
	</div>
	<!-- /.box-header -->
	
	<!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?php echo $action_url; ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table; ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id; ?>">
    <input type="hidden" name="sca" value="<?php echo $sca; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="spt" value="<?php echo $spt; ?>">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">	
	<div class="box-body">	
    <?php
    $option = '';
    $option_hidden = '';
    if ($is_notice || $is_html || $is_secret || $is_mail) {
        $option = '';
        if ($is_notice) {
            $option .= "\n".'<input type="checkbox" id="notice" name="notice" value="1" '.$notice_checked.'>'."\n".'<label for="notice">공지</label>';
        }

        if ($is_html) {
            if ($is_dhtml_editor) {
                $option_hidden .= '<input type="hidden" value="html1" name="html">';
            } else {
                $option .= "\n".'<input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'>'."\n".'<label for="html">HTML</label>';
            }
        }

        if ($is_secret) {
            if ($is_admin || $is_secret==1) {
                $option .= "\n".'<input type="checkbox" id="secret" name="secret" value="secret" '.$secret_checked.'>'."\n".'<label for="secret">비밀글</label>';
            } else {
                $option_hidden .= '<input type="hidden" name="secret" value="secret">';
            }
        }

        if ($is_mail) {
            $option .= "\n".'<input type="checkbox" id="mail" name="mail" value="mail" '.$recv_email_checked.'>'."\n".'<label for="mail">답변메일받기</label>';
        }
    }
	
	if ($option_hidden) { ?>	
	  <div class="form-group">
		<?php echo $option_hidden; ?>
	  </div>
	<?php } ?>	  
	
	<?php if ($is_category) { ?>
	  <div class="form-group col-xs-3">
        <select name="ca_name" id="ca_name" required class="form-control">
            <option value="">분류를 선택하세요</option>
            <?php echo $category_option; ?>
        </select>
	  </div>
	<?php } ?>
	
	<?php if ($is_name) { ?>
	  <div class="form-group">
	  <input type="text" name="wr_name" value="<?php echo $name; ?>" id="wr_name" required class="form-control required" placeholder="이름:">
	  </div>
	<?php } ?>
	
	<?php if ($is_password) { ?>
	  <div class="form-group">
		<input type="password" name="wr_password" id="wr_password" <?php echo $password_required; ?> class="form-control <?php echo $password_required; ?>" placeholder="비밀번호:">
	  </div>
	<?php } ?>

    <?php if ($is_email) { ?>	  
	  <div class="form-group">
		<input type="text" name="wr_email" value="<?php echo $email; ?>" id="wr_email" class="form-control email " placeholder="이메일:">
	  </div>
	<?php } ?>

    <?php if ($is_homepage) { ?>	  
	  <div class="form-group">
		<input type="text" name="wr_homepage" value="<?php echo $homepage; ?>" id="wr_homepage" class="form-control full_input" size="50" placeholder="홈페이지:">
	  </div>
	<?php } ?>
	
	<?php if ($option) { ?>	
	  <div class="form-group">
		<?php echo $option; ?>
	  </div>
	<?php } ?>
	  
	<div class="form-group">
		<input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="form-control required" placeholder="제목:">
	</div>

	<div class="form-group">
		<div class="write_div">
			<div class="wr_content <?php echo $is_dhtml_editor ? $config['cf_editor'] : ''; ?>">
				<?php if($write_min || $write_max) { ?>
				<!-- 최소/최대 글자 수 사용 시 -->
				<p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
				<?php } ?>
				<?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
				<?php if($write_min || $write_max) { ?>
				<!-- 최소/최대 글자 수 사용 시 -->
				<div id="char_count_wrap"><span id="char_count"></span>글자</div>
				<?php } ?>
			</div>
		</div>
	</div>
	
	
	
	<?php if (G5_LINK_COUNT) { ?>
		<?php for ($i=1; $is_link && $i<=G5_LINK_COUNT; $i++) { ?>
		<div class="form-group">
			  <i class="fa fa-link" aria-hidden="true"></i> Link
			  <input type="text" name="wr_link<?php echo $i; ?>" value="<?php if ($w=="u") { echo $write['wr_link'.$i];} ?>" id="wr_link<?php echo $i; ?>" class="form-control">
		  </div>
		<?php } ?>
	<?php } ?>
	
	<?php if ($file_count) { ?>
		<?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
		<div class="form-group">
			  <i class="fa fa-paperclip"></i> Attachment
			  <input type="file" name="bf_file[]" id="bf_file_<?php echo $i+1 ?>" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file ">
			  
			  <?php if ($is_file_content) { ?>
			  <input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="full_input frm_input" size="50" placeholder="파일 설명을 입력해주세요.">
			  <?php } ?>
			  
			  <?php if($w == 'u' && $file[$i]['file']) { ?>
			  <span class="file_del"><input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label></span>
			  <?php } ?>
			  
			  <p class="help-block">Max. <?php echo $upload_max_filesize; ?></p>
			
		</div>		  
		<?php } ?>
	<?php } ?>
	
	<?php if ($is_use_captcha) { //자동등록방지  ?>
    <div class="form-group"><?php echo $captcha_html; ?></div>
    <?php } ?>
	<!-- /.box-body -->
	
	<div class="box-footer">
		<button type="reset" class="btn btn-default text-yellow"><i class="fa fa-times" aria-hidden="true"></i> 리셋</button>
		<a href="./board.php?bo_table=<?php echo $bo_table; ?>" class="btn btn-default"><i class="fa fa-list" aria-hidden="true"></i> 목록</a>
		<div class="pull-right">
			<button type="submit" id="btn_submit" accesskey="s" class="btn btn-default text-red"><i class="fa fa-pencil" aria-hidden="true"></i> 등록</button>
		  </div>
	</div>
	<!-- /.box-footer -->
	
	</form>	
  </div>
  <!-- /. box -->
  
  </div>
</div>
<script>
<?php if($write_min || $write_max) { ?>
// 글자수 제한
var char_min = parseInt(<?php echo $write_min; ?>); // 최소
var char_max = parseInt(<?php echo $write_max; ?>); // 최대
check_byte("wr_content", "char_count");

$(function() {
	$("#wr_content").on("keyup", function() {
		check_byte("wr_content", "char_count");
	});
});

<?php } ?>
function html_auto_br(obj)
{
	if (obj.checked) {
		result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
		if (result)
			obj.value = "html2";
		else
			obj.value = "html1";
	}
	else
		obj.value = "";
}

function fwrite_submit(f)
{
	<?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

	var subject = "";
	var content = "";
	$.ajax({
		url: g5_bbs_url+"/ajax.filter.php",
		type: "POST",
		data: {
			"subject": f.wr_subject.value,
			"content": f.wr_content.value
		},
		dataType: "json",
		async: false,
		cache: false,
		success: function(data, textStatus) {
			subject = data.subject;
			content = data.content;
		}
	});

	if (subject) {
		alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
		f.wr_subject.focus();
		return false;
	}

	if (content) {
		alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
		if (typeof(ed_wr_content) != "undefined")
			ed_wr_content.returnFalse();
		else
			f.wr_content.focus();
		return false;
	}

	if (document.getElementById("char_count")) {
		if (char_min > 0 || char_max > 0) {
			var cnt = parseInt(check_byte("wr_content", "char_count"));
			if (char_min > 0 && char_min > cnt) {
				alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
				return false;
			}
			else if (char_max > 0 && char_max < cnt) {
				alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
				return false;
			}
		}
	}

	<?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

	document.getElementById("btn_submit").disabled = "disabled";

	return true;
}
</script>
<!-- } 게시물 작성/수정 끝 -->