<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // �����Լ� ��Ŭ��� ?>
<?
$report_idx = trim(sqlfilter($_REQUEST['report_idx']));

/// ���ε��� ���� �����ϱ�
$fileQuery = "SELECT * FROM report_additional_files WHERE report_idx=".$report_idx;
$fileResult = mysqli_query($gconnet, $fileQuery);

while( $row = mysqli_fetch_assoc($fileResult) ) {
    unlink("../upload_file/report/".$row['report_file_name']);
}

// ���� �����ϱ�
$deleteQuery = "DELETE FROM report_list WHERE idx=".$report_idx;
$deleteResult = mysqli_query($gconnet, $deleteQuery);

echo json_encode($deleteResult);

?>