<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/design.css">', 0);
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/view.css">', 1);
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/view_comment.css">', 2);
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<!-- 최상위 박스 시작 { -->
<div id="nbo_box" style="width:<?php echo $width; ?>" class="nbo_box_view">

<!-- 글읽기 시작 { -->
<article id="nbv">

    <section id="sev_subject">
        <?php if ($category_name) { ?>
        <span class="view_cate"><?php echo $view['ca_name']; // 분류 출력 끝 ?></span> 
        <?php } ?>
        
        <span class="view_subject"><?php echo cut_str(get_text($view['wr_subject']), 45); // 글제목 출력  ?></span>
    </section>

    <div class="nbo_line_top"></div><!-- 상단 가로줄 -->
    
    <section id="sev_info">
        <div id="info_left">
            <?php echo $view['name'] ?>
        </div>
        <div id="info_right">
            <?php if ($is_ip_view) { ?>
            <i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $view['wr_ip'] ?>
            <?php } ?>

               <i class="fa fa-commenting-o" aria-hidden="true"></i><?php echo number_format($view['wr_comment']) ?>
            <i class="fa fa-eye" aria-hidden="true"></i><?php echo number_format($view['wr_hit']) ?>
            <span class="info_date"><?php echo date("Y.m.d H:i", strtotime($view['wr_datetime'])) ?></span>
            <?php if ($scrap_href) { ?>
            <a href="<?php echo $scrap_href;  ?>" target="_blank" class="info_scrap" onclick="win_scrap(this.href); return false;" title="스크랩"><i class="fa fa-bookmark" aria-hidden="true"></i></a>
            <?php } ?>
        </div>
    </section>


    <!-- 첨부파일 시작 { -->
    <?php
    $cnt = 0;
    if ($view['file']['count']) {
        for ($i=0; $i<count($view['file']); $i++) {
            if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view'])
                $cnt++;
        }
    }
    ?>

    <?php if($cnt) { ?>
    <section id="sev_upload">
        <ul>
        <?php
        for ($i=0; $i<count($view['file']); $i++) {
            if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) {
         ?>
            <li>
                <span class="file_icon"><i class="fa fa-download" aria-hidden="true"></i></span>
                <span class="file_source"><a href="<?php echo $view['file'][$i]['href'];  ?>"><?php echo $view['file'][$i]['source'] ?> [<?php echo $view['file'][$i]['size'] ?>]</a></span>
                <span class="file_info"><?php echo $view['file'][$i]['download'] ?>회&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date("Y.m.d H:i", strtotime($view['file'][$i]['datetime'])) ?></span>
            </li>

        <?php } } ?>
        </ul>
    </section>
    <?php } ?>
    <!-- } 첨부파일 끝 -->

    <!-- 관련링크 시작 { -->
    <?php if(isset($view['link']) && array_filter($view['link'])) { ?>
    <section id="sev_upload">
       <ul>
        <?php
        $cnt = 0;
        for ($i=1; $i<=count($view['link']); $i++) {
            if ($view['link'][$i]) {
                $cnt++;
                $link = cut_str($view['link'][$i], 70);
            ?>
            <li>
                <span class="link_icon"><i class="fa fa-link" aria-hidden="true"></i></span>
                <span class="link_source"><a href="<?php echo $view['link_href'][$i] ?>" target="_blank"><?php echo $link ?></a></span>
                <span class="link_info"><?php echo $view['link_hit'][$i] ?>회</span>
            </li>
            <?php } } ?>
        </ul>
    </section>
    <?php } ?>
    <!-- } 관련링크 끝 -->

    <!-- 본문 시작 { -->
    <section id="sev_cont">
        <?php
        // 파일 출력
        $v_img_count = count($view['file']);
        if($v_img_count) {
            echo "<div id=\"cont_img\">\n";

            foreach($view['file'] as $view_file) {
                echo get_file_thumbnail($view_file);
            }

            echo "</div>\n";
        }
         ?>
        <!-- 본문 내용 시작 { -->
        <div id="cont_view"><?php echo get_view_thumbnail($view['content']); ?></div>
        <?php //echo $view['rich_content']; // {이미지:0} 과 같은 코드를 사용할 경우 ?>
        <!-- } 본문 내용 끝 -->
    </section>
    <!-- } 본문 끝 -->

    <!-- 수정일 시작 { -->
    <?php if ($view['wr_datetime']< $view['wr_10']) { ?>
    <section id="sev_ldate">
        <div class="idate_wrap">
            수정일 : <?php echo date("Y.m.d H:i", strtotime($view['wr_10'])) ?>
        </div>
    </section>
    <?php } ?>
    <!-- } 수정일 끝 -->

    <!-- 서명 시작 { -->
    <?php if ($is_signature && $signature) { ?>
    <section id="sev_sign">
        <div class="sign_wrap">
            <?php echo get_member_profile_img($view['mb_id']); ?>
            <span><?php echo nl2br($signature); ?></span>
        </div>
    </section>
    <?php } ?>
    <!-- } 서명 끝 -->

    <!--  추천 비추천 시작 { -->
    <?php if ( $good_href || $nogood_href) { ?>
    <section id="sev_vote">
        <?php if ($good_href) { ?>
        <div id="vote_good">
            <a href="<?php echo $good_href.'&amp;'.$qstr ?>" id="good_button" ><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
            <strong><?php echo number_format($view['wr_good']) ?></strong></a>
            <!--<b id="act_good"></b> -->
        </div>
        <?php } ?>

        <?php if ($nogood_href) { ?>
        <div id="vote_ngood">
            <a href="<?php echo $nogood_href.'&amp;'.$qstr ?>" id="nogood_button"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i>
            <strong><?php echo number_format($view['wr_nogood']) ?></strong></a>
            <!--<b id="act_ngood"></b> -->
        </div>
        <?php } ?>
    </section>

    <?php } else { if($board['bo_use_good'] || $board['bo_use_nogood']) { ?>
    <section id="sev_vote">
        <?php if($board['bo_use_good']) { ?>
        <div id="vote_good">
            <span class="nbtn_good"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
            <strong><?php echo number_format($view['wr_good']) ?></strong>
        </div>
        <?php } ?>

        <?php if($board['bo_use_nogood']) { ?>
        <div id="vote_ngood">
            <span class="nbtn_ngood"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i>
            <strong><?php echo number_format($view['wr_nogood']) ?></strong></a>
        </div>
        <?php } ?>
    </section>
    <?php }} ?>
    <!-- } 추천 비추천 끝 -->

    <?php
    // 코멘트 입출력
    include_once(G5_BBS_PATH.'/view_comment.php');
    ?>

    <div class="nbo_line_bottom"></div><!-- 하단 가로줄 -->

    <!--  하단 버튼 시작 { -->
    <section id="sec_btn">
        <div class="btn_left">
            <ul>
                <?php if($update_href || $delete_href || $copy_href || $move_href || $search_href) { ?>
                <?php if ($update_href) { ?><li><a href="<?php echo $update_href ?>"class="nbtn nbtn_modify">수정</a><?php } ?></li>
                <?php if ($delete_href) { ?><li><a href="<?php echo $delete_href ?>"class="nbtn nbtn_del" onclick="del(this.href); return false;">삭제</a></li><?php } ?>
                <?php } ?>
            </ul>
        </div>

        <div class="btn_right">
            <ul>     
                <?php if ($reply_href) { ?><li><a href="<?php echo $reply_href ?>" class="nbtn nbtn_basic" title="답변">답변</a></li><?php } ?>
                <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="nbtn nbtn_basic" title="글쓰기">글쓰기</a></li><?php } ?>
                <li><a href="<?php echo $list_href ?>" class="nbtn nbtn_basic" title="목록">목록</a></li>
            </ul>
        </div>
    </section>
    <!-- }  하단 버튼 끝 -->

</article>
<!-- } 글읽기 끝 -->

</div>
<!-- } 최상위 박스 끝 -->



<script>
<?php if ($board['bo_download_point'] < 0) { ?>
$(function() {
    $("a.view_file_download").click(function() {
        if(!g5_is_member) {
            alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
            return false;
        }

        var msg = "파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";

        if(confirm(msg)) {
            var href = $(this).attr("href")+"&js=on";
            $(this).attr("href", href);

            return true;
        } else {
            return false;
        }
    });
});
<?php } ?>

function board_move(href)
{
    window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}
</script>

<script>
$(function() {
    $("a.view_image").click(function() {
        window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
        return false;
    });

    // 추천, 비추천
    $("#good_button, #nogood_button").click(function() {
        var $tx;
        if(this.id == "good_button")
            $tx = $("#act_good");
        else
            $tx = $("#act_ngood");

        excute_good(this.href, $(this), $tx);
        return false;
    });

    // 이미지 리사이즈
    $("#sev_cont").viewimageresize();
});

function excute_good(href, $el, $tx)
{
    $.post(
        href,
        { js: "on" },
        function(data) {
            if(data.error) {
                alert(data.error);
                return false;
            }

            if(data.count) {
                $el.find("strong").text(number_format(String(data.count)));
                if($tx.attr("id").search("nogood") > -1) {
                    $tx.text("이 글을 비추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                } else {
                    $tx.text("이 글을 추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                }
            }
        }, "json"
    );
}
</script>
<!-- } 게시글 읽기 끝 -->