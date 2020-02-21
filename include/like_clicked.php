<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$report_idx = trim(sqlfilter($_REQUEST['report_idx']));

//이미 좋아요 눌럿는지 확인
$select_likes = "SELECT COUNT(*) AS cnt FROM report_likes WHERE report_idx=".$report_idx." AND member_idx=".$_SESSION['user_access_idx'];
$likes_result = mysqli_query($gconnet, $select_likes);
$my_like = mysqli_fetch_assoc($likes_result);

$response = array();


/*
function addToAlarm($alarmType, $reportIdx, $memberIdx, $alarmMsg, $gconnet) {
    $query = "INSERT INTO alarm_list SET ";
    $query .= " alarm_type='".$alarmType."', ";
    $query .= " report_idx=".$reportIdx.", ";
    $query .= " member_idx=".$memberIdx.", ";
    $query .= " alarm_msg='".$alarmMsg."' ";

    $result = mysqli_query($gconnet, $query);

}
*/
if (intval($my_like['cnt']) > 0) {

    $delete_query = "DELETE FROM report_likes WHERE report_idx=".$report_idx." AND member_idx=".$_SESSION['user_access_idx'];
    $delete_result = mysqli_query($gconnet, $delete_query);

    $select_query = "SELECT likes, member_idx FROM report_list WHERE idx=" . $report_idx;
    $select_result = mysqli_query($gconnet, $select_query);
    $select_row = mysqli_fetch_assoc($select_result);
    $likes_cnt = $select_row['likes'];

    $update_query = "UPDATE report_list SET likes=" . ($likes_cnt - 1) . " WHERE idx=" . $report_idx;
    $update_result = mysqli_query($gconnet, $update_query);

    $response = array(
        "result"=>"fail",
        "like_cnt" => ($likes_cnt - 1),
        "msg" => "좋아요가 취소되었습니다."
    );
}else {

    checkPopular($report_idx, $gconnet);

    $select_query = "SELECT likes, member_idx FROM report_list WHERE idx=" . $report_idx;
    $select_result = mysqli_query($gconnet, $select_query);
    $select_row = mysqli_fetch_assoc($select_result);
    $likes_cnt = $select_row['likes'];
    $writer_idx = $select_row['member_idx'];

    $insert_likes = "INSERT INTO report_likes SET report_idx=" . $report_idx . ", member_idx=" . $_SESSION['user_access_idx'];
    $insert_result = mysqli_query($gconnet, $insert_likes);
    
    $update_query = "UPDATE report_list SET likes=" . ($likes_cnt + 1) . " WHERE idx=" . $report_idx;
    $update_result = mysqli_query($gconnet, $update_query);

    //5개 단위로 알림 보냄
    //if ( (($likes_cnt + 1)%5) == 0 ) {
    addToAlarm("LIKE", $report_idx, $writer_idx, "내 제보를 ".($likes_cnt + 1)."명이 마음에 들어합니다.", $gconnet);
    //}

    if ($update_result) {
        $response = array(
            "result" => "success",
            "like_cnt" => ($likes_cnt + 1),
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
exit();
?>