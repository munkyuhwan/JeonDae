<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$keyword = trim(sqlfilter($_REQUEST['keyword']));
if (str_replace(" ","",$keyword) == "") {
    exit();
}

$query = "SELECT * FROM uni_list WHERE uni_name LIKE '%".$keyword."%' ";
$result = mysqli_query($gconnet, $query);
$response = array();
while($row = mysqli_fetch_assoc($result)) {?>
    <li onclick="console.log('ddd'); onUniSelect(<?=$row['idx']?>); " >
        <input type="hidden" value="<?=$row['idx']?>" id="uni_<?=$row['idx']?>" >
        <input type="hidden" value="<?=$row['email']?>" id="uni_email_<?=$row['idx']?>" >
        <?=$row['uni_name']?>
    </li>
<?} ?>