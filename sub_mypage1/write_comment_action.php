<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // �����Լ� ��Ŭ��� ?>
<?
$parentIdx = trim(sqlfilter($_REQUEST['parent_idx']));
$commentTo = trim(sqlfilter($_REQUEST['comment_to']));

$reportIdx = trim(sqlfilter($_REQUEST['report_idx']));
$commentTxt = trim(sqlfilter($_REQUEST['content_txt']));
$userIdx = $_SESSION['user_access_idx'];

/*
$writerQuery = "SELECT member_idx FROM report_list WHERE idx=".$reportIdx;
$writerResult = mysqli_query($gconnet, $writerQuery);
$writerAssoc = mysqli_fetch_assoc($writerResult);
$receiver = $writerAssoc['member_idx'];
addToAlarm("CMNT", $reportIdx, $receiver, "���ο� ����� �ֽ��ϴ�.", $gconnet);
*/

if ($parentIdx) {
//�ڽ� ���

    if ($commentTo != "") {
        // �ڽĴ�ۿ��� ���

        $seq_query = "SELECT depth, seq FROM report_comments WHERE idx=".$commentTo." AND del_yn='N' ";
        $seq_result = mysqli_query($gconnet, $seq_query);
        $seq_assc = mysqli_fetch_assoc($seq_result);
        $parent_seq = $seq_assc['seq'];
        $depth = $seq_assc['depth'];


        //���� update;
        $update_seq = "UPDATE report_comments SET ";
        $update_seq .= " seq = seq+1 ";
        $update_seq .= " WHERE report_idx=".$reportIdx." AND parent_idx=".$parentIdx." AND depth=".$depth." AND seq >".$parent_seq;
        $update_seq_result = mysqli_query($gconnet, $update_seq);

        $parent_seq++;
        $depth++;

        $query = "INSERT INTO report_comments SET ";
        $query .= " report_idx=".$reportIdx.", ";
        $query .= " parent_idx=".$parentIdx.", ";
        $query .= " depth=".$depth.", ";
        $query .= " seq=".$parent_seq.", ";
        $query .= " member_idx= ".$userIdx.", ";
        $query .= " comment_txt= '".$commentTxt."' ";
        $result = mysqli_query($gconnet, $query);


    }else {

        $depth_query = "SELECT depth FROM report_comments WHERE idx=" . $parentIdx . " AND del_yn='N' ";

        $depth_result = mysqli_query($gconnet, $depth_query);
        $depth_assc = mysqli_fetch_assoc($depth_result);
        $depth = $depth_assc['depth'];

        // depth�� 0, �θ����� ��۴ޱ�
        $depth++;

        // ���� depth�� ������ ��� seq
        $seq_query = "SELECT seq FROM report_comments WHERE report_idx=".$reportIdx." AND parent_idx=".$parentIdx." AND depth=".$depth." AND del_yn='N' ORDER BY seq DESC LIMIT 1 ";
        $seq_result = mysqli_query($gconnet, $seq_query);
        $seq_row = mysqli_fetch_assoc($seq_result);
        $seq = $seq_row['seq'];

        $seq++;

        $query = "INSERT INTO report_comments SET ";
        $query .= " report_idx=".$reportIdx.", ";
        $query .= " parent_idx=".$parentIdx.", ";
        $query .= " depth=".$depth.", ";
        $query .= " seq=".$seq.", ";
        $query .= " member_idx= ".$userIdx.", ";
        $query .= " comment_txt= '".$commentTxt."' ";
        $result = mysqli_query($gconnet, $query);

    }

}else {
//�θ� ���

    // ��� ī��Ʈ
    $cnt_query = "SELECT seq FROM report_comments WHERE report_idx=".$reportIdx." AND parent_idx=0 AND del_yn='N' ORDER BY idx DESC LIMIT 1";
    $cnt_result = mysqli_query($gconnet, $cnt_query);
    $comment_cnt = mysqli_fetch_assoc($cnt_result);
    $cnt = $comment_cnt['seq']; // �θ��� ī��Ʈ

    $cnt++;

    $query = "INSERT INTO report_comments SET ";
    $query .= " report_idx= ".$reportIdx.", ";
    $query .= " member_idx= ".$userIdx.", ";
    $query .= " seq= ".$cnt.", ";
    $query .= " comment_txt= '".$commentTxt."' ";
    $result = mysqli_query($gconnet, $query);


}

if($result){?>
    <SCRIPT LANGUAGE="JavaScript">
        <!--
        alert('����� ���������� �Ϸ� �Ǿ����ϴ�.');
        parent.location.href =  "./";
        //-->
    </SCRIPT>
<?}else{?>
    <SCRIPT LANGUAGE="JavaScript">
        <!--
        alert('����� ������ �߻��߽��ϴ�.');
        //-->
    </SCRIPT>
<?}

?>
