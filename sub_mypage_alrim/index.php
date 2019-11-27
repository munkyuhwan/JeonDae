<? include $_SERVER['DOCUMENT_ROOT'] . "/include/head.php" ?>
<?

$query = "SELECT push1_yn,push2_yn,push3_yn,push4_yn FROM member_info WHERE idx=".$_SESSION['user_access_idx'];
$result = mysqli_query($gconnet, $query);
$row = mysqli_fetch_assoc($result);

?>
<script>
    function updatePush(id) {
        $.ajax({
            url:"alarm_update.php",
            data:{"id":id,"checked":$('#'+id).prop("checked")},
            success:function(response) {

            },
            error:function(error) {

            }
        })
    }
</script>
<body>
<div class="wrapper">
    <header>
        <div class="header grd_bg sub">
            <h1>알림설정</h1>
            <a class="back_btn" href="javascript:history.go(-1)"></a>
        </div>
    </header>
    <? include $_SERVER['DOCUMENT_ROOT']."/include/main_nav.php"?>
    <section class="main_section">
        <div class="alrim_list">
            <ul>
                <li>내 제보가 발행될 때
                    <div class="slider on">
                        <input type="checkbox" id="chk1" <?= $row['push1_yn']=='Y'? "checked":"" ?> onchange="updatePush(this.id)" >
                        <label for="chk1" class="slider_btn"></label>
                    </div>
                </li>
                <li>댓글
                    <div class="slider">
                        <input type="checkbox" id="chk2" <?= $row['push2_yn']=='Y'? "checked":"" ?>  onchange="updatePush(this.id)" >
                        <label for="chk2" class="slider_btn"></label>
                    </div>
                </li>
                <li>좋아요
                    <div class="slider">
                        <input type="checkbox" id="chk3" <?= $row['push3_yn']=='Y'? "checked":"" ?>  onchange="updatePush(this.id)" >
                        <label for="chk3" class="slider_btn"></label>
                    </div>
                </li>
                <li>인기 피드
                    <div class="slider">
                        <input type="checkbox" id="chk4" <?= $row['push3_yn']=='Y'? "checked":"" ?>  onchange="updatePush(this.id)" >
                        <label for="chk4" class="slider_btn"></label>
                    </div>
                </li>
            </ul>
        </div>

    </section>
</div>
</body>
</html>

<!--

-->