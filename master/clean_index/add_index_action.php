<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login_frame.php"; // 관리자 로그인여부 확인?>
<?
$total_param = trim(sqlfilter($_REQUEST['total_param']));
$s_gubun = "NOR";

$category_idx = trim(sqlfilter($_REQUEST['category_idx']));
$clean_content_cnt = trim(sqlfilter($_REQUEST['clean_content_cnt']));
$mid_content_cnt_start = trim(sqlfilter($_REQUEST['mid_content_cnt_start']));
$mid_content_cnt_end = trim(sqlfilter($_REQUEST['mid_content_cnt_end']));
$content_standard = trim(sqlfilter($_REQUEST['content_standard']));

$select_query = "SELECT idx FROM clean_index WHERE category_idx=".$category_idx;
$result = mysqli_query($gconnet, $select_query);

$row = mysqli_fetch_array($result);

$query = "";
if (count($row)>0) {
    $query = "UPDATE clean_index SET ";
    $query .= " non_content_cnt=".$clean_content_cnt.", ";
    $query .= " mid_content_cnt_start=".$mid_content_cnt_start.", ";
    $query .= " mid_content_cnt_end=".$mid_content_cnt_end.", ";
    $query .= " clean_content_cnt=".$content_standard." ";
    $query .= "WHERE category_idx=".$category_idx;
}else {
    $query = "INSERT INTO clean_index SET";
    $query .= " category_idx=".$category_idx.", ";
    $query .= " non_content_cnt=".$clean_content_cnt.", ";
    $query .= " mid_content_cnt_start=".$mid_content_cnt_start.", ";
    $query .= " clean_content_cnt=".$mid_content_cnt_end.", ";
    $query .= " content_standard=".$content_standard." ";
}
$result = mysqli_query($gconnet,$query);


if($result){
    ?>
    <SCRIPT LANGUAGE="JavaScript">
        <!--
        alert('등록이 정상적으로 완료 되었습니다.');
        //parent.location.href =  "member_list.php?<?=$total_param?>";
        parent.location.href =  "../clean_index/?<?=$total_param?>";
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
