<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // �����Լ� ��Ŭ��� ?>
<?
$parentIdx = trim(sqlfilter($_REQUEST['parent_idx']));
$reportIdx = trim(sqlfilter($_REQUEST['report_idx']));
$commentTxt = trim(sqlfilter($_REQUEST['content_txt']));
$userIdx = $_SESSION['idx'];

$query = "INSERT INTO report_comments SET ";
$query .= " report_idx= ".$reportIdx.", ";
$query .= " member_idx= ".$userIdx.", ";
$query .= " comment_txt= '".$commentTxt."' ";

$result = mysqli_query($gconnet, $query);

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
<?}?>