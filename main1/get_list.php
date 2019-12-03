<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
//
$page = trim(sqlfilter($_REQUEST['page']));
$block = trim(sqlfilter($_REQUEST['block']));

$user_clean_query = "SELECT clean_index, category_idx FROM user_clean_index WHERE member_idx=".$_SESSION['user_access_idx'];
//cleanindex 0:없음 1:중간 2:클린
$user_clean_result = mysqli_query($gconnet, $user_clean_query);

$cleanIndex=array();
//user_clean_index.clean_index 2:클린 1:중간 0:없음
$clean_query="";
while($rows=mysqli_fetch_assoc($user_clean_result)) {
    //$cleanIndex[$row['category_idx']] = $row['clean_index'];

    $select_category_clean_index = "SELECT * FROM clean_index WHERE category_idx=".$rows['category_idx'];
    $category_clean_result = mysqli_query($gconnet, $select_category_clean_index);
    $clean_row = mysqli_fetch_assoc($category_clean_result);
    $lowest = $clean_row['non_content_cnt'];
    $highest = $clean_row['clean_content_cnt'];

    switch ($row['clean_index']) {
        case 0:
            $clean_query .= " ( report.category=".$rows['category_idx']." AND (report.bad_report >=".$lowest.") ) OR ";
            break;
        case 1:
            $clean_query .= " ( report.category=".$rows['category_idx']." AND (report.bad_report >=".$lowest." AND report.bad_report <=".$highest.") ) OR ";
            break;
        case 2:
            $clean_query .= " ( report.category=".$rows['category_idx']." AND (report.bad_report <=".$highest.") ) OR ";
            break;
        default:
            break;
    }

}
$clean_query = substr($clean_query,0,-3);




$subscribe_list_query = "SELECT subscribe.category_idx, category_name.sub_name FROM subscribe_list AS subscribe, report_sub_categories AS category_name WHERE subscribe.member_idx=".$_SESSION['user_access_idx']." AND subscribe.sub_category_idx=category_name.idx  ";
$subscribe_list_result = mysqli_query($gconnet,$subscribe_list_query);

$hashtag_like_query = "";
while($subscribe_row = mysqli_fetch_assoc($subscribe_list_result)) {
    $hashtag_like_query .= " report.report_hashtag LIKE '%#".$subscribe_row['sub_name'].",%' OR ";
}

$hashtag_like_query = substr($hashtag_like_query, 0 , -3);

$query = "SELECT report.idx AS report_idx, report.category AS categrory_idx, report.content_text, report.report_hashtag, report.bad_report ";
$query .= " ,report.likes, (SELECT COUNT(*) FROM report_comments WHERE report_idx=report.idx AND del_yn='N') AS comment_cnt ";
$query .= " ,member.file_chg, member.real_name ";
$query .= " ,clean.non_content_cnt, clean.clean_content_cnt ";

$query .= "FROM report_list AS report , clean_index AS clean, member_info AS member ";

$query .= " WHERE report.category=clean.category_idx AND report.member_idx=member.idx ";
$query .= " AND ( ".$clean_query." )";
$query .= " AND (".$hashtag_like_query.")  ";
$query .= " ORDER BY report.idx DESC ";
$query_limit .= $query." LIMIT ".($page*$block)." , ".$block ;

//echo $query;
$result = mysqli_query($gconnet,$query_limit);

$cnt_result = mysqli_query($gconnet,$query);
$cnt = mysqli_fetch_all($cnt_result);
$num = count($cnt);

// publ

?>
<?if(mysqli_num_rows($result) <= 0){
    echo "{'result':false'}";
    exit();
}?>
<?while($row = mysqli_fetch_assoc($result)) {?>
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
                <p id="content_<?=$row['report_idx']?>" ><?= nl2br($row['content_text']) ?></p>
                <button type="button" class="more_btn" onclick="$('#content_<?=$row['report_idx']?>').gettag ">...더보기</button>
            </div>
            <?
            $img_query = "SELECT * FROM report_additional_files WHERE report_idx=".$row['report_idx'];
            $img_result = mysqli_query($gconnet, $img_query);
            $img_row = mysqli_fetch_all($img_result);
            ?>
            <?if(count($img_row) > 0) {?>
                <div class="img_wrap">
                    <div class="flex_wrap">
                        <?if(count($img_row) == 1) {?>
                            <div class="flex2_wrap item1">
                                <a href="javascript:setImages(<?=$row['report_idx']?>)" class="pop_call" data-pop="img_pop" >
                                    <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[0][2]?>" alt="">
                                </a>
                            </div>

                        <?} else if(count($img_row) == 2 ) {?>
                            <div class="flex2_wrap item1">
                                <a href="javascript:setImages(<?=$row['report_idx']?>)" class="pop_call" data-pop="img_pop" >
                                    <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[0][2]?>" alt="">
                                </a>
                            </div>
                            <div class="flex2_wrap item1">
                                <a href="javascript:setImages(<?=$row['report_idx']?>)" class="pop_call" data-pop="img_pop" >
                                    <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[1][2]?>" alt="">
                                </a>
                            </div>
                        <?} else if(count($img_row) == 3 ) {?>
                            <div class="flex2_wrap item2">
                                <a href="javascript:setImages(<?=$row['report_idx']?>)" class="pop_call" data-pop="img_pop" >
                                    <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[0][2]?>" alt="">
                                </a>
                                <a href="javascript:setImages(<?=$row['report_idx']?>)" class="pop_call" data-pop="img_pop" >
                                    <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[1][2]?>" alt="">
                                </a>
                            </div>
                            <div class="flex2_wrap item1">
                                <a href="javascript:setImages(<?=$row['report_idx']?>)" class="pop_call" data-pop="img_pop" >
                                    <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[2][2]?>" alt="">
                                </a>
                            </div>
                        <?} else if(count($img_row) == 4 ) {?>
                            <div class="flex2_wrap item2">
                                <a href="javascript:setImages(<?=$row['report_idx']?>)" class="pop_call" data-pop="img_pop">
                                    <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[0][2]?>" alt="">
                                </a>
                                <a href="javascript:setImages(<?=$row['report_idx']?>)" class="pop_call" data-pop="img_pop">
                                    <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[1][2]?>" alt="">
                                </a>
                            </div>
                            <div class="flex2_wrap item2">
                                <a href="javascript:setImages(<?=$row['report_idx']?>)" class="pop_call" data-pop="img_pop" >
                                    <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[2][2]?>" alt="">
                                </a>
                                <a href="javascript:setImages(<?=$row['report_idx']?>)">
                                    <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[3][2]?>" alt="">
                                </a>
                            </div>
                        <?} else if(count($img_row) == 5 ) {?>
                            <div class="flex2_wrap item2">
                                <a href="javascript:setImages(<?=$row['report_idx']?>)" class="pop_call" data-pop="img_pop" >
                                    <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[0][2]?>" alt="">
                                </a>
                                <a href="javascript:setImages(<?=$row['report_idx']?>)" class="pop_call" data-pop="img_pop" >
                                    <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[1][2]?>" alt="">
                                </a>
                            </div>
                            <div class="flex2_wrap item3">
                                <a href="javascript:setImages(<?=$row['report_idx']?>)" class="pop_call" data-pop="img_pop" >
                                    <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[2][2]?>" alt="">
                                </a>
                                <a href="javascript:setImages(<?=$row['report_idx']?>)" class="pop_call" data-pop="img_pop" >
                                    <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[3][2]?>" alt="">
                                </a>
                                <a href="javascript:setImages(<?=$row['report_idx']?>)" class="pop_call" data-pop="img_pop" >
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
                <img src="<?=$profile_img?>" alt="">
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
<?}?>
