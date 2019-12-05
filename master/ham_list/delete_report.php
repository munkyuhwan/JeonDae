<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$idx = trim(sqlfilter($_REQUEST['idx']));

$query = "UPDATE report_list SET del_yn='Y' WHERE idx=".$idx;
$result = mysqli_query($gconnet, $query);

/*
$file_list = "SELECT * FROM report_additional_files WHERE report_idx=".$idx;
$file_list_result = mysqli_query($gconnet, $file_list);

//게시글의 스크랩 삭제
$delete_sub_categories = "DELETE FROM scrab_list WHERE report_idx=".$idx;
$delete_result = mysqli_query($gconnet, $delete_sub_categories);


while($row = mysqli_fetch_assoc($file_list_result)) {
    $delete_query = "DELETE FROM report_additional_files WHERE idx=".$row['idx'];
    $delete_result = mysqli_query($gconnet, $delete_query);

    if ($delete_result) {
        unlink("../../upload_file/report/".$row['report_file_name']);
    }

}
*/

?>
