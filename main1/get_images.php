<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$report_idx = trim(sqlfilter($_REQUEST['report_idx']));

$query = "SELECT * FROM report_additional_files WHERE report_idx=".$report_idx;
$result = mysqli_query($gconnet, $query);

$response = array();

while($row = mysqli_fetch_assoc($result) ) {
    array_push($response, $row);
}

echo json_encode($response);

?>