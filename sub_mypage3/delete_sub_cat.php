<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$idx = trim(sqlfilter($_REQUEST['idx']));
$category_idx = trim(sqlfilter($_REQUEST['category_idx']));
$select = "SELECT idx FROM subscribe_list WHERE  sub_category_idx=".$idx." AND member_idx=".$_SESSION['user_access_idx'];
$sel_result = mysqli_query($gconnet, $select);

if (mysqli_num_rows($sel_result)>0) {
    $query = "DELETE FROM subscribe_list WHERE sub_category_idx=" . $idx . " AND member_idx=" . $_SESSION['user_access_idx'];
    $result = mysqli_query($gconnet, $query);
}else {
    $query = "INSERT INTO subscribe_list SET category_idx=".$category_idx.", sub_category_idx=" . $idx . ", member_idx=" . $_SESSION['user_access_idx'];
    $result = mysqli_query($gconnet, $query);
}


$response = array();
if ($result) {
    $response = array(
        "result"=>"success"
    );
}else {
    $response = array(
        "result"=>"fail"
    );
}

echo json_encode($response);

?>