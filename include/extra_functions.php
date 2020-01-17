<?php


function addToAlarm($alarmType, $reportIdx, $receiver, $alarmMsg, $gconnet) {

    $push_type = array(
        "PUBL" => "push1_yn",
        "CMNT" => "push2_yn",
        "LIKE" => "push3_yn",
        "TOP" => "push4_yn",
    );

    $select_push_yn = "SELECT ".$push_type[$alarmType]." FROM member_info WHERE idx=".$receiver;
    $select_push_result = mysqli_query($gconnet, $select_push_yn);
    $select_push = mysqli_fetch_assoc($select_push_result);

    if ($select_push[$push_type[$alarmType]] == 'Y') {
        $query = "INSERT INTO alarm_list SET ";
        $query .= " alarm_type='" . $alarmType . "', ";
        $query .= " report_idx=" . $reportIdx . ", ";
        $query .= " member_idx=" . $receiver . ", ";
        $query .= " alarm_msg='" . $alarmMsg . "' ";
        $result = mysqli_query($gconnet, $query);
    }

}

function checkPopular($reportIdx, $gconnet) {

    $cnt_query = "SELECT report.member_idx, report.likes, report.view_cnt, (SELECT COUNT(*)  FROM report_comments WHERE report_idx=report.idx ) AS comment_cnt FROM report_list AS report WHERE report.idx=".$reportIdx;
    $cnt_result = mysqli_query($gconnet, $cnt_query);
    $cnt_data = mysqli_fetch_assoc($cnt_result);

    $report_likes = $cnt_data['likes'];
    $report_view_cnt = $cnt_data['view_cnt'];
    $report_comment_cnt = $cnt_data['comment_cnt'];
    $member_idx = $cnt_data['member_idx'];

    $check_popularity = "SELECT COUNT(*) AS cnt FROM popular_feeds WHERE category_idx=".$reportIdx;
    $check_popularity .= " AND view_cnt > ".$report_view_cnt.', ';
    $check_popularity .= " AND comment_cnt > ".$report_comment_cnt.", ";
    $check_popularity .= " AND like_cnt > ".$report_likes." ";

    $popularity_result = mysqli_query($gconnet, $check_popularity);
    $popularity_data = mysqli_fetch_assoc($popularity_result);

    if ( intval($popularity_data['cnt']) > 0 ) {
        addToAlarm("TOP", $reportIdx, $member_idx, "", $gconnet);
    }


}



?>