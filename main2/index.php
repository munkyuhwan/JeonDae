<? include $_SERVER['DOCUMENT_ROOT'] . "/include/head.php" ?>
<?

$keyword = trim(sqlfilter($_REQUEST['key']));

$query = "SELECT main.category_name, main.idx, main.cover_img, main.profile_img ".
    " FROM report_categories AS main ".
    " WHERE 1 ";

if ($keyword != "") {
    $query .= " AND main.category_name LIKE '%".$keyword."%' ";
}

$result = mysqli_query($gconnet,$query);
?>
<body>
<script type="application/javascript">
    function subscribe(idx, yn) {
        var str = "";
        if (yn) {
            //구독하기
            str='구독 하겠습니까?'
        }else {
            //구독 취소
            str='구독을 취소 하겠습니까?';
        }

        if (confirm(str)) {
            $.ajax({
                url: "subscribe.php",
                data: {"idx": idx, "sub_yn": yn},
                success: function (response) {
                    console.log(response)
                    try {
                        var res = JSON.parse(response);
                        if (res.result == 'success') {
                            location.reload();
                        }
                    }catch(e) {

                    }

                },
                error: function (error) {

                }

            })
        }
    }

    function checkInp() {
        return $('#key').val().replace(" ","") != "";
    }
</script>
<div class="wrapper">
    <? include $_SERVER['DOCUMENT_ROOT']."/include/header.php"?>
    <? include $_SERVER['DOCUMENT_ROOT']."/include/main_nav.php"?>
    <section class="main_section">
        <div class="area_wrap">
            <div class="area_search">
                <input type="text" name="key" id="key" value="<?=$keyword?>" ><button type="button" onclick="if (checkInp()) {location.href='./?key='+$('#key').val();}else{alert('검색 키워드를 입력하세요')} "  >검색</button>
            </div>
            <div class="area_list">
                <ul>
                    <?while ($row = mysqli_fetch_assoc($result)) {?>
                        <?
                        $subscribe_query = "SELECT COUNT(*) AS cnt FROM subscribe_list WHERE member_idx=".$_SESSION['user_access_idx']." AND category_idx=".$row['idx'];
                        $subscribe_result = mysqli_query($gconnet, $subscribe_query);
                        $subscribe_row = mysqli_fetch_assoc($subscribe_result);
                        ?>
                        <li <?= intval($subscribe_row['cnt']) > 0 ? "class=\"added\"":"" ?>>
                            <a href="../sub_area?idx=<?=$row['idx']?>"><?=$row['category_name']?> 대신 전해드립니다</a>
                            <p class="distance">2Km</p>
                            <p class="btn_box">
                                <button type="button" class="add_btn" onclick="subscribe(<?=$row['idx']?>,true)" >추가</button>
                                <button type="button" class="cancle_btn" onclick="subscribe(<?=$row['idx']?>,false)" >취소</button>
                            </p>
                        </li>
                    <?}?>
                </ul>
            </div>
        </div>
    </section>
</div>
<? include $_SERVER['DOCUMENT_ROOT']."/include/gnb.php" ?>

<div class="popup post_pop">
    <div class="popup_wrap post_btn">
        <div class="post_btn_wrap">
            <ul>
                <li><button type="button">게시물 저장(스크랩)</button></li>
                <li><a href="">해당 게시물 신고하기</a></li>
                <li><button type="button" class="pop_call" data-pop="share_pop">해당 게시물 공유</button></li>
                <li><button type="button">해당 카테고리 구독 취소</button></li>
            </ul>
        </div>
        <button type="button" class="pop_close">취소</button>
    </div>
</div>
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
<?include $_SERVER['DOCUMENT_ROOT']."/include/share_pop.php"?>
</body>
</html>

<!--

-->