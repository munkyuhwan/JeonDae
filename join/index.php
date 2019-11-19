<? include $_SERVER['DOCUMENT_ROOT'] . "/include/head.php" ?>
<?php
$fbId = trim(sqlfilter($_REQUEST['fb_id']));
$year = date("Y", time());

$guQuery = "SELECT * FROM gus ";
$result = mysqli_query($gconnet, $guQuery);

?>
<body>
<div class="wrapper ">
    <section class="join_section grd_bg ">
        <h1><img src="../images/logo.png" alt="전대전 로고"></h1>
        <div class="join_form">
            <h2>회원가입</h2>
            <form name="frm" method="post" action="join_action.php">
                <input type="hidden" name="fb_id" value="<?=$fbId?>">
                <div class="join_row">
                    <p><input type="radio" id="check_male" name="gender" value="M" required><label for="check_male">남</label></p>
                    <p><input type="radio" id="check_female" name="gender" value="F" required><label for="check_female">녀</label></p>
                </div>
                <div class="join_row select_row">
                    <div class="select_div">
                        <select name="birth" id="birth" required >
                            <option value="">출생년도</option>
                            <?for($i=$year;$i>($year-100);$i--) {?>
                                <option value="<?=$i?>"><?=$i?></option>
                            <?}?>
                        </select>
                    </div>
                </div>
                <div class="join_row select_row">
                    <div class="select_div">
                        <select name="region" id="region" required>
                            <option value="">지역</option>
                            <?while($row = mysqli_fetch_assoc($result) ) {?>
                                <option value="<?=$row['idx']?>"><?=$row['gu_name']?></option>
                            <?}?>
                        </select>
                    </div>
                </div>
                <div class="btn_row">
                    <button type="submit">완료</button>
                </div>
            </form>
        </div>
    </section>
</div>
</body>
</html>
