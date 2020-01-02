<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$page = trim(sqlfilter($_REQUEST['page']));
$block = trim(sqlfilter($_REQUEST['block']));
//구독한 제보함 가져오기
$category_query = "SELECT report.category_idx, pop.view_cnt AS limit_view, pop.comment_cnt AS limit_comment, pop.like_cnt AS limit_like ";
$category_query .= "FROM subscribe_list AS report, popular_feeds AS pop WHERE 1 ";

if ( trim(sqlfilter($_REQUEST['sub_idx'])) ) {
    $category_query .= " AND report.category_idx=".trim(sqlfilter($_REQUEST['sub_idx']))." ";
}
$category_query .= " AND report.member_idx=".$_SESSION['user_access_idx']." AND report.category_idx=pop.category_idx ";
$category_query .= " GROUP BY report.category_idx, pop.view_cnt, pop.comment_cnt, pop.like_cnt ";
$category_result = mysqli_query($gconnet, $category_query);

$result = array();
while($row = mysqli_fetch_assoc($category_result)) {
    $report_query = "SELECT report.*, (SELECT profile_img FROM report_categories WHERE idx=report.category) AS category_profile, (SELECT COUNT(*) FROM report_comments WHERE report_idx=report.idx ) AS comment_cnt, (SELECT user_id FROM member_info WHERE idx=report.member_idx) AS user_id, (SELECT file_chg FROM member_info WHERE idx=report.member_idx) AS file_chg FROM report_list AS report WHERE 1";
    $report_query .= " AND report.category = ".$row['category_idx'];
    $report_query .= " AND report.likes >= ".$row['limit_like'];
    $report_query .= " AND report.view_cnt >= ".$row['limit_view'];
    $report_query .= " AND (SELECT COUNT(*) FROM report_comments WHERE report_idx=report.idx ) >= ".$row['limit_comment'];
    $report_query .= " LIMIT ".($page*$block).",".$block;
    $report_result = mysqli_query($gconnet, $report_query);
    while( $report_row = mysqli_fetch_assoc($report_result) ) {
        array_push($result, $report_row);
    }
}

?>
<?foreach($result as $k=>$row) {?>
    <li class="item">
        <div class="item_top user_box">
            <div class="prf_box">
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
            <button type="button" class="pop_call" data-pop="post_pop" onclick="openEtcPopup(<?= $row['idx'] ?>)"  ></button>
        </div>
        <div class="item_mid">
            <div class="text_box">
                <p style=" overflow:hidden; text-overflow:ellipsis; word-wrap:break-word; display:-webkit-box; -webkit-line-clamp:3; -webkit-box-orient:vertical" >
                    <?=nl2br($row['content_text'])?>
                </p>
                <button type="button" class="more_btn" onclick="location.href='../main_detail/?idx=<?=$row['idx']?>'; ">...더보기</button>
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
                                    <img src="../upload_file/report/<?= $img_res[0]["report_file_name"] ?>"
                                         alt="">
                                </a>
                            </div>

                        <? } else if ($img_cnt == 2) { ?>
                            <div class="flex2_wrap ">
                                <a href="javascript:setImages(<?= $row['idx'] ?>,<?=$row['likes']?>,<?=$row['comment_cnt']?>)" class="pop_call" data-pop="img_pop">
                                    <img  id="img_<?=$row['idx']?>" src="../upload_file/report/<?= $img_res[0]["report_file_name"] ?>"
                                         alt="">
                                </a>
                            </div>
                            <div class="flex2_wrap ">
                                <a href="javascript:setImages(<?= $row['idx']?>,<?=$row['likes']?>,<?=$row['comment_cnt']?>)" class="pop_call" data-pop="img_pop">
                                    <img src="../upload_file/report/<?= $img_res[1]["report_file_name"]?>"
                                         alt="">
                                </a>
                            </div>
                        <? } else if ($img_cnt == 3) { ?>
                            <div class="flex2_wrap item2">
                                <a href="javascript:setImages(<?= $row['idx'] ?>,<?=$row['likes']?>,<?=$row['comment_cnt']?>)" class="pop_call" data-pop="img_pop">
                                    <img  id="img_<?=$row['idx']?>"  src="../upload_file/report/<?= $img_res[0]["report_file_name"] ?>"
                                         alt="">
                                </a>
                                <a href="javascript:setImages(<?= $row['idx'] ?>,<?=$row['likes']?>,<?=$row['comment_cnt']?>)" class="pop_call" data-pop="img_pop">
                                    <img src="../upload_file/report/<?= $img_res[1]["report_file_name"] ?>"
                                         alt="">
                                </a>
                            </div>
                            <div class="flex2_wrap ">
                                <a href="javascript:setImages(<?= $row['idx'] ?>,<?=$row['likes']?>,<?=$row['comment_cnt']?>)" class="pop_call" data-pop="img_pop">
                                    <img src="../upload_file/report/<?= $img_res[2]["report_file_name"] ?>"
                                         alt="">
                                </a>
                            </div>
                        <? } else if ($img_cnt == 4) { ?>
                            <div class="flex2_wrap item2">
                                <a href="javascript:setImages(<?= $row['idx'] ?>,<?=$row['likes']?>,<?=$row['comment_cnt']?>)" class="pop_call" data-pop="img_pop">
                                    <img  id="img_<?=$row['idx']?>"  src="../upload_file/report/<?= $img_res[0]["report_file_name"] ?>"
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
                                    <img  id="img_<?=$row['idx']?>"  src="../upload_file/report/<?= $img_res[0]["report_file_name"] ?>"
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
                            <?
                        } ?>
                    </div>
                </div>
            <?}?>
            <div class="btn_box">
                <button type="button" class="like_btn" onclick="likeClick(<?= $row['idx'] ?>)" ><?=$row['likes']?></button>
                <span class="reply_cnt" ><?=$row['comment_cnt']?></span>
            </div>
        </div>
        <div class="item_bot">
            <div class="reply_list">
                <?
                $comment_query = "SELECT report.comment_txt, report.idx AS comment_idx, report.parent_idx, report.wdate, (SELECT real_name FROM member_info WHERE idx=report.member_idx ) AS member_name, (SELECT file_chg FROM member_info WHERE idx=report.member_idx ) AS file_chg, (SELECT user_id FROM member_info WHERE idx=report.member_idx ) AS user_id  FROM report_comments AS report WHERE report.del_yn='N' AND parent_idx=0 AND report.report_idx=".$row['idx']." ORDER BY idx DESC LIMIT 0,2";
                $comment_res = mysqli_query($gconnet, $comment_query);
                ?>
                <button type="button" class="reply_all">댓글 <span><?=$row['comment_cnt']?></span>개 모두 보기</button>
                <ul>
                    <?while ($r = mysqli_fetch_assoc($comment_res)) {?>
                        <li class="reply_item user_box">
                            <div class="reply_inner"  id="div_<?=$r['comment_idx']?>" >
                                <div class="prf_box">
                                    <?if($r['file_chg'] == "") {?>
                                        <img src="http://graph.facebook.com/<?=$r['user_id']?>/picture?type=normal" alt="유저 사진">
                                    <?}else {?>
                                        <img src="../upload_file/member/<?=$r['file_chg']?>" alt="">
                                    <?}?>
                                </div>
                                <div class="info_box ">
                                    <div class="reply_top"><p class="name"><?=$r['member_name']?></p><p class="reply_txt"><?=$r['comment_txt']?></p></div>
                                    <div class="etc_info">
                                        <p><?=date("m월 d일 h:i", strtotime($r['wdate']) )?></p>
                                        <button type="button" onclick=" addCommentField('<?=$r['comment_idx']?>', '<?= $row['report_idx'] ?>','<?= $profile_img_assoc["file_chg"] ?>' );" >답글 달기</button>
                                    </div>
                                </div>
                                <button type="button" class="like_btn"></button>
                            </div>
                            <?
                            $sub_comment_query = "SELECT report.comment_txt, report.idx AS comment_idx, report.wdate, (SELECT real_name FROM member_info WHERE idx=report.member_idx ) AS member_name,(SELECT file_chg FROM member_info WHERE idx=report.member_idx ) AS file_chg,(SELECT user_id FROM member_info WHERE idx=report.member_idx ) AS user_id  FROM report_comments AS report WHERE report.del_yn='N' AND parent_idx=".$r['comment_idx']." ORDER BY idx DESC LIMIT 0,2";
                            $sub_comment_res = mysqli_query($gconnet, $sub_comment_query);
                            ?>
                            <? if (mysqli_num_rows($sub_comment_res) > 0 ) {?>
                                <ul>
                                    <?while ($sub_row = mysqli_fetch_assoc($sub_comment_res) ) {?>
                                        <li class="reply_item user_box">
                                            <div class="reply_inner" id="div_<?=$r['comment_idx']?>_<?= $sub_row['comment_idx'] ?>">
                                                <div class="prf_box">
                                                    <?if($sub_row['file_chg'] == "") {?>
                                                        <img src="http://graph.facebook.com/<?=$sub_row['user_id']?>/picture?type=normal" alt="유저 사진">
                                                    <?}else {?>
                                                        <img src="../upload_file/member/<?=$sub_row['file_chg']?>" alt="">
                                                    <?}?>
                                                </div>
                                                <div class="info_box ">
                                                    <div class="reply_top"><p class="name"><?=$sub_row['member_name']?></p><p class="reply_txt"><?=$sub_row['comment_txt']?></p></div>
                                                    <div class="etc_info">
                                                        <p><?=date("m월 d일 h:i", strtotime($sub_row['wdate']) )?></p>
                                                        <button type="button" onclick="addInnerCommentField('<?=$r['comment_idx']?>',<?= $sub_row['comment_idx'] ?>, '<?= $row['report_idx'] ?>','<?= $profile_img_assoc["file_chg"] ?>' );">답글 달기</button>
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
        <div class="item_reply_input"  id="main_comment_<?=$row['report_idx']?>" >
            <div class="prf_box">
                <?if($row['file_chg'] == "") {?>
                    <img src="http://graph.facebook.com/<?=$row['user_id']?>/picture?type=normal" alt="유저 사진">
                <?}else {?>
                    <img src="../upload_file/member/<?=$row['file_chg']?>" alt="">
                <?}?>
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
