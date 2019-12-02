<? include $_SERVER['DOCUMENT_ROOT'] . "/include/head.php" ?>
<?
$query = "SELECT COUNT(*) AS cnt FROM scrab_list AS scrab, report_list AS report WHERE 1 ";
$where = " AND scrab.member_idx=".$_SESSION['user_access_idx']." ";
$where .= " AND scrab.report_idx = report.idx ";
$result = mysqli_query($gconnet, $query.$where);
$row = mysqli_fetch_assoc($result);
?>
<script>
    var page = 0;
    var block = 10;

    function loadData() {
        $.ajax({
            url:"get_data.php",
            data:{"page":page, "block":block},
            method:"POST",
            success:function(response) {
                $('#report_list').append(response);
            },
            error:function(error) {

            }
        })
    }
</script>
<body onload="loadData()">
<div class="wrapper">

    <? include $_SERVER['DOCUMENT_ROOT']."/include/header.php"?>
    <? include $_SERVER['DOCUMENT_ROOT']."/include/main_nav.php"?>
    
    <section class="main_section">
        <p class="scrap_cnt">스크랩 한 글수 <span><?=$row['cnt']?></span>개</p>
        <div class="list_wrap">
            <ul id="report_list">

            </ul>
        </div>
    </section>
</div>
<? include $_SERVER['DOCUMENT_ROOT']."/include/gnb.php" ?>
<? include $_SERVER['DOCUMENT_ROOT']."/include/etc_popup.php" ?>

<div class="popup img_pop">
    <div class="img_slider">
        <div class="swiper-container">
            <ul class="swiper-wrapper">
                <li class="swiper-slide">
                    <img src="images/img_sample2.jpg" alt="">
                </li>
                <li class="swiper-slide">
                    <img src="images/img_sample4.jpg" alt="">
                </li>
                <li class="swiper-slide">
                    <img src="images/img_sample5.jpg" alt="">
                </li>
                <li class="swiper-slide">
                    <img src="images/img_sample6.jpg" alt="">
                </li>
                <li class="swiper-slide">
                    <img src="images/img_sample4.jpg" alt="">
                </li>
            </ul>
        </div>
        <div class="slide_nav_btn">
            <button class="slide_prev_btn"><img src="images/icon_arrow_left.png"></button>
            <button class="slide_next_btn"><img src="images/icon_arrow_right.png"></button>
        </div>
    </div>
    <div class="btn_box">
        <button type="button" class="like_btn">26</button>
        <span class="reply_cnt">15</span>
    </div>
    <button tpye="button" class="pop_close"></button>
</div>
<div class="popup share_pop">
    <h2 class="hidden">공유하기</h2>
    <div class="popup_wrap">
        <div class="share_top grd_bg">
            <img src="images/logo2.png" alt="">
        </div>
        <div class="share_mid">
            <ul>
                <li class="fb_link" >
                    <a href="#" title="페이스북 공유하기"></a>
                </li>
                <li class="tw_link" >
                    <a href="#" title="트위터 공유하기"></a>
                </li>
                <li class="kt_ink">
                    <a href="#" title="카카오톡 공유하기"></a>
                </li>
                <li class="ks_link">
                    <a href="#" title="카카오스토리 공유하기"></a>
                </li>
            </ul>
        </div>
        <div class="btn_row">
            <button type="button" class="pop_close blue_btn">확인</button>
        </div>
    </div>
</div>
</body>
</html>

<!--

-->