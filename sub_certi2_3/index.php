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
            <div class="certi_addr">
                <p><?=trim(sqlfilter($_REQUEST['oldAddr']))?> </p> <!-- 도로명주소 -->
                <p><?=trim(sqlfilter($_REQUEST['newAddr']))?> </p><!-- 지번주소 -->
            </div>
            <div class="btn_row">
                <form name="frm" id="frm" action="action.php" >
                    <input type="hidden" name="oldAddr" value="<?=trim(sqlfilter($_REQUEST['oldAddr']))?>" >
                    <input type="hidden" name="newAddr" value="<?=trim(sqlfilter($_REQUEST['newAddr']))?>" >
                    <input type="hidden" name="sggNm" value="<?=trim(sqlfilter($_REQUEST['sggNm']))?>" >
                    <input type="hidden" name="siNm" value="<?=trim(sqlfilter($_REQUEST['siNm']))?>" >
                    <button type="submit" class="blue_btn loca_btn">이 주소로 저장</button>
                </form>
            </div>
        </div>
    </section>
</div>
</body>
</html>

<!--

-->