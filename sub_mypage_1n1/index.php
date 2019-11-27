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
                <button tpye="button" class="on">자주묻는질문</button>
                <button tpye="button" class="">1:1문의</button>
            </div>
            <div class="tab_con">
                <div class="" style="display: block;">
                    <p class="tab_tlt">자주 묻는 질문 BEST%</p>
                    <ul id="faq_list">

                    </ul>
                </div>
                <div class="inquiry_1n1">
                    <div class="inpuiry_box">
                        <form action="">
                            <input type="text" placeholder="제목을 입력해 주세요.">
                            <textarea name="" id="" cols="" rows="" placeholder="내용을 입력해주세요."></textarea>
                            <button type="button" class="blue_btn">확인</button>
                        </form>
                    </div>
                    <p class="tab_tlt">내 문의내역</p>
                    <ul>
                        <!-- <li class="empty">문의 내역이 없습니다.</li> -->
                        <li>
                            <div class="slide_top">
                                <p class="answer">답변 대기</p>
                                <p class="date">2019년 11월29일</p>
                                <p class="tlt">1:1문의 남겨요!</p>
                            </div>
                            <div class="slide_bot">
                                <div class="ques">
                                    전국의 모든 소식을 대신 전해 드림으로써 더 많은 사람들에게 더 많은 소식을 알려드립니다. <br>
                                    가슴 속에 하나 둘 새겨지는 별을 이제 다 못 헤는 것은 쉬이 아침이 오는 까닭이요. 내일 밤이 남은 까닭이요. 아직 나의 청춘이 다하지 않은 까닭입니다.
                                    <div class="btn_row">
                                        <button type="button" class="blue_btn">수정</button><button type="button">삭제</button>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="slide_top">
                                <p class="answer on">답변 완료</p>
                                <p class="date">2019년 11월29일</p>
                                <p class="tlt">1:1문의 남겨요!</p>
                            </div>
                            <div class="slide_bot">
                                <div class="ques">
                                    전국의 모든 소식을 대신 전해 드림으로써 더 많은 사람들에게 더 많은 소식을 알려드립니다. <br>
                                    가슴 속에 하나 둘 새겨지는 별을 이제 다 못 헤는 것은 쉬이 아침이 오는 까닭이요. 내일 밤이 남은 까닭이요. 아직 나의 청춘이 다하지 않은 까닭입니다.
                                    <div class="btn_row">
                                        <button type="button" class="blue_btn">수정</button><button type="button">삭제</button>
                                    </div>
                                </div>
                                <div class="answer">
                                    전국의 모든 소식을 대신 전해 드림으로써 더 많은 사람들에게 더 많은 소식을 알려드립니다. <br>
                                    가슴 속에 하나 둘 새겨지는 별을 이제 다 못 헤는 것은 쉬이 아침이 오는 까닭이요. 내일 밤이 남은 까닭이요. 아직 나의 청춘이 다하지 않은 까닭입니다.
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="slide_top">
                                <p class="answer on">답변 완료</p>
                                <p class="date">2019년 11월29일</p>
                                <p class="tlt">1:1문의 남겨요!</p>
                            </div>
                            <div class="slide_bot">
                                <div class="ques">
                                    전국의 모든 소식을 대신 전해 드림으로써 더 많은 사람들에게 더 많은 소식을 알려드립니다. <br>
                                    가슴 속에 하나 둘 새겨지는 별을 이제 다 못 헤는 것은 쉬이 아침이 오는 까닭이요. 내일 밤이 남은 까닭이요. 아직 나의 청춘이 다하지 않은 까닭입니다.
                                    <div class="btn_row">
                                        <button type="button" class="blue_btn">수정</button><button type="button">삭제</button>
                                    </div>
                                </div>
                                <div class="answer">
                                    전국의 모든 소식을 대신 전해 드림으로써 더 많은 사람들에게 더 많은 소식을 알려드립니다. <br>
                                    가슴 속에 하나 둘 새겨지는 별을 이제 다 못 헤는 것은 쉬이 아침이 오는 까닭이요. 내일 밤이 남은 까닭이요. 아직 나의 청춘이 다하지 않은 까닭입니다.
                                </div>
                            </div>
                        </li>
                    </ul>
                    </li>
                </div>
            </div>
        </div>
    </section>
</div>
</body>
</html>