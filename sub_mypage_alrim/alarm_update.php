<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // �����Լ� ��Ŭ��� ?>
<?
$id = trim(sqlfilter($_REQUEST['id']));
$checked = trim(sqlfilter($_REQUEST['checked']));
$pushNum = str_replace("chk","", $id);
$checked = $checked == "true" ? "Y":"N";

$query = "UPDATE member_info SET push".$pushNum."_yn='".$checked."' WHERE idx=".$_SESSION['user_access_idx'];
$result = mysqli_query($gconnet, $query);

echo json_encode($result);

?>