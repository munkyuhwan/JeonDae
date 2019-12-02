<? include $_SERVER['DOCUMENT_ROOT'] . "/include/head.php" ?>
<?
$query = "SELECT * FROM enquries_list WHERE member_idx=".$_SESSION['user_access_idx']." ORDER BY idx DESC ";
$result = mysqli_query($gconnet, $query);
?>
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
                        location.reload();
                    }catch (e) {

                    }
                },
                error: function (error) {

                }
            })
        }
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
                <button type="button" class="">1:1문의</button>
            </div>
            <div class="tab_con">
                <div class="" style="display: block;">
                    <p class="tab_tlt">자주 묻는 질문 BEST%</p>
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
                    <ul>
                        <!-- <li class="empty">문의 내역이 없습니다.</li> -->
                        <?while($row = mysqli_fetch_assoc($result)) {?>
                            <li>
                                <div class="slide_top" >
                                    <p class="answer <?= str_replace(["Y","N"],["on",""],$row['reply_yn']) ?>" ><?= str_replace(["Y","N"],["답변 완료","답변 대기"],$row['reply_yn']) ?></p>
                                    <p class="date"><?=date("Y년 m월d일", strtotime($row['wdate']))?></p>
                                    <p class="tlt"><?=$row['q_title']?></p>
                                </div>
                                <div class="slide_bot">
                                    <div class="ques">
                                        <?=$row['q_text']?>
                                        <?if($row['member_idx']==$_SESSION['user_access_idx']) {?>
                                            <div class="btn_row">
                                                <button type="button" class="blue_btn" onclick="location.href='modify.php?idx=<?=$row['idx']?>'; " >수정</button><button type="button" onclick="deleteFaq(<?=$row['idx']?>)" >삭제</button>
                                            </div>
                                        <?}?>
                                    </div>
                                    <? if($row['reply_yn'] == "Y" ) {?>
                                        <div class="answer">
                                            <?=$row['q_reply']?>
                                        </div>
                                    <?}?>
                                </div>
                            </li>
                        <?}?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</div>
<? include $_SERVER['DOCUMENT_ROOT']."/include/footer.php"?>
</body>
</html>