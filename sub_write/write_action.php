<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?php

$category = $_REQUEST['categories'];

$input_text = trim(sqlfilter($_REQUEST['input_text']));
$hash_tags = trim(sqlfilter($_REQUEST['hash_tags']));
$complete_yn = trim(sqlfilter($_REQUEST['complete_yn']));
$continue_idx = trim(sqlfilter($_REQUEST['continue_idx']));
$subcategories = $_REQUEST['subcategories'];

if($continue_idx == "") {
    $hash_tags .= ',';
}
foreach($subcategories as $v) {
    $hash_tags .= "#".$v.",";
}
$hash_tags = substr($hash_tags,1,-1);
$hash_tags .= ',';


if ($_SESSION['user_access_idx'] != "") {
    $member_idx = $_SESSION['user_access_idx'];

    //사용자 연령대 받기
    $getAgeQuery = "SELECT birthday FROM member_info WHERE idx=".$member_idx;
    $getAgeResult = mysqli_query($gconnet, $getAgeQuery);
    $ageRow = mysqli_fetch_assoc($getAgeResult);

    $yNow = date("Y",time());
    $myBirth = $ageRow['birthday'];

    $ageBand = floor( (intval($yNow)-intval($myBirth))/10 )*10;

    $hash_tags .= "#".$ageBand."대,";


}else {
    //익명 제보자
    $select_unknown = "SELECT idx FROM member_info WHERE user_id='unknown' ";
    $unknown_result= mysqli_query($gconnet, $select_unknown);
    $unknown_row = mysqli_fetch_assoc($unknown_result);
    $member_idx = $unknown_row['idx'];
}




$bbs = "report";
$_P_DIR_FILE = $_P_DIR_FILE.$bbs."/";
$_P_DIR_WEB_FILE = $_P_DIR_WEB_FILE.$bbs."/";

$file_array = array();


foreach ($_FILES['add_pic'] as $k=>$v) {
    foreach ($v as $key=>$item) {
        $file_array[$key][$k] = $item;
    }
}
$file_name_arr = array();
foreach ($file_array as $k=>$v) {
    $_FILES['img_plus_'.$k]['name'] = $v['name'];
    $_FILES['img_plus_'.$k]['type'] = $v['type'];
    $_FILES['img_plus_'.$k]['tmp_name'] = $v['tmp_name'];
    $_FILES['img_plus_'.$k]['error'] = $v['error'];
    $_FILES['img_plus_'.$k]['size'] = $v['size'];

    $file_c = uploadFile($_FILES, 'img_plus_'.$k, $_FILES['img_plus_'.$k], $_P_DIR_FILE); // 파일 업로드후 변형된 파일이름 리턴.

    if($v['name']!="") {
        array_push($file_name_arr, $file_c);
        //$file_query = "INSERT INTO report_additional_files SET ";
        //$file_query .= " report_idx = " . $report_idx . ", ";
        //$file_query .= " report_file_name = '" . $file_c . "' ";
        //$result = mysqli_query($gconnet, $file_query);
    }
}


if ($continue_idx != "") {
    $query = "UPDATE report_list SET ";
    $query .= " complete_yn='".$complete_yn."', ";
    $query .= " category = ".$category[0].", ";
    $query .= " report_hashtag = '" . $hash_tags . "', ";
    $query .= " content_text = '" . $input_text . "' ";
    $query .= " WHERE idx=" . $continue_idx . " ";
    $result = mysqli_query($gconnet, $query);
    if (count($file_name_arr)>0) {
        foreach ($file_name_arr as $k => $v) {
            $query = "INSERT INTO report_additional_files SET ";
            $query .= "report_idx=".$continue_idx.", ";
            $query .= "report_file_name='" . $v . "'; ";
            $result = mysqli_query($gconnet, $query);
        }

    }
    //echo $query;
    //$result = mysqli_query($gconnet, $query);

}else {
   // $query = "BEGIN;";
    $query = "INSERT INTO report_list  SET ";
    if ($category[0] != "") {
        $query .= " category = ".$category[0].", ";
    }
    $query .= " member_idx = " . $member_idx . ", ";
    $query .= " report_hashtag = '" . $hash_tags . "', ";
    $query .= " complete_yn = '" . $complete_yn . "', ";
    $query .= " content_text = '" . $input_text . "'; ";

    $result = mysqli_query($gconnet, $query);

    $lastIdxQuery = "SELECT idx FROM report_list ORDER BY idx DESC LIMIT 1";
    $lastIdxResult = mysqli_query($gconnet, $lastIdxQuery);
    $lastIdxRow = mysqli_fetch_assoc($lastIdxResult);
    $last_idx = $lastIdxRow['idx'];

    if (count($file_name_arr)>0) {
        foreach ($file_name_arr as $k => $v) {
            $query = "INSERT INTO report_additional_files SET ";
            $query .= "report_idx=".$last_idx.", ";
            $query .= "report_file_name='" . $v . "'; ";
            $result = mysqli_query($gconnet, $query);
        }

    }
    //$query .= "COMMIT;";

}



if($result){
    ?>
    <SCRIPT LANGUAGE="JavaScript">
        <!--
        alert('등록이 정상적으로 완료 되었습니다.');
        <?if ($_SESSION['user_access_idx'] != "") {
        ?>
            parent.location.href =  "../main1";
        <?}else {?>
            parent.location.href =  "./";
        <?}?>
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
