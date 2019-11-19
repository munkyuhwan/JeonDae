<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?

$idx = trim(sqlfilter($_REQUEST['idx']));

$fname_query = "SELECT report_file_name FROM report_aditional_files WHERE idx=".$idx;
$fname_result = mysqli_query($gconnet, $fname_query);
$fname_assoc = mysqli_fetch_assoc($fname_result);
$filename = $fname_assoc['report_file_name'];

$query = "DELETE FROM report_additional_files WHERE idx=".$idx;
$result = mysqli_query($gconnet, $query);

if ($result) {
    unlink($_SERVER['DOCUMENT_ROOT']."/upload_file/report/".$filename);
    echo "{\"result\":true}";
} else {
    echo "{\"result\":false}";
}

?>