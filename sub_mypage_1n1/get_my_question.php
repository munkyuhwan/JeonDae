<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$page = trim(sqlfilter($_REQUEST['page']));
$block = trim(sqlfilter($_REQUEST['block']));
$query = "SELECT * FROM enquries_list WHERE member_idx=".$_SESSION['user_access_idx']." ORDER BY idx DESC LIMIT ".$page.",".$block;
$result = mysqli_query($gconnet, $query);
if(mysqli_num_rows($result) > 0) {
?>
<?while($row = mysqli_fetch_assoc($result)) {?>
    <li>
        <div class="slide_top" >
            <p class="answer <?= str_replace(["Y","N"],["on",""],$row['reply_yn']) ?>" ><?= str_replace(["Y","N"],["답변 완료","답변 대기"],$row['reply_yn']) ?></p>
            <p class="date"><?=date("Y년 m월d일", strtotime($row['wdate']))?></p>
            <p class="tlt"><?=$row['q_title']?></p>
        </div>
        <div class="slide_bot">
            <div class="ques">
                <?=$row['q_text']?>
                <?if($row['member_idx']==$_SESSION['user_access_idx']) {?>
                    <div class="btn_row">
                        <button type="button" class="blue_btn" onclick="location.href='modify.php?idx=<?=$row['idx']?>'; " >수정</button><button type="button" onclick="deleteFaq(<?=$row['idx']?>)" >삭제</button>
                    </div>
                <?}?>
            </div>
            <? if($row['reply_yn'] == "Y" ) {?>
                <div class="answer">
                    <?=$row['q_reply']?>
                </div>
            <?}?>
        </div>
    </li>
<?}?>
<?}else {
    echo "";
}?>