<? include $_SERVER['DOCUMENT_ROOT']."/include/head.php"; ?>
<?
$block = 10;
$scroll_num = 0;
$query = "SELECT report.idx AS report_idx, report.wdate, report.content_text, report.report_hashtag, member.real_name, member.file_chg  FROM report_list AS report, member_info AS member WHERE report.del_yn='N' AND report.member_idx=member.idx ";
$query_limit .= $query." LIMIT ".($block*$scroll_num)." , ".$block ;
$result = mysqli_query($gconnet,$query_limit);

$cnt_result = mysqli_query($gconnet,$query);
$cnt = mysqli_fetch_all($cnt_result);
$num = count($cnt);

?>
<body>
<div class="wrapper">
    <header>
        <div class="header grd_bg">
            <h1><a href="main.html"><img src="images/logo_txt.png" alt="전대전 - 전국 대신 전해드립니다"></a></h1>
            <button type="button" class="snb_btn"></button>
        </div>
    </header>
    <nav class="main_nav">
        <ul>
            <li class="main_menu1"><a href="main1.html" title="메인" class="on"></a></li>
            <li class="main_menu2"><a href="main2.html" title=""></a></li>
            <li class="main_menu3"><a href="main3.html" title="거래"></a></li>
            <li class="main_menu4"><a href="main4.html" title="알림"></a></li>
            <li class="main_menu5"><a href="main5.html" title="검색"></a></li>
        </ul>
    </nav>
    <section class="main_section">
        <div class="list_wrap">
            <ul>
                <?while($row = mysqli_fetch_assoc($result)) {?>
                    <li class="item">
                        <div class="item_top user_box">
                            <div class="prf_box">
                                <img src="./upload_file/member/<?=$row['file_chg']?>" alt="">
                            </div>
                            <div class="info_box ">
                                <p class="name"><?=$row['real_name']?></p>
                                <div class="etc_info">
                                    <p><?=date("m월 d일 h:i", strtotime($row['wdate']) )?></p><p><?=$row['report_idx']?>번째 제보</p>
                                    <?$hashtags = explode(",",$row['report_hashtag'])?>
                                    <?foreach($hashtags as $v) {?>
                                        <button type="button"><?=$v?></button>
                                    <?}?>
                                </div>
                            </div>
                            <button type="button" class="pop_call" data-pop="post_pop"></button>
                        </div>
                        <div class="item_mid">
                            <div class="text_box">
                                <p><?=$row['content_text']?></p>
                                <button type="button" class="more_btn">...더보기</button>
                            </div>
                            <div class="img_wrap">
                                <div class="flex_wrap">

                                    <div class="flex2_wrap item2">
                                        <a href="">
                                            <img src="images/img_sample5.jpg" alt="">
                                        </a>
                                        <a href="">
                                            <img src="images/img_sample4.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="flex2_wrap item3">
                                        <a href="">
                                            <img src="images/img_sample5.jpg" alt="">
                                        </a>
                                        <a href="">
                                            <img src="images/img_sample6.jpg" alt="">
                                        </a>
                                        <a href="">
                                            <img src="images/img_sample6.jpg" alt="">
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
                                <?
                                $comment_query = "SELECT report.comment_txt, report.idx AS comment_idx, report.wdate, (SELECT real_name FROM member_info WHERE idx=report.member_idx ) AS member_name FROM report_comments AS report WHERE report.del_yn='N' AND report.parent_idx=0 AND report.report_idx=".$row['idx'];
                                $comment_res = mysqli_query($gconnet, $comment_query);
                                ?>
                                <button type="button" class="reply_all">댓글 <span>00</span>개 모두 보기</button>
                                <ul>
                                    <li class="reply_item user_box">
                                        <div class="reply_inner">
                                            <div class="prf_box">
                                                <img src="images/img_sample2.jpg" alt="">
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
                                                        <img src="images/img_sample2.jpg" alt="">
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
                                                                <img src="images/img_sample2.jpg" alt="">
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
                                <img src="images/img_sample2.jpg" alt="">
                            </div>
                            <div class="input_box">
                                <form action="">
                                    <input type="text">
                                    <button type="button">게시</button>
                                </form>
                            </div>
                        </div>
                    </li>
                <?}?>

            </ul>
        </div>
        <a href="sub_write.html" class="post_write_btn"></a>
    </section>
</div>
<div class="snb">
    <div class="snb_wrap">
        <div class="snb_top user_wrap">
            <div class="user_img">
                <img src="images/img_sample2.jpg" alt="유저 사진">
            </div>
            <div class="user_name">
                김충분
            </div>
            <div class="user_tag">
                <button type="button">#서울</button><button type="button">#구리시</button><button type="button">#구리시</button>
            </div>
            <div class="user_certi">
                <span class="certi1">학교인증</span>
                <span class="certi2 on">지역인증</span>
            </div>
        </div>
        <div class="snb_mid">
            <ul>
                <li class="snb_menu1"><a href="sub_mypage1.html"><p><img src="images/icon_snb_menu1.png" width="16" alt=""></p> 내가 제보한 글</a></li>
                <li class="snb_menu2"><a href="sub_mypage2.html"><p><img src="images/icon_snb_menu2.png" width="10" alt=""></p> 스크랩 한 글</a></li>
                <li class="snb_menu3"><a href="sub_mypage3.html"><p><img src="images/icon_snb_menu3.png" width="15" alt=""></p> 구독관리</a></li>
                <li class="snb_menu4"><a href="sub_mypage4.html"><p><img src="images/icon_snb_menu4.png" width="15" alt=""></p> 일반설정</a></li>
            </ul>
        </div>
        <button type="button" class="snb_close"></button>
    </div>
</div>
<div class="popup post_pop">
    <div class="popup_wrap post_btn">
        <div class="post_btn_wrap">
            <ul>
                <li><button type="button">게시물 저장(스크랩)</button></li>
                <li><a href="">해당 게시물 신고하기</a></li>
                <li><a href="">해당 게시물 공유</a></li>
                <li><button type="button">해당 카테고리 구독 취소</button></li>
            </ul>
        </div>
        <button type="button" class="pop_close">취소</button>
    </div>
</div>

</body>
</html>

<!--

-->