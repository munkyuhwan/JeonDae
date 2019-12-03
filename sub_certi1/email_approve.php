<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?

$idx = trim(sqlfilter($_REQUEST['id']));
$token = trim(sqlfilter($_REQUEST['token']));
$uni_idx = trim(sqlfilter($_REQUEST['uni_idx']));

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

    $update_member = "UPDATE member_info SET uni=".$uni_idx." WHERE idx=".$idx;
    $update_result = mysqli_query($gconnet, $update_member);

    $category_query = "SELECT idx FROM report_categories WHERE school_idx=".$uni_idx;
    $category_result = mysqli_query($gconnet, $category_query);

    if ( mysqli_num_rows($category_result) > 0 ) {
        while ($category_row = mysqli_fetch_assoc($category_result)) {
            //재보함 idx
            $category_idx = $category_row['idx'];

            //제보함에 해당하는 구독 해시태그 받아오기
            $hashtag_query = "SELECT idx FROM report_sub_categories WHERE report_idx=" . $category_idx;
            $hashtag_result = mysqli_query($gconnet, $hashtag_query);

            while ($hashtag_row = mysqli_fetch_assoc($hashtag_result)) {
                //받은 해시태그, 멤버가 이미 저장되어 있는지 확인
                $subscribe_query = "SELECT COUNT(*) AS cnt FROM subscribe_list WHERE member_idx=" . $idx . " AND sub_category_idx=" . $hashtag_row['idx'];
                $subscribe_result = mysqli_query($gconnet, $subscribe_query);
                $subscribe_row = mysqli_fetch_assoc($subscribe_result);


                $sub_cnt = intval($subscribe_row['cnt']);
                if ($sub_cnt > 0) {
                    //해시태그 구독이 이미 저장되어 있으면 넘어간다

                } else {
                    //해시태그 구독이 저장된게 없으면 INSERT
                    $insert = "INSERT INTO subscribe_list SET ";
                    $insert .= " member_idx=" . $idx . ", ";
                    $insert .= " category_idx=" . $category_idx . ", ";
                    $insert .= " sub_category_idx=" . $hashtag_row['idx'];

                    $insert_result = mysqli_query($gconnet, $insert);

                }
            }


        }
    }

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