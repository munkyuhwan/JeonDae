<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$report_idx = trim(sqlfilter($_REQUEST['report_idx']));

/// 업로드한 파일 삭제하기
$fileQuery = "SELECT * FROM report_additional_files WHERE report_idx=".$report_idx;
$fileResult = mysqli_query($gconnet, $fileQuery);

while( $row = mysqli_fetch_assoc($fileResult) ) {
    unlink("../upload_file/report/".$row['report_file_name']);
}

// 제보 삭제하기
$deleteQuery = "DELETE FROM report_list WHERE idx=".$report_idx;
$deleteResult = mysqli_query($gconnet, $deleteQuery);

echo json_encode($deleteResult);

?>