<? include $_SERVER['DOCUMENT_ROOT'] . "/include/head.php" ?>
<?

$_SESSION['user_access_idx'] = $_SESSION['idx'];
$idx = $_SESSION['user_access_idx'];
$query = "SELECT * FROM member_info WHERE idx=".$idx;
$result = mysqli_query($gconnet,$query);
$row = mysqli_fetch_assoc($result);

$hashtag_query ="SELECT * FROM user_hashtags WHERE member_idx=".$idx;
$hashtag_result = mysqli_query($gconnet, $hashtag_query);


$subscribe_query = "SELECT subscribe.idx, subscribe.category_idx FROM subscribe_list AS subscribe WHERE member_idx=".$idx;
$subscribe_result = mysqli_query($gconnet, $subscribe_query);

$current_year = date('Y',time())



?>
<body>
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
            <div class="user_wrap">
                <div class="user_img_wrap">
                    <div class="user_img">
                        <img src="../thumb/thumb.php?src=../upload_file/member/<?=$row['file_chg']?>" alt="유저 사진">
                    </div>
                    <input type="file" id="img_change">
                    <label for="img_change" class="img_change_btn"></label>
                </div>
            </div>
            <div class="info_row">
                <p class="info_tlt">이름</p>
                <div class="info_con name_con"><input type="text" class="" value="<?=$row['real_name']?>"></div>
            </div>
            <div class="user_certi">
                <span class="certi1">학교인증</span>
                <span class="certi2 on">지역인증</span>
            </div>
            <div class="info_row">
                <p class="info_tlt">성별</p>
                <div class="info_con gender">
                    <input type="radio" id="check_male" <?=$row['gender']=='M' ? "checked":"" ?> name="gender">
                    <label for="check_male">남</label>
                    <input type="radio" id="check_female" <?=$row['gender']=='F' ? "checked":"" ?>  name="gender">
                    <label for="check_female">녀</label>
                </div>
            </div>
            <div class="info_row">
                <p class="info_tlt">연령</p>
                <div class="info_con">
                    <div class="select_div">
                        <select name="" id="">
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
                        <?while($hashtag_row = mysqli_fetch_assoc($hashtag_result)) {?>
                            <span><?=$hashtag_row['hash_tag']?></span>
                        <?}?>
                        <button type="button" class="tag_arrow"></button>
                    </div>
                    <div class="tag_type">
                        <ul>
                            <li><input type="checkbox" id="subs1"><label for="subs1">일상</label></li>
                            <li><input type="checkbox" id="subs2"><label for="subs2">중고거래</label></li>
                            <li><input type="checkbox" id="subs3"><label for="subs3">알바</label></li>
                            <li><input type="checkbox" id="subs4"><label for="subs4">동호회</label></li>
                            <li><input type="checkbox" id="subs5"><label for="subs5">인디밴드</label></li>
                            <li><input type="checkbox" id="subs6"><label for="subs6">20대</label></li>
                            <li><input type="checkbox" id="subs7"><label for="subs7">30대</label></li>
                            <li><input type="checkbox" id="subs8"><label for="subs8">40대</label></li>
                            <li><input type="checkbox" id="subs9"><label for="subs9">심야영화</label></li>
                            <li><input type="checkbox" id="subs10"><label for="subs10">기타</label></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="info_row">
                <p class="info_tlt">구독정보</p>
                <div class="info_con subs_info">
                    <?while($sub_row = mysqli_fetch_assoc($subscribe_result) ) {?>
                        <span><?=$sub_row['category_nam']?></span>
                    <?}?>
                    <span>광진구</span>, <span>성동구</span>, <span>마포구</span>
                </div>
            </div>
            <div class="info_row">
                <p class="info_tlt">클린필터</p>
                <div class="info_con">
                    <div class="clean_level">
                        <p class="level1">
                            <input type="radio" name="subs_clean" id="lv1" <?=$row['clean_filter'] == 1 ? "checked":"" ?> ><label for="lv1"><span>클린</span></label>
                        </p>
                        <p class="level2">
                            <input type="radio" name="subs_clean" id="lv2" <?=$row['clean_filter'] == 2 ? "checked":"" ?>><label for="lv2"><span>중간</span></label>
                        </p>
                        <p class="level3">
                            <input type="radio" name="subs_clean" id="lv3" <?=$row['clean_filter'] == 3 ? "checked":"" ?>><label for="lv3"><span>없음</span></label>
                        </p>
                        <div class="clean_bar"></div>
                    </div>
                </div>
            </div>
            <div class="info_row btn_row">
                <button type="button" class="blue_btn">저장</button><button type="button">취소</button>
            </div>
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