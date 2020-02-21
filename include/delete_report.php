<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$report_idx = sqlfilter(trim($_REQUEST['report_idx']));

$deleteList = "UPDATE report_list SET del_yn='Y'   WHERE idx=".$report_idx;
$listResult = mysqli_query($gconnet, $deleteList);

$response = array();

if ($listResult) {
    $response = array(
        "result" => true
    );
}else {

    $response = array(
        "result" => false
    );
}

echo json_encode($response);

?>