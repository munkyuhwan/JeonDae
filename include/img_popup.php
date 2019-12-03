<script>
    var popImg = "<li class=\"swiper-slide\" >"+
                 "   <img src=\"../thumb/thumb.php?src={0}\" alt=\"\">"+
                 "</li>"
    function setImages(report_idx) {
        swiper = new Swiper('.swiper-container',{
            effect: "slide",
            loop: true,
            navigation:{ nextEl: ".slide_next_btn", prevEl: ".slide_prev_btn" },
            autoplay: { delay: 3000 },
            on:{ slideChange: function(){
                $(".main_visual").removeClass("bounce");
                setTimeout(function() {
                    $(".main_visual").addClass("bounce")  }, 200); }
            },
        });
        $.ajax({
            url:"get_images.php",
            method:"POST",
            data:{"report_idx":report_idx},
            success:function(response){
                $(".pop_call").on("click",function(){
                    var name = $(this).attr("data-pop");
                    $(".popup."+name).fadeIn();
                    $(".mask").fadeIn();
                    $("html").addClass("scroll_no");
                    $(".snb").removeClass("snb_on");
                    swiper.update();
                });

                try {
                    var res = JSON.parse(response);
                    var str = "";
                    for(let obj of res) {
                        console.log(obj)
                        str += popImg.format("../upload_file/report/" + obj.report_file_name);
                    }
                    $("#img_list").html("");
                    $("#img_list").html(str);

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
        <div class="swiper-container">
            <ul class="swiper-wrapper" id="img_list" >
                <!-- li class="swiper-slide">
                    <img src="../images/img_sample2.jpg" alt="">
                </li>
                <li class="swiper-slide">
                    <img src="../images/img_sample4.jpg" alt="">
                </li>
                <li class="swiper-slide">
                    <img src="../images/img_sample5.jpg" alt="">
                </li>
                <li class="swiper-slide">
                    <img src="../images/img_sample6.jpg" alt="">
                </li>
                <li class="swiper-slide">
                    <img src="../images/img_sample4.jpg" alt="">
                </li -->
            </ul>
        </div>
        <div class="slide_nav_btn">
            <button class="slide_prev_btn"><img src="../images/icon_arrow_left.png"></button>
            <button class="slide_next_btn"><img src="../images/icon_arrow_right.png"></button>
        </div>
    </div>
    <div class="btn_box">
        <button type="button" class="like_btn">26</button>
        <span class="reply_cnt">15</span>
    </div>
    <button tpye="button" class="pop_close"></button>
</div>