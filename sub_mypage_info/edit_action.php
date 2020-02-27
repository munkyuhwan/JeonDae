<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?


$user_name = trim(sqlfilter($_REQUEST['user_name']));
$gender = trim(sqlfilter($_REQUEST['gender']));
$year_birth = trim(sqlfilter($_REQUEST['year_birth']));
$clean_filter = trim(sqlfilter($_REQUEST['subs_clean']));

$member_idx = $_SESSION['user_access_idx'];

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
    $file_c = uploadFile($_FILES, "profile_img", $_FILES['profile_img'], $_P_DIR_FILE, $_SESSION['profile_img']); // 파일 업로드후 변형된 파일이름 리턴.
}

$query = "UPDATE member_info SET ";
$query .= "member_gubun = 'NOR', ";
$query .= "real_name = '".$user_name."', ";
$query .= "gender = '".$gender."', ";
$query .= "birthday = '".$year_birth."', ";
if ($_FILES['profile_img']['size']>0) {
    $query .= "file_chg = '" . $file_c . "', ";
}
$query .= "clean_filter = ".$clean_filter." ";
$query .= " WHERE idx=".$member_idx;
$result = mysqli_query($gconnet,$query);

//update clean index
$update_clean_index = "UPDATE user_clean_index SET clean_index=".$clean_filter." WHERE member_idx=".$_SESSION['user_access_idx'];
$update_clean_result = mysqli_query($gconnet, $update_clean_index);





//$del_subscribes = "DELETE FROM subscribe_list WHERE member_idx=".$member_idx;
//$sub_result = mysqli_query($gconnet,$del_subscribes);



$subscribes = ($_REQUEST['hashtags']);
$hashtags_idx_array = array();
foreach($subscribes as $v) {

    $select = "SELECT idx FROM report_sub_categories WHERE sub_name='".$v."' ";
    $selRes = mysqli_query($gconnet, $select);

    while( $row = mysqli_fetch_assoc($selRes) ) {
        array_push($hashtags_idx_array, $row['idx']);
    }

}


$del_subscribes = "DELETE FROM subscribe_list WHERE member_idx=".$member_idx;
$sub_result = mysqli_query($gconnet,$del_subscribes);



foreach($hashtags_idx_array as $k=>$v) {

    $sub_category_query = "SELECT report_idx FROM report_sub_categories WHERE del_yn='N' AND idx=".$v;
    $sub_result = mysqli_query($gconnet,$sub_category_query);
    while ($row = mysqli_fetch_assoc($sub_result) ) {
        $insert_subscribe_list  = "INSERT INTO subscribe_list SET category_idx=".$row['report_idx'].", sub_category_idx=".$v.", member_idx=".$member_idx;
        $inser_sub_result = mysqli_query($gconnet,$insert_subscribe_list);
    }

}

/*
foreach ($subscribes as $k=>$v) {
    $sub_category_query = "SELECT report_idx FROM report_sub_categories WHERE del_yn='N' AND idx=".$v;
    $sub_result = mysqli_query($gconnet,$sub_category_query);
    $report_idx = mysqli_fetch_assoc($sub_result);
    //while ($row = mysqli_fetch_row($sub_result) ) {
        $insert_subscribe_list  = "INSERT INTO subscribe_list SET category_idx=".$report_idx['report_idx'].", sub_category_idx=".$v.", member_idx=".$member_idx;
        $inser_sub_result = mysqli_query($gconnet,$insert_subscribe_list);
    //}
}
*/

if($result){
    if ($_FILES['profile_img']['size']>0) {
        $_SESSION['profile_img'] = $file_c;
    }else {

    }
    $_SESSION['user_access_name'] = $user_name;

    ?>
    <SCRIPT LANGUAGE="JavaScript">
        <!--
        alert('등록이 정상적으로 완료 되었습니다.');
        //parent.location.href =  "member_list.php?<?=$total_param?>";
        parent.location.href =  "./";
        //-->
    </SCRIPT>
<?}else{?>
    <SCRIPT LANGUAGE="JavaScript">
        <!--
        alert('등록중 오류가 발생했습니다.');
        history.back()
        //-->
    </SCRIPT>
<?}


?>