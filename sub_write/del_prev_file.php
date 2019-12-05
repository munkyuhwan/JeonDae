<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?php
$fileName = trim(sqlfilter($_REQUEST['fileName']));
$fileIdx = trim(sqlfilter($_REQUEST['fileIdx']));


$query = "DELETE FROM report_additional_files WHERE idx=".$fileIdx;
$result = mysqli_query($gconnet, $query);

if($result) {
    unlink("../upload_file/report/".$fileName);
}


?>