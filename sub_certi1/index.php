<? include $_SERVER['DOCUMENT_ROOT'] . "/include/head.php" ?>
<body>
<div class="wrapper">
    <header>
        <div class="header grd_bg sub">
            <h1>대학인증</h1>
            <a class="back_btn" href="javascript:history.go(-1)"></a>
        </div>
    </header>
    <section class="main_section">
        <div class="certi_wrap">
            <div class="desc">대학 메일 인증을 통해 더 많은 서비스를 이용하실 수 있습니다. <br>
                인증 오류 및 문의는 FAQ나 1:1 문의를 이용해주세요.</div>
            <h2>학교 검색</h2>
            <div class="input_wrap uni">
                <input type="text">
                <button type="button" class="input_btn"></button>
                <div class="auto_complete">
                    <ul>
                        <li>한양대학교 사이버캠퍼스</li>
                        <li>한양대학교 사이버캠퍼스</li>
                        <li>한양대학교 사이버캠퍼스</li>
                        <li>한양대학교 사이버캠퍼스</li>
                    </ul>
                </div>
            </div>
            <!-- 학교 검색 후 이메일 인증 영역 보여짐 -->
            <div class="result_wrap">
                <h3>학교 인증 이메일</h3>
                <input type="email"> @<span>hanyang.ac.kr</span>
                <p class="mail_desc">인증 메일을 보내기 전에 해당 메일 계정이 활성화 되어있는지 확인해주세요</p>
                <div class="btn_row">
                    <button type="button" class="blue_btn">인증메일 전송</button>
                </div>
            </div>
        </div>

    </section>
</div>
</body>
</html>

<!--

-->