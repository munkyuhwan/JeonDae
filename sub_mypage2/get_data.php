<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?// include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$page = trim(sqlfilter($_REQUEST['page']));
$block = trim(sqlfilter($_REQUEST['block']));

$query = "SELECT report.*,
          (SELECT COUNT(*) AS cnt FROM report_comments WHERE report_idx=report.idx) AS comment_cnt,
          (SELECT file_chg FROM member_info WHERE idx=report.member_idx) AS file_chg,
          (SELECT real_name FROM member_info WHERE idx=report.member_idx) AS real_name
          FROM scrab_list AS scrab, report_list AS report WHERE 1 ";
$where = " AND scrab.member_idx=".$_SESSION['user_access_idx']." ";
$where .= " AND scrab.report_idx = report.idx ";
$limit  = " LIMIT ".($page*$block).",".$block;

$result = mysqli_query($gconnet, $query.$where.$limit);

while($row = mysqli_fetch_assoc($result) ) {
    //print_r($row);
?>
<li class="item">
    <div class="item_top user_box">
        <div class="prf_box">
            <img src="../upload_file/member/<?=$row['file_chg']?>" alt="">
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
        <button type="button" class="pop_call" data-pop="post_pop" onclick="openEtcPopup(<?=$row['idx']?>)" ></button>
    </div>
    <div class="item_mid">
        <div class="text_box">
            <p style=" overflow:hidden; text-overflow:ellipsis; word-wrap:break-word; display:-webkit-box; -webkit-line-clamp:12; -webkit-box-orient:vertical">
                <?=nl2br($row['content_text'])?>
            </p>
            <button type="button" class="more_btn">...더보기</button>
        </div>
        <?
        $img_query = "SELECT * FROM report_additional_files WHERE report_idx=" . $row['idx'];
        $img_result = mysqli_query($gconnet, $img_query);
        $img_cnt = mysqli_num_rows($img_result);

        $img_res = array();
        while($img_row = mysqli_fetch_assoc($img_result)) {
            array_push($img_res, $img_row);
        }

        ?>
        <? if ($img_cnt > 0) { ?>
            <div class="img_wrap">
                <div class="flex_wrap">
                    <? if ($img_cnt == 1) { ?>

                        <div class="flex2_wrap item1">
                            <a href="javascript:setImages(<?= $row['idx']?>,<?=$row['likes']?>,<?=$row['comment_cnt']?>)" class="pop_call" data-pop="img_pop">
                                <img id="img_<?=$row['idx']?>" src="../upload_file/report/<?= $img_res[0]["report_file_name"] ?>"
                                     alt="">
                            </a>
                        </div>

                    <? } else if ($img_cnt == 2) { ?>
                        <div class="flex2_wrap item1">
                            <a href="javascript:setImages(<?= $row['idx'] ?>,<?=$row['likes']?>,<?=$row['comment_cnt']?>)" class="pop_call" data-pop="img_pop">
                                <img id="img_<?=$row['idx']?>" src="../upload_file/report/<?= $img_res[0]["report_file_name"] ?>"
                                     alt="">
                            </a>
                        </div>
                        <div class="flex2_wrap item1">
                            <a href="javascript:setImages(<?= $row['idx']?>,<?=$row['likes']?>,<?=$row['comment_cnt']?>)" class="pop_call" data-pop="img_pop">
                                <img src="../upload_file/report/<?= $img_res[1]["report_file_name"]?>"
                                     alt="">
                            </a>
                        </div>
                    <? } else if ($img_cnt == 3) { ?>
                        <div class="flex2_wrap item2">
                            <a href="javascript:setImages(<?= $row['idx'] ?>,<?=$row['likes']?>,<?=$row['comment_cnt']?>)" class="pop_call" data-pop="img_pop">
                                <img id="img_<?=$row['idx']?>" src="../upload_file/report/<?= $img_res[0]["report_file_name"] ?>"
                                     alt="">
                            </a>
                            <a href="javascript:setImages(<?= $row['idx'] ?>,<?=$row['likes']?>,<?=$row['comment_cnt']?>)" class="pop_call" data-pop="img_pop">
                                <img src="../upload_file/report/<?= $img_res[1]["report_file_name"] ?>"
                                     alt="">
                            </a>
                        </div>
                        <div class="flex2_wrap item1">
                            <a href="javascript:setImages(<?= $row['idx'] ?>,<?=$row['likes']?>,<?=$row['comment_cnt']?>)" class="pop_call" data-pop="img_pop">
                                <img src="../upload_file/report/<?= $img_res[2]["report_file_name"] ?>"
                                     alt="">
                            </a>
                        </div>
                    <? } else if ($img_cnt == 4) { ?>
                        <div class="flex2_wrap item2">
                            <a href="javascript:setImages(<?= $row['idx'] ?>,<?=$row['likes']?>,<?=$row['comment_cnt']?>)" class="pop_call" data-pop="img_pop">
                                <img id="img_<?=$row['idx']?>" src="../upload_file/report/<?= $img_res[0]["report_file_name"] ?>"
                                     alt="">
                            </a>
                            <a href="javascript:setImages(<?= $row['idx'] ?>,<?=$row['likes']?>,<?=$row['comment_cnt']?>)" class="pop_call" data-pop="img_pop">
                                <img src="../upload_file/report/<?= $img_res[1]["report_file_name"] ?>"
                                     alt="">
                            </a>
                        </div>
                        <div class="flex2_wrap item2">
                            <a href="javascript:setImages(<?= $row['idx'] ?>,<?=$row['likes']?>,<?=$row['comment_cnt']?>)" class="pop_call" data-pop="img_pop">
                                <img src="../upload_file/report/<?= $img_res[2]["report_file_name"] ?>"
                                     alt="">
                            </a>
                            <a href="javascript:setImages(<?= $row['idx'] ?>,<?=$row['likes']?>,<?=$row['comment_cnt']?>)">
                                <img src="../upload_file/report/<?= $img_res[3]["report_file_name"] ?>"
                                     alt="">
                            </a>
                        </div>
                    <? } else if ($img_cnt == 5) { ?>
                        <div class="flex2_wrap item2">
                            <a href="javascript:setImages(<?= $row['idx'] ?>,<?=$row['likes']?>,<?=$row['comment_cnt']?>)" class="pop_call" data-pop="img_pop">
                                <img id="img_<?=$row['idx']?>" src="../upload_file/report/<?= $img_res[0]["report_file_name"] ?>"
                                     alt="">
                            </a>
                            <a href="javascript:setImages(<?= $row['idx'] ?>,<?=$row['likes']?>,<?=$row['comment_cnt']?>)" class="pop_call" data-pop="img_pop">
                                <img src="../upload_file/report/<?= $img_res[1]["report_file_name"] ?>"
                                     alt="">
                            </a>
                        </div>
                        <div class="flex2_wrap item3">
                            <a href="javascript:setImages(<?= $row['idx'] ?>,<?=$row['likes']?>,<?=$row['comment_cnt']?>)" class="pop_call" data-pop="img_pop">
                                <img src="../upload_file/report/<?= $img_res[2]["report_file_name"] ?>"
                                     alt="">
                            </a>
                            <a href="javascript:setImages(<?= $row['idx'] ?>,<?=$row['likes']?>,<?=$row['comment_cnt']?>)" class="pop_call" data-pop="img_pop">
                                <img src="../upload_file/report/<?= $img_res[3]["report_file_name"] ?>"
                                     alt="">
                            </a>
                            <a href="javascript:setImages(<?= $row['idx'] ?>,<?=$row['likes']?>,<?=$row['comment_cnt']?>)" class="pop_call" data-pop="img_pop">
                                <img src="../upload_file/report/<?= $img_res[4]["report_file_name"] ?>"
                                     alt="">
                            </a>
                        </div>
                    <?} ?>
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
            $comment_query = "SELECT comments.report_idx, comments.parent_idx, comments.comment_txt, comments.wdate, member.real_name, member.file_chg FROM report_comments AS comments, member_info AS member WHERE 1 ";
            $comment_where = " AND comments.report_idx=".$row['idx'];
            $comment_where .= " AND comments.member_idx=member.idx";
            $comment_orderby = " ORDER BY comments.idx, comments.parent_idx ";
            $limit = " LIMIT 0,3 ";
            $total_query = $comment_query.$comment_where.$comment_orderby.$limit;
            $comment_res = mysqli_query($gconnet, $total_query);
            $i=0;
            ?>
            <button type="button" class="reply_all">댓글 <span><?=$row['comment_cnt']?></span>개 모두 보기</button>
            <ul>
                <? while($comment_row = mysqli_fetch_assoc($comment_res) ) {?>
                    <?if ($comment_row['parent_idx']==0) {?>
                        <li class="reply_item user_box">
                            <div class="reply_inner">
                                <div class="prf_box">
                                    <img src="../upload_file/member/<?=$comment_row['file_chg']?>" alt="">
                                </div>
                                <div class="info_box ">
                                    <div class="reply_top"><p class="name"><?=$comment_row['real_name']?></p><p class="reply_txt"><?=$comment_row['comment_txt']?></p></div>
                                    <div class="etc_info">
                                        <p><?=date("m월 d일 h:i", strtotime($row['wdate']) )?></p><button type="button">답글 달기</button>
                                    </div>
                                </div>
                                <button type="button" class="like_btn"></button>
                            </div>
                    <?}else {?>
                        <ul>
                            <li class="reply_item user_box">
                                <div class="reply_inner">
                                    <div class="prf_box">
                                        <img src="../upload_file/member/<?=$comment_row['file_chg']?>" alt="">
                                    </div>
                                    <div class="info_box ">
                                        <div class="reply_top"><p class="name"><?=$comment_row['real_name']?></p><p class="reply_txt"><?=$comment_row['comment_txt']?></p></div>
                                        <div class="etc_info">
                                            <p><?=date("m월 d일 h:i", strtotime($row['wdate']) )?></p><button type="button">답글 달기</button>
                                        </div>
                                    </div>
                                    <button type="button" class="like_btn"></button>
                                </div>
                            </li>

                    <?}?>
                            <?
                            if ($i >= (mysqli_num_rows($comment_res)-1) ) {
                                echo "</ul></li>";
                            }
                            $i++;
                            ?>
                <?}?>
            </ul>

        </div>
    </div>
    <div class="item_reply_input">
        <div class="prf_box">
            <img src="../upload_file/member/<?=$row['file_chg']?>" alt="">
        </div>
        <div class="input_box">
            <form action="write_comment_action.php" method="post" name="frm">
                <input type="text" name="content_txt" required  placeholder="댓글 달기...">
                <input type="hidden" name="report_idx" id="report_idx" value="<?=$row['idx']?>" >
                <input type="hidden" name="parent_idx" id="parent_idx" >
                <button type="button">게시</button>
            </form>
        </div>
    </div>
</li>
<?}?>