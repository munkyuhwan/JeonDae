<? include $_SERVER['DOCUMENT_ROOT'] . "/include/head.php" ?>
<?
//구독한 제보함 가져오기
$category_query = "SELECT report.category_idx, pop.view_cnt, pop.comment_cnt, pop.like_cnt FROM subscribe_list AS report, popular_feeds AS pop WHERE 1 ";
$category_query .= " AND report.member_idx=".$_SESSION['user_access_idx']." AND report.category_idx=pop.category_idx ";
$category_query .= " GROUP BY report.category_idx, pop.view_cnt, pop.comment_cnt, pop.like_cnt ";
$category_result = mysqli_query($gconnet, $category_query);
$categories = array();
while($row = mysqli_fetch_assoc($category_result)) {
    array_push($categories, $row);
}
echo "<br><br><br><br>";
print_r($categories);


?>
<body>
<div class="wrapper">
    <? include $_SERVER['DOCUMENT_ROOT']."/include/header.php"?>
    <? include $_SERVER['DOCUMENT_ROOT']."/include/main_nav.php"?>
    <section class="main_section">
        <div class="list_wrap">
            <ul>
                <li class="item">
                    <div class="item_top user_box">
                        <div class="prf_box">
                            <img src="../images/img_sample2.jpg" alt="">
                        </div>
                        <div class="info_box ">
                            <p class="name">사나</p>
                            <div class="etc_info">
                                <p>8월 20일 오후 6:18</p><p>N번째 제보</p><button type="button">#구리시</button><button type="button">#20대</button>
                            </div>
                        </div>
                        <button type="button" class="pop_call" data-pop="post_pop"></button>
                    </div>
                    <div class="item_mid">
                        <div class="text_box">
                            <p> 위 사진 오른쪽 지갑을 2019년 11월 2일 토요일 태안-> 부천 방향
                                충남고속 고속버스에서 잃어버렸어요 </p>
                            <button type="button" class="more_btn">...더보기</button>
                        </div>
                        <div class="img_wrap">
                            <div class="flex_wrap">
                                <div class="flex2_wrap item2">
                                    <a href="#" class="pop_call" data-pop="img_pop">
                                        <img src="../images/img_sample5.jpg" alt="">
                                    </a>
                                    <a href="#" class="pop_call" data-pop="img_pop">
                                        <img src="../images/img_sample4.jpg" alt="">
                                    </a>
                                </div>
                                <div class="flex2_wrap item3">
                                    <a href="#" class="pop_call" data-pop="img_pop">
                                        <img src="../images/img_sample5.jpg" alt="">
                                    </a>
                                    <a href="#" class="pop_call" data-pop="img_pop">
                                        <img src="../images/img_sample6.jpg" alt="">
                                    </a>
                                    <a href="#" class="pop_call" data-pop="img_pop">
                                        <img src="../images/img_sample6.jpg" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="btn_box">
                            <button type="button" class="like_btn">26</button>
                            <span class="reply_cnt">15</span>
                        </div>
                    </div>
                    <div class="item_bot">
                        <div class="reply_list">
                            <button type="button" class="reply_all">댓글 <span>00</span>개 모두 보기</button>
                            <ul>
                                <li class="reply_item user_box">
                                    <div class="reply_inner">
                                        <div class="prf_box">
                                            <img src="../images/img_sample2.jpg" alt="">
                                        </div>
                                        <div class="info_box ">
                                            <div class="reply_top"><p class="name">사나</p><p class="reply_txt">얼른 지갑 찾으시길 바래요..</p></div>
                                            <div class="etc_info">
                                                <p>8월 20일 오후 6:18</p><button type="button">답글 달기</button>
                                            </div>
                                        </div>
                                        <button type="button" class="like_btn"></button>
                                    </div>
                                    <ul>
                                        <li class="reply_item user_box">
                                            <div class="reply_inner">
                                                <div class="prf_box">
                                                    <img src="../images/img_sample2.jpg" alt="">
                                                </div>
                                                <div class="info_box ">
                                                    <div class="reply_top"><p class="name">사나</p><p class="reply_txt">얼른 지갑 찾으시길 바래요..얼른 지갑 찾으시길 바래요..얼른 지갑 찾으시길 바래요..얼른 지갑 찾으시길 바래요..얼른 지갑 찾으시길 바래요..</p></div>
                                                    <div class="etc_info">
                                                        <p>8월 20일 오후 6:18</p><button type="button">답글 달기</button>
                                                    </div>
                                                </div>
                                                <button type="button" class="like_btn"></button>
                                            </div>
                                            <ul>
                                                <li class="reply_item user_box">
                                                    <div class="reply_inner">
                                                        <div class="prf_box">
                                                            <img src="../images/img_sample2.jpg" alt="">
                                                        </div>
                                                        <div class="info_box ">
                                                            <div class="reply_top"><p class="name">사나</p><p class="reply_txt">얼른 지갑 찾으시길 바래요..</p></div>
                                                            <div class="etc_info">
                                                                <p>8월 20일 오후 6:18</p><button type="button">답글 달기</button>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="like_btn"></button>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>

                        </div>
                    </div>
                    <div class="item_reply_input">
                        <div class="prf_box">
                            <img src="../images/img_sample2.jpg" alt="">
                        </div>
                        <div class="input_box">
                            <form action="">
                                <input type="text" placeholder="댓글 달기...">
                                <button type="button">게시</button>
                            </form>
                        </div>
                    </div>
                </li>
                <li class="item">
                    <div class="item_top user_box">
                        <div class="prf_box">
                            <img src="../images/img_sample2.jpg" alt="">
                        </div>
                        <div class="info_box ">
                            <p class="name">사나</p>
                            <div class="etc_info">
                                <p>8월 20일 오후 6:18</p><p>N번째 제보</p><button type="button">#구리시</button><button type="button">#20대</button>
                            </div>
                        </div>
                        <button type="button" class="pop_call" data-pop="post_pop"></button>
                    </div>
                    <div class="item_mid">
                        <div class="text_box">
                            <p> 위 사진 오른쪽 지갑을 2019년 11월 2일 토요일 태안-> 부천 방향
                                충남고속 고속버스에서 잃어버렸어요 </p>
                            <button type="button" class="more_btn">...더보기</button>
                        </div>
                        <div class="img_wrap">
                            <div class="flex_wrap">
                                <div class="flex2_wrap item2">
                                    <a href="">
                                        <img src="../images/img_sample5.jpg" alt="">
                                    </a>
                                    <a href="">
                                        <img src="../images/img_sample4.jpg" alt="">
                                    </a>
                                </div>
                                <div class="flex2_wrap item3">
                                    <a href="">
                                        <img src="../images/img_sample5.jpg" alt="">
                                    </a>
                                    <a href="">
                                        <img src="../images/img_sample6.jpg" alt="">
                                    </a>
                                    <a href="">
                                        <img src="../images/img_sample6.jpg" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="btn_box">
                            <button type="button" class="like_btn">26</button>
                            <span class="reply_cnt">15</span>
                        </div>
                    </div>
                    <div class="item_bot">
                        <div class="reply_list">
                            <button type="button" class="reply_all">댓글 <span>00</span>개 모두 보기</button>
                            <ul>
                                <li class="reply_item user_box">
                                    <div class="reply_inner">
                                        <div class="prf_box">
                                            <img src="../images/img_sample2.jpg" alt="">
                                        </div>
                                        <div class="info_box ">
                                            <div class="reply_top"><p class="name">사나</p><p class="reply_txt">얼른 지갑 찾으시길 바래요..</p></div>
                                            <div class="etc_info">
                                                <p>8월 20일 오후 6:18</p><button type="button">답글 달기</button>
                                            </div>
                                        </div>
                                        <button type="button" class="like_btn"></button>
                                    </div>
                                    <ul>
                                        <li class="reply_item user_box">
                                            <div class="reply_inner">
                                                <div class="prf_box">
                                                    <img src="../images/img_sample2.jpg" alt="">
                                                </div>
                                                <div class="info_box ">
                                                    <div class="reply_top"><p class="name">사나</p><p class="reply_txt">얼른 지갑 찾으시길 바래요..</p></div>
                                                    <div class="etc_info">
                                                        <p>8월 20일 오후 6:18</p><button type="button">답글 달기</button>
                                                    </div>
                                                </div>
                                                <button type="button" class="like_btn"></button>
                                            </div>
                                            <ul>
                                                <li class="reply_item user_box">
                                                    <div class="reply_inner">
                                                        <div class="prf_box">
                                                            <img src="../images/img_sample2.jpg" alt="">
                                                        </div>
                                                        <div class="info_box ">
                                                            <div class="reply_top"><p class="name">사나</p><p class="reply_txt">얼른 지갑 찾으시길 바래요..</p></div>
                                                            <div class="etc_info">
                                                                <p>8월 20일 오후 6:18</p><button type="button">답글 달기</button>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="like_btn"></button>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>

                        </div>
                    </div>
                    <div class="item_reply_input">
                        <div class="prf_box">
                            <img src="../images/img_sample2.jpg" alt="">
                        </div>
                        <div class="input_box">
                            <form action="">
                                <input type="text" placeholder="댓글 달기...">
                                <button type="button">게시</button>
                            </form>
                        </div>
                    </div>
                </li>
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