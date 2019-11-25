<? include $_SERVER['DOCUMENT_ROOT'] . "/include/head.php" ?>
<body>
<div class="wrapper">
    <header>
        <div class="header grd_bg sub">
            <h1>지역인증</h1>
            <a class="back_btn" href="javascript:history.go(-1)"></a>
        </div>
    </header>
    <section class="main_section">
        <div class="certi_result map">
            <h2 class="hidden">주소 검색지도</h2>
            <div class="map_noti">지도를 움직여 주소를 설정하세요</div>
            <div class="map_wrap">
                <!-- 지도 api 불러올 영역 -->
                <img src="images/img_sample_map.jpg" alt="" style="max-width:unset; width:200%; ">
                <p class="map_pointer"><img src="images/icon_map_pointer.png" alt=""></p>
            </div>
            <div class="map_bot">
                <div class="addr_info">
                    <p class="addr1">마포구 삼개로 3길 13</p> <!-- 도로명주소 -->
                    <p class="addr2">서울특별시 마포구 도화동 209-12</p><!-- 지번주소 -->
                </div>
                <div class="btn_row">
                    <button type="button" class="blue_btn loca_btn"><img src="images/icon_loca.png" alt=""> 현 위치로 주소 설정</button>
                </div>
            </div>
        </div>
    </section>
</div>
</body>
</html>

<!--

-->