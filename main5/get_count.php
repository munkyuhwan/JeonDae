<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$keyword = trim(sqlfilter($_REQUEST['keyword']));
$period = trim(sqlfilter($_REQUEST['period']));
$cnt = 0;
if (str_replace(" ","", $keyword) != '') {

    $count_query = "SELECT COUNT(*) AS cnt FROM report_list WHERE 1 ";
    $where = " AND ( content_text LIKE '%" . $keyword . "%' OR report_hashtag LIKE '%" . $keyword . "%' ) AND published_yn='Y' AND del_yn='N' AND complete_yn='Y' ";
    $where .= $period != "" ? " AND wdate >= NOW() - INTERVAL 1 " . $period : "";


    $count_query = $count_query . $where;
    $count_result = mysqli_query($gconnet, $count_query);
    $cnt_assoc = mysqli_fetch_assoc($count_result);
    $cnt = $cnt_assoc['cnt'];
}
$result = array(
    "result"=>$cnt
);

echo json_encode($result);



?>