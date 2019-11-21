<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login_frame.php"; // 관리자 로그인여부 확인?>
<?
//print_r($_REQUEST);

$user_name = trim(sqlfilter($_REQUEST['user_name']));
$gender = trim(sqlfilter($_REQUEST['gender']));
$year_birth = trim(sqlfilter($_REQUEST['year_birth']));
$member_type = trim(sqlfilter($_REQUEST['memb_type']));
$clean_filter = trim(sqlfilter($_REQUEST['clean_filter']));

$member_id = trim(sqlfilter($_REQUEST['member_id']));

$bbs = "member";
$_P_DIR_FILE = $_P_DIR_FILE.$bbs."/";
$_P_DIR_WEB_FILE = $_P_DIR_WEB_FILE.$bbs."/";
################ 사진 이미지 업로드 ##############


if ($_FILES['profile_img']['size']>0){
    $file_o = $_FILES['profile_img']['name'];
    $i_width = "185";
    $i_height = "185";
    $i_width2 = "";
    $i_height2 = "";
    //$watermark_sect = "imgw";
    $watermark_sect = "";
    $file_c = uploadFile($_FILES, "profile_img", $_FILES['profile_img'], $_P_DIR_FILE); // 파일 업로드후 변형된 파일이름 리턴.
}

$query = "UPDATE member_info SET ";
$query .= "member_type = '".$member_type."', ";
$query .= "member_gubun = 'NOR', ";
$query .= "real_name = '".$user_name."', ";
$query .= "gender = '".$gender."', ";
$query .= "birthday = '".$year_birth."', ";
if ($_FILES['profile_img']['size']>0) {
    $query .= "file_chg = '" . $file_c . "', ";
}
$query .= "clean_filter = ".$clean_filter." ";
$query .= " WHERE idx=".$member_id;
$result = mysqli_query($gconnet,$query);


$subscribes = ($_REQUEST['subscribes']);
$hashtag = trim(sqlfilter($_REQUEST['hashtag']));

$del_subscribes = "DELETE FROM subscribe_list WHERE member_idx=".$member_id;
$sub_result = mysqli_query($gconnet,$del_subscribes);


foreach ($subscribes as $k=>$v) {
    $sub_category_query = "SELECT idx FROM report_sub_categories WHERE del_yn='N' AND report_idx=".$v;
    $sub_result = mysqli_query($gconnet,$sub_category_query);
    while ($row = mysqli_fetch_row($sub_result) ) {
        $insert_subscribe_list  = "INSERT INTO subscribe_list SET category_idx=".$v.", sub_category_idx=".$row[0].", member_idx=".$member_id;
        $inser_sub_result = mysqli_query($gconnet,$insert_subscribe_list);
    }
}

/*
$hatag_array = explode(',', $hashtag);
$del_hashtag = "DELETE FROM user_hashtags WHERE member_idx=".$member_id;
$hash_result = mysqli_query($gconnet,$del_hashtag);
foreach ($hatag_array as $k=>$v) {
    $tmp = str_replace(" ","", $v);
    if ( $tmp != '') {
        $insert_hashtag = "INSERT INTO user_hashtags SET " . " member_idx=" . $member_id . ", hash_tag='" . $v . "'";
        $insert_hashtag_result = mysqli_query($gconnet, $insert_hashtag);
    }
}
*/



/*
$total_param = trim(sqlfilter($_REQUEST['total_param']));
$s_gubun = "NOR";

$report_name = trim(sqlfilter($_REQUEST['report_name']));
$inputFB = trim(sqlfilter($_REQUEST['inputFB']));
$app_id = trim(sqlfilter($_REQUEST['app_id']));
$app_secret = trim(sqlfilter($_REQUEST['app_secret']));
$page_id = trim(sqlfilter($_REQUEST['page_id']));



$bbs = "member";
$_P_DIR_FILE = $_P_DIR_FILE.$bbs."/";
$_P_DIR_WEB_FILE = $_P_DIR_WEB_FILE.$bbs."/";
################ 사진 이미지 업로드 ##############


if ($_FILES['profile_img']['size']>0){
    $file_o = $_FILES['profile_img']['name'];
    $i_width = "185";
    $i_height = "185";
    $i_width2 = "";
    $i_height2 = "";
    //$watermark_sect = "imgw";
    $watermark_sect = "";
    $file_c = uploadFile($_FILES, "profile_img", $_FILES['profile_img'], $_P_DIR_FILE); // 파일 업로드후 변형된 파일이름 리턴.
}


$query = " insert into report_categories set ";
$query .= " category_name = '".$report_name."', ";
$query .= " profile_img = '".$file_c."', ";
$query .= " app_id = '".$app_id."', ";
$query .= " app_secret = '".$app_secret."', ";
$query .= " page_id = '".$page_id."' ";

$result = mysqli_query($gconnet,$query);
*/

if($result){
    ?>
    <SCRIPT LANGUAGE="JavaScript">
        <!--
        alert('등록이 정상적으로 완료 되었습니다.');
        //parent.location.href =  "member_list.php?<?=$total_param?>";
        parent.location.href =  "../members/?bmenu=3&smenu=1";
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
