<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?php
$total_param = trim(sqlfilter($_REQUEST['total_param']));
$input_text = trim(sqlfilter($_REQUEST['input_text']));
$hash_tags = trim(sqlfilter($_REQUEST['hash_tags']));
$idx =  trim(sqlfilter($_REQUEST['idx']));

$member_idx = $_SESSION['admin_coinc_idx'];

$query = "UPDATE  report_list SET ";
$query .= " member_idx = ".$member_idx.", ";
$query .= " report_hashtag = '".$hash_tags."', ";
$query .= " content_text = '".$input_text."' ";
$query .= " WHERE idx=".$idx;
$result = mysqli_query($gconnet, $query);

$report_idx = $idx;

$bbs = "report";
$_P_DIR_FILE = $_P_DIR_FILE.$bbs."/";
$_P_DIR_WEB_FILE = $_P_DIR_WEB_FILE.$bbs."/";

$file_array = array();

foreach ($_FILES['img_add'] as $k=>$v) {
    foreach ($v as $key=>$item) {
        $file_array[$key][$k] = $item;
    }
}


foreach ($file_array as $k=>$v) {
    if ($v['size'] > 0) {
        $_FILES['img_plus_' . $k]['name'] = $v['name'];
        $_FILES['img_plus_' . $k]['type'] = $v['type'];
        $_FILES['img_plus_' . $k]['tmp_name'] = $v['tmp_name'];
        $_FILES['img_plus_' . $k]['error'] = $v['error'];
        $_FILES['img_plus_' . $k]['size'] = $v['size'];

        $file_c = uploadFile($_FILES, 'img_plus_' . $k, $_FILES['img_plus_' . $k], $_P_DIR_FILE); // 파일 업로드후 변형된 파일이름 리턴.

        $file_query = "INSERT INTO report_additional_files SET ";
        $file_query .= " report_idx = " . $report_idx . ", ";
        $file_query .= " report_file_name = '" . $file_c . "' ";
        $result = mysqli_query($gconnet, $file_query);
    }
}


if($result){
    ?>
    <SCRIPT LANGUAGE="JavaScript">
        <!--
        alert('등록이 정상적으로 완료 되었습니다.');
        parent.location.href =  "./?idx=<?=$idx?>&<?=$total_param?>";
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