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

    if ($select_push == 'Y') {
        $query = "INSERT INTO alarm_list SET ";
        $query .= " alarm_type='" . $alarmType . "', ";
        $query .= " report_idx=" . $reportIdx . ", ";
        $query .= " member_idx=" . $receiver . ", ";
        $query .= " alarm_msg='" . $alarmMsg . "' ";
        $result = mysqli_query($gconnet, $query);
    }

}



?>