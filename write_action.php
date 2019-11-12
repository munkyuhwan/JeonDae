<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?php
$category_idx = trim(sqlfilter($_REQUEST['category_select']));
$sub_category_select = trim(sqlfilter($_REQUEST['sub_category_select']));
$input_text = trim(sqlfilter($_REQUEST['input_text']));

$member_idx = $_SESSION['user_idx'];

$query = "INSERT INTO report_list SET ";
$query .= " member_idx = ".$member_idx.", ";
$query .= " category = ".$category_idx.", ";
$query .= " sub_category = ".$sub_category_select.", ";
$query .= " content_text = '".$input_text."' ";


$result = mysqli_query($gconnet, $query);

if($result){
    ?>
    <SCRIPT LANGUAGE="JavaScript">
        <!--
        alert('등록이 정상적으로 완료 되었습니다.');
        parent.location.href =  "./send_form.php";
        //-->
    </SCRIPT>
<?}else{?>
    <SCRIPT LANGUAGE="JavaScript">
        <!--
        alert('등록중 오류가 발생했습니다.');
        //-->
    </SCRIPT>
<?} ?>