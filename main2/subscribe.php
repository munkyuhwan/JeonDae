<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
// 제보함 idx
$category_idx = trim(sqlfilter($_REQUEST['idx']));
// 구독 추가인지 삭제인지 boolean값
$which = ( trim(sqlfilter($_REQUEST['sub_yn'])) );
$result = array();
if($which == "true") {
    // 구독 추가하기

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

    $clean_query = "SELECT * FROM user_clean_index WHERE member_idx=".$_SESSION['user_access_idx']." AND category_idx=".$category_idx;
    $clean_result = mysqli_query($gconnet, $clean_query);
    $clean_row = mysqli_fetch_assoc($clean_result);

    if (mysqli_num_rows($clean_row) > 0) {
        $update_clean = "UPDATE user_clean_index SET clean_index=0 WHERE idx=".$clean_row['idx'];
        $update_clean_result = mysqli_query($gconnet, $update_clean);
    }else {
        $insert_clean = "INSERT INTO user_clean_index SET clean_index=0, member_idx=".$_SESSION['user_access_idx'].", category_idx=".$category_idx;
        $insert_clean_result = mysqli_query($gconnet, $insert_clean);
    }


    if ($sub_result) {
        $result = array(
            "result"=>"success"
        );
    }else {
        $result = array(
            "result"=>"fail"
        );
    }

}else {
    // 구독 취소하기
    //이미 구독 / 해시태그가 있음
    // 해당 카테고리 구독 삭제
    $del_subs = "DELETE FROM subscribe_list WHERE";
    $del_subs .= " member_idx=".$_SESSION['user_access_idx']." AND category_idx=".$category_idx;
    $del_result = mysqli_query($gconnet,$del_subs);

    // 클린필더 삭제
    $del_filter = "DELETE FROM user_clean_index WHERE member_idx=".$_SESSION['user_access_idx']." AND category_idx=".$category_idx;
    $del_result = mysqli_query($gconnet,$del_filter);


    if ($del_result) {
        $result = array(
            "result"=>"success"
        );
    }else {
        $result = array(
            "result"=>"fail"
        );
    }
}

echo json_encode($result);



?>