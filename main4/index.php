<? include $_SERVER['DOCUMENT_ROOT'] . "/include/head.php" ?>
<?
$query = "SELECT * FROM alarm_list WHERE member_idx=".$_SESSION['user_access_idx'];
$result = mysqli_query($gconnet, $query);

?>
<body>
<div class="wrapper">
    <? include $_SERVER['DOCUMENT_ROOT']."/include/header.php"?>
    <? include $_SERVER['DOCUMENT_ROOT']."/include/main_nav.php"?>
    <section class="main_section">
        <div class="alrim_wrap">
            <ul>
                <?while ( $row = mysqli_fetch_assoc($result) ) {?>
                    <li class="item">
                        <div class="alrim_type type1"> <!-- 발행 -->
                            <img src="../images/img_sample2.jpg" alt="">
                        </div>
                        <div class="tlt">내 제보가 [<span>광진구 대신 전해드립니다</span>]에 발행되었습니다.</div>
                        <div class="desc">얼마전에 구리시로 이사온 24살 남자입니다.
                            이사온지 얼마 안돼서 친구도 없고 맨날 심심해서 혼자 피시방
                            만 다니는데 같이 다닐 친구필요해요 ㅠ  남자여자 상관없고
                            좋아요 누르면 달려갑니다!  </div>
                        <div class="date">8월 20일 오후 6:18</div>
                    </li>
                <?}?>

                <?/*?>
                <li class="item">
                    <div class="alrim_type type2"> <!-- 좋아요 -->
                        <img src="../images/icon_heart.png" alt="" width="32">
                    </div>
                    <div class="tlt">내 제보를 <span>5명</span>이 마음에 들어합니다.</div>
                    <div class="desc">얼마전에 구리시로 이사온 24살 남자입니다.
                        이사온지 얼마 안돼서 친구도 없고 맨날 심심해서 혼자 피시방
                        만 다니는데 같이 다닐 친구필요해요 ㅠ  남자여자 상관없고
                        좋아요 누르면 달려갑니다!  </div>
                    <div class="date">8월 20일 오후 6:18</div>
                </li>
                <li class="item">
                    <div class="alrim_type type3"> <!-- 인기등록 -->
                        <img src="../images/icon_popular.png" alt="" width="20">
                    </div>
                    <div class="tlt">내 제보가 인기 게시물에 등록되었습니다!</div>
                    <div class="desc">얼마전에 구리시로 이사온 24살 남자입니다.
                        이사온지 얼마 안돼서 친구도 없고 맨날 심심해서 혼자 피시방
                        만 다니는데 같이 다닐 친구필요해요 ㅠ  남자여자 상관없고
                        좋아요 누르면 달려갑니다!  </div>
                    <div class="date">8월 20일 오후 6:18</div>
                </li>
                <?*/?>
            </ul>
        </div>
        <a href="sub_write.html" class="post_write_btn"></a>
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