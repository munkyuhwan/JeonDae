<? include $_SERVER['DOCUMENT_ROOT'] . "/include/head.php" ?>
<body onload="init()">
<div class="wrapper">
    <header>
        <div class="header grd_bg sub">
            <h1>지역인증</h1>
            <a class="back_btn" href="javascript:history.go(-1)"></a>
        </div>
    </header>
    <section class="main_section">
        <div class="certi_result">
            <h2 class="hidden">주소 검색결과</h2>
            <div class="input_wrap ">
                <form name="formRoadSearch" action="./" id="formRoadSearch" method="post" >
                    <input type="hidden" name="resultType" value="json" >
                    <input type="hidden" name="currentPage" id="currentPage" >
                    <input type="hidden" name="countPerPage" id="countPerPage" >
                    <!-- input type="hidden" name="keyword" value="<?//=trim(sqlfilter($_REQUEST['addr_inp']))?>" -->
                    <input type="hidden" name="returnUrl" >
                    <input type="hidden" name="confmKey" value="devU01TX0FVVEgyMDE5MTEyNjEyMzA1NTEwOTIyMTM=" >
                    <input type="text" name="keyword" id="keyword" value="<?=trim(sqlfilter($_REQUEST['keyword']))?>">
                    <button type="submit" class="input_btn"></button>
                </form>
            </div>
            <div class="result_list" id="jusoList" >
            </div>
        </div>
    </section>
    <form name="frm" id="frmNext" action="../sub_certi2_3">
        <input type="hidden" name="oldAddr" id="oldAddr">
        <input type="hidden" name="newAddr" id="newAddr">
        <input type="hidden" name="sggNm" id="sggNm">
        <input type="hidden" name="siNm" id="siNm">
    </form>
</div>
<script language="javascript">

    var currentPage = 1;
    var countPerPage = 10;

    $(window).scroll(function() {
        if($(window).scrollTop() + $(window).height() == $(document).height()) {
            searchList(currentPage,countPerPage)
        }
    });

    var jusuList =  " <li onclick=\"toNext(this);\" > " +
                    "   <p class=\"tlt\" >{0}</p>"+
                    "   <p class=\"detail\" >{1}</p>"+
                    "   <p class=\"detail2\"><i>도로명</i>{2}</p>"+
                    "   <input type='hidden' value='{3}' >"+
                    "   <input type='hidden' value='{4}' >"+
                    "</li>"

    function init(){
        $('#jusoList').html("");
        searchList(1, 10);
    }

    function toNext(elm) {
        var oldAddr = elm.getElementsByTagName('P')[1].innerHTML
        var newAddr = elm.getElementsByTagName('P')[2].innerHTML.replace("<i>도로명</i>","")
        var sggNm = elm.getElementsByTagName('input')[0].value
        var siNm = elm.getElementsByTagName('input')[1].value

        $('#newAddr').val(newAddr)
        $('#oldAddr').val(oldAddr)
        $('#sggNm').val(sggNm)
        $('#siNm').val(siNm)
        $('#frmNext').submit();
    }

    function searchList(cPage, cntPage) {
        $('#currentPage').val(cPage);
        $('#countPerPage').val(cntPage);

        $.ajax({
            url : "http://www.juso.go.kr/addrlink/addrLinkApiJsonp.do"
            ,type:"post"
            ,data:$("#formRoadSearch").serialize()
            ,dataType:"jsonp"
            ,crossDomain:true
            ,success:function(jsonStr) {

                $("#listRoadSearch").html("");
                var errCode = jsonStr.results.common.errorCode;
                var errDesc = jsonStr.results.common.errorMessage;
                if (errCode == "0" && jsonStr.results.common.totalCount > 0 ) {

                    var str = "<ul>";
                    for (let data of jsonStr.results.juso) {
                        str += jusuList.format(data.bdNm, data.jibunAddr, data.roadAddr, data.sggNm, data.siNm);
                    }
                    str += "</ul>";

                    $('#jusoList').append(str);
                    currentPage++;

                }else {
                    alert('검색 결과가 없습니다.')
                }
            }
            ,error: function(xhr,status, error){
                alert("에러발생");
            }
        });
    }
</script>
</body>
</html>

<!--

-->