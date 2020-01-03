<? include $_SERVER['DOCUMENT_ROOT'] . "/include/head.php" ?>
<?
/*
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
*/
$query_category = "SELECT cat_name.sub_name FROM subscribe_list AS subscribe, report_sub_categories AS cat_name  WHERE subscribe.member_idx=".$_SESSION['user_access_idx']." AND subscribe.sub_category_idx=cat_name.idx ";
$query_category_result = mysqli_query($gconnet, $query_category);
$hashtag_str = "";
while($row = mysqli_fetch_assoc($query_category_result)) {
    $hashtag_str .= "#".$row['sub_name'].",";
    array_push($categories, $row['sub_name']);
}
$select_incomplete = "SELECT report.idx, report.content_text, report.wdate, report.report_hashtag ";
//$select_incomplete .= " , add_files.idx AS file_idx, add_files.report_file_name ";
$select_incomplete .= " FROM report_list AS report";
//$select_incomplete .= " , report_additional_files AS add_files";
$select_incomplete .= " WHERE report.member_idx=".$_SESSION['user_access_idx']." AND report.complete_yn='N' ";
//$select_incomplete .= " AND report.idx=add_files.report_idx ";

//echo "<br><br><br><br><br>".$select_incomplete;

$incomplete_result = mysqli_query($gconnet, $select_incomplete);
$incomplete_cnt = mysqli_num_rows($incomplete_result);

?>
<script type="text/javascript" >


    var addPicTmp = "" +
        "<div class=\"added_img\" name='img_wrapper' >"+
        "   <img alt=\"\" name='tmp_img' src='{0}' >"+
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
            str = addPicTmp.format("");
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
<script>
    /*
    window.onbeforeunload = function (e) {
        $("#complete_yn").val("N")
        var message = "Your confirmation message goes here.",
            e = e || window.event;
        // For IE and Firefox
        if (e) {
            e.returnValue = message;
        }
        $("#cancelBtn").click()
        // For Safari
        return false;
    };
    */

    function addHashtag() {

        var str = "";

        if ($("#hash_tags").val()[0] != "#" ) {
            str = "#" + $("#hash_tags").val().replace(" ", ",#");
        }else {
            str = $("#hash_tags").val().replace(" ", ",#");
        }

        $("#hash_tags").val( str )
    }
</script>
<body>
<div class="wrapper">
    <form name="frm" action="write_action.php" method="post" enctype="multipart/form-data" >
        <input type="hidden" name="complete_yn" id="complete_yn" value="Y" >
        <input type="hidden" name="continue_idx" id="continue_idx" >
    <header>
        <div class="header grd_bg write">
            <h1 class="hidden">제보하기</h1>
            <button type="submit" class="complte_btn">제보</button>
            <button type="button" class="pop_call cancle_btn" data-pop="confirm_pop" id="cancelBtn" >취소</button>
            <?if (intval($incomplete_cnt)>0) {?>
                <button type="button" class="pop_call temp_list_btn" data-pop="temp_pop" style="display:block" >임시보관함</button>
            <?}?>
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
                    <textarea name="hash_tags" id="hash_tags" placeholder="태그를 입력해주세요. 예) #성동구 #홍대" required onkeyup="addHashtag()"  ><?=$hashtag_str?></textarea>
                </div>
                <div class="add_wrap" id="photo_wrapper">
                    <button type="button" class="add_img_btn" onclick="addFile();"></button>
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
                <li><button type="button" class="blue_txt pop_close" onclick="$('#complete_yn').val('N'); document.frm.submit(); ">임시 저장</button></li>
                <li><button type="button" class="pop_close" onclick="history.back();" >삭제</button></li>
            </ul>
        </div>
    </div>
</div>
<div class="popup temp_pop">
    <div class="pop_head grd_bg">
        <h2>임시보관함</h2>
        <button type="button" class="pop_close" id="tmp_close"></button>
        <button type="button" class="revise_btn" id="edit_delete">편집</button>
    </div>
    <!-- 내용 클릭시 임시저장내용 볼러옴 -->
    <script>
        function deletePrevFile(fileName,fileIdx) {
            $.ajax({
                url:"del_prev_file.php",
                data:{"fileName":fileName,"fileIdx":fileIdx},
                success:function(response) {

                },
                error:function(error) {

                }

            })
        }
    </script>
    <script>
        var tmpContent="";
        var tmpHashtags="";
        var tmpReportIdx = "";
        var prevAddPicTmp = "" +
            "<div class=\"added_img\" name='img_wrapper' >"+
            "   <img alt=\"\" name='tmp_img' src='../upload_file/report/{0}' >"+
            "   <button  type=\"button\" class=\"img_del\" name='del_btn' onclick=\"deletePrevFile('{0}','{1}')\"></button>"+
            "   <input hidden type=\"file\" name=\"add_pic[]\" onblur='onFileChoose(event,this)' onchange=\"onFileChoose(event, this)\" >"+
            "</div>";
        function onTmpSelected(report_idx, content, hashtag) {
            $("#input_text").val(content);
            $("#hash_tags").val(hashtag);
            $('#continue_idx').val(report_idx)
            $.ajax({
                url:"get_additional_files.php",
                data:{"report_idx":report_idx},
                success:function(response) {
                    try {
                        var res = JSON.parse(response);
                        var str = ""
                        for(let obj of res) {
                            str += prevAddPicTmp.format(obj.report_file_name, obj.idx);
                        }
                        $('#photo_wrapper').html("<button type=\"button\" class=\"add_img_btn\" onclick=\"addFile();\" ></button>")
                        $('#photo_wrapper').append(str);


                    }catch (e) {

                    }
                },
                error:function(error) {

                }
            })
            $("#tmp_close").click();
        }

        $("#edit_delete").on('click', function() {

        });

    </script>
    <div class="pop_body">
        <ul>
            <?while($row = mysqli_fetch_assoc($incomplete_result) ) {?>
                <li>
                    <div class="slide_top">
                        <p class="tlt"><?=date("Y년 m월 d일",strtotime($row['wdate']))?> 임시저장</p>
                        <button type="button" class="temp_del_btn"></button>
                    </div>
                    <div class="slide_bot" onclick="onTmpSelected('<?=$row['idx']?>', '<?=$row['content_text']?>', '<?=$row['report_hashtag']?>') ">
                        <?=$row['content_text']?>
                    </div>
                </li>
            <?}?>
        </ul>
    </div>
</div>
</body>
</html>

<!--

-->