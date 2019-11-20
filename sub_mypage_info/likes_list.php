<?
$likes_cnt_query = "SELECT COUNT(*) AS cnt FROM report_likes WHERE member_idx=".$_SESSION['user_access_idx'];
$likes_cnt_result = mysqli_query($gconnet, $likes_cnt_query);
$likes_cnt_row = mysqli_fetch_assoc($likes_cnt_result);

$likes_query =  "SELECT report_idx FROM report_likes WHERE member_idx=".$_SESSION['user_access_idx']." LIMIT 0,3 ";
$likes_result = mysqli_query($gconnet, $likes_query);

?>
<p class="cnt_row"><span><?=$likes_cnt_row['cnt']?></span>개의 글이 있습니다.</p>
<ul>
    <?while($likes_row = mysqli_fetch_assoc($likes_result) ) {?>
        <?
        $like_report = "SELECT content_text, report_hashtag, wdate, idx FROM report_list WHERE del_yn='N' AND published_yn='Y' AND idx=".$likes_row['report_idx'];
        $like_report_result = mysqli_query($gconnet, $like_report);
        $like_report_row = mysqli_fetch_assoc($like_report_result);
        ?>
        <li class="item">
            <div class="item_box">
                <p class="con_box"><?=$like_report_row['content_text']?><a href="" class="more_btn">...더보기</a></p>
                <div class="con_info">
                    <p><?=date("m월 d일 h:i", strtotime($like_report_row['wdate']) )?></p>
                    <p><?=$like_report_row['idx']?>번째 제보</p>
                    <?$like_hashtags = explode(",",$like_report_row['report_hashtag'])?>
                    <?foreach($like_hashtags as $v) {?>
                        <span><?=$v?></span>
                    <?}?>
                </div>
            </div>
            <div class="reply_cnt">
                <div class="cnt_box">
                    <?
                    $comment_cnt = 'SELECT COUNT(*) AS comment_cnt FROM report_comments WHERE report_idx='.$like_report_row['idx'];
                    $cmt_cnt_result = mysqli_query($gconnet, $comment_cnt);
                    $cmt_cnt = mysqli_fetch_assoc($cmt_cnt_result);
                    ?>
                    <p class="cnt_num"><?=$cmt_cnt['comment_cnt']?></p>
                    <p>댓글</p>
                </div>
            </div>
        </li>
    <?}?>
</ul>