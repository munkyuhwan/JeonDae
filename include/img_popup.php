

<script type="application/javascript">
    var popImg = "<li class=\"swiper-slide\" >"+
                 "   <img src=\"../thumb/thumb.php?src={0}&size=<500\" alt=\"\">"+
                 "</li>"
    function setImages(report_idx, likeCnt, commentCnt, imgIdx) {
        $.ajax({
            url:"get_images.php",
            method:"POST",
            data:{"report_idx":report_idx},
            success:function(response){

                try {
                    $('#pop_like_cnt').html(likeCnt);
                    $('#pop_comment_cnt').html(commentCnt);
                    var res = JSON.parse(response);
                    var str = "";
                    var initialIndex = 1
                    var i=1;
                    for(let obj of res) {
                        if (obj.idx == imgIdx) {
                            initialIndex = i;
                        }
                        str += popImg.format("../upload_file/report/" + obj.report_file_name);
                        i++;
                    }
                    $("#img_list").html("");
                    $("#img_list").html(str);

                    var swiper2 = new Swiper('.swiper-container',{
                        effect: "slide",
                        loop: true,
                        navigation:{ nextEl: ".slide_next_btn", prevEl: ".slide_prev_btn" },
                        //autoplay: { delay: 3000 },
                        on:{ slideChange: function(){
                            $(".main_visual").removeClass("bounce");
                            setTimeout(function() {
                                $(".main_visual").addClass("bounce")
                            }, 200);

                        }
                        }
                    });
                    swiper2.activeIndex = initialIndex;
                    swiper2.update();


                }catch(e) {
                    console.log(e)
                }


            },
            error:function(error) {

            }
        })
    }
</script>
<div class="popup img_pop">
    <div class="img_slider">
        <div class="swiper-container popup-swiper">
            <ul class="swiper-wrapper" id="img_list" >
            </ul>
        </div>
        <div class="slide_nav_btn">
            <button class="slide_prev_btn"><img src="../images/icon_arrow_left.png"></button>
            <button class="slide_next_btn"><img src="../images/icon_arrow_right.png"></button>
        </div>
    </div>
    <div class="btn_box">
        <button type="button" class="like_btn" id="pop_like_cnt">26</button>
        <span class="reply_cnt" id="pop_comment_cnt">15</span>
    </div>
    <button tpye="button" class="pop_close"></button>
</div>