<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/design.css">', 0);
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/write.css">', 1);
?>

<!-- 최상위 박스 시작 { -->
<div id="nbo_box" style="width:<?php echo $width; ?>">

<div class="nbo_line_top"></div><!-- 상단 가로줄 -->

<!-- 글쓰기 시작 { -->
<article id="nbw">
<!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <?php
    $option = '';
    $option_hidden = '';
    if ($is_notice || $is_html || $is_secret || $is_mail) { 
        $option = '';
        if ($is_notice) {
            $option .= PHP_EOL.'<li class="chk_box"><input type="checkbox" id="notice" name="notice"  class="selec_chk" value="1" '.$notice_checked.'>'.PHP_EOL.'<label for="notice"><span></span>공지</label></li>';
        }
        if ($is_html) {
            if ($is_dhtml_editor) {
                $option_hidden .= '<input type="hidden" value="html1" name="html">';
            } else {
                $option .= PHP_EOL.'<li class="chk_box"><input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" class="selec_chk" value="'.$html_value.'" '.$html_checked.'>'.PHP_EOL.'<label for="html"><span></span>html</label></li>';
            }
        }
        if ($is_secret) {
            if ($is_admin || $is_secret==1) {
                $option .= PHP_EOL.'<li class="chk_box"><input type="checkbox" id="secret" name="secret"  class="selec_chk" value="secret" '.$secret_checked.'>'.PHP_EOL.'<label for="secret"><span></span>비밀글</label></li>';
            } else {
                $option_hidden .= '<input type="hidden" name="secret" value="secret">';
            }
        }
        if ($is_mail) {
            $option .= PHP_EOL.'<li class="chk_box"><input type="checkbox" id="mail" name="mail"  class="selec_chk" value="mail" '.$recv_email_checked.'>'.PHP_EOL.'<label for="mail"><span></span>답변메일받기</label></li>';
        }
    }
    echo $option_hidden;
    ?>

    <section id="sew_input">
        <table>
        <tbody>
            <?php if ($is_category) { ?>
            <tr>
                <td class="td_class">분류</td>
                <td>
                    <select name="ca_name" id="ca_name" required class="write_select">
                        <option value="">분류를 선택하세요</option>
                        <?php echo $category_option ?>
                    </select>    
                </td>
            </tr>
            <?php } ?>

            <?php if ($is_name) { ?>
            <tr>
                <td class="td_class">이름</td>
                <td><input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="write_basic required"></td>
            </tr>
            <?php } ?>

            <?php if ($is_password) { ?>
            <tr>
                <td class="td_class">비밀번호</td>
                <td><input type="password" name="wr_password" id="wr_password" <?php echo $password_required ?> class="write_basic <?php echo $password_required ?>" autocomplete="new-password" maxlength='4'><br><span class="pass_text">글 수정 및 삭제를 위해서 필요합니다. (숫자 4자리)</span></td>
            </tr>
            <?php } ?>

            <?php if ($is_email) { ?>
            <tr>
                <td class="td_class">이메일</td>
                <td><input type="text" name="wr_email" value="<?php echo $email ?>" id="wr_email" class="write_basic email"></td>
            </tr>
            <?php } ?>

            <?php if ($is_homepage) { ?>
            <tr>
                <td class="td_class">홈페이지</td>
                <td><input type="text" name="wr_homepage" value="<?php echo $homepage ?>" id="wr_homepage" class="write_home" size="50"></td>
            </tr>
            <?php } ?>

			<?php if($w == 'u') { // ------------- 수정모드일때 업데이트날짜 표시?>
            <tr>
                <td class="td_class">수정일</td>
                <td><input type=text name='wr_10' required value='<?=G5_TIME_YMDHIS?>' class="write_update" onfocus='this.blur();'></td>
            </tr>
            <?php } ?>

            <?php if ($option) { ?>
            <tr>
                <td class="td_class">옵션</td>
                <td><ul><?php echo $option ?></ul></td>
            </tr>
            <?php } ?>

            <tr>
                <td class="td_class">제목</td>
                <td><input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="write_title" size="50" maxlength="255"></td>
            </tr>
        </tbody>
        </table>
    </section>

    <section id="sew_write">
        <div class="wr_content <?php echo $is_dhtml_editor ? $config['cf_editor'] : ''; ?>">
         <?php if($write_min || $write_max) { ?>
           <!-- 최소/최대 글자 수 사용 시 -->
           <div id="char_max">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</div>
          <?php } ?>

          <?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>

          <?php if($write_min || $write_max) { ?>
          <!-- 최소/최대 글자 수 사용 시 -->
          <div id="char_count_wrap"><span id="char_count"></span>&nbsp;글자</div>
          <?php } ?>
        </div>
    </section>

    <?php if ($is_link) { ?>
    <section id="sew_link">
        <table>
        <tbody>
            <?php for ($i=1; $is_link && $i<=G5_LINK_COUNT; $i++) { ?>
            <tr>
                <td class="td_class">링크 #<?php echo $i ?></td>
                <td><input type="text" name="wr_link<?php echo $i ?>" value="<?php if($w=="u"){ echo $write['wr_link'.$i]; } ?>" id="wr_link<?php echo $i ?>" class="write_link" size="50"></td>
            </tr>
            <?php } ?>
        </tbody>
        </table>
    </section>
    <?php } ?>

    <?php if ($is_file) { ?>
    <section id="sew_file">
        <table>
        <tbody>
        <?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
            <tr>
                <td class="td_class">파일 #<?php echo $i+1 ?></td>
                <td>
                    <input type="file" name="bf_file[]" id="bf_file_<?php echo $i+1 ?>" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="write_file">
                    <?php if($w == 'u' && $file[$i]['file']) { ?>
                        <span class="file_del">
                            <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?><span>삭제</span></label>
                        </span>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
        </table>
    </section>
    <?php } ?>

    <?php if ($is_use_captcha) { //자동등록방지  ?>
    <section id="sew_captcha">
        <?php echo $captcha_html ?>
    </section>
    <?php } ?>

    <div class="nbo_line_bottom"></div><!-- 하단 가로줄 -->

    <section id="sec_btn">
        <div class="btn_right">
            <ul>
                <li><a href="<?php echo get_pretty_url($bo_table); ?>" class="nbtn nbtn_cancel">취소</a></li>
                <li><button type="submit" id="btn_submit" accesskey="s" class="nbtn nbtn_basic">등록하기</button></li>
            </ul>
        </div>
    </section>

    </form>
</article>
<!-- } 글쓰기 끝 -->

</div>
<!-- } 최상위 박스 끝 -->


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