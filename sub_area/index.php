<? include $_SERVER['DOCUMENT_ROOT']."/include/head.php" ?>
<?

$idx = trim(sqlfilter($_REQUEST['idx']));
$query = "SELECT cover_img, profile_img, category_name  FROM report_categories WHERE idx=".$idx;
$result = mysqli_query($gconnet, $query);
$row = mysqli_fetch_assoc($result);

if ($_SESSION['user_access_idx']!='') {
    $subscribe_query = "SELECT COUNT(*) AS cnt  FROM subscribe_list WHERE category_idx=" . $idx . " AND member_idx=" . $_SESSION['user_access_idx'];
    $sub_res = mysqli_query($gconnet, $subscribe_query);
    $sub_assoc = mysqli_fetch_assoc($sub_res);
    $subscribe_cnt = $sub_assoc['cnt'];
}

?>
<script type="application/javascript">
    var page = 0;
    var block = 5;

    function loadData() {
        console.log(page)
        $.ajax({
            url:"get_data.php",
            data:{"page":page, "block":block, "category_idx":<?=$idx?>},
            method:"POST",
            success:function(response) {
                if (response != "" ) {
                    $('#report_list').append(response);
                    $(".pop_call").on("click", function () {
                        var name = $(this).attr("data-pop");
                        $(".popup." + name).fadeIn();
                        $(".mask").fadeIn();
                        $("html").addClass("scroll_no");
                        $(".snb").removeClass("snb_on");
                        //swiper.update();
                    });
                    page++;
                }
            },
            error:function(error) {

            }
        })
    }



    $(window).on("scroll", function() {
        var scrollHeight = $(document).height();
        var scrollPosition = $(window).height() + $(window).scrollTop();
        if ((scrollHeight - scrollPosition) / scrollHeight === 0) {
            loadData();
        }
    });

</script>
<body onload="loadData();loadMainData(); ">
<div class="wrapper">
    <? include $_SERVER['DOCUMENT_ROOT']."/include/header.php" ?>
    <? include $_SERVER['DOCUMENT_ROOT']."/include/main_nav.php" ?>
    <section class="main_section">
        <h2 class="hidden">지역 메인</h2>
        <div class="area_tlt">
            <div class="area_img">
                <img src="../thumb/thumb.php?src=../upload_file/category_cover/<?=$row['cover_img']?>" alt="지역 이미지">
            </div>
            <div class="area_inner">
                <p class="area_logo"><img src="../thumb/thumb.php?src=../upload_file/category_profile/<?=$row['profile_img']?>" alt="원 이미지"></p>
                <span><?=$row['category_name']?></span>
                <?if (intval($subscribe_cnt) <= 0 ) {?>
                    <form action="do_subscribe.php" name="frm" method="post" target="_fra_admin"  >
                        <input type="hidden" name="category_idx" value="<?=$idx?>">
                        <button type="submit" class="subs_btn blue_btn" >구독</button>
                    </form>
                <?}?>
            </div>
        </div>
        <div class="list_wrap popular">
            <p class="desc">이 구역의 인기글은 나야 :)</p>
            <div class="swiper-container2">
                <ul class="swiper-wrapper" id="main_list">

                </ul>
                <div class="swiper-pagination">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <a href="../main3?sub_idx=<?=$idx?>" class="more_btn">더보기</a>
        </div>
        <div class="list_wrap">
            <ul id="report_list" >
            </ul>
        </div>
        <a href="../sub_write" class="post_write_btn"></a>
    </section>
</div>
<script>

    var swiper = new Swiper('.swiper-container2',{
        effect: "slide",
        loop: true,
        navigation:{ nextEl: ".slide_next_btn", prevEl: ".slide_prev_btn" },
        autoplay: { delay: 3000 },
        on:{ slideChange: function(){
            $(".main_visual").removeClass("bounce");
            setTimeout(function() {
                $(".main_visual").addClass("bounce")
            }, 200);
        }

        }
    });

    function loadMainData() {
        $.ajax({
            url:"get_data.php",
            data:{"page":page, "block":block, "category_idx":<?=$idx?>},
            method:"POST",
            success:function(response) {
                $('#main_list').append(response);
                swiper.update();
            },
            error:function(error) {

            }
        })
    }
</script>
<? include $_SERVER['DOCUMENT_ROOT']."/include/gnb.php" ?>
<? include $_SERVER['DOCUMENT_ROOT']."/include/share_pop.php" ?>
<? include $_SERVER['DOCUMENT_ROOT']."/include/img_popup.php" ?>
<? include $_SERVER['DOCUMENT_ROOT']."/include/footer.php"?>
</body>
</html>

<!--

-->