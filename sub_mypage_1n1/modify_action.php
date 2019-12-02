<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$idx = trim(sqlfilter($_REQUEST['idx']));
$title = trim(sqlfilter($_REQUEST['query_title']));
$text = trim(sqlfilter($_REQUEST['query_text']));

$query = "UPDATE enquries_list SET ";
$query .= " q_title='".$title."', ";
$query .= " q_text='".$text."' ";
$query .= " WHERE idx=".$idx;

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