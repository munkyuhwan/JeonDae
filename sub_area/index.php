<? include $_SERVER['DOCUMENT_ROOT']."/include/head.php" ?>
<?
$idx = trim(sqlfilter($_REQUEST['idx']));
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
<script type="application/javascript">
    var page = 0;
    var block = 10;

    function loadData() {
        $.ajax({
            url:"get_data.php",
            data:{"page":page, "block":block, "category_idx":<?=$idx?>},
            method:"POST",
            success:function(response) {
                $('#report_list').append(response);
            },
            error:function(error) {

            }
        })
    }


</script>
<body onload="loadData();">
<div class="wrapper">
    <? include $_SERVER['DOCUMENT_ROOT']."/include/header.php" ?>
    <? include $_SERVER['DOCUMENT_ROOT']."/include/main_nav.php" ?>
    <section class="main_section">
        <h2 class="hidden">지역 메인</h2>
        <div class="area_tlt">
            <div class="area_img">
                <img src="../thumb/thumb.php?src=../upload_file/category_cover/<?=$row['cover_img']?>" alt="지역 이미지">
            </div>
            <div class="area_inner">
                <p class="area_logo"><img src="../thumb/thumb.php?src=../upload_file/category_profile/<?=$row['profile_img']?>" alt="원 이미지"></p>
                <span><?=$row['category_name']?></span>
                <?if (intval($subscribe_cnt) <= 0 ) {?>
                    <form action="do_subscribe.php" name="frm" method="post" target="_fra_admin"  >
                        <input type="hidden" name="category_idx" value="<?=$idx?>">
                        <button type="submit" class="subs_btn blue_btn" >구독</button>
                    </form>
                <?}?>
            </div>
        </div>
        <div class="list_wrap popular">
            <p class="desc">이 구역의 인기글은 나야 :)</p>
            <div class="swiper-container">
                <ul class="swiper-wrapper">
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
                                <p class="name"><?=$v['real_name']?></p>
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
                                <p><?=$v['content_text']?></p>
                                <button type="button" class="more_btn">...더보기</button>
                            </div>
                            <?
                            $img_query = "SELECT * FROM report_additional_files WHERE report_idx=".$v['idx'];
                            $img_result = mysqli_query($gconnet, $img_query);
                            $img_row = mysqli_fetch_all($img_result);
                            ?>
                            <?if(count($img_row) > 0) {?>
                                <div class="img_wrap">
                                    <div class="flex_wrap">
                                        <?if(count($img_row) == 1) {?>
                                            <div class="flex2_wrap item1">
                                                <a href="">
                                                    <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[0][2]?>" alt="">
                                                </a>
                                            </div>

                                        <?} else if(count($img_row) == 2 ) {?>
                                            <div class="flex2_wrap item1">
                                                <a href="">
                                                    <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[0][2]?>" alt="">
                                                </a>
                                            </div>
                                            <div class="flex2_wrap item1">
                                                <a href="">
                                                    <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[1][2]?>" alt="">
                                                </a>
                                            </div>
                                        <?} else if(count($img_row) == 3 ) {?>
                                            <div class="flex2_wrap item2">
                                                <a href="">
                                                    <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[0][2]?>" alt="">
                                                </a>
                                                <a href="">
                                                    <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[1][2]?>" alt="">
                                                </a>
                                            </div>
                                            <div class="flex2_wrap item1">
                                                <a href="">
                                                    <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[2][2]?>" alt="">
                                                </a>
                                            </div>
                                        <?} else if(count($img_row) == 4 ) {?>
                                            <div class="flex2_wrap item2">
                                                <a href="">
                                                    <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[0][2]?>" alt="">
                                                </a>
                                                <a href="">
                                                    <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[1][2]?>" alt="">
                                                </a>
                                            </div>
                                            <div class="flex2_wrap item2">
                                                <a href="">
                                                    <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[2][2]?>" alt="">
                                                </a>
                                                <a href="">
                                                    <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[3][2]?>" alt="">
                                                </a>
                                            </div>
                                        <?} else if(count($img_row) == 5 ) {?>
                                            <div class="flex2_wrap item2">
                                                <a href="">
                                                    <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[0][2]?>" alt="">
                                                </a>
                                                <a href="">
                                                    <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[1][2]?>" alt="">
                                                </a>
                                            </div>
                                            <div class="flex2_wrap item3">
                                                <a href="">
                                                    <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[2][2]?>" alt="">
                                                </a>
                                                <a href="">
                                                    <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[3][2]?>" alt="">
                                                </a>
                                                <a href="">
                                                    <img src="../thumb/thumb.php?src=../upload_file/report/<?=$img_row[4][2]?>" alt="">
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
                </ul>
                <div class="swiper-pagination">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <a href="../main3?sub_idx=<?=$idx?>" class="more_btn">더보기</a>
        </div>
        <div class="list_wrap">
            <ul id="report_list" >
            </ul>
        </div>
        <a href="../sub_write" class="post_write_btn"></a>
    </section>
</div>
<? include $_SERVER['DOCUMENT_ROOT']."/include/gnb.php" ?>
<? include $_SERVER['DOCUMENT_ROOT']."/include/share_pop.php" ?>

<div class="popup img_pop">
    <div class="img_slider">
        <div class="swiper-container">
            <ul class="swiper-wrapper">
                <li class="swiper-slide">
                    <img src="../images/img_sample2.jpg" alt="">
                </li>
                <li class="swiper-slide">
                    <img src="../images/img_sample4.jpg" alt="">
                </li>
                <li class="swiper-slide">
                    <img src="../images/img_sample5.jpg" alt="">
                </li>
                <li class="swiper-slide">
                    <img src="../images/img_sample6.jpg" alt="">
                </li>
                <li class="swiper-slide">
                    <img src="../images/img_sample4.jpg" alt="">
                </li>
            </ul>
        </div>
        <div class="slide_nav_btn">
            <button class="slide_prev_btn"><img src="../images/icon_arrow_left.png"></button>
            <button class="slide_next_btn"><img src="../images/icon_arrow_right.png"></button>
        </div>
    </div>
    <div class="btn_box">
        <button type="button" class="like_btn">26</button>
        <span class="reply_cnt">15</span>
    </div>
    <button tpye="button" class="pop_close"></button>
</div>
<? include $_SERVER['DOCUMENT_ROOT']."/include/share_pop.php"?>
<? include $_SERVER['DOCUMENT_ROOT']."/include/footer.php"?>
</body>
</html>

<!--

-->