<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$parentIdx = trim(sqlfilter($_REQUEST['parent_idx']));
$reportIdx = trim(sqlfilter($_REQUEST['report_idx']));
$commentTxt = trim(sqlfilter($_REQUEST['content_txt']));
$userIdx = $_SESSION['user_access_idx'];
/*
$writerQuery = "SELECT member_idx FROM report_list WHERE idx=".$reportIdx;
$writerResult = mysqli_query($gconnet, $writerQuery);
$writerAssoc = mysqli_fetch_assoc($writerResult);
$receiver = $writerAssoc['member_idx'];
addToAlarm("CMNT", $reportIdx, $receiver, "새로운 댓글이 있습니다.", $gconnet);
*/
$query = "INSERT INTO report_comments SET ";
if ($parentIdx!='') {
    $query .= " parent_idx= ".$parentIdx.", ";
}
$query .= " report_idx= ".$reportIdx.", ";
$query .= " member_idx= ".$userIdx.", ";
$query .= " comment_txt= '".$commentTxt."' ";
$result = mysqli_query($gconnet, $query);


$get_receiver = "SELECT member_idx FROM report_list WHERE idx=".$reportIdx;
$receiver_result = mysqli_query($gconnet, $get_receiver);
$receiver = mysqli_fetch_assoc($receiver_result);
addToAlarm("CMNT", $reportIdx, $receiver['member_idx'], "", $gconnet);


if($result){?>
    <SCRIPT LANGUAGE="JavaScript">
        <!--
        alert('등록이 정상적으로 완료 되었습니다.');
        parent.location.href =  "./?idx=<?=$reportIdx?>";
        //-->
    </SCRIPT>
<?}else{?>
    <SCRIPT LANGUAGE="JavaScript">
        <!--
        alert('등록중 오류가 발생했습니다.');
        //-->
    </SCRIPT>
<?}?>