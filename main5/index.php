<? include $_SERVER['DOCUMENT_ROOT'] . "/include/head.php" ?>

<body>
<div class="wrapper">
    <? include $_SERVER['DOCUMENT_ROOT']."/include/main_nav.php"?>

    <section class="main_section sc_section">
        <h2 class="hidden">검색</h2>
        <div class="sc_wrap">
            <div class="sc_box">
                <input type="text" class="search_input" placeholder="검색어를 입력해 주세요.">
                <button type="button" class="search_btn">검색</button>
            </div>
            <div class="sc_option">
                <div class="option_top">
                    <p>검색옵션 <span>기간 이전 게시물은 계속 검색을 이용해주세요.</span></p>
                    <button type="button" class="option_btn"></button>
                </div>
                <div class="option_bot">
                    <ul>
                        <li><input type="radio" id="sc_chk1" name="sc_opt"><label for="sc_chk1">1일</label></li>
                        <li><input type="radio" id="sc_chk2" name="sc_opt"><label for="sc_chk2">1주일</label></li>
                        <li><input type="radio" id="sc_chk3" name="sc_opt"><label for="sc_chk3">1개월</label></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- 검색 전 보여줄 이미지 검색 후 안보임 -->
        <!-- <div class="search_empty"></div> -->
        <!-- 검색 전 보여줄 이미지 -->
        <div class="sc_list">
            <p class="cnt_row">'20개'+의 게시물이 검색되었습니다.</p>
            <!-- 최초 검색시 최대 20개까지 검색결과 보여줌 / '계속검색'터치 시 20개씩 추가로 검색 -->
            <ul>
                <li class="sum_item">
                    <p class="con_box">위 사진 오른쪽 지갑을 2019년 11월 2일 토요일 태안-&gt; 부천 방향 충남고속 고속버스에서 잃어버렸어요 <a href="" class="more_btn">...더보기</a></p>
                    <div class="con_info">
                        <p>8월 20일 오후 6:18</p><p>N번째 제보</p><p><span>#구리시</span> <span>#20대</span></p>
                    </div>
                </li>
                <li class="sum_item">
                    <p class="con_box">위 사진 오른쪽 지갑을 2019년 11월 2일 토요일 태안-&gt; 부천 방향 충남고속 고속버스에서 잃어버렸어요 <a href="" class="more_btn">...더보기</a></p>
                    <div class="con_info">
                        <p>8월 20일 오후 6:18</p><p>N번째 제보</p><p><span>#구리시</span> <span>#20대</span></p>
                    </div>
                </li>
                <li class="sum_item">
                    <p class="con_box">위 사진 오른쪽 지갑을 2019년 11월 2일 토요일 태안-&gt; 부천 방향 충남고속 고속버스에서 잃어버렸어요 <a href="" class="more_btn">...더보기</a></p>
                    <div class="con_info">
                        <p>8월 20일 오후 6:18</p><p>N번째 제보</p><p><span>#구리시</span> <span>#20대</span></p>
                    </div>
                </li>
                <li class="sum_item">
                    <p class="con_box">위 사진 오른쪽 지갑을 2019년 11월 2일 토요일 태안-&gt; 부천 방향 충남고속 고속버스에서 잃어버렸어요 <a href="" class="more_btn">...더보기</a></p>
                    <div class="con_info">
                        <p>8월 20일 오후 6:18</p><p>N번째 제보</p><p><span>#구리시</span> <span>#20대</span></p>
                    </div>
                </li>
                <li class="sum_item">
                    <p class="con_box">위 사진 오른쪽 지갑을 2019년 11월 2일 토요일 태안-&gt; 부천 방향 충남고속 고속버스에서 잃어버렸어요 <a href="" class="more_btn">...더보기</a></p>
                    <div class="con_info">
                        <p>8월 20일 오후 6:18</p><p>N번째 제보</p><p><span>#구리시</span> <span>#20대</span></p>
                    </div>
                </li>
                <li class="sum_item">
                    <p class="con_box">위 사진 오른쪽 지갑을 2019년 11월 2일 토요일 태안-&gt; 부천 방향 충남고속 고속버스에서 잃어버렸어요 <a href="" class="more_btn">...더보기</a></p>
                    <div class="con_info">
                        <p>8월 20일 오후 6:18</p><p>N번째 제보</p><p><span>#구리시</span> <span>#20대</span></p>
                    </div>
                </li>
                <li>
                    <button type="button" class="go_sc_btn">계속 검색</button>
                </li>
            </ul>
        </div>
    </section>
</div>
<? include $_SERVER['DOCUMENT_ROOT']."/include/gnb.php" ?>

</body>
</html>

<!--

-->