<? include $_SERVER['DOCUMENT_ROOT'] . "/include/head.php" ?>
<?
//구독한 제보함 가져오기
$category_query = "SELECT report.category_idx, pop.view_cnt AS limit_view, pop.comment_cnt AS limit_comment, pop.like_cnt AS limit_like ";
$category_query .= "FROM subscribe_list AS report, popular_feeds AS pop WHERE 1 ";
$category_query .= " AND report.member_idx=".$_SESSION['user_access_idx']." AND report.category_idx=pop.category_idx ";
$category_query .= " GROUP BY report.category_idx, pop.view_cnt, pop.comment_cnt, pop.like_cnt ";
$category_result = mysqli_query($gconnet, $category_query);

$result = array();
while($row = mysqli_fetch_assoc($category_result)) {
    $report_query = "SELECT report.*, (SELECT profile_img FROM report_categories WHERE idx=report.category) AS category_profile, (SELECT COUNT(*) FROM report_comments WHERE report_idx=report.idx ) AS comment_cnt FROM report_list AS report WHERE 1";
    $report_query .= " AND report.category = ".$row['category_idx'];
    $report_query .= " AND report.likes >= ".$row['limit_like'];
    $report_query .= " AND report.view_cnt >= ".$row['limit_view'];
    $report_query .= " AND (SELECT COUNT(*) FROM report_comments WHERE report_idx=report.idx ) >= ".$row['limit_comment'];

    $report_result = mysqli_query($gconnet, $report_query);
    while( $report_row = mysqli_fetch_assoc($report_result) ) {
        array_push($result, $report_row);
    }
}

?>
<body>
<div class="wrapper">
    <? include $_SERVER['DOCUMENT_ROOT']."/include/header.php"?>
    <? include $_SERVER['DOCUMENT_ROOT']."/include/main_nav.php"?>
    <section class="main_section">
        <div class="list_wrap">
            <ul>

                <?//while($row = mysqli_fetch_assoc($result)) {?>
                <?foreach($result as $k=>$row) {?>
                    <li class="item">
                        <div class="item_top user_box">
                            <div class="prf_box">
                                <?=$row['file_chg']?>
                                <img src="../upload_file/category_profile/<?=$row['category_profile']?>" alt="">
                            </div>
                            <div class="info_box ">
                                <p class="name"><?=$row['real_name']?></p>
                                <div class="etc_info">
                                    <p><?=date("m월 d일 h:i", strtotime($row['wdate']) )?></p><p><?=$row['idx']?>번째 제보</p>
                                    <?$hashtags = explode(",",$row['report_hashtag'])?>
                                    <?foreach($hashtags as $v) {?>
                                        <button type="button"><?=$v?></button>
                                    <?}?>
                                </div>
                            </div>
                            <button type="button" class="pop_call" data-pop="post_pop"></button>
                        </div>
                        <div class="item_mid">
                            <div class="text_box">
                                <p><?=$row['content_text']?></p>
                                <button type="button" class="more_btn">...더보기</button>
                            </div>
                            <?
                            $img_query = "SELECT * FROM report_additional_files WHERE report_idx=".$row['idx'];
                            $img_result = mysqli_query($gconnet, $img_query);
                            $img_row = mysqli_fetch_all($img_result);
                            ?>
                            <?if(count($img_row) > 0) {?>
                            <div class="img_wrap">
                                <div class="flex_wrap">
                                    <?if(count($img_row) == 1) {?>
                                        <div class="flex2_wrap item1">
                                            <a href="">
                                                <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[0][2]?>" alt="">
                                            </a>
                                        </div>

                                    <?} else if(count($img_row) == 2 ) {?>
                                        <div class="flex2_wrap item1">
                                            <a href="">
                                                <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[0][2]?>" alt="">
                                            </a>
                                        </div>
                                        <div class="flex2_wrap item1">
                                            <a href="">
                                                <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[1][2]?>" alt="">
                                            </a>
                                        </div>
                                    <?} else if(count($img_row) == 3 ) {?>
                                        <div class="flex2_wrap item2">
                                            <a href="">
                                                <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[0][2]?>" alt="">
                                            </a>
                                            <a href="">
                                                <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[1][2]?>" alt="">
                                            </a>
                                        </div>
                                        <div class="flex2_wrap item1">
                                            <a href="">
                                                <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[2][2]?>" alt="">
                                            </a>
                                        </div>
                                    <?} else if(count($img_row) == 4 ) {?>
                                        <div class="flex2_wrap item2">
                                            <a href="">
                                                <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[0][2]?>" alt="">
                                            </a>
                                            <a href="">
                                                <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[1][2]?>" alt="">
                                            </a>
                                        </div>
                                        <div class="flex2_wrap item2">
                                            <a href="">
                                                <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[2][2]?>" alt="">
                                            </a>
                                            <a href="">
                                                <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[3][2]?>" alt="">
                                            </a>
                                        </div>
                                    <?} else if(count($img_row) == 5 ) {?>
                                        <div class="flex2_wrap item2">
                                            <a href="">
                                                <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[0][2]?>" alt="">
                                            </a>
                                            <a href="">
                                                <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[1][2]?>" alt="">
                                            </a>
                                        </div>
                                        <div class="flex2_wrap item3">
                                            <a href="">
                                                <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[2][2]?>" alt="">
                                            </a>
                                            <a href="">
                                                <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[3][2]?>" alt="">
                                            </a>
                                            <a href="">
                                                <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[4][2]?>" alt="">
                                            </a>
                                        </div>
                                    <?}?>
                                </div>
                            </div>
                            <?}?>
                            <div class="btn_box">
                                <button type="button" class="like_btn"><?=$row['likes']?></button>
                                <span class="reply_cnt"><?=$row['comment_cnt']?></span>
                            </div>
                        </div>
                        <div class="item_bot">
                            <div class="reply_list">
                                <?
                                $comment_query = "SELECT report.comment_txt, report.idx AS comment_idx, report.parent_idx, report.wdate, (SELECT real_name FROM member_info WHERE idx=report.member_idx ) AS member_name, (SELECT file_chg FROM member_info WHERE idx=report.member_idx ) AS file_chg  FROM report_comments AS report WHERE report.del_yn='N' AND parent_idx=0 AND report.report_idx=".$row['idx']." ORDER BY idx DESC LIMIT 0,2";
                                $comment_res = mysqli_query($gconnet, $comment_query);
                                ?>
                                <button type="button" class="reply_all">댓글 <span><?=$row['comment_cnt']?></span>개 모두 보기</button>
                                <ul>
                                    <?while ($r = mysqli_fetch_assoc($comment_res)) {?>
                                        <li class="reply_item user_box">
                                            <div class="reply_inner">
                                                <div class="prf_box">
                                                    <img src="../upload_file/member/<?=$r['file_chg']?>" alt="">
                                                </div>
                                                <div class="info_box ">
                                                    <div class="reply_top"><p class="name"><?=$r['member_name']?></p><p class="reply_txt"><?=$r['comment_txt']?></p></div>
                                                    <div class="etc_info">
                                                        <p><?=date("m월 d일 h:i", strtotime($r['wdate']) )?></p><button type="button">답글 달기</button>
                                                    </div>
                                                </div>
                                                <button type="button" class="like_btn"></button>
                                            </div>
                                            <?
                                            $sub_comment_query = "SELECT report.comment_txt, report.idx AS comment_idx, report.wdate, (SELECT real_name FROM member_info WHERE idx=report.member_idx ) AS member_name,(SELECT file_chg FROM member_info WHERE idx=report.member_idx ) AS file_chg  FROM report_comments AS report WHERE report.del_yn='N' AND parent_idx=".$r['comment_idx']." ORDER BY idx DESC LIMIT 0,2";
                                            $sub_comment_res = mysqli_query($gconnet, $sub_comment_query);
                                            ?>
                                            <? if (mysqli_num_rows($sub_comment_res) > 0 ) {?>
                                                <ul>
                                                    <?while ($sub_row = mysqli_fetch_assoc($sub_comment_res) ) {?>
                                                        <li class="reply_item user_box">
                                                            <div class="reply_inner">
                                                                <div class="prf_box">
                                                                    <img src="../upload_file/member/<?=$sub_row['file_chg']?>" alt="">
                                                                </div>
                                                                <div class="info_box ">
                                                                    <div class="reply_top"><p class="name"><?=$sub_row['member_name']?></p><p class="reply_txt"><?=$sub_row['comment_txt']?></p></div>
                                                                    <div class="etc_info">
                                                                        <p><?=date("m월 d일 h:i", strtotime($sub_row['wdate']) )?></p><button type="button">답글 달기</button>
                                                                    </div>
                                                                </div>
                                                                <button type="button" class="like_btn"></button>
                                                            </div>
                                                        </li>
                                                        <?
                                                        if (mysqli_num_rows($sub_comment_res) > 2) {
                                                            break;
                                                        }
                                                        ?>
                                                    <?}?>
                                                </ul>
                                            <?}?>
                                        </li>
                                    <?}?>
                                </ul>
                            </div>
                        </div>
                        <div class="item_reply_input">
                            <div class="prf_box">
                                <img src="../thumb/thumb.php?src=../upload_file/member/<?=$_SESSION['profile_img']?>" alt="">
                            </div>
                            <div class="input_box">
                                <form action="write_comment_action.php" method="post" name="frm">
                                    <input type="text" name="content_txt" required >
                                    <input type="hidden" name="report_idx" id="report_idx" value="<?=$row['idx']?>" >
                                    <input type="hidden" name="parent_idx" id="parent_idx" >
                                    <button type="submit">게시</button>
                                </form>
                            </div>
                        </div>
                    </li>

                <?}?>

            </ul>
        </div>
        <a href="../sub_write" class="post_write_btn"></a>
    </section>
</div>
<? include $_SERVER['DOCUMENT_ROOT']."/include/gnb.php" ?>

<div class="popup post_pop">
    <div class="popup_wrap post_btn">
        <div class="post_btn_wrap">
            <ul>
                <li><button type="button">게시물 저장(스크랩)</button></li>
                <li><a href="">해당 게시물 신고하기</a></li>
                <li><button type="button" class="pop_call" data-pop="share_pop">해당 게시물 공유</button></li>
                <li><button type="button">해당 카테고리 구독 취소</button></li>
            </ul>
        </div>
        <button type="button" class="pop_close">취소</button>
    </div>
</div>
<div class="popup img_pop">
    <div class="img_slider">
        <div class="swiper-container">
            <ul class="swiper-wrapper">
                <li class="swiper-slide">
                    <img src="../images/img_sample2.jpg" alt="">
                </li>
                <li class="swiper-slide">
                    <img src="../images/img_sample4.jpg" alt="">
                </li>
                <li class="swiper-slide">
                    <img src="../images/img_sample5.jpg" alt="">
                </li>
                <li class="swiper-slide">
                    <img src="../images/img_sample6.jpg" alt="">
                </li>
                <li class="swiper-slide">
                    <img src="../images/img_sample4.jpg" alt="">
                </li>
            </ul>
        </div>
        <div class="slide_nav_btn">
            <button class="slide_prev_btn"><img src="../images/icon_arrow_left.png"></button>
            <button class="slide_next_btn"><img src="../images/icon_arrow_right.png"></button>
        </div>
    </div>
    <div class="btn_box">
        <button type="button" class="like_btn">26</button>
        <span class="reply_cnt">15</span>
    </div>
    <button tpye="button" class="pop_close"></button>
</div>
<?include $_SERVER['DOCUMENT_ROOT']."/include/share_pop.php"?>

</body>
</html>

<!--

-->