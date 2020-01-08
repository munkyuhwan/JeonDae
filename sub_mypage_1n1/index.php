<? include $_SERVER['DOCUMENT_ROOT'] . "/include/head.php" ?>

<script>
    var page = 0;
    var block = 10;
    function getFaq() {
        $.ajax({
            url:"faq_template.php",
            data:{"page":page, "block":block},
            success:function(response) {
                $('#faq_list').append(response);
                $(".slide_top").on("click",function(){
                    if( $(this).closest(".del_body").length){
                        return false;
                    }else{
                        $(this).toggleClass("on");
                        $(this).next().slideToggle();
                    }
                });
            },
            error:function(error) {

            }

        })
    }
    var questionPage=0;
    var questionBlock = 5;

    function deleteFaq(idx) {
        if(confirm('삭제 하시겠습니까?')) {
            $.ajax({
                url: "delete.php",
                data: {"idx": idx},
                method: "post",
                success: function (response) {
                    try {
                        var res = JSON.parse(response);
                        alert(res.msg);
                        questionPage = 0;
                        getQuestions(true);
                        //location.reload();
                    }catch (e) {

                    }
                },
                error: function (error) {

                }
            })
        }
    }


    function getQuestions(init) {
        $.ajax({
            url: "get_my_question.php",
            data: {"page":questionPage,"block":questionBlock},
            method: "post",
            success: function (response) {
                if (response != "") {
                    if (init) {
                        $("#question_list").html("")
                        $("#question_list").html(response);
                        $(".slide_top").on("click",function(){
                            if( $(this).closest(".del_body").length){
                                return false;
                            }else{
                                $(this).toggleClass("on");
                                $(this).next().slideToggle();
                            }
                        });
                    }else {
                        $("#question_list").append(response);

                    }

                    questionPage += questionBlock
                }

            },
            error: function (error) {

            }
        })
    }

    $(document).ready(function() {
        getQuestions(false);
    })

    $(window).on("scroll", function() {
        var scrollHeight = $(document).height();
        var scrollPosition = $(window).height() + $(window).scrollTop();
        if ((scrollHeight - scrollPosition) / scrollHeight === 0) {
            getQuestions();
        }
    });

    function resetText() {
        $("#query_title").val("")
        $("#query_text").val("")
    }

</script>
<body onload="getFaq();">
<div class="wrapper">
    <header>
        <div class="header grd_bg sub">
            <h1>문의</h1>
            <a class="back_btn" href="javascript:history.go(-1)"></a>
        </div>
    </header>
    <section class="main_section">
        <div class="inquiry_list">
            <div class="tab_menu">
                <button type="button" class="on">자주묻는질문</button>
                <button type="button" class="" onclick="getQuestions()">1:1문의</button>
            </div>
            <div class="tab_con">
                <div class="" style="display: block;">
                    <p class="tab_tlt">자주 묻는 질문 BEST</p>
                    <ul id="faq_list">

                    </ul>
                </div>
                <div class="inquiry_1n1">
                    <div class="inpuiry_box">
                        <form name="frm" action="action.php" target="_fra_admin" method="post" >
                            <input type="text" name="query_title" id="query_title" placeholder="제목을 입력해 주세요.">
                            <textarea name="query_text" id="query_text" cols="" rows="" placeholder="내용을 입력해주세요."></textarea>
                            <button type="submit" class="blue_btn">확인</button>
                        </form>
                    </div>
                    <p class="tab_tlt">내 문의내역</p>
                    <ul id="question_list">
                        <!-- <li class="empty">문의 내역이 없습니다.</li> -->

                    </ul>
                </div>
            </div>
        </div>
    </section>
</div>
<? include $_SERVER['DOCUMENT_ROOT']."/include/footer.php"?>
</body>
</html>