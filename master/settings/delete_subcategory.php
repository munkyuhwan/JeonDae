<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login_frame.php"; // 관리자 로그인여부 확인?>
<?
$total_param = trim(sqlfilter($_REQUEST['total_param']));
$s_gubun = "NOR";

$sub_category_id = trim(sqlfilter($_REQUEST['idx']));


$query = "UPDATE report_sub_categories SET del_yn='Y' WHERE idx=".$sub_category_id;
$result = mysqli_query($gconnet,$query);

if($result) {
    echo json_encode($result);
}



?>
