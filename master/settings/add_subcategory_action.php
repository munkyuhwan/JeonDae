<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login_frame.php"; // 관리자 로그인여부 확인?>

<?
$total_param = trim(sqlfilter($_REQUEST['total_param']));
$s_gubun = "NOR";

$sub_category_name = trim(sqlfilter($_REQUEST['category_name']));
$main_category = trim(sqlfilter($_REQUEST['main_category']));


$query = " insert into report_sub_categories set ";
$query .= " report_idx = ".$main_category.", ";
$query .= " sub_name ='".$sub_category_name."'";

$result = mysqli_query($gconnet,$query);


if($result){
    ?>
    <SCRIPT LANGUAGE="JavaScript">
        <!--
        alert('등록이 정상적으로 완료 되었습니다.');
        //parent.location.href =  "member_list.php?<?=$total_param?>";
        parent.location.href =  "../settings/category_setting.php?<?=$total_param?>";
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
