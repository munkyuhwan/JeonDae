<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?php
$input_text = trim(sqlfilter($_REQUEST['input_text']));
$member_idx = trim(sqlfilter($_REQUEST['member_idx']));
$report_idx = trim(sqlfilter($_REQUEST['report_idx']));

$query = "INSERT INTO report_comments SET ";
$query .= " report_idx = ".$report_idx.", ";
$query .= " member_idx = ".$member_idx.", ";
$query .= " comment_txt = '".$input_text."' ";
$result = mysqli_query($gconnet, $query);

if($result){
    ?>
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
<?}


?>