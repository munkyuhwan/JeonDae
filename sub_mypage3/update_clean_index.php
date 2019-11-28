<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$categoryIdx = trim(sqlfilter($_REQUEST['categoryIdx']));
$cleanIdx = trim(sqlfilter($_REQUEST['cleanIdx']));

$query = "UPDATE user_clean_index SET clean_index=".$cleanIdx." WHERE member_idx=".$_SESSION['user_access_idx']." AND category_idx=".$categoryIdx;
$result = mysqli_query($gconnet, $query);

$response=array();
if ($result) {
    $response=array(
        "result"=>true,
        "msg"=>"설정되었습니다."
    );
}else {
    $response=array(
        "result"=>false,
        "msg"=>"오류가 있습니다."
    );
}
echo json_encode($response);
?>