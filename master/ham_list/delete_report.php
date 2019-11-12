<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$idx = trim(sqlfilter($_REQUEST['idx']));

$query = "UPDATE report_list SET del_yn='Y' WHERE idx=".$idx;
$result = mysqli_query($gconnet, $query);
echo $query;
print_r($result);

?>
