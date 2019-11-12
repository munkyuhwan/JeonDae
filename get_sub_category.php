<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?php
$idx = trim(sqlfilter($_REQUEST['idx']));
$query = "SELECT sub.idx, sub.report_idx, sub.sub_name FROM report_sub_categories AS sub WHERE sub.del_yn='N' AND sub.report_idx=".$idx;
$result = mysqli_query($gconnet, $query);

$res = array();
while ($row = mysqli_fetch_assoc($result)) {
    array_push($res, $row);
}

echo json_encode($res);


?>