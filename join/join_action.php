<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?php

$fbId = trim(sqlfilter($_REQUEST['fb_id']));
$fbName = trim(sqlfilter($_REQUEST['fb_name']));
$gender= trim(sqlfilter($_REQUEST['gender']));
$birth= trim(sqlfilter($_REQUEST['birth']));
$region= trim(sqlfilter($_REQUEST['region']));

$checkQuery = "SELECT COUNT(*) AS cnt FROM member_info WHERE user_id='".$fbId."'";
$checkResult = mysqli_query($gconnet, $checkQuery);
$checkRow = mysqli_fetch_assoc($checkResult);

if (intval($checkRow['cnt']) > 0 ) {?>
    <script>
        alert('이미 가입되 계정입니다.');
        location.replace('../intro');
    </script>
<?}else {
    $query = "INSERT INTO member_info SET";
    $query .= " member_type='GEN', ";
    $query .= " member_gubun='NOR', ";
    $query .= " real_name='".$fbName."', ";
    $query .= " user_id='" . $fbId . "', ";
    $query .= " gender='" . $gender . "', ";
    $query .= " birthday= '" . $birth . "', ";
    $query .= " local= '" . $region . "', ";
    $query .= " wdate=now()";
    $result = mysqli_query($gconnet, $query);

    $selectQuery = "SELECT idx, real_name, file_chg FROM member_info WHERE user_id='".$fbId."'";
    $selectResult = mysqli_query($gconnet, $selectQuery);
    $selectRow = mysqli_fetch_assoc($selectResult);
    $idx = $selectRow['idx'];
    session_start();
    $_SESSION['user_access_idx'] = $idx;
    $_SESSION['user_access_name'] = $row['real_name'];

}
if ($result) {?>
    <script>
        alert('등록 되었습니다');
        location.replace('../main1');
    </script>
<?}else {?>
    <script>
        alert('등록중 오류가 발생했습니다.');
        history.back();
    </script>

<?} ?>
