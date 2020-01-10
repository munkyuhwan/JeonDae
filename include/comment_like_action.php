<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$commentIdx = trim(sqlfilter($_REQUEST['comment_idx']));
$memberIdx = $_SESSION['user_access_idx'];

$select = "SELECT COUNT(*) cnt FROM comment_likes WHERE comment_idx=".$commentIdx." AND member_idx=".$memberIdx;
$select_result = mysqli_query($gconnet, $select);
$select_row = mysqli_fetch_assoc($select_result);
$cnt = $select_row['cnt'];

$response = array();
if (intval($cnt) > 0) {
    $query = "DELETE FROM comment_likes WHERE comment_idx=".$commentIdx." AND member_idx=".$memberIdx;
    $result = mysqli_query($gconnet, $query);

    if ($result) {
        $response = array(
            "msg"=>"좋아요가 취소되었습니다."
        );
    }

}else {
    $query = "INSERT INTO comment_likes SET comment_idx=".$commentIdx.", member_idx=".$memberIdx;
    $result = mysqli_query($gconnet, $query);

    if ($result) {
        $response = array(
            "msg"=>"좋아요를 하셨습니다."
        );
    }
}
echo json_encode($response);
?>