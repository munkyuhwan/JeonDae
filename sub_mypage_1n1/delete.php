<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$total_param = trim(sqlfilter($_REQUEST['total_param']));
$idx = trim(sqlfilter($_REQUEST['idx']));

$query = "DELETE FROM enquries_list WHERE idx=".$idx;
$result = mysqli_query($gconnet, $query);

$response = array();
if($result) {
    $response = array(
        "msg"=>"삭제되었습니다."
    );
}else {

    $response = array(
        "msg"=>"오류가 발생했습니다."
    );
}
echo json_encode($response);

?>