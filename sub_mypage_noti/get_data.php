<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$page = trim(sqlfilter($_REQUEST['page']));
$block = trim(sqlfilter($_REQUEST['block']));

$query = "SELECT write_time, subject, content FROM board_content WHERE is_del='N' AND bbs_code='notice' ";
$limit = " LIMIT ".($page*$block).",".$block;

$result = mysqli_query($gconnet, $query.$limit);

while($row = mysqli_fetch_assoc($result)) {?>
    <li>
        <div class="slide_top">
            <p class="noti_date"><?= date("Y/m/d", strtotime($row['write_time']) ) ?></p>
            <p class="tlt"><?=$row['subject']?></p>
        </div>
        <div class="slide_bot">
            <?=$row['content']?>
        </div>
    </li>
<?} ?>