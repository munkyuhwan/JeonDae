<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?

$idx = trim(sqlfilter($_REQUEST['id']));
$token = trim(sqlfilter($_REQUEST['token']));

$query = "SELECT idx, approved_yn FROM uni_approval WHERE member_idx=".$idx." AND approve_code='".$token."' ";
$result = mysqli_query($gconnet, $query);
$row = mysqli_fetch_assoc($result);

if ($row['approved_yn']=='Y') {
    ?>
    <script>
        alert('이미 인증되었습니다.');
        location.replace("../");
    </script>
    <?
    exit();
}

if(mysqli_num_rows($result) > 0) {
    $update = "UPDATE uni_approval SET approved_yn='Y' WHERE member_idx=".$idx." AND approve_code='".$token."' ";
    $update_result = mysqli_query($gconnet, $update);
    ?>
    <script>
        alert('인증되었습니다.');
        location.replace("../");
    </script>
    <?
}else {
    ?>
    <script>
        alert('인증에 실패했습니다.');
        location.replace("../sub_certi1");
    </script>
    <?
}


?>