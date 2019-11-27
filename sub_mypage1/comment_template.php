<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$block = trim(sqlfilter($_REQUEST['block']));;
$scroll_num = trim(sqlfilter($_REQUEST['page']));;

$comment_cnt_query = "SELECT COUNT(*) AS cnt FROM report_comments AS comm, report_list AS report, member_info AS member WHERE comm.member_idx=".$idx." AND comm.report_idx=report.idx AND comm.member_idx=member.idx ";
$comment_cnt_result = mysqli_query($gconnet, $comment_cnt_query);
$comment_cnt_row = mysqli_fetch_assoc($comment_cnt_result);

$comment_query = "SELECT comm.comment_txt, comm.idx, report.content_text, report.report_hashtag, report.idx AS report_idx, member.file_chg, member.real_name FROM report_comments AS comm, report_list AS report, member_info AS member WHERE comm.member_idx=".$_SESSION['user_access_idx']." AND comm.report_idx=report.idx AND comm.member_idx=member.idx ";
$limit = " LIMIT ".($block*$scroll_num).",".$block;
$comment_query .= $limit;

$comment_result = mysqli_query($gconnet, $comment_query);
?>
<ul>
    <?while ( $comment_row = mysqli_fetch_assoc($comment_result) ) {?>
        <li class="sum_item">
            <p class="con_box"><?=$comment_row['comment_txt']?><a href="" class="more_btn">...더보기</a></p>
            <div class="con_info">
                <p><?=date("m월 d일 h:i", strtotime($comment_row['wdate']) )?></p><p><?=$comment_row['idx']?>번째 제보</p>
                <p>
                    <?$hashtags = explode(",",$comment_row['report_hashtag'])?>
                    <?foreach($hashtags as $v) {?>
                        <span><?=$v?></span>
                    <?}?>
                </p>
            </div>
        </li>
    <?}?>
</ul>