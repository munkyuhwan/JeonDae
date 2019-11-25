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
        <div class="certi_wrap">
            <div class="desc">지역 인증을 통해 더 많은 서비스를 이용하실 수 있습니다. <br>
                인증 오류 및 문의는 FAQ나 1:1 문의를 이용해주세요.</div>
            <h2>지번, 도로명, 건물명을 입력하세요</h2>
            <div class="input_wrap ">
                <input type="text" id="addr_inp" placeholder="ex) 전대동12-3 또는 전대전아파트">
                <button type="button" class="input_btn" onclick="" ></button>
            </div>
            <div class="btn_row">
                <button type="button" class="blue_btn loca_btn"><img src="images/icon_loca.png" alt=""> 현 위치로 주소 설정</button>
            </div>
        </div>
    </section>
</div>
<script language="javascript">

    function getAddress() {
        $.ajax({
            url:"https://update.juso.go.kr/updateInfo.do",
            type:"post",
            data:{"app_key":"devU01TX0FVVEgyMDE5MTEyNTE3MjYxMjEwOTIxODU=", "keyword":"응암동","currentPage":1,"countPerPage":10,"resultType":"json"},
            success:function(response) {
                console.log(response)
            },
            error:function(error) {

            }
        })
    }
    getAddress()
</script>
</body>
</html>

<!--

-->