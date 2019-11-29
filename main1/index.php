<? include $_SERVER['DOCUMENT_ROOT'] . "/include/head.php" ?>
<?
/*
$block = 10;
$scroll_num = 0;
$query = "SELECT report.idx AS report_idx, report.wdate, report.content_text, report.report_hashtag, report.likes, (SELECT COUNT(*) AS cnt FROM report_comments WHERE report_idx=report.idx) AS comment_cnt,  member.real_name, member.file_chg  FROM report_list AS report, member_info AS member WHERE report.del_yn='N' AND report.member_idx=member.idx ";
$query_limit .= $query." LIMIT ".($block*$scroll_num)." , ".$block ;
$result = mysqli_query($gconnet,$query_limit);

$cnt_result = mysqli_query($gconnet,$query);
$cnt = mysqli_fetch_all($cnt_result);
$num = count($cnt);
*/
// publ
?>
<script>
    var page = 0;
    var block = 10;
    function getList() {
        $.ajax({
            url:"get_list.php",
            data:{"page":page,"block":block},
            success:function(response) {
                try {
                    var res = JSON.parse(response)

                }catch (e) {
                    $("#main_list").append(response);
                    $(".pop_call").on("click",function(){
                        var name = $(this).attr("data-pop");
                        $(".popup."+name).fadeIn();
                        $(".mask").fadeIn();
                        $("html").addClass("scroll_no");
                        $(".snb").removeClass("snb_on");
                        swiper.update();
                    });
                    page++;
                }

            },
            error:function(error) {

            }
        })
    }
</script>
<body onload="getList();">
<div class="wrapper">
    <? include $_SERVER['DOCUMENT_ROOT']."/include/header.php"?>
    <? include $_SERVER['DOCUMENT_ROOT']."/include/main_nav.php"?>
    <section class="main_section">
        <div class="list_wrap">
            <ul id="main_list">
                <?/*while($row = mysqli_fetch_assoc($result)) {?>
                    <li class="item">
                        <div class="item_top user_box">
                            <div class="prf_box">
                                <img src="../upload_file/member/<?=$row['file_chg']?>" alt="">
                            </div>
                            <div class="info_box ">
                                <p class="name"><?=$row['real_name']?></p>
                                <div class="etc_info">
                                    <p><?=date("m월 d일 h:i", strtotime($row['wdate']) )?></p><p><?=$row['report_idx']?>번째 제보</p>
                                    <?$hashtags = explode(",",$row['report_hashtag'])?>
                                    <?foreach($hashtags as $v) {?>
                                        <button type="button"><?=$v?></button>
                                    <?}?>
                                </div>
                            </div>
                            <button type="button" class="pop_call" data-pop="post_pop" onclick="openEtcPopup(<?=$row['report_idx']?>)"></button>
                        </div>
                        <div class="item_mid">
                            <div class="text_box">
                                <p><?=$row['content_text']?></p>
                                <button type="button" class="more_btn">...더보기</button>
                            </div>
                            <?
                            $img_query = "SELECT * FROM report_additional_files WHERE report_idx=".$row['report_idx'];
                            $img_result = mysqli_query($gconnet, $img_query);
                            $img_row = mysqli_fetch_all($img_result);
                            //$img_cnt = mysqli_fetch_all($img_result);
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
                                $comment_query = "SELECT report.comment_txt, report.idx AS comment_idx, report.parent_idx, report.wdate, (SELECT real_name FROM member_info WHERE idx=report.member_idx ) AS member_name, (SELECT file_chg FROM member_info WHERE idx=report.member_idx ) AS file_chg  FROM report_comments AS report WHERE report.del_yn='N' AND parent_idx=0 AND report.report_idx=".$row['report_idx']." ORDER BY idx DESC LIMIT 0,2";
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
                                <img src="images/img_sample2.jpg" alt="">
                            </div>
                            <div class="input_box">
                                <form action="write_comment_action.php" method="post" name="frm">
                                    <input type="text" name="content_txt" required >
                                    <input type="hidden" name="report_idx" id="report_idx" value="<?=$row['report_idx']?>" >
                                    <input type="hidden" name="parent_idx" id="parent_idx" >
                                    <button type="submit">게시</button>
                                </form>
                            </div>
                        </div>
                    </li>
                <?}*/?>
            </ul>
        </div>
        <a href="../sub_write" class="post_write_btn"></a>
    </section>
</div>
<? include $_SERVER['DOCUMENT_ROOT']."/include/gnb.php" ?>
<? include $_SERVER['DOCUMENT_ROOT']."/include/etc_popup.php" ?>

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