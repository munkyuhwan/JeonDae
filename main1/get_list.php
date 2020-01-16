<? include$_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
//
$page = trim(sqlfilter($_REQUEST['page']));
$block = trim(sqlfilter($_REQUEST['block']));
//$_SESSION['user_access_idx']= "";

if ($_SESSION['user_access_idx']== "") {

    $category = trim(sqlfilter($_REQUEST['category']));

    $query = "SELECT report.idx AS report_idx, report.category AS categrory_idx, report.content_text, report.report_hashtag, report.bad_report ";
    $query .= " ,report.likes, (SELECT COUNT(*) FROM report_comments WHERE report_idx=report.idx AND del_yn='N') AS comment_cnt ";
    $query .= " ,member.file_chg, member.real_name ";
    $query .= " ,clean.non_content_cnt, clean.clean_content_cnt ";

    $query .= "FROM report_list AS report , clean_index AS clean, member_info AS member ";

    $query .= " WHERE report.category=clean.category_idx AND report.member_idx=member.idx ";
    $query .= " ORDER BY report.idx DESC ";

    $query_limit .= $query . " LIMIT " . ($page * $block) . " , " . $block;

    $result = mysqli_query($gconnet, $query_limit);
    $cnt_result = mysqli_query($gconnet, $query);
    $num = mysqli_num_rows($cnt_result);

}else {

    $user_clean_query = "SELECT clean_index, category_idx FROM user_clean_index WHERE member_idx=" . $_SESSION['user_access_idx'];
//cleanindex 0:없음 1:중간 2:클린
    $user_clean_result = mysqli_query($gconnet, $user_clean_query);

    $cleanIndex = array();
//user_clean_index.clean_index 2:클린 1:중간 0:없음
    $clean_query = "";
    while ($rows = mysqli_fetch_assoc($user_clean_result)) {
        //$cleanIndex[$row['category_idx']] = $row['clean_index'];

        $select_category_clean_index = "SELECT * FROM clean_index WHERE category_idx=" . $rows['category_idx'];
        $category_clean_result = mysqli_query($gconnet, $select_category_clean_index);
        $clean_row = mysqli_fetch_assoc($category_clean_result);
        $lowest = $clean_row['non_content_cnt'];
        $highest = $clean_row['clean_content_cnt'];

        switch ($row['clean_index']) {
            case 0:
                $clean_query .= " ( report.category=" . $rows['category_idx'] . " AND (report.bad_report >=" . $lowest . ") ) OR ";
                break;
            case 1:
                $clean_query .= " ( report.category=" . $rows['category_idx'] . " AND (report.bad_report >=" . $lowest . " AND report.bad_report <=" . $highest . ") ) OR ";
                break;
            case 2:
                $clean_query .= " ( report.category=" . $rows['category_idx'] . " AND (report.bad_report <=" . $highest . ") ) OR ";
                break;
            default:
                break;
        }

    }
    $clean_query = substr($clean_query, 0, -3);


    $subscribe_list_query = "SELECT subscribe.category_idx, category_name.sub_name FROM subscribe_list AS subscribe, report_sub_categories AS category_name WHERE subscribe.member_idx=" . $_SESSION['user_access_idx'] . " AND subscribe.sub_category_idx=category_name.idx  ";
    $subscribe_list_result = mysqli_query($gconnet, $subscribe_list_query);

    $hashtag_like_query = "";
    while ($subscribe_row = mysqli_fetch_assoc($subscribe_list_result)) {
        $hashtag_like_query .= " report.report_hashtag LIKE '%#" . $subscribe_row['sub_name'] . ",%' OR ";
    }

    $hashtag_like_query = substr($hashtag_like_query, 0, -3);

    $query = "SELECT report.idx AS report_idx, report.category AS categrory_idx, report.content_text, report.report_hashtag, report.bad_report, report.wdate ";
    $query .= " ,report.likes, (SELECT COUNT(*) FROM report_comments WHERE report_idx=report.idx AND del_yn='N') AS comment_cnt ";
    $query .= " ,member.file_chg, member.real_name, member.user_id ";

    if ( mysqli_num_rows($category_clean_result) > 0 ) {
        $query .= " ,clean.non_content_cnt, clean.clean_content_cnt ";
    }

    $query .= "FROM report_list AS report , member_info AS member ";
    if ( mysqli_num_rows($category_clean_result) > 0 ) {
        $query .= " , clean_index AS clean ";
    }

    $query .= " WHERE report.member_idx=member.idx AND report.del_yn='N' AND report.complete_yn='Y' ";
    if ( mysqli_num_rows($category_clean_result) > 0 ) {
        $query .= " AND report.category=clean.category_idx ";
    }
    if (mysqli_num_rows($category_clean_result)>0) {
        $query .= " AND ( " . $clean_query . " )";
    }
    if (mysqli_num_rows($subscribe_list_result)>0) {
        $query .= " AND (" . $hashtag_like_query . ")  ";
    }

    $query .= " ORDER BY report.idx DESC ";
    $query_limit .= $query . " LIMIT " . ($page * $block) . " , " . $block;

    $result = mysqli_query($gconnet, $query_limit);

    $cnt_result = mysqli_query($gconnet, $query);
    $num = mysqli_num_rows($cnt_result);
}
// publ

?>
<?if(mysqli_num_rows($result) <= 0){
    exit();
}else {
    ?>

    <? while ($row = mysqli_fetch_assoc($result)) {
        $comment_i=0;
        ?>
        <li class="item">
            <div class="item_top user_box">
                <div class="prf_box">
                    <?if($row['file_chg'] == "") {?>
                        <img src="http://graph.facebook.com/<?=$row['user_id']?>/picture?type=normal" alt="유저 사진">
                    <?}else {?>
                        <img src="../thumb/thumb.php?src=../upload_file/member/<?=$row['file_chg']?>&size=<300" alt="유저 사진">
                    <?}?>
                </div>
                <div class="info_box ">
                    <p class="name"><?= $row['real_name'] ?></p>
                    <div class="etc_info">
                        <p><?= date("m월 d일 h:i", strtotime($row['wdate'])) ?></p>
                        <p><?= $row['report_idx'] ?>번째 제보</p>
                        <? $hashtags = explode(",", $row['report_hashtag']) ?>
                        <? foreach ($hashtags as $v) { ?>
                            <button type="button"><?= $v ?></button>
                            <?
                        } ?>
                    </div>
                </div>
                <button type="button" class="pop_call" data-pop="post_pop" onclick="openEtcPopup(<?= $row['report_idx'] ?>)" ></button>
            </div>
            <div class="item_mid">
                <div class="text_box">
                    <p id="content_<?= $row['report_idx'] ?>" class="main_content" >
                        <?= nl2br( $row['content_text']) ?>
                    </p>
                    <?
                    $lineNum = substr_count($row['content_text'],"\n");
                    $textCnt = mb_strlen($row['content_text'],"utf-8");
                    ?>
                    <? if($lineNum > 3 || $textCnt > 120) {?>
                        <button type="button" class="more_btn" onclick="$('#content_<?= $row['report_idx'] ?>').attr('class','main_content_open'); $(this).css('display','none'); ">
                            ...더보기
                        </button>
                    <?}?>
                </div>
                <?
                $img_query = "SELECT * FROM report_additional_files WHERE report_idx=" . $row['report_idx'];
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
                                    <a href="javascript:setImages('<?= $row['report_idx']?>','<?=$row['likes']?>','<?=$row['comment_cnt']?>', '<?=$img_res[0]["idx"]?>')" class="pop_call" data-pop="img_pop">
                                        <img id="img_<?=$row['report_idx']?>" src="../thumb/thumb.php?src=../upload_file/report/<?= $img_res[0]["report_file_name"] ?>&size=<500"
                                             alt="">
                                    </a>
                                </div>

                            <? } else if ($img_cnt == 2) { ?>
                                <div class="flex2_wrap ">
                                    <a href="javascript:setImages('<?= $row['report_idx']?>','<?=$row['likes']?>','<?=$row['comment_cnt']?>', '<?=$img_res[0]["idx"]?>')" class="pop_call" data-pop="img_pop">
                                        <img id="img_<?=$row['report_idx']?>" src="../thumb/thumb.php?src=../upload_file/report/<?= $img_res[0]["report_file_name"] ?>&size=<500"
                                             alt="">
                                    </a>
                                </div>
                                <div class="flex2_wrap ">
                                    <a href="javascript:setImages('<?= $row['report_idx']?>','<?=$row['likes']?>','<?=$row['comment_cnt']?>', '<?=$img_res[1]["idx"]?>')" class="pop_call" data-pop="img_pop">
                                        <img src="../thumb/thumb.php?src=../upload_file/report/<?= $img_res[1]["report_file_name"]?>&size=<500"
                                             alt="">
                                    </a>
                                </div>
                            <? } else if ($img_cnt == 3) { ?>
                                <div class="flex2_wrap item2">
                                    <a href="javascript:setImages('<?= $row['report_idx']?>','<?=$row['likes']?>','<?=$row['comment_cnt']?>', '<?=$img_res[0]["idx"]?>')" class="pop_call" data-pop="img_pop">
                                        <img id="img_<?=$row['report_idx']?>" src="../thumb/thumb.php?src=../upload_file/report/<?= $img_res[0]["report_file_name"]?>&size=<500"
                                             alt="">
                                    </a>
                                    <a href="javascript:setImages('<?= $row['report_idx']?>','<?=$row['likes']?>','<?=$row['comment_cnt']?>', '<?=$img_res[1]["idx"]?>')" class="pop_call" data-pop="img_pop">
                                        <img src="../thumb/thumb.php?src=../upload_file/report/<?= $img_res[1]["report_file_name"]?>&size=<500"
                                             alt="">
                                    </a>
                                </div>
                                <div class="flex2_wrap ">
                                    <a href="javascript:setImages('<?= $row['report_idx']?>','<?=$row['likes']?>','<?=$row['comment_cnt']?>', '<?=$img_res[2]["idx"]?>')" class="pop_call" data-pop="img_pop">
                                        <img src="../thumb/thumb.php?src=../upload_file/report/<?= $img_res[2]["report_file_name"]?>&size=<500"
                                             alt="">
                                    </a>
                                </div>
                            <? } else if ($img_cnt == 4) { ?>
                                <div class="flex2_wrap item2">
                                    <a href="javascript:setImages('<?= $row['report_idx']?>','<?=$row['likes']?>','<?=$row['comment_cnt']?>', '<?=$img_res[0]["idx"]?>')" class="pop_call" data-pop="img_pop">
                                        <img id="img_<?=$row['report_idx']?>" src="../thumb/thumb.php?src=../upload_file/report/<?= $img_res[0]["report_file_name"]?>&size=<500"
                                             alt="">
                                    </a>
                                    <a href="javascript:setImages('<?= $row['report_idx']?>','<?=$row['likes']?>','<?=$row['comment_cnt']?>', '<?=$img_res[1]["idx"]?>')" class="pop_call" data-pop="img_pop">
                                        <img src="../thumb/thumb.php?src=../upload_file/report/<?= $img_res[1]["report_file_name"]?>&size=<500"
                                             alt="">
                                    </a>
                                </div>
                                <div class="flex2_wrap item2">
                                    <a href="javascript:setImages('<?= $row['report_idx']?>','<?=$row['likes']?>','<?=$row['comment_cnt']?>', '<?=$img_res[2]["idx"]?>')" class="pop_call" data-pop="img_pop">
                                        <img src="../thumb/thumb.php?src=../upload_file/report/<?= $img_res[2]["report_file_name"]?>&size=<500"
                                             alt="">
                                    </a>
                                    <a href="javascript:setImages('<?= $row['report_idx']?>','<?=$row['likes']?>','<?=$row['comment_cnt']?>', '<?=$img_res[3]["idx"]?>')">
                                        <img src="../thumb/thumb.php?src=../upload_file/report/<?= $img_res[3]["report_file_name"]?>&size=<500"
                                             alt="">
                                    </a>
                                </div>
                            <? } else if ($img_cnt == 5) { ?>
                                <div class="flex2_wrap item2">
                                    <a href="javascript:setImages('<?= $row['report_idx']?>','<?=$row['likes']?>','<?=$row['comment_cnt']?>', '<?=$img_res[0]["idx"]?>')" class="pop_call" data-pop="img_pop">
                                        <img id="img_<?=$row['report_idx']?>" src="../thumb/thumb.php?src=../upload_file/report/<?=$img_res[0]["report_file_name"]?>&size=<500"
                                             alt="">
                                    </a>
                                    <a href="javascript:setImages('<?= $row['report_idx']?>','<?=$row['likes']?>','<?=$row['comment_cnt']?>', '<?=$img_res[1]["idx"]?>')" class="pop_call" data-pop="img_pop">
                                        <img src="../thumb/thumb.php?src=../upload_file/report/<?= $img_res[1]["report_file_name"]?>&size=<500"
                                             alt="">
                                    </a>
                                </div>
                                <div class="flex2_wrap item3">
                                    <a href="javascript:setImages('<?= $row['report_idx']?>','<?=$row['likes']?>','<?=$row['comment_cnt']?>', '<?=$img_res[2]["idx"]?>')" class="pop_call" data-pop="img_pop">
                                        <img src="../thumb/thumb.php?src=../upload_file/report/<?= $img_res[2]["report_file_name"]?>&size=<500"
                                             alt="">
                                    </a>
                                    <a href="javascript:setImages('<?= $row['report_idx']?>','<?=$row['likes']?>','<?=$row['comment_cnt']?>', '<?=$img_res[3]["idx"]?>')" class="pop_call" data-pop="img_pop">
                                        <img src="../thumb/thumb.php?src=../upload_file/report/<?= $img_res[3]["report_file_name"]?>&size=<500"
                                             alt="">
                                    </a>
                                    <a href="javascript:setImages('<?= $row['report_idx']?>','<?=$row['likes']?>','<?=$row['comment_cnt']?>', '<?=$img_res[4]["idx"]?>')" class="pop_call" data-pop="img_pop">
                                        <img src="../thumb/thumb.php?src=../upload_file/report/<?= $img_res[4]["report_file_name"]?>&size=<500"
                                             alt="">
                                    </a>
                                </div>
                            <?} ?>
                        </div>
                    </div>
                <?}?>
                <div class="btn_box">
                    <button type="button" class="like_btn" id="like_btn_<?=$row['report_idx']?>" onclick="likeClick(<?= $row['report_idx'] ?>)" ><?= $row['likes'] ?></button>
                    <span class="reply_cnt"><?= $row['comment_cnt'] ?></span>
                </div>
            </div>
            <div class="item_bot">
                <div class="reply_list">
                    <?
                    $comment_cnt_query = "SELECT COUNT(*) AS comment_cnt FROM report_comments WHERE report_idx=".$row['report_idx'];
                    $comment_cnt_result = mysqli_query($gconnet, $comment_cnt_query);
                    $comment_cnt = mysqli_fetch_assoc($comment_cnt_result);

                    $comment_query = "SELECT mom.*, (SELECT real_name FROM member_info WHERE idx=mom.member_idx ) AS member_name, (SELECT file_chg FROM member_info WHERE idx=mom.member_idx ) AS file_chg, (SELECT user_id FROM member_info WHERE idx=mom.member_idx ) AS user_id  FROM report_comments AS mom WHERE mom.report_idx=".$row['report_idx']." AND mom.parent_idx=0  ";
                    $comment_query .= " LIMIT 0,3 ";
                    $comment_res = mysqli_query($gconnet, $comment_query);
                    ?>
                    <button type="button" class="reply_all" onclick="setCommentList(<?=$row['report_idx']?>, this, '댓글 <span><?= $comment_cnt['comment_cnt'] ?></span>개 ');  ">댓글 <span><?= $comment_cnt['comment_cnt'] ?></span>개 모두 보기</button>
                    <ul id="comment_list_whole_<?=$row['report_idx']?>" style="display: none;" >
                    </ul>

                    <ul id="comment_list_<?=$row['report_idx']?>" >
                        <? while ($r = mysqli_fetch_assoc($comment_res)) { ?>
                            <li class="reply_item user_box" >
                                <div class="reply_inner" id="div_<?=$r['comment_idx']?>" >
                                    <div class="prf_box">
                                        <?if ($r['file_chg'] == "") {?>
                                        <?}else {?>
                                            <img src="../thumb/thumb.php?src=../upload_file/member/<?= $r['file_chg'] ?>&size=<500" alt="">
                                        <?}?>
                                    </div>
                                    <div class="info_box ">
                                        <div class="reply_top">
                                            <p class="name"><?= $r['member_name'] ?></p>
                                            <p class="reply_txt"><?= $r['comment_txt'] ?></p>
                                        </div>
                                        <div class="etc_info">
                                            <p><?= date("m월 d일 h:i", strtotime($r['wdate'])) ?></p>
                                            <button type="button" onclick="$('#comment_box_<?= $r['idx'] ?>').toggle() " >답글 달기</button>
                                        </div>
                                    </div>
                                    <?
                                    $select = "SELECT COUNT(*) cnt FROM comment_likes WHERE comment_idx=".$r['idx']." AND member_idx=".$_SESSION['user_access_idx'];
                                    $select_result = mysqli_query($gconnet, $select);
                                    $select_row = mysqli_fetch_assoc($select_result);
                                    $cnt = $select_row['cnt'];
                                    ?>
                                    <button type="button" class="like_btn <?=$cnt > 0 ? 'on':'';?>" id="comment_like_<?=$r['idx']?>" onclick=" commentLikeClicked(<?=$r['idx']?>); "  ></button>
                                </div>
                                <?
                                $son_comment_query = "SELECT son.*,
                                                            (SELECT real_name FROM member_info WHERE idx=son.member_idx ) AS member_name,
                                                            (SELECT file_chg FROM member_info WHERE idx=son.member_idx ) AS file_chg,
                                                            (SELECT user_id FROM member_info WHERE idx=son.member_idx ) AS user_id
                                                            FROM report_comments AS son
                                                            WHERE parent_idx=".$r['idx']." ORDER BY seq ASC " ;

                                $son_comment_result = mysqli_query($gconnet, $son_comment_query);
                                ?>
                                <ul>
                                    <div class="item_reply_input" id="comment_box_<?=$r['idx']?>" style="display: none;" >
                                        <div class="prf_box">
                                            <img src="../thumb/thumb.php?src=../upload_file/member/<?= $profile_img_assoc["file_chg"] ?>&size=<300" alt="">
                                        </div>
                                        <div class="input_box">
                                            <form action="write_comment_action.php" method="post" name="frm">
                                                <input type="text" name="content_txt" required>
                                                <input type="hidden" name="report_idx" id="report_idx" value="<?= $row['report_idx'] ?>">
                                                <input type="hidden" name="parent_idx" id="parent_idx" value="<?=$r['idx']?>">
                                                <button type="submit">게시</button>
                                            </form>
                                        </div>
                                    </div>
                                    <? while($son=mysqli_fetch_assoc($son_comment_result)) {?>
                                        <li class="reply_item user_box" >
                                            <div class="reply_inner" id="div_<?=$son['comment_idx']?>" >
                                                <div class="prf_box">
                                                    <?if ($son['file_chg'] == "") {?>
                                                    <?}else {?>
                                                        <img src="../thumb/thumb.php?src=../upload_file/member/<?= $son['file_chg'] ?>&size=<500" alt="">
                                                    <?}?>
                                                </div>
                                                <div class="info_box ">
                                                    <div class="reply_top">
                                                        <p class="name"><?= $son['member_name'] ?></p>
                                                        <p class="reply_txt"><?= $son['comment_txt'] ?></p>
                                                    </div>
                                                    <div class="etc_info">
                                                        <p><?= date("m월 d일 h:i", strtotime($son['wdate'])) ?></p>
                                                        <button type="button" onclick="$('#comment_box_<?= $son['idx'] ?>').toggle() " >답글 달기</button>
                                                    </div>
                                                </div>
                                                <?
                                                $select = "SELECT COUNT(*) cnt FROM comment_likes WHERE comment_idx=".$son['idx']." AND member_idx=".$_SESSION['user_access_idx'];
                                                $select_result = mysqli_query($gconnet, $select);
                                                $select_row = mysqli_fetch_assoc($select_result);
                                                $cnt = $select_row['cnt'];
                                                ?>
                                                <button type="button" class="like_btn  <?=$cnt > 0 ? 'on':'';?>"  id="comment_like_<?=$son['idx']?>"  onclick=" commentLikeClicked(<?=$son['idx']?>); "  ></button>
                                            </div>
                                            <div class="item_reply_input" id="comment_box_<?=$son['idx']?>" style="display: none;" >
                                                <div class="prf_box">
                                                    <img src="../thumb/thumb.php?src=../upload_file/member/<?= $profile_img_assoc["file_chg"] ?>&size=<300" alt="">
                                                </div>
                                                <div class="input_box">
                                                    <form action="write_comment_action.php" method="post" name="frm">
                                                        <input type="text" name="content_txt" required>
                                                        <input type="hidden" name="report_idx" id="report_idx" value="<?= $row['report_idx'] ?>">
                                                        <input type="hidden" name="parent_idx" id="parent_idx" value="<?= $r['idx'] ?>">
                                                        <input type="hidden" name="comment_to" id="comment_to" value="<?= $son['idx'] ?>">
                                                        <input type="hidden" name="seq" id="seq" value="<?=$son['seq']?>">
                                                        <button type="submit">게시</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </li>
                                    <?
                                        if ($comment_i >= 2) {
                                            break;
                                        }
                                        $comment_i++;
                                    }?>
                                </ul>
                            </li>

                        <?
                            if ($comment_i >= 2) {
                                break;
                            }
                            $comment_i++;

                        }?>
                    </ul>
                </div>
            </div>
            <div class="item_reply_input" id="main_comment_<?=$row['report_idx']?>" >
                <div class="prf_box">
                    <img src="../thumb/thumb.php?src=../upload_file/member/<?= $profile_img_assoc["file_chg"] ?>&size=<300" alt="">
                </div>
                <div class="input_box">
                    <form action="write_comment_action.php" method="post" name="frm">
                        <input type="text" name="content_txt" required>
                        <input type="hidden" name="report_idx" id="report_idx" value="<?= $row['report_idx'] ?>">
                        <input type="hidden" name="parent_idx" id="parent_idx">
                        <button type="submit">게시</button>
                    </form>
                </div>
            </div>
        </li>
        <?
    }
}?>
