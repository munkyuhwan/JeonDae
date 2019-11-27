<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?

$page = trim(sqlfilter($_REQUEST['page']));
$block = trim(sqlfilter($_REQUEST['block']));

$query = "SELECT report.idx AS report_idx, report.wdate, report.content_text, report.report_hashtag, report.likes, (SELECT COUNT(*) AS cnt FROM report_comments WHERE report_idx=report.idx) AS comment_cnt,  member.real_name, member.file_chg  FROM report_list AS report, member_info AS member WHERE report.del_yn='N' AND report.complete_yn='Y' AND report.del_yn='N' AND report.member_idx=member.idx AND report.member_idx=".$_SESSION['user_access_idx'];
$query_limit .= $query." LIMIT ".($page*$block)." , ".$block ;
$result = mysqli_query($gconnet,$query_limit);

$rows = array();
while($row = mysqli_fetch_assoc($result)) {
    array_push($rows, $row);
}

echo json_encode($rows);

?>