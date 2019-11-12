<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login_frame.php"; // 관리자 로그인여부 확인?>

<?
$total_param = trim(sqlfilter($_REQUEST['total_param']));
$s_gubun = "NOR";

$category_idx = trim(sqlfilter($_REQUEST['category_idx']));
$report_name = trim(sqlfilter($_REQUEST['report_name']));
$inputFB = trim(sqlfilter($_REQUEST['inputFB']));
$app_id = trim(sqlfilter($_REQUEST['app_id']));
$app_secret = trim(sqlfilter($_REQUEST['app_secret']));
$page_id = trim(sqlfilter($_REQUEST['page_id']));

$original_profile = trim(sqlfilter($_REQUEST['original_profile']));
$original_cover = trim(sqlfilter($_REQUEST['original_cover']));


$bbs_profile = "category_profile";
$bbs_cover = "category_cover";
$_P_DIR_FILE_PROFILE = $_P_DIR_FILE.$bbs_profile."/";
$_P_DIR_WEB_FILE_PROFILE = $_P_DIR_WEB_FILE.$bbs_profile."/";
$_P_DIR_FILE_COVER = $_P_DIR_FILE.$bbs_cover."/";
$_P_DIR_WEB_FILE_COVER = $_P_DIR_WEB_FILE.$bbs_cover."/";

################ 사진 이미지 업로드 ##############


if ($_FILES['profile_img']['size']>0){
    $_P_DIR_FILE = $_P_DIR_FILE.$bbs_profile."/";
    $_P_DIR_WEB_FILE = $_P_DIR_WEB_FILE.$bbs_profile."/";
    $file_o = $_FILES['profile_img']['name'];
    $i_width = "185";
    $i_height = "185";
    $i_width2 = "";
    $i_height2 = "";
    //$watermark_sect = "imgw";
    $watermark_sect = "";
    $file_profile = uploadFile($_FILES, "profile_img", $_FILES['profile_img'], $_P_DIR_FILE_PROFILE, $original_profile); // 파일 업로드후 변형된 파일이름 리턴.
}

if ($_FILES['cover_img']['size']>0){
    $_P_DIR_FILE = $_P_DIR_FILE.$bbs_cover."/";
    $_P_DIR_WEB_FILE = $_P_DIR_WEB_FILE.$bbs_cover."/";
    $file_o = $_FILES['cover_img']['name'];
    $i_width = "185";
    $i_height = "185";
    $i_width2 = "";
    $i_height2 = "";
    //$watermark_sect = "imgw";
    $watermark_sect = "";
    $file_cover = uploadFile($_FILES, "cover_img", $_FILES['cover_img'], $_P_DIR_FILE_COVER, $original_cover); // 파일 업로드후 변형된 파일이름 리턴.
}

$query = " UPDATE report_categories SET ";
$query .= " category_name = '" . $report_name . "', ";
if ($_FILES['profile_img']['size']>0) {
    $query .= " profile_img = '" . $file_profile . "', ";
}
if ($_FILES['cover_img']['size']>0) {
    $query .= " cover_img = '".$file_cover."', ";
}
$query .= " app_id = '".$app_id."', ";
$query .= " app_secret = '".$app_secret."', ";
$query .= " page_id = '".$page_id."' ";
$query .= " WHERE idx=".$category_idx;

$result = mysqli_query($gconnet,$query);



if($result){
    ?>
    <SCRIPT LANGUAGE="JavaScript">
        <!--
        alert('등록이 정상적으로 완료 되었습니다.');
        //parent.location.href =  "member_list.php?<?=$total_param?>";
        parent.location.href =  "../main/?<?=$total_param?>";
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
