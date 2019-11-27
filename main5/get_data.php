<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$keyword = trim(sqlfilter($_REQUEST['keyword']));
$page = trim(sqlfilter($_REQUEST['page']));
$block = trim(sqlfilter($_REQUEST['block']));
$period = trim(sqlfilter($_REQUEST['period']));

if (str_replace(" ","", $keyword) != '') {

    $query = "SELECT idx, content_text, report_hashtag, wdate FROM report_list WHERE 1 ";
    $count_query = "SELECT COUNT(*) AS cnt FROM report_list WHERE 1 ";
    $where = " AND ( content_text LIKE '%" . $keyword . "%' OR report_hashtag LIKE '%" . $keyword . "%' ) AND published_yn='Y' AND del_yn='N' AND complete_yn='Y' ";

    $where .= $period != "" ? " AND wdate >= NOW() - INTERVAL 1 " . $period : "";
    $limit = " LIMIT ".$page*$block.",".$block;

    $query = $query . $where.$limit;
    $result = mysqli_query($gconnet, $query);


    $count_query = $count_query . $where;
    $count_result = mysqli_query($count_query);
    $cnt_assoc = mysqli_fetch_assoc($count_result);
    $cnt = $cnt_assoc['cnt'];
}

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    array_push($data, $row);
}


echo json_encode($data);


?>