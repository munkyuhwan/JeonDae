<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login_frame.php"; // 관리자 로그인여부 확인?>
<?
$total_param = trim(sqlfilter($_REQUEST['total_param']));
$s_gubun = "NOR";

$category_idx = trim(sqlfilter($_REQUEST['category_idx']));
$view_cnt = trim(sqlfilter($_REQUEST['view_cnt']));
$comment_cnt = trim(sqlfilter($_REQUEST['comment_cnt']));
$like_cnt = trim(sqlfilter($_REQUEST['like_cnt']));


$select_query = "SELECT idx FROM popular_feeds WHERE category_idx=".$category_idx;
$result = mysqli_query($gconnet, $select_query);

$row = mysqli_fetch_array($result);

$query = "";
if (count($row)>0) {
    $query = "UPDATE popular_feeds SET ";
    $query .= " view_cnt=".$view_cnt.", ";
    $query .= " comment_cnt=".$comment_cnt.", ";
    $query .= " like_cnt=".$like_cnt;
    $query .= " WHERE category_idx=".$category_idx;
}else {
    $query = "INSERT INTO popular_feeds SET";
    $query .= " category_idx=".$category_idx.", ";
    $query .= " view_cnt=".$view_cnt.", ";
    $query .= " comment_cnt=".$comment_cnt.", ";
    $query .= " like_cnt=".$like_cnt;
}
$result = mysqli_query($gconnet,$query);

if($result){
    ?>
    <SCRIPT LANGUAGE="JavaScript">
        <!--
        alert('등록이 정상적으로 완료 되었습니다.');
        //parent.location.href =  "member_list.php?<?=$total_param?>";
        parent.location.href =  "../popular_feeds/?<?=$total_param?>";
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
