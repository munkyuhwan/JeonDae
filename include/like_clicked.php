<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$report_idx = trim(sqlfilter($_REQUEST['report_idx']));

//이미 좋아요 눌럿는지 확인
$select_likes = "SELECT COUNT(*) AS cnt FROM report_likes WHERE report_idx=".$report_idx." AND member_idx=".$_SESSION['user_access_idx'];
$likes_result = mysqli_query($gconnet, $select_likes);
$my_like = mysqli_fetch_assoc($likes_result);

$response = array();


if (intval($my_like['cnt']) > 0) {
    $response = array(
        "result"=>"fail",
        "msg" => "이미 좋아요를 하셨습니다."
    );
}else {
    $select_query = "SELECT likes FROM report_list WHERE idx=" . $report_idx;
    $select_result = mysqli_query($gconnet, $select_query);
    $select_row = mysqli_fetch_assoc($select_result);
    $likes_cnt = $select_row['likes'];

    $insert_likes = "INSERT INTO report_likes SET report_idx=" . $report_idx . ", member_idx=" . $_SESSION['user_access_idx'];
    $insert_result = mysqli_query($gconnet, $insert_likes);
    
    $update_query = "UPDATE report_list SET likes=" . ($likes_cnt + 1) . " WHERE idx=" . $report_idx;
    $update_result = mysqli_query($gconnet, $update_query);

    if ($update_result) {
        $response = array(
            "result" => "success",
            "msg" => "좋아요를 하셨습니다."
        );
    } else {
        $response = array(
            "result" => "fail",
            "msg" => "오류가 있습니다."
        );
    }

}
echo json_encode($response);
?>