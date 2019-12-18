<? include $_SERVER['DOCUMENT_ROOT'] . "/include/head.php" ?>
<body onload="getData()">
<script>
    var page=0;
    var block=10;
    function getData() {
        $.ajax({
            url:"get_data.php",
            data:{"page":page, "block":block},
            success:function(response) {
                console.log(response)
                $("#msg_list").append(response)
                page++;
            },
            error:function(error) {
                console.log(error)
            }
        })
    }

    $(window).on("scroll", function() {
        var scrollHeight = $(document).height();
        var scrollPosition = $(window).height() + $(window).scrollTop();
        if ((scrollHeight - scrollPosition) / scrollHeight === 0) {
            getData();
        }
    });

</script>
<div class="wrapper" >
    <? include $_SERVER['DOCUMENT_ROOT']."/include/header.php"?>
    <? include $_SERVER['DOCUMENT_ROOT']."/include/main_nav.php"?>
    <section class="main_section">
        <div class="alrim_wrap">
            <ul id="msg_list">

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
