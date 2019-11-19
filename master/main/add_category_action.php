<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login_frame.php"; // 관리자 로그인여부 확인?>

<?
$total_param = trim(sqlfilter($_REQUEST['total_param']));
$s_gubun = "NOR";

$report_name = trim(sqlfilter($_REQUEST['report_name']));
$inputFB = trim(sqlfilter($_REQUEST['inputFB']));
$app_id = trim(sqlfilter($_REQUEST['app_id']));
$app_secret = trim(sqlfilter($_REQUEST['app_secret']));
$page_id = trim(sqlfilter($_REQUEST['page_id']));


/*
if($s_gubun == "NOR"){
    $member_sect_str = "일반";
} elseif($s_gubun == "SPE"){
    $member_sect_str = "VVIP 멤버십";
}

$member_gubun = trim(sqlfilter($_REQUEST['member_gubun']));
$user_id = trim(sqlfilter($_REQUEST['member_id']));
$user_pwd = trim(sqlfilter($_REQUEST['member_password']));
$user_pwd = md5($user_pwd);
$user_name = trim(sqlfilter($_REQUEST['member_name']));
//$birthday = trim(sqlfilter($_REQUEST['birthday']));
$birthday_year = trim(sqlfilter($_REQUEST['birthday_year']));
$birthday_month = trim(sqlfilter($_REQUEST['birthday_month']));
$birthday_day = trim(sqlfilter($_REQUEST['birthday_day']));
$birthday = $birthday_year."-".$birthday_month."-".$birthday_day;
$gender = trim(sqlfilter($_REQUEST['gender']));
//$email = trim(sqlfilter($_REQUEST['member_email']));
$email = $user_id;
$mail_ok = trim(sqlfilter($_REQUEST['mail_ok']));
$user_lname = trim(sqlfilter($_REQUEST['member_lname']));
$cell1 = trim(sqlfilter($_REQUEST['cell1']));
$cell2 = trim(sqlfilter($_REQUEST['cell2']));
$cell3 = trim(sqlfilter($_REQUEST['cell3']));
$cell = $cell1."-".$cell2."-".$cell3;
//$cell = trim(sqlfilter($_REQUEST['cell']));
$nation = trim(sqlfilter($_REQUEST['nation']));
$scipe_id = trim(sqlfilter($_REQUEST['scipe_id']));
$post = trim(sqlfilter($_REQUEST['zip_code1']));
$addr1 = trim(sqlfilter($_REQUEST['member_address']));
$addr2 = trim(sqlfilter($_REQUEST['member_address2']));
$m_channel = trim(sqlfilter($_REQUEST['m_channel']));
$recom_name = trim(sqlfilter($_REQUEST['recom_name']));
$m_intro = trim(sqlfilter($_REQUEST['m_intro']));
*/

/*
$sql_pre1 = "select idx from member_info where user_id = '".$user_id."' "; // 회원테이블 아이디 중복여부 체크
$result_pre1  = mysqli_query($gconnet,$sql_pre1);

if(mysqli_num_rows($result_pre1) > 0) {
    error_frame("입력하신 이메일은 이미 사용중입니다. 다시 확인하시고 입력해 주세요.");
}
*/

/*
if($email){ // 이메일을 입력했을때

    $sql_pre4 = "select idx from member_info where email = '".$email."' ";
    $result_pre4  = mysqli_query($gconnet,$sql_pre4);
    if(mysqli_num_rows($result_pre4) > 0) {
        error_frame("입력하신 이메일은 이미 사용중입니다. 다시 확인하시고 입력해 주세요.");
    }

} // 이메일을 입력했을때 종료
*/
/*
if($recom_name){ // 추천인 입력했을때

    $sql_pre3 = "select idx from member_info where user_id = '".$recom_name."' and memout_yn != 'Y' and memout_yn != 'S' and member_type='GEN' ";
    $result_pre3  = mysqli_query($gconnet,$sql_pre3);
    if(mysqli_num_rows($result_pre3) == 0) {
        error_frame("입력하신 추천자와 일치하는 데이터가 없습니다. 다시 확인하시고 입력해 주세요.");
    } else {
        $row_pre3  = mysqli_fetch_array($result_pre3);
        $chuchun_idx = $row_pre3['idx'];
    }

} else { // 추천인 아이디를 입력했을때 종료
    $chuchun_idx = 0;
}
*/

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
    $file_profile = uploadFile($_FILES, "profile_img", $_FILES['profile_img'], $_P_DIR_FILE_PROFILE); // 파일 업로드후 변형된 파일이름 리턴.
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
    $file_cover = uploadFile($_FILES, "cover_img", $_FILES['cover_img'], $_P_DIR_FILE_COVER); // 파일 업로드후 변형된 파일이름 리턴.
}

$query = " insert into report_categories set ";
$query .= " category_name = '".$report_name."', ";
$query .= " profile_img = '".$file_profile."', ";
$query .= " cover_img = '".$file_cover."', ";
$query .= " app_id = '".$app_id."', ";
$query .= " app_secret = '".$app_secret."', ";
$query .= " page_id = '".$page_id."' ";

$result = mysqli_query($gconnet,$query);


/*
$login_ok = "Y"; // 최초 가입시 로그인 허용
$master_ok = "Y"; // 관리자 등록시 Y, 자가 등록시 N
$ad_mem_sect = "Y"; // 관리자 입력여부.
$memout_yn = "N"; // 탈퇴신청시 Y , 디폴트는 N
$mail_ok = "Y"; // 이메일 수신 허용
$member_type = "GEN"; // 회원
$member_gubun = "NOR"; // 일반회원

$member_level_basic_sql = "select level_code from member_level_set where 1 and level_type='".$member_type."' order by idx asc limit 0,1"; // 회원가입시 기본설정 등급코드 추출
$member_level_basic_query = mysqli_query($gconnet,$member_level_basic_sql);
$member_level_basic_row = mysqli_fetch_array($member_level_basic_query);
$user_level = $member_level_basic_row['level_code'];

$query = " insert into member_info set ";
$query .= " member_type = '".$member_type."', ";
$query .= " member_gubun = '".$member_gubun."', ";
$query .= " push_key = '".$push_key."', ";
$query .= " user_id = '".$user_id."', ";
$query .= " user_pwd = '".$user_pwd."', ";
$query .= " user_name = '".$user_name."', ";
$query .= " birthday = '".$birthday."', ";
$query .= " birthday_tp = '".$birthday_tp."', ";
$query .= " gender = '".$gender."', ";
$query .= " email = '".$email."', ";
$query .= " mail_ok = '".$mail_ok."', ";
$query .= " chuchun_id = '".$recom_name."', ";
$query .= " cell = '".$cell."', ";
$query .= " nation = '".$nation."', ";
$query .= " scipe_id = '".$scipe_id."', ";
$query .= " post = '".$post."', ";
$query .= " addr1 = '".$addr1."', ";
$query .= " addr2 = '".$addr2."', ";
$query .= " file_org = '".$file_o."', ";
$query .= " file_chg = '".$file_c."', ";
$query .= " user_level = '".$user_level."', ";
$query .= " login_ok = '".$login_ok."', ";
$query .= " master_ok = '".$master_ok."', ";
$query .= " ad_mem_sect = '".$ad_mem_sect."', ";
$query .= " memout_yn = '".$memout_yn."', ";
$query .= " memout_sect = '".$memout_sect."', ";
$query .= " memout_memo = '".$memout_memo."', ";
$query .= " m_intro = '".$m_intro."', ";
$query .= " wdate = now() ";

//echo $query;

$result = mysqli_query($gconnet,$query);

$member_idx = mysqli_insert_id();

if($member_idx == 0){
    $member_idx_sql = "select idx from member_info where 1 order by idx desc limit 0,1";
    $member_idx_query = mysqli_query($gconnet,$member_idx_sql);
    $member_idx_row = mysqli_fetch_array($member_idx_query);
    $member_idx = $member_idx_row['idx'];
}

$point_sect = "refund"; // 포인트

########### 회원가입시 포인트  적립시작 #################
$sql_member_in = "select member_in_gen from member_point_set where 1 and point_sect='".$point_sect."' and coin_type='member' order by idx desc limit 0,1 "; // 포인트  설정 테이블에서 회원가입시의 설정값을 추출한다.
$result_member_in = mysqli_query($gconnet,$sql_member_in);

if(mysqli_num_rows($result_member_in)==0) {
    $chg_mile = 0;
} else {
    $row_member_in = mysqli_fetch_array($result_member_in);
    $chg_mile = $row_member_in[member_in_gen];
}

$mile_title = "회원가입 포인트 적립"; // 포인트  적립 내역
$mile_sect = "A"; // 포인트  종류 = A : 적립, P : 대기, M : 차감
coin_plus_minus($point_sect,$member_idx,$mile_sect,$chg_mile,$mile_title,"","","");

if($chuchun_idx){ // 추천인 아이디를 입력했을때

    ###########  추천받은사람 포인트  적립시작 #################
    $sql_member_chu = "select member_chuchun_recev from member_point_set where 1=1 and point_sect='".$point_sect."' and coin_type='member' order by idx desc limit 0,1 "; // 포인트  설정 테이블에서 추천받은 사람의 설정값을 추출한다.
    $result_member_chu = mysqli_query($gconnet,$sql_member_chu);
    if(mysqli_num_rows($result_member_chu)==0) {
        $chg_mile2 = 0;
    } else {
        $row_member_chu = mysqli_fetch_array($result_member_chu);
        $chg_mile2 = $row_member_chu[member_chuchun_recev];
    }

    $mile_title2 = $prev_row['user_id']." 님 추천으로 포인트  적립"; // 포인트  적립 내역
    $mile_sect2 = "A"; // 포인트  종류 = A : 적립, P : 대기, M : 차감
    coin_plus_minus($point_sect,$chuchun_idx,$mile_sect2,$chg_mile2,$mile_title2,"","","");
    ###########  추천받은사람 포인트  적립종료 #################

    ###########  추천한사람 포인트  적립시작 #################
    $sql_member_in2 = "select member_chuchun_send from member_point_set where 1=1 and point_sect='".$point_sect."' and coin_type='member' order by idx desc limit 0,1 "; // 포인트  설정 테이블에서 회원가입시의 설정값을 추출한다.
    $result_member_in2 = mysqli_query($gconnet,$sql_member_in2);

    if(mysqli_num_rows($result_member_in2)==0) {
        $chg_mile3 = 0;
    } else {
        $row_member_in2 = mysqli_fetch_array($result_member_in2);
        $chg_mile3 = $row_member_in2[member_chuchun_send]; // 회원가입 추천아이디 입력에 따른 포인트
    }

    $mile_title3 = $prev_row['chuchun_id']." 님 추천하신 포인트  적립"; // 포인트  적립 내역
    $mile_sect3 = "A"; // 포인트  종류 = A : 적립, P : 대기, M : 차감
    coin_plus_minus($point_sect,$member_idx,$mile_sect3,$chg_mile3,$mile_title3,"","","");
    ###########  추천한사람 포인트  적립종료 #################

} // 추천인 아이디를 입력했을때 종료

########### 회원가입시 포인트  적립종료 #################

*/

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
