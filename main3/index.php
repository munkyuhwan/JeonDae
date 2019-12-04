<? include $_SERVER['DOCUMENT_ROOT'] . "/include/head.php" ?>
<script>
    var page = 0;
    var block = 5;
    function getList() {

        $.ajax({
            url:"get_list.php",
            cache:true,
            data:{"page":page,"block":block,"sub_idx":<?=$_REQUEST['sub_idx']?>},
            success:function(response) {
                if (response!="") {
                    $("#main_list").append(response);
                    $(".pop_call").on("click", function () {
                        var name = $(this).attr("data-pop");
                        $(".popup." + name).fadeIn();
                        $(".mask").fadeIn();
                        $("html").addClass("scroll_no");
                        $(".snb").removeClass("snb_on");
                    });
                    page++;
                }

            },
            error:function(error) {

            }
        })
    }
    getList();
    $(window).on("scroll", function() {
        var scrollHeight = $(document).height();
        var scrollPosition = $(window).height() + $(window).scrollTop();
        if ((scrollHeight - scrollPosition) / scrollHeight === 0) {
            getList();
        }
    });

</script>
<body>
<div class="wrapper">
    <? include $_SERVER['DOCUMENT_ROOT']."/include/header.php"?>
    <? include $_SERVER['DOCUMENT_ROOT']."/include/main_nav.php"?>
    <section class="main_section">
        <div class="list_wrap">
            <ul id="main_list">
            </ul>
        </div>
        <a href="../sub_write" class="post_write_btn"></a>
    </section>
</div>
<? include $_SERVER['DOCUMENT_ROOT']."/include/gnb.php" ?>
<? include $_SERVER['DOCUMENT_ROOT']."/include/etc_popup.php" ?>
<? include $_SERVER['DOCUMENT_ROOT']."/include/img_popup.php" ?>
<?include $_SERVER['DOCUMENT_ROOT']."/include/share_pop.php"?>

</body>
</html>

<!--

-->