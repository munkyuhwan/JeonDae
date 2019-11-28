<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$category_idx = trim(sqlfilter($_REQUEST['category_idx']));

if ($_SESSION['user_access_idx']) {

    // 해당 제보함이 이미 추가되어있나 확
    $select_subs = "SELECT COUNT(*) AS cnt FROM subscribe_list";
    $select_subs .= " WHERE member_idx=".$_SESSION['user_access_idx']." AND category_idx=".$category_idx;
    $select_subs_result = mysqli_query($gconnet, $select_subs);
    $select_cnt = mysqli_fetch_assoc($select_subs_result);

    if (intval($select_cnt) > 0) {
        //이미 구독 / 해시태그가 있음
        // 기존 구독 삭제
        $del_subs = "DELETE FROM subscribe_list WHERE";
        $del_subs .= " member_idx=".$_SESSION['user_access_idx']." AND category_idx=".$category_idx;
        $del_result = mysqli_query($gconnet,$del_subs);

    }else {
        //구독 / 해시태그가 없음
        // 새로 추가해야함
        // 지나감
    }

    // 재보함에 해당되는 해시태그 불러옴
    $sub_category_query = "SELECT idx FROM report_sub_categories WHERE del_yn='N' AND report_idx=".$category_idx;
    $sub_result = mysqli_query($gconnet,$sub_category_query);

    // 해시태그 구독리스트에 추가
    while ($row = mysqli_fetch_assoc($sub_result) ) {
        $insert_subscribe_list  = "INSERT INTO subscribe_list SET category_idx=".$category_idx.", sub_category_idx=".$row['idx'].", member_idx=".$_SESSION['user_access_idx'];
        $inser_sub_result = mysqli_query($gconnet,$insert_subscribe_list);
    }
    ?>
    <script>
        alert('구독 되었습니다.');
    </script>
    <?
    exit();
}else {
    ?>
    <script>
        alert('로그인 후 이용하실 수 있습니다.');
    </script>
    <?
    exit();
}

?>
