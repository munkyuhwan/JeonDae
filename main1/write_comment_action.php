<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$parentIdx = trim(sqlfilter($_REQUEST['parent_idx']));
$reportIdx = trim(sqlfilter($_REQUEST['report_idx']));
$commentTxt = trim(sqlfilter($_REQUEST['content_txt']));
$userIdx = $_SESSION['user_access_idx'];

$query = "INSERT INTO report_comments SET ";
if ($parentIdx!='') {
    $query .= " parent_idx= ".$parentIdx.", ";
}
$query .= " report_idx= ".$reportIdx.", ";
$query .= " member_idx= ".$userIdx.", ";
$query .= " comment_txt= '".$commentTxt."' ";

$result = mysqli_query($gconnet, $query);

if($result){?>
    <SCRIPT LANGUAGE="JavaScript">
        <!--
        alert('등록이 정상적으로 완료 되었습니다.');
        parent.location.href =  "./";
        //-->
    </SCRIPT>
<?}else{?>
    <SCRIPT LANGUAGE="JavaScript">
        <!--
        alert('등록중 오류가 발생했습니다.');
        //-->
    </SCRIPT>
<?}?>