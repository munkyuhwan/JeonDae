<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$parentIdx = trim(sqlfilter($_REQUEST['parent_idx']));
$reportIdx = trim(sqlfilter($_REQUEST['report_idx']));
$commentTxt = trim(sqlfilter($_REQUEST['content_txt']));
$userIdx = $_SESSION['idx'];

$query = "INSERT INTO report_comments SET ";
$query .= " report_idx= ".$reportIdx.", ";
$query .= " member_idx= ".$userIdx.", ";
$query .= " comment_txt= '".$commentTxt."' ";

echo $query;

$result = mysqli_query($gconnet, $query);
if($result) {

}else {

}

//print_r($_REQUEST);



?>