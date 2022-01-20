<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/design.css">', 0);
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/list.css">', 1);
?>

<!-- 최상위 박스 시작 { -->
<div id="nbo_box" style="width:<?php echo $width; ?>">


<!-- 리스트 시작 { -->
<article id="nbl">
    
    <!-- 게시판 카테고리 시작 { -->
    <?php if ($is_category) { ?>
    <section id="sel_cate">
        <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
        <ul>
            <?php echo $category_option ?>
        </ul>
    </section>
    <?php } ?>
    <!-- } 게시판 카테고리 끝 -->

    <form name="fboardlist" id="fboardlist" action="<?php echo G5_BBS_URL; ?>/board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">


    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <?php if ($is_admin == 'super' || $is_auth) {  ?>
    <section id="sel_info">
        <div id="info_total">
            Total <span><?php echo number_format($total_count) ?></span>건,&nbsp;&nbsp;<span><?php echo $page ?></span>페이지</span>
        </div>

        <ul>
            <?php if ($admin_href) { ?>
            <li><a href="<?php echo $admin_href ?>" class="lbtn_admin" title="관리자"><i class="fa fa-cog" aria-hidden="true"></i></a></li>
            <?php } ?>

            <?php if ($rss_href) { ?>            
            <li><a href="<?php echo $rss_href ?>" class="lbtn_sub" title="RSS"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
            <?php } ?>

            <?php if ($is_checkbox) { ?>    
            <li><button type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"  class="lbtn_sub" title="삭제"><i class="fa fa-trash-o" aria-hidden="true"></i></button></li>
            <li><button type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value"  class="lbtn_sub" title="복사"><i class="fa fa-files-o" aria-hidden="true"></i></button></li>
            <li><button type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value"  class="lbtn_sub" title="이동"><i class="fa fa-arrows" aria-hidden="true"></i></button></li>
            <?php } ?>
        </ul>
    </section>
    <?php }  ?>
    <!-- } 게시판 페이지 정보 및 버튼 끝 -->

    <div class="nbo_line_top"></div><!-- 상단 가로줄 -->

    <section id="sel_list">
        
        <table>
            <thead>
                <tr>
                    <?php if ($is_checkbox) { ?>
                    <th scope="col" class="all_chk chk_box"><div id="thead_line">
                        <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);" class="selec_chk">
                        <label for="chkall"><span></span></label></div>
                    </th>
                    <?php } ?>

                    <th scope="col"><div id="thead_line">번호</div></th>
            
                    <th scope="col"><div id="thead_line">제목</div></th>
            
                    <th scope="col"><div id="thead_line">글쓴이</div></th>
            
                    <th scope="col"><div id="thead_line"><?php echo subject_sort_link('wr_hit', $qstr2, 1) ?>조회</a></div></th>

                    <?php if ($is_good) { ?>
                    <th scope="col"><div id="thead_line"><?php echo subject_sort_link('wr_good', $qstr2, 1) ?><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></div></th>
                    <?php } ?>

                    <?php if ($is_nogood) { ?>
                    <th scope="col"><div id="thead_line"><?php echo subject_sort_link('wr_nogood', $qstr2, 1) ?><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></a></div></th>
                    <?php } ?>

                    <th scope="col"><?php echo subject_sort_link('wr_datetime', $qstr2, 1) ?>날짜 </a></th>
                </tr>
            </thead>

            <tbody>
                <?php
                    for ($i=0; $i<count($list); $i++) {
                    if ($i%2==0) $lt_class = "even";
                    else $lt_class = "";
                ?>
                <tr class="<?php if ($list[$i]['is_notice']) echo "list_notice"; ?> <?php echo $lt_class ?>">

                    <?php if ($is_checkbox) { ?>
                    <td class="td_chk  chk_box">
                        <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>" class="selec_chk">
                        <label for="chk_wr_id_<?php echo $i ?>"><span></span></label>
                    </td>
                    <?php } ?>

                    <td class="td_num">
                        <?php
                            if ($list[$i]['is_notice']) // 공지사항
                                echo '<span class="num_notice"><i class="fa fa-check-circle-o" aria-hidden="true"></i></span>';
                            else if ($wr_id == $list[$i]['wr_id'])
                                echo "<span class=\"num_current\"><i class=\"fa fa-arrow-right\" aria-hidden=\"true\"></i></span>";
                            else
                                echo $list[$i]['num'];
                        ?>
                    </td>
                    
                    <td class="td_subject" style="padding-left:<?php echo $list[$i]['reply'] ? (strlen($list[$i]['wr_reply'])*10) : '0'; ?>px">
                        <div id="subject_wrap">
                            <?php echo $list[$i]['icon_reply'] ?>
                    
                            <?php if ($is_category && $list[$i]['ca_name']) {?>
                            <span class="lsub_cate"><a href="<?php echo $list[$i]['ca_name_href'] ?>">[<?php echo $list[$i]['ca_name'] ?>]</a></span>
                            <?php } ?>

                            <a href="<?php echo $list[$i]['href'] ?>">                        
                            <?php if (isset($list[$i]['icon_secret'])) echo rtrim($list[$i]['icon_secret']);?>
                            <span class="lsub_title"><?php echo $list[$i]['subject'] ?></span></a>

                            <?php
                                if (isset($list[$i]['icon_file']))  echo "<img src=\"{$board_skin_url}/img/icon_file.png\">";
                                if ($list[$i]['icon_link'])  echo "<img src=\"{$board_skin_url}/img/icon_link.png\">";
                                if ($list[$i]['icon_new']) echo "<img src=\"{$board_skin_url}/img/icon_new.png\">";
                            ?>

                            <?php if ($list[$i]['comment_cnt']) { ?>
                            <span class="lsub_cmt">[<?php echo $list[$i]['wr_comment']; ?>]</span>
                            <?php } ?>
                        </div>

                    <td class="td_name sv_use"><?php echo $list[$i]['name'] ?></td>

                    <td class="td_hit"><?php echo $list[$i]['wr_hit'] ?></td>

                    <?php if ($is_good) { ?>
                    <td class="td_vote"><?php echo $list[$i]['wr_good'] ?></td>
                    <?php } ?>

                    <?php if ($is_nogood) { ?>
                    <td class="td_vote"><?php echo $list[$i]['wr_nogood'] ?></td>
                    <?php } ?>

                    <td class="td_date"><?php echo $list[$i]['datetime2'] ?></td>
                </tr>
                <?php } ?>

                <?php if (count($list) == 0) { echo '<tr><td colspan="'.$colspan.'" class="empty_table">게시물이 없습니다.</td></tr>'; } ?>

            </tbody>
        </table>
    </section>
    </form>

    <div class="nbo_line_bottom"></div><!-- 하단 가로줄 -->

    <section id="sec_btn">
        <!-- 게시판 검색 시작 { -->
        <div id="lsch_wrap">
            <form name="fsearch" method="get">
            <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
            <input type="hidden" name="sca" value="<?php echo $sca ?>">
            <input type="hidden" name="sop" value="and">
            <label for="sfl" class="sound_only">검색대상</label>

                <select name="sfl" id="sfl"><?php echo get_board_sfl_select_options($sfl); ?></select>
                <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="" size="25" maxlength="20" placeholder=" ">
                <button type="submit" value="검색" class="sch_btn"><i class="fa fa-search" aria-hidden="true"></i></button>
            </form>
        </div>
        <!-- } 게시판 검색 끝 --> 

        <!-- 버튼 시작 { -->
        <?php if ($list_href || $is_checkbox || $write_href) { ?>
        <div class="btn_right">
            <?php if ($list_href || $write_href) { ?>
            <ul>
                <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="nbtn nbtn_rss" title="RSS"><i class="fa fa-rss" aria-hidden="true"></i></a></li><?php } ?>
                <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="nbtn nbtn_basic" title="글쓰기">글쓰기</a></li><?php } ?>
            </ul>    
            <?php } ?>
        </div>
        <?php } ?>   
        <!-- } 버튼 끝 -->
    </section>

    <!-- 페이지 시작 { -->
    <section id="sec_page">
        <?php echo $write_pages; ?>
    </section>
    <!-- } 페이지 끝 -->

</article>
<!-- } 리스트 끝 -->

</div>
<!-- } 최상위 박스 끝 -->

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = g5_bbs_url+"/board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == "copy")
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = g5_bbs_url+"/move.php";
    f.submit();
}

// 게시판 리스트 관리자 옵션
jQuery(function($){
    $(".btn_more_opt.is_list_btn").on("click", function(e) {
        e.stopPropagation();
        $(".more_opt.is_list_btn").toggle();
    });
    $(document).on("click", function (e) {
        if(!$(e.target).closest('.is_list_btn').length) {
            $(".more_opt.is_list_btn").hide();
        }
    });
});
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->
