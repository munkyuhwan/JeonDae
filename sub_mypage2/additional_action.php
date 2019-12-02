<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$action = trim(sqlfilter($_REQUEST['action']));
$reportIdx = trim(sqlfilter($_REQUEST['reportIdx']));
$msgStr = "";
if ($action == "scrab") {
    $select_scrab = "SELECT COUNT(*) AS cnt FROM scrab_list WHERE member_idx=".$_SESSION['user_access_idx']." AND report_idx=".$reportIdx;
    $scrab_result = mysqli_query($gconnet, $select_scrab);
    $scrab_row = mysqli_fetch_assoc($scrab_result);

    if ( intval($scrab_row['cnt']) <= 0 ) {
        $query = "INSERT INTO scrab_list SET member_idx=" . $_SESSION['user_access_idx'] . ", report_idx=" . $reportIdx;
        $msgStr = "스크랩이 되었습니다.";
    }else {
        $response = array(
            "result"=>"fail",
            "msg"=>"이미 스크랩 되었습니다."
        );
        echo json_encode($response);
        exit;
    }

} else if ($action == "scrab_cancel") {
    $select_scrab = "SELECT COUNT(*) AS cnt FROM scrab_list WHERE member_idx=".$_SESSION['user_access_idx']." AND report_idx=".$reportIdx;
    $scrab_result = mysqli_query($gconnet, $select_scrab);
    $scrab_row = mysqli_fetch_assoc($scrab_result);

    if ( intval($scrab_row['cnt']) > 0 ) {
        $query = "DELETE FROM scrab_list WHERE member_idx=".$_SESSION['user_access_idx']." AND report_idx=".$reportIdx;
        $msgStr = "스크랩이 취소되었습니다.";
    }else {
        $response = array(
            "result"=>"fail",
            "msg"=>"스크랩이 없습니다."
        );
        echo json_encode($response);
        exit;
    }

}
else if ($action == "badReport") {

    $select_scrab = "SELECT COUNT(*) AS cnt FROM bad_report_list WHERE member_idx=".$_SESSION['user_access_idx']." AND report_idx=".$reportIdx;
    $scrab_result = mysqli_query($gconnet, $select_scrab);
    $scrab_row = mysqli_fetch_assoc($scrab_result);

    if ( intval($scrab_row['cnt']) <= 0 ) {
        $select_query = "SELECT bad_report FROM report_list WHERE idx=" . $reportIdx;
        $select_result = mysqli_query($gconnet, $select_query);
        $select_row = mysqli_fetch_assoc($select_result);
        $badCnt = $select_row['bad_report'];

        $query = "INSERT INTO bad_report_list SET member_idx=" . $_SESSION['user_access_idx'] . ", report_idx=" . $reportIdx;
        $result = mysqli_query($gconnet, $query);


        $query = "UPDATE report_list SET bad_report=" . ($badCnt + 1) . " WHERE idx=" . $reportIdx;

        $msgStr = "신고가 되었습니다.";
    }else {
        $response = array(
            "result"=>"fail",
            "msg"=>"이미 신고 되었습니다."
        );
        echo json_encode($response);
        exit;
    }

}else if ($action == "cancelSub") {
    $category_query = "SELECT category FROM report_list WHERE idx=".$reportIdx;
    $category_result = mysqli_query($gconnet, $category_query);
    $category_row = mysqli_fetch_assoc($category_result);
    $category_idx = $category_row['category'];

    $query = "DELETE FROM subscribe_list WHERE member_idx=".$_SESSION['user_access_idx']." AND category_idx=".$category_idx;
    $msgStr = "구독 취소가 되었습니다.";

}

$result = mysqli_query($gconnet, $query);
if($result) {
    $response = array(
        "result"=>"success",
        "msg"=>$msgStr
    );
    echo json_encode($response);
}else {
    $response = array(
        "result"=>"fail",
        "msg"=>"오류가 발생했습니다."
    );
    echo json_encode($response);
}




?>
