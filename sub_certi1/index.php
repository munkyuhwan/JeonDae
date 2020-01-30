<? include $_SERVER['DOCUMENT_ROOT'] . "/include/head.php" ?>
<script type="application/javascript">
    function searchUni() {
        $.ajax({
            url:"search_for.php",
            data:{"keyword":$("#keyword").val()},
            success:function(response) {
                $('.auto_complete').css("display","block");
                $("#uni_list").css("display","block");
                $("#uni_list").html(response)
            },
            error:function(error) {

            }
        })
    }

    function onUniSelect(idx) {
        $("#uni_list").css("display","none");
        $("#uni_email").html( $("#uni_email_"+idx).val() );
        $("#domain").val( $("#uni_email_"+idx).val() );
        $("#uni_idx").val(idx);
        $(".result_wrap").show();
    }

    function mailDone() {
        alert('인증메일이 발송되었습니다.');
        location.replace('../main1');
    }

</script>
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
                <input type="text" id="keyword" onkeyup="searchUni()">
                <button type="button" class="input_btn"></button>
                <div class="auto_complete">
                    <ul id="uni_list">
                    </ul>
                </div>
            </div>
            <!-- 학교 검색 후 이메일 인증 영역 보여짐 -->
            <div class="result_wrap" style="display: none;" >
                <h3>학교 인증 이메일</h3>
                <form name="frm" action="action.php"  method="post" >
                    <input type="hidden" name="uni_idx" id="uni_idx"  >
                    <input type="hidden" name="domain" id="domain" value="@gmail.com" >
                    <input type="text" name="email_id" > <span id="uni_email">@hanyang.ac.kr</span>
                    <p class="mail_desc">인증 메일을 보내기 전에 해당 메일 계정이 활성화 되어있는지 확인해주세요</p>
                    <div class="btn_row">
                        <button type="submit" class="blue_btn">인증메일 전송</button>
                    </div>
                </form>
            </div>
        </div>

    </section>
</div>
<iframe name="iframe1" style="display:none;"></iframe>

<?// include $_SERVER['DOCUMENT_ROOT']."/include/footer.php" ?>
</body>
</html>

<!--

-->