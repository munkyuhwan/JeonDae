<? include$_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$page = trim(sqlfilter($_REQUEST['page']));
$block = trim(sqlfilter($_REQUEST['block']));
$idx = $_SESSION['user_access_idx'];
$comment_query = "SELECT comm.comment_txt, comm.idx, report.content_text, report.report_hashtag, report.idx AS report_idx, member.file_chg, member.real_name FROM report_comments AS comm, report_list AS report, member_info AS member WHERE comm.member_idx=".$idx." AND comm.report_idx=report.idx AND comm.member_idx=member.idx LIMIT ".$page.",".$block;
$comment_result = mysqli_query($gconnet, $comment_query);

if ( mysqli_num_rows($comment_result) > 0 ) {

?>
    <?while ( $comment_row = mysqli_fetch_assoc($comment_result) ) {?>
        <li class="item">
            <div class="item_box">
                <p class="con_box"  style=" overflow:hidden; text-overflow:ellipsis; word-wrap:break-word; display:-webkit-box; -webkit-line-clamp:12; -webkit-box-orient:vertical"><?=nl2br($comment_row['comment_txt'])?></p>
                <a href="../main_detail?idx=<?=$comment_row['report_idx']?>" class="more_btn">...더보기</a>
                <div class="con_info">
                    <p><?=date("m월 d일 h:i", strtotime($comment_row['wdate']) )?></p><p><?=$comment_row['idx']?>번째 제보</p>
                    <p>
                        <?$hashtags = explode(",",$comment_row['report_hashtag'])?>
                        <?foreach($hashtags as $v) {?>
                            <span><?=$v?></span>
                        <?}?>
                    </p>
                </div>
            </div>
        </li>
    <?}?>
<?}else {
    echo "";
}?>
