<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$user_idx = $_SESSION['user_access_idx'];
$report_idx = sqlfilter(trim($_REQUEST['report_idx']));

$query = "SELECT COUNT(*) cnt FROM report_list WHERE idx=".$report_idx." AND member_idx=".$user_idx;
$result = mysqli_query($gconnet, $query);
$row = mysqli_fetch_assoc($result);

$cnt = $row['cnt'];
$response = array();
if ($cnt > 0) {
    $response = array(
        "result"=> true
    );
}else {
    $response = array(
        "result"=> false
    );
}

echo json_encode($response);
?>