<? include $_SERVER['DOCUMENT_ROOT'] . "/include/head.php" ?>
<?

$idx = $_SESSION['user_access_idx'];
$query = "SELECT * FROM member_info WHERE idx=".$idx;
$result = mysqli_query($gconnet,$query);
$row = mysqli_fetch_assoc($result);

$current_year = date('Y',time());


// 회원 제보함 구독 리스트
$main_category = "SELECT subscribe.category_idx, report.category_name FROM subscribe_list AS subscribe, report_categories AS report WHERE subscribe.member_idx=".$idx." AND subscribe.category_idx=report.idx GROUP BY subscribe.category_idx ";
$main_cat_result = mysqli_query($gconnet, $main_category);

// 해시태그
$hashtag_query = "SELECT subscribe.category_idx, sub_cat.sub_name FROM subscribe_list AS subscribe, report_sub_categories AS sub_cat WHERE subscribe.member_idx=".$idx." AND subscribe.sub_category_idx=sub_cat.idx ";
$hastag_result = mysqli_query($gconnet, $hashtag_query);



?>
<body>

<script type="application/javascript">

    function imageSelected(event) {
        var reader = new FileReader;
        reader.onload = function() {
            $("#profile_img").attr("src",reader.result);
        };
        reader.readAsDataURL(event.target.files[0]);
    }

</script>
<div class="wrapper">
    <header>
        <div class="header grd_bg sub">
            <h1>개인정보수정</h1>
            <a class="back_btn" href="javascript:history.go(-1)"></a>
        </div>
    </header>
    <nav class="main_nav">
        <ul>
            <li class="main_menu1"><a href="main1.html" title="메인"></a></li>
            <li class="main_menu2"><a href="main2.html" title=""></a></li>
            <li class="main_menu3"><a href="main3.html" title="거래"></a></li>
            <li class="main_menu4"><a href="main4.html" title="알림"></a></li>
            <li class="main_menu5"><a href="main5.html" title="검색"></a></li>
        </ul>
    </nav>
    <section class="main_section">

        <div class="myinfo_wrap">
            <form name="frm" action="edit_action.php" method="post" enctype="multipart/form-data" >
            <div class="user_wrap">
                <div class="user_img_wrap">
                    <div class="user_img">
                        <img id="profile_img" src="../thumb/thumb.php?src=../upload_file/member/<?=$_SESSION['profile_img']?>&size=400x300" alt="유저 사진">
                    </div>
                    <input type="file" name="profile_img" id="img_change" onchange="imageSelected(event)" >
                    <label for="img_change" class="img_change_btn"></label>
                </div>
            </div>
            <div class="info_row">
                <p class="info_tlt">이름</p>
                <div class="info_con name_con"><input type="text" name="user_name" class="" value="<?=$_SESSION['user_access_name']?>"></div>
            </div>
            <div class="user_certi">
                <span class="certi1">학교인증</span>
                <span class="certi2 on">지역인증</span>
            </div>
            <div class="info_row">
                <p class="info_tlt">성별</p>
                <div class="info_con gender">
                    <input type="radio" id="check_male" value="M" <?=$row['gender']=='M' ? "checked":"" ?> name="gender">
                    <label for="check_male">남</label>
                    <input type="radio" id="check_female" value="F" <?=$row['gender']=='F' ? "checked":"" ?>  name="gender">
                    <label for="check_female">녀</label>
                </div>
            </div>
            <div class="info_row">
                <p class="info_tlt">연령</p>
                <div class="info_con">
                    <div class="select_div">
                        <select name="year_birth" id="">
                            <?for($i=$current_year;$i>1950;$i--) {?>
                                <option value="<?=$i?>" <?=$i==$row['birthday'] ? "selected":"" ?> ><?=$i?></option>
                            <?}?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="info_row">
                <p class="info_tlt">가입일</p>
                <div class="info_con">
                    <?=date("Y.m.d", strtotime($row['wdate']) )?>
                </div>
            </div>
            <div class="info_row">
                <p class="info_tlt">관심해시태그</p>
                <div class="info_con">
                    <div class="selected_tag">
                        <?while($sub_cat_row = mysqli_fetch_assoc($hastag_result)) {?>
                            <span><?=$sub_cat_row["sub_name"]?></span>
                        <?}?>
                         <button type="button" class="tag_arrow"></button>
                    </div>
                    <div class="tag_type">
                        <ul>
                            <? while($main_cat_row = mysqli_fetch_assoc($main_cat_result) ) {?>
                                <?
                                $sub_query = "SELECT * FROM report_sub_categories WHERE report_idx=".$main_cat_row['category_idx'];
                                $sub_query_res = mysqli_query($gconnet, $sub_query);
                                ?>
                                <?while ($sub_row = mysqli_fetch_assoc($sub_query_res)) {?>
                                    <li><input type="checkbox" name="hashtags[]" id="subs<?=$sub_row['idx']?>" value="<?=$sub_row['idx']?>" checked><label for="subs<?=$sub_row['idx']?>"><?=$sub_row['sub_name']?></label></li>
                                <?}?>
                           <?}?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="info_row">
                <p class="info_tlt">구독정보</p>
                <div class="info_con subs_info">
                    <?
                    $main_cat_result = mysqli_query($gconnet, $main_category);
                    ?>
                    <? while( $main_cat_row = mysqli_fetch_assoc($main_cat_result) ) {?>
                        <span><?=$main_cat_row['category_name']?></span>
                    <?}?>
                </div>
            </div>
            <div class="info_row">
                <p class="info_tlt">클린필터</p>
                <div class="info_con">
                    <div class="clean_level">
                        <p class="level1">
                            <input type="radio" name="subs_clean" value="1" id="lv1" <?=$row['clean_filter'] == 1 ? "checked":"" ?> ><label for="lv1"><span>클린</span></label>
                        </p>
                        <p class="level2">
                            <input type="radio" name="subs_clean" value="2"  id="lv2" <?=$row['clean_filter'] == 2 ? "checked":"" ?>><label for="lv2"><span>중간</span></label>
                        </p>
                        <p class="level3">
                            <input type="radio" name="subs_clean" value="3"  id="lv3" <?=$row['clean_filter'] == 3 ? "checked":"" ?>><label for="lv3"><span>없음</span></label>
                        </p>
                        <div class="clean_bar"></div>
                    </div>
                </div>
            </div>
            <div class="info_row btn_row">
                <button type="submit" class="blue_btn">저장</button><button type="button">취소</button>
            </div>

                <form>
        </div>

            <div class="mylist">
            <div class="tab_menu">
                <button tpye="button" class="on">작성한 글</button>
                <button tpye="button">작성한 댓글</button>
                <button tpye="button">좋아요한 글</button>
            </div>
            <div class="tab_con">
                <div class="con1" style="display:block">
                    <? include "write_list.php"?>
                </div>
                <div class="con2">
                    <? include "comment_list.php"?>
                </div>
                <div class="con3">
                    <? include "likes_list.php"?>
                </div>
            </div>
        </div>

    </section>
</div>

</body>
</html>

<!--

-->