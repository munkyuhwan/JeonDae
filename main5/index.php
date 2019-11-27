<? include $_SERVER['DOCUMENT_ROOT'] . "/include/head.php" ?>
<script>
    var page = 0;
    var block = 10;
    var liFormat = "<li class=\"sum_item\">"+
                    "   <p class=\"con_box\">{0}<a href=\"\" class=\"more_btn\">...더보기</a></p>"+
                    "   <div class=\"con_info\">"+
                    "       <p>{1}</p><p>{2}번째 제보</p><p>{3}</p>"+
                    "   </div>"+
                    "</li>"
    var moreBtn = "<li>"+
                  "   <button type=\"button\" class=\"go_sc_btn\">계속 검색</button>"+
                  "</li>";

    function init() {
        page = 0;
        $('#list').html("")

    }

    function getData(keyword) {

        $.ajax({
            url:"get_data.php",
            data:{"keyword":keyword, "page":page, "block":block,"period": $('input[name="sc_opt[]"]:checked').val() },
            success:function(response) {
                console.log(response)
                try {
                    var res = JSON.parse(response);
                    var str = "";
                    if (res.length > 0) {
                        page++;
                    }

                    for(let data of res) {
                        var hashs = data.report_hashtag.split(",");
                        var hashStr='';
                        for(let hash of hashs) {
                            hashStr += "<span>"+hash+"</span>";
                        }
                        str += liFormat.format(data.content_text, data.wdate, data.idx, hashStr );
                    }

                    $('#list').append(str)

                }catch (e) {

                }
            },
            error:function(error) {

            }
        })

    }

    function getCount(keyword) {
        $.ajax({
            url:"get_count.php",
            data:{"keyword":keyword,"period":$('input[name="sc_opt[]"]:checked').val()},
            success:function(response) {
                console.log(response)
                try {
                    var res = JSON.parse(response);
                    var str = "'"+res.result+"개'의 게시물이 검색되었습니다.";
                    $('#count').html(str)
                }catch (e) {

                }
            },
            error:function(error) {

            }
        })
    }
</script>
<body onload="getData('')">
<div class="wrapper">
    <? include $_SERVER['DOCUMENT_ROOT']."/include/header.php"?>
    <? include $_SERVER['DOCUMENT_ROOT']."/include/main_nav.php"?>

    <section class="main_section sc_section">
        <h2 class="hidden">검색</h2>
        <div class="sc_wrap">
            <div class="sc_box">
                <input type="text" class="search_input" placeholder="검색어를 입력해 주세요." id="keyword">
                <button type="button" class="search_btn" onclick="init(); getData($('#keyword').val()); getCount($('#keyword').val()); " >검색</button>
            </div>
            <div class="sc_option">
                <div class="option_top">
                    <p>검색옵션 <span>기간 이전 게시물은 계속 검색을 이용해주세요.</span></p>
                    <button type="button" class="option_btn"></button>
                </div>
                <div class="option_bot">
                    <ul>
                        <li><input type="radio" id="sc_chk1" name="sc_opt[]" value="DAY" onclick="init();getData($('#keyword').val());getCount($('#keyword').val()); " ><label for="sc_chk1">1일</label></li>
                        <li><input type="radio" id="sc_chk2" name="sc_opt[]" value="WEEK"  onclick="init();getData($('#keyword').val());getCount($('#keyword').val()); " ><label for="sc_chk2">1주일</label></li>
                        <li><input type="radio" id="sc_chk3" name="sc_opt[]" value="MONTH"  onclick="init();getData($('#keyword').val());getCount($('#keyword').val()); " ><label for="sc_chk3">1개월</label></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- 검색 전 보여줄 이미지 검색 후 안보임 -->
        <!-- <div class="search_empty"></div> -->
        <!-- 검색 전 보여줄 이미지 -->
        <div class="sc_list">
            <p class="cnt_row" id="count"></p>
            <!-- 최초 검색시 최대 20개까지 검색결과 보여줌 / '계속검색'터치 시 20개씩 추가로 검색 -->
            <ul id="list">

            </ul>
            <ul id="more_list">
                <li>
                    <button type="button" class="go_sc_btn" onclick="getData($('#keyword').val())" >계속 검색</button>
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