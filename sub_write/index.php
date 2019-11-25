<? include $_SERVER['DOCUMENT_ROOT'] . "/include/head.php" ?>
<?
$category_query = "SELECT report.category_idx, pop.view_cnt, pop.comment_cnt, pop.like_cnt, (SELECT COUNT(*) AS comment_cnt FROM report_comments WHERE report_idx=report.category_idx ) AS reply_cnt ";
$category_query .= "FROM subscribe_list AS report, popular_feeds AS pop WHERE 1 ";
$category_query .= " AND report.member_idx=".$_SESSION['user_access_idx']." AND report.category_idx=pop.category_idx ";
$category_query .= " GROUP BY report.category_idx, pop.view_cnt, pop.comment_cnt, pop.like_cnt ";
$category_result = mysqli_query($gconnet, $category_query);
$categories = array();

while($row = mysqli_fetch_assoc($category_result)) {
    $category_idx = $row['category_idx'];
    $view_cnt = $row['view_cnt'];
    $comment_cnt = $row['comment_cnt'];
    $like_cnt = $row['like_cnt'];
    $total_comment_cnt = $row['reply_cnt'];

    //구독 상세 카테고리 리스트 쿼리
    $my_subscribe = "SELECT sub_list.category_idx AS subscribe_cat_idx, sub_list.sub_category_idx, sub_cat.sub_name ";
    $my_subscribe .= " FROM subscribe_list AS sub_list, report_sub_categories AS sub_cat ";
    $my_subscribe .= " WHERE sub_list.sub_category_idx=sub_cat.idx AND sub_list.member_idx=".$_SESSION['user_access_idx']." AND sub_list.category_idx=".$category_idx;
    $my_sub_result = mysqli_query($gconnet, $my_subscribe);

    while($sub_row = mysqli_fetch_assoc($my_sub_result)) {
        array_push($categories, $sub_row['sub_name']);

    }

}
?>
<script type="text/javascript" >

    var addPicTmp = "" +
        "<div class=\"added_img\" name='img_wrapper' >"+
        "   <img alt=\"\" name='tmp_img' >"+
        "   <button  type=\"button\" class=\"img_del\" name='del_btn' onclick='deleteFile(this)'></button>"+
        "   <input hidden type=\"file\" name=\"add_pic[]\" onblur='onFileChoose(event,this)' onchange=\"onFileChoose(event, this)\" >"+
        "</div>";

    function onFileChoose(event, el) {

        var str = "";
        var reader = new FileReader;
        reader.onload = function() {
            str = addPicTmp.format(reader.result);
            var idx = $("input[name='add_pic[]']").index(el)
            $("img[name='tmp_img']")[idx].src=reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
        $("#picCnt").html( $("div[name='img_wrapper']").length );
    }

    function addFile() {
        if ( checkCnt() == true ) {
            var str = "";
            str = addPicTmp.format();
            $('#photo_wrapper').append(str);
            var inpLength = $("input[name='add_pic[]']").length;
            $("input[name='add_pic[]']")[inpLength - 1].click()

        }else {
            alert('5개 이상 추가하실 수 없습니다.');
        }

    }

    function deleteFile(ord) {
        var idx = $("button[name=del_btn]").index(ord);
        $("div[name='img_wrapper']")[idx].remove()
    }

    function checkCnt() {
        if ($("div[name='img_wrapper']").length < 5) {
            return true;
        }else {
            return false;
        }
    }
</script>
<body>
<div class="wrapper">
    <form name="frm" action="write_action.php" method="post" enctype="multipart/form-data" >
    <header>
        <div class="header grd_bg write">
            <h1 class="hidden">제보하기</h1>
            <button type="submit" class="complte_btn">제보</button>
            <button type="button" class="pop_call cancle_btn" data-pop="confirm_pop" id="cancelBtn">취소</button>
            <button type="button" class="pop_call temp_list_btn" data-pop="temp_pop" style="display:none">임시보관함</button>
        </div>
    </header>
    <section class="main_section">
        <div class="wirte_wrap">
            <div class="write_top">
                <div class="prf_box">
                    <img src="<?=$profile_img?>" alt="">
                </div>
                <textarea name="input_text" id="input_text" cols="" rows="" placeholder="어떤 이야기를 제보해 주시겠어요?" required ></textarea>
            </div>
            <div class="write_bot">
                <div class="tag_input">
                    <textarea name="hash_tags" id="hash_tags" placeholder="태그를 입력해주세요. 예) #성동구 #홍대" required><? foreach($categories as $k=>$v){ echo "#".$v;if( $k<(count($categories)-1) ){echo ",";} }?></textarea>
                </div>
                <div class="add_wrap" id="photo_wrapper">
                    <!-- input hidden type="file" id="add_pic" name="add_pic[]" onchange="onFileChoose(event, this)" -->
                    <button type="button" class="add_img_btn" onclick="addFile();"></button>
                    <!-- 이미지 추가 -->
                    <!-- div class="added_img">
                        <img src="../images/img_sample2.jpg" alt="">
                        <button  type="button" class="img_del"></button>
                    </div>
                    <div class="added_img">
                        <img src="../images/img_sample2.jpg" alt="">
                        <button  type="button" class="img_del"></button>
                    </div>
                    <div class="added_img">
                        <img src="../images/img_sample2.jpg" alt="">
                        <button  type="button" class="img_del"></button>
                    </div>
                    <div class="added_img">
                        <img src="../images/img_sample2.jpg" alt="">
                        <button  type="button" class="img_del"></button>
                    </div>
                    <div class="added_img">
                        <img src="../images/img_sample2.jpg" alt="">
                        <button  type="button" class="img_del"></button>
                    </div -->
                </div>
                <p class="img_cnt"><span id="picCnt">0</span> / 5</p>
            </div>
        </div>
    </section>
    </form>

</div>
<div class="popup confirm_pop">
    <div class="popup_wrap post_btn">
        <h2 class="hidden">임시</h2>
        <div class="post_btn_wrap">
            <ul>
                <li><p class="cofirm_tlt">임시 저장하시겠어요?</p>
                    <p class="confirm_desc">임시 저장을 사용해  내용을 저장하고<br>나중에  다시 작업할 수 있습니다.</p></li>
                <li><button type="button" class="blue_txt pop_close">임시 저장</button></li>
                <li><button type="button" class="pop_close">삭제</button></li>
            </ul>
        </div>
    </div>
</div>
<div class="popup temp_pop">
    <div class="pop_head grd_bg">
        <h2>임시보관함</h2>
        <button type="button" class="pop_close"></button>
        <button type="button" class="revise_btn">편집</button>
    </div>
    <!-- 내용 클릭시 임시저장내용 볼러옴 -->
    <div class="pop_body">
        <ul>
            <li>
                <div class="slide_top">
                    <p class="tlt">2019년 11월 12일 임시저장</p>
                    <button type="button" class="temp_del_btn"></button>
                </div>
                <div class="slide_bot">
                    전국의 모든 소식을 대신 전해 드림으로써 더 많은 사람들에게 더 많은 소식을 알려드립니다. <br>
                    가슴 속에 하나 둘 새겨지는 별을 이제 다 못 헤는 것은 쉬이 아침이 오는 까닭이요. 내일 밤이 남은 까닭이요. 아직 나의 청춘이 다하지 않은 까닭입니다.
                </div>
            </li>
            <li>
                <div class="slide_top">
                    <p class="tlt">2019년 11월 12일 임시저장</p>
                    <button type="button" class="temp_del_btn"></button>
                </div>
                <div class="slide_bot">
                    전국의 모든 소식을 대신 전해 드림으로써 더 많은 사람들에게 더 많은 소식을 알려드립니다. <br>
                    가슴 속에 하나 둘 새겨지는 별을 이제 다 못 헤는 것은 쉬이 아침이 오는 까닭이요. 내일 밤이 남은 까닭이요. 아직 나의 청춘이 다하지 않은 까닭입니다.
                </div>
            </li>
        </ul>
    </div>
</div>
</body>
</html>

<!--

-->