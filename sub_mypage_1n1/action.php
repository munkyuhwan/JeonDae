<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?

$title = trim(sqlfilter($_REQUEST['query_title']));
$text = trim(sqlfilter($_REQUEST['query_text']));

$query = "INSERT INTO enquries_list SET ";
$query .= " member_idx=".$_SESSION['user_access_idx'].", ";
$query .= " q_title='".$title."', ";
$query .= " q_text='".$text."' ";

$result = mysqli_query($gconnet, $query);
if($result) {
    ?>
    <script>
        alert('작성되었습니다.');
        parent.location.reload();
    </script>
    <?
}else {
    ?>
    <script>
        alert('등록중 오류가 발생했습니다.');
    </script>
    <?
}

?>