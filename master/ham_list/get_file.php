<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?php
$idx = trim(sqlfilter($_REQUEST['idx']));

$file_query = "SELECT * FROM report_additional_files WHERE report_idx=".$idx;
$file_result = mysqli_query($gconnet, $file_query);

$data = array();
while ($row = mysqli_fetch_assoc($file_result)) {
    array_push($data, $row);
}

echo json_encode($data);

?>