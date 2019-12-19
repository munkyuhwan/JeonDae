<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$idx = trim(sqlfilter($_REQUEST['category_idx']));
$query = "SELECT cover_img, profile_img, category_name  FROM report_categories WHERE idx=".$idx;
$result = mysqli_query($gconnet, $query);
$row = mysqli_fetch_assoc($result);

if ($_SESSION['user_access_idx']!='') {
    $subscribe_query = "SELECT COUNT(*) AS cnt  FROM subscribe_list WHERE category_idx=" . $idx . " AND member_idx=" . $_SESSION['user_access_idx'];
    $sub_res = mysqli_query($gconnet, $subscribe_query);
    $sub_assoc = mysqli_fetch_assoc($sub_res);
    $subscribe_cnt = $sub_assoc['cnt'];
}

?>
<?
$category_query = "SELECT report.category_idx, pop.view_cnt AS limit_view, pop.comment_cnt AS limit_comment, pop.like_cnt AS limit_like ";
$category_query .= "FROM subscribe_list AS report, popular_feeds AS pop WHERE 1 ";
$category_query .= " AND report.category_idx=".$idx." ";
$category_query .= " AND report.member_idx=".$_SESSION['user_access_idx']." AND report.category_idx=pop.category_idx ";
$category_query .= " GROUP BY report.category_idx, pop.view_cnt, pop.comment_cnt, pop.like_cnt ";

$category_result = mysqli_query($gconnet, $category_query);
$result = array();
while($row = mysqli_fetch_assoc($category_result)) {
    $report_query = "SELECT report.*, (SELECT profile_img FROM report_categories WHERE idx=report.category) AS category_profile, (SELECT COUNT(*) FROM report_comments WHERE report_idx=report.idx ) AS comment_cnt FROM report_list AS report WHERE 1";
    $report_query .= " AND report.category = ".$row['category_idx'];
    $report_query .= " AND report.likes >= ".$row['limit_like'];
    $report_query .= " AND report.view_cnt >= ".$row['limit_view'];
    $report_query .= " AND (SELECT COUNT(*) FROM report_comments WHERE report_idx=report.idx ) >= ".$row['limit_comment'];

    $report_result = mysqli_query($gconnet, $report_query);
    while( $report_row = mysqli_fetch_assoc($report_result) ) {
        array_push($result, $report_row);
    }
}
?>
<?foreach ($result as $k=>$v) {?>
    <li class="item swiper-slide">
        <div class="item_top user_box">
            <div class="prf_box">
                <img src="../upload_file/category_profile/<?=$v['category_profile']?>" alt="">
            </div>
            <div class="info_box ">
                <p class="name" ><?=$v['real_name']?></p>
                <div class="etc_info">
                    <p><?=date("m월 d일 h:i", strtotime($v['wdate']) )?></p><p><?=$v['idx']?>번째 제보</p>
                    <?$hashtags = explode(",",$v['report_hashtag'])?>
                    <?foreach($hashtags as $val) {?>
                        <button type="button"><?=$val?></button>
                    <?}?>
                </div>
            </div>
        </div>
        <div class="item_mid">
            <div class="text_box">
                <p  id="content_<?=$v['idx']?>" ><?=$v['content_text']?></p>
                <button type="button" class="more_btn">...더보기</button>
            </div>
            <?
            $img_query = "SELECT * FROM report_additional_files WHERE report_idx=".$v['idx'];
            $img_result = mysqli_query($gconnet, $img_query);
            $img_cnt = mysqli_num_rows($img_result);

            $img_res = array();
            while($img_row = mysqli_fetch_assoc($img_result)) {
                array_push($img_res, $img_row);
            }
            print_r($img_res);
            ?>
            <?if(count($img_res) > 0) {?>
                <div class="img_wrap">
                    <div class="flex_wrap">
                        <?if(count($img_res) == 1) {?>
                            <div class="flex2_wrap item1">
                                <a href="">
                                    <img src="../upload_file/report/<?=$img_res[0]["report_file_name"]?>" alt="">
                                </a>
                            </div>

                        <?} else if(count($img_res) == 2 ) {?>
                            <div class="flex2_wrap item1">
                                <a href="">
                                    <img src="../upload_file/report/<?=$img_res[0]["report_file_name"]?>" alt="">
                                </a>
                            </div>
                            <div class="flex2_wrap item1">
                                <a href="">
                                    <img src="../upload_file/report/<?=$img_res[1]["report_file_name"]?>" alt="">
                                </a>
                            </div>
                        <?} else if(count($img_res) == 3 ) {?>
                            <div class="flex2_wrap item2">
                                <a href="">
                                    <img src="../upload_file/report/<?=$img_res[0]["report_file_name"]?>" alt="">
                                </a>
                                <a href="">
                                    <img src="../upload_file/report/<?=$img_res[1]["report_file_name"]?>" alt="">
                                </a>
                            </div>
                            <div class="flex2_wrap item1">
                                <a href="">
                                    <img src="../upload_file/report/<?=$img_res[2]["report_file_name"]?>" alt="">
                                </a>
                            </div>
                        <?} else if(count($img_res) == 4 ) {?>
                            <div class="flex2_wrap item2">
                                <a href="">
                                    <img src="../upload_file/report/<?=$img_res[0]["report_file_name"]?>" alt="">
                                </a>
                                <a href="">
                                    <img src="../upload_file/report/<?=$img_res[1]["report_file_name"]?>" alt="">
                                </a>
                            </div>
                            <div class="flex2_wrap item2">
                                <a href="">
                                    <img src="../upload_file/report/<?=$img_res[2]["report_file_name"]?>" alt="">
                                </a>
                                <a href="">
                                    <img src="../upload_file/report/<?=$img_res[3]["report_file_name"]?>" alt="">
                                </a>
                            </div>
                        <?} else if(count($img_res) == 5 ) {?>
                            <div class="flex2_wrap item2">
                                <a href="">
                                    <img src="../upload_file/report/<?=$img_res[0]["report_file_name"]?>" alt="">
                                </a>
                                <a href="">
                                    <img src="../upload_file/report/<?=$img_res[1]["report_file_name"]?>" alt="">
                                </a>
                            </div>
                            <div class="flex2_wrap item3">
                                <a href="">
                                    <img src="../upload_file/report/<?=$img_res[2]["report_file_name"]?>" alt="">
                                </a>
                                <a href="">
                                    <img src="../upload_file/report/<?=$img_res[3]["report_file_name"]?>" alt="">
                                </a>
                                <a href="">
                                    <img src="../upload_file/report/<?=$img_res[4]["report_file_name"]?>" alt="">
                                </a>
                            </div>
                        <?}?>
                    </div>
                </div>
            <?}?>
            <div class="btn_box">
                <button type="button" class="like_btn"><?=$v['likes']?></button>
                <span class="reply_cnt"><?=$v['comment_cnt']?></span>
            </div>
        </div>
    </li>
<?}?>
