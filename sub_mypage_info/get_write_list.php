<? include$_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$page = trim(sqlfilter($_REQUEST['page']));
$block = trim(sqlfilter($_REQUEST['block']));

$write_query =  "SELECT report.content_text, report.report_hashtag, report.wdate, report.idx, (SELECT COUNT(*) AS comment_cnt FROM report_comments WHERE report_idx=report.idx) AS comment_cnt FROM report_list AS report WHERE report.complete_yn='Y' AND report.del_yn='N' AND report.member_idx=".$_SESSION['user_access_idx']." LIMIT ".$page.",".$block;
$write_result = mysqli_query($gconnet, $write_query);

if ( mysqli_num_rows($write_result) > 0 ) {

?>
    <?while($write_row = mysqli_fetch_assoc($write_result) ) {?>
        <li class="item">
            <div class="item_box">
                <p class="con_box" style=" overflow:hidden; text-overflow:ellipsis; word-wrap:break-word; display:-webkit-box; -webkit-line-clamp:12; -webkit-box-orient:vertical"><?=nl2br($write_row['content_text'])?></p><a href="../main_detail?idx=<?=$write_row['idx']?>" class="more_btn">...더보기</a>
                <div class="con_info">
                    <p><?=date("m월 d일 h:i", strtotime($row['wdate']) )?></p>
                    <p><?=$write_row['idx']?>번째 제보</p>
                    <p>
                        <?$hashtags = explode(",",$write_row['report_hashtag'])?>
                        <?foreach($hashtags as $v) {?>
                            <span><?=$v?></span>
                        <?}?>
                    </p>
                </div>
            </div>
            <div class="reply_cnt">
                <div class="cnt_box">
                    <p class="cnt_num"><?=$write_row['comment_cnt']?></p>
                    <p>댓글</p>
                </div>
            </div>
        </li>
    <?}?>

<?}else {
    echo "";
}?>
