<? include $_SERVER['DOCUMENT_ROOT'] . "/include/head.php" ?>
<?
$idx = trim(sqlfilter($_REQUEST['idx']));
$query = "SELECT * FROM enquries_list WHERE idx=".$idx." AND member_idx=".$_SESSION['user_access_idx']." ORDER BY idx DESC ";
$result = mysqli_query($gconnet, $query);
$row = mysqli_fetch_assoc($result);
?>
<body>
<div class="wrapper">
    <header>
        <div class="header grd_bg sub">
            <h1>문의</h1>
            <a class="back_btn" href="javascript:history.go(-1)"></a>
        </div>
    </header>
    <section class="main_section">
        <div class="inquiry_list">
            <div class="tab_con">
                <div class="inquiry_1n1" style="display: block;">
                    <div class="inpuiry_box">
                        <form name="frm" action="modify_action.php" target="_fra_admin" method="post" >
                            <input type="hidden" name="idx" value="<?=$idx?>">
                            <input type="text" name="query_title" id="query_title" value="<?=$row['q_title']?>" placeholder="제목을 입력해 주세요.">
                            <textarea name="query_text" id="query_text" cols="" rows="" placeholder="내용을 입력해주세요."><?=$row['q_text']?></textarea>
                            <button type="submit" class="blue_btn">수정</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
<? include $_SERVER['DOCUMENT_ROOT']."/include/footer.php"?>
</body>
</html>