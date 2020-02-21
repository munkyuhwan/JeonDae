<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$userIdx = $_SESSION['user_access_idx'];

if ($userIdx != "") {
    $fcmToken = $_REQUEST['token'];
    $device = $_REQUEST['device'];

    $select = "SELECT push_key FROM member_info WHERE idx=".$userIdx;
    $selectResult = mysqli_query($gconnet, $select);
    $row = mysqli_fetch_assoc($selectResult);

    //if ($row['push_key']== "" || $row['push_key']==null) {

        $updatePushKey = "UPDATE member_info SET push_key='".$device."://".$fcmToken."' WHERE idx=".$userIdx;
        $result = mysqli_query($gconnet, $updatePushKey);

    //}else {
        exit();
    //}

}else {
    exit();
}


?>