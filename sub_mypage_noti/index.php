<? include $_SERVER['DOCUMENT_ROOT'] . "/include/head.php" ?>
<script type="application/javascript">

    var page=0;
    var block=10;
    function getData() {
        $.ajax({
            url:"get_data.php",
            data:{"page":page,"block":block},
            success:function(response) {
                $('#list').append(response);
                $('#list').trigger("create");
                $('.slide_top').click(function() {
                    if( $(this).closest(".del_body").length){
                        return false;
                    }else{
                        $(this).toggleClass("on");
                        $(this).next().slideToggle();
                    }
                })
                page++;
            },
            error:function(error) {

            }
        })
    }

</script>
<body onload="getData()">
<div class="wrapper">
    <header>
        <div class="header grd_bg sub">
            <h1>공지사항</h1>
            <a class="back_btn" href="javascript:history.go(-1)"></a>
        </div>
    </header>
    <? include $_SERVER['DOCUMENT_ROOT']."/include/main_nav.php"?>
    <section class="main_section">
        <div class="noti_list">
            <ul id="list">
            </ul>
        </div>

    </section>
</div>
</body>
</html>

<!--

-->