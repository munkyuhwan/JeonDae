<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // �����Լ� ��Ŭ��� ?>
<?
// ������ idx
$category_idx = trim(sqlfilter($_REQUEST['idx']));
// ���� �߰����� �������� boolean��
$which = ( trim(sqlfilter($_REQUEST['sub_yn'])) );
$result = array();
if($which == "true") {
    // ���� �߰��ϱ�

    // �ش� �������� �̹� �߰��Ǿ��ֳ� Ȯ
    $select_subs = "SELECT COUNT(*) AS cnt FROM subscribe_list";
    $select_subs .= " WHERE member_idx=".$_SESSION['user_access_idx']." AND category_idx=".$category_idx;
    $select_subs_result = mysqli_query($gconnet, $select_subs);
    $select_cnt = mysqli_fetch_assoc($select_subs_result);

    if (intval($select_cnt) > 0) {
        //�̹� ���� / �ؽ��±װ� ����
        // ���� ���� ����
        $del_subs = "DELETE FROM subscribe_list WHERE";
        $del_subs .= " member_idx=".$_SESSION['user_access_idx']." AND category_idx=".$category_idx;
        $del_result = mysqli_query($gconnet,$del_subs);

    }else {
        //���� / �ؽ��±װ� ����
        // ���� �߰��ؾ���
        // ������
    }

    // �纸�Կ� �ش�Ǵ� �ؽ��±� �ҷ���
    $sub_category_query = "SELECT idx FROM report_sub_categories WHERE del_yn='N' AND report_idx=".$category_idx;
    $sub_result = mysqli_query($gconnet,$sub_category_query);

    // �ؽ��±� ��������Ʈ�� �߰�
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
    // ���� ����ϱ�
    //�̹� ���� / �ؽ��±װ� ����
    // �ش� ī�װ� ���� ����
    $del_subs = "DELETE FROM subscribe_list WHERE";
    $del_subs .= " member_idx=".$_SESSION['user_access_idx']." AND category_idx=".$category_idx;
    $del_result = mysqli_query($gconnet,$del_subs);

    // Ŭ���ʴ� ����
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