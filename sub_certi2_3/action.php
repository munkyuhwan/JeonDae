<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?php
$oldAddr = trim(sqlfilter($_REQUEST['oldAddr']));
$newAddr = trim(sqlfilter($_REQUEST['newAddr']));
$sggNm = trim(sqlfilter($_REQUEST['sggNm']));
$siNm = trim(sqlfilter($_REQUEST['siNm']));

$member_idx = $_SESSION['user_access_idx'];

//선택된 구 idx받기
$gu_query = "SELECT idx FROM gus WHERE gu_name='".$sggNm."'";
$gu_result = mysqli_query($gconnet, $gu_query);
$gu_row = mysqli_fetch_assoc($gu_result);
$gu_idx = $gu_row['idx'];


if ($gu_idx!='') {
//회원 정보 지역 업데이트
    $update_query = "UPDATE member_info SET ";
    $update_query .= " local=" . $gu_idx . " ";
    $update_query .= " area_appr_yn='Y', ";
    $update_query .= " WHERE idx=" . $member_idx;
    $update_result = mysqli_query($gconnet, $update_query);

    if ($update_result) {
        //지역에 해당하는 제보함 가져오기
        $category_query = "SELECT idx FROM report_categories WHERE area_idx=".$gu_idx;
        $category_result = mysqli_query($gconnet, $category_query);

        if (mysqli_num_rows($category_result)) {
            while ($category_row = mysqli_fetch_assoc($category_result)) {
                print_r($category_row);
                //재보함 idx
                $category_idx = $category_row['idx'];

                //제보함에 해당하는 구독 해시태그 받아오기
                $hashtag_query = "SELECT idx FROM report_sub_categories WHERE report_idx=".$category_idx;
                $hashtag_result = mysqli_query($gconnet, $hashtag_query);
                while ($hashtag_row = mysqli_fetch_assoc($hashtag_result)) {
                    //받은 해시태그, 멤버가 이미 저장되어 있는지 확인
                    $subscribe_query = "SELECT COUNT(*) AS cnt FROM subscribe_list WHERE member_idx=" . $member_idx . " AND sub_category_idx=" . $hashtag_row['idx'];
                    $subscribe_result = mysqli_query($gconnet, $subscribe_query);
                    $subscribe_row = mysqli_fetch_assoc($subscribe_result);

                    $sub_cnt = intval($subscribe_row['cnt']);
                    if ($sub_cnt > 0) {
                        //해시태그 구독이 이미 저장되어 있으면 넘어간다

                    } else {
                        //해시태그 구독이 저장된게 없으면 INSERT
                        $insert = "INSERT INTO subscribe_list SET ";
                        $insert .= " member_idx=" . $member_idx . ", ";
                        $insert .= " category_idx=" . $category_idx . ", ";
                        $insert .= " sub_category_idx=" . $hashtag_row['idx'];
                        $insert_result = mysqli_query($gconnet, $insert);

                    }

                }

            }
            ?>
            <script>
                alert('인증이 완료되었습니다.');
                location.replace('../main1');
            </script>
            <?
        }else {?>
            <script>
                alert('인증이 완료되었습니다.');
                location.replace('./');
            </script>
        <?}


    }else {?>
        <script>
            alert('인증이 완료되었습니다.');
            location.replace('./');
        </script>
        <?
        exit();
    }

}else {?>
    <script>
        alert('인증이 완료되었습니다.');
        location.replace('./');
    </script>
    <?

    exit();
}


?>