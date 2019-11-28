<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
//
$page = trim(sqlfilter($_REQUEST['page']));
$block = trim(sqlfilter($_REQUEST['block']));

$user_clean_query = "SELECT clean_index, category_idx FROM user_clean_index WHERE member_idx=".$_SESSION['user_access_idx'];
//cleanindex 0:없음 1:중간 2:클린
$user_clean_result = mysqli_query($gconnet, $user_clean_query);

$cleanIndex=array();
while($row=mysqli_fetch_assoc($user_clean_result)) {
    $cleanIndex[$row['category_idx']] = $row['clean_index'];
}
print_r($cleanIndex);
echo "<br><br><br>";
$query = "SELECT clean.idx AS user_clean, clean.clean_index, report.category, report.idx AS report_idx, report.wdate, report.content_text, report.report_hashtag, report.likes, report.bad_report, (SELECT COUNT(*) AS cnt FROM report_comments WHERE report_idx=report.idx) AS comment_cnt,  member.real_name, member.file_chg  ";


//if
//$query .= " ,IF (clean_index = 0, bad_report > clean_index.non_content_cnt) ";
//$query .= " ELSEIF clean_index = 1 THEN (bad_report > clean_index.mid_content_cnt_start AND bad_report < clean_index.mid_content_cnt_end ); ";
//$query .= " ELSEIF clean_index = 2 THEN bad_report > clean_index.clean_content_cnt; ";
//$query .= " END IF ";


$query .= " FROM report_list AS report, member_info AS member, user_clean_index AS clean, clean_index ";

$query .= " WHERE report.del_yn='N' AND report.member_idx=member.idx ";

$query .= " AND clean.member_idx=".$_SESSION['user_access_idx']." AND clean.category_idx=report.category AND clean_index.category_idx=report.category ";


echo $query;
$query_limit .= $query." LIMIT ".($page*$block)." , ".$block ;
$result = mysqli_query($gconnet,$query_limit);

$cnt_result = mysqli_query($gconnet,$query);
$cnt = mysqli_fetch_all($cnt_result);
$num = count($cnt);
// publ

/*
while($row = mysqli_fetch_assoc($result)) {
?>
    <input type="text" value="<?=$row['idx']?>">
<?}*/ ?>
