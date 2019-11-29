<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$email_approval = trim(sqlfilter($_REQUEST['email_approval']));
if ($email_approval == "") {
    ?>
    <script>
        alert('비정상적인 경로 입니다.');
        history.back();
    </script>
    <?
    exit();
}else {
    $select = "SELECT COUNT(*) AS cnt FROM uni_approval WHERE approve_code='" . $email_approval . "' ";
    $select_result = mysqli_query($gconnet, $select);
    $select_row = mysqli_fetch_assoc($select_result);
    if (intval($select_row['cnt']) > 0 ) {
        $query = "UPDATE uni_approval SET approved_yn='Y' WHERE approve_code='" . $email_approval . "' ";
        $result = mysqli_query($gconnet, $query);
        ?>
        <script>
            alert("인증되었습니다.");
            location.replace("../main1");
        </script>
        <?
        exit();
    }else {
        ?>
        <script>
            alert('비정상적인 경로 입니다.');
            history.back();
        </script>
        <?
        exit();
    }
}
?>