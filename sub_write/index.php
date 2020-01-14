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
$query_category = "SELECT cat_name.sub_name FROM subscribe_list AS subscribe, report_sub_categories AS cat_name  WHERE subscribe.member_idx=".$_SESSION['user_access_idx']." AND subscribe.sub_category_idx=cat_name.idx ";
$query_category_result = mysqli_query($gconnet, $query_category);
$hashtag_str = "";
$categories = array();
while($row = mysqli_fetch_assoc($query_category_result)) {
    $hashtag_str .= "#".$row['sub_name'].",";
    array_push($categories, $row['sub_name']);
}
*/

$select_incomplete = "SELECT report.idx, report.content_text, report.wdate, report.report_hashtag, report.category ";
//$select_incomplete .= " , add_files.idx AS file_idx, add_files.report_file_name ";
$select_incomplete .= " FROM report_list AS report";
//$select_incomplete .= " , report_additional_files AS add_files";
$select_incomplete .= " WHERE report.member_idx=".$_SESSION['user_access_idx']." AND report.complete_yn='N' ";
//$select_incomplete .= " AND report.idx=add_files.report_idx ";

//echo "<br><br><br><br><br>".$select_incomplete;

$incomplete_result = mysqli_query($gconnet, $select_incomplete);
$incomplete_cnt = mysqli_num_rows($incomplete_result);

// 재보함 종류 지역 / 학교
$categoryType = trim(sqlfilter($_REQUEST['top_cat']));
$allCategoriesQuery = "SELECT category_name, idx FROM report_categories ";

if ($categoryType != "") {
    if ($categoryType == "area") {
        $allCategoriesQuery .= " WHERE area_idx != 0 ";
    }
    else if ($categoryType == "school") {
        $allCategoriesQuery .= " WHERE school_idx != 0 ";
    }
}

$categoryResult = mysqli_query($gconnet, $allCategoriesQuery);

?>
<script type="text/javascript" >

    /*
    var addPicTmp = "" +
        "<div class=\"added_img\" name='img_wrapper' >"+
        "   <img alt=\"\" name='tmp_img' src='{0}' >"+
        "   <button  type=\"button\" class=\"img_del\" name='del_btn' onclick='deleteFile(this)'></button>"+
        "   <input hidden type=\"file\" name=\"add_pic[]\" onblur='onFileChoose(event,this)' onchange=\"onFileChoose(event, this)\" >"+
        "</div>";
    */

    var fileReaderObj = new Array();

    function onFileChoose(event) {

        var i=0;
        console.log(event)
        for (let obj of event.target.files) {

            if (i >= 4) break;
            var reader = new FileReader;
            reader.onload = function(e) {
                fileReaderObj.push(e)

                if (i >= (event.target.files.length-1) ) {
                    setDisplay();
                }
                i++;

            };
            reader.readAsDataURL(obj);
        }

        //console.log(fileReaderObj)

    }

    var prevImg = 0;
    function setDisplay() {

        if (fileReaderObj.length >= 5) {
            $("#add_btn").css("display","none")
        }else {
            $("#add_btn").css("display","block")
        }

        var i=0;

        for(let data of fileReaderObj) {

            $("div[name='img_wrapper[]']")[prevImg+i].style.display = "block"
            $("img[name='tmp_img[]']")[prevImg+i].src = data.srcElement.result

            //console.log($("input[name='add_pic[]']")[i].value[0])
            //$("input[name='add_pic[]']")[i].value = (data.srcElement.result)
            i++
        }

    }

    function addFile() {
        console.log("add file")
        if ( checkCnt() == true ) {
            //$("#img_select").click()
            var i=0;
            for (let imgs of $("img[name='tmp_img[]']") ) {
                console.log(imgs.getAttribute("src") )
                if (imgs.getAttribute("src") == "" || imgs.getAttribute("src") == undefined) {
                    console.log(i+"번째")
                    $("input[name='add_pic[]']")[i].click();
                    break;
                }
                i++;
                prevImg = i
            }

        }else {
        }
    }

    function deleteFile(ord) {
        var idx = $("button[name=del_btn]").index(ord);
        fileReaderObj.splice(idx,1)
        $("div[name='img_wrapper[]']")[idx].style.display = "none"
        setDisplay()
    }


    function checkCnt() {
        if (fileReaderObj.length < 5) {
            return true;
        }else {
            alert('5개 이상 추가하실 수 없습니다.');
            return false;
        }
    }
</script>
<script>
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

<script>
    function onCategorySelected(idx) {

        $.ajax({
            url:"get_subcategories.php",
            data:{"category_idx":idx},
            metho:"POST",
            success:function(response) {
                $("#subcategory_list").html("");
                $("#subcategory_list").html(response);
            },
            error:function(error) {

            }
        })

    }
</script>

<body>
<div class="wrapper">
    <form name="frm" action="write_action.php" onsubmit="" method="post" enctype="multipart/form-data" >
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
                <div class="item_mid tag_type_category">
                    <ul>
                        <? while($category = mysqli_fetch_assoc($categoryResult)) {?>
                            <li>
                                <input type="radio" name="categories[]" value="<?=$category['idx']?>" id="category_<?=$category['idx']?>" onclick="onCategorySelected(<?=$category['idx']?>)" >
                                <label for="category_<?=$category['idx']?>">
                                    <?=$category['category_name']?>
                                </label>
                            </li>
                        <?}?>
                    </ul>
                </div>
                <div class="item_mid tag_type_subcategory">
                    <ul id="subcategory_list">
                    </ul>
                </div>
                <div class="write_bot">
                    <div class="tag_input">
                        <textarea name="hash_tags" id="hash_tags" rows="1" cols="1" placeholder="태그를 입력해주세요. 예) #성동구 #홍대" required onkeyup="addHashtag()"  ><?=$hashtag_str?></textarea>
                    </div>
                    <div class="add_wrap" id="photo_wrapper">
                        <input type="file" name="img_select" id="img_select" onblur='onFileChoose(event,this)' onchange="onFileChoose(event, this)" style="display: none;" multiple accept="image/*" >
                        <button type="button" class="add_img_btn" id="add_btn" onclick="addFile();"></button>

                        <div class="added_img" name='img_wrapper[]' style="display: none;" >
                            <img alt=""  name='tmp_img[]' src='' >
                            <button  type="button" class="img_del" name='del_btn' onclick='deleteFile(this)'></button>
                            <input  type="file" name="add_pic[]" onblur='onFileChoose(event,this)' onchange="onFileChoose(event, this)"  >
                        </div>

                        <div class="added_img" name='img_wrapper[]'  style="display: none;">
                            <img alt="" name='tmp_img[]' src='' >
                            <button  type="button" class="img_del" name='del_btn' onclick='deleteFile(this)' ></button>
                            <input  type="file" name="add_pic[]" onblur='onFileChoose(event,this)' onchange="onFileChoose(event, this)"  >
                        </div>

                        <div class="added_img" name='img_wrapper[]' style="display: none;" >
                            <img alt="" name='tmp_img[]' src='' >
                            <button  type="button" class="img_del" name='del_btn' onclick='deleteFile(this)'></button>
                            <input  type="file" name="add_pic[]" onblur='onFileChoose(event,this)' onchange="onFileChoose(event, this)"  >
                        </div>

                        <div class="added_img" name='img_wrapper[]' style="display: none;" >
                            <img alt="" name='tmp_img[]' src='' >
                            <button  type="button" class="img_del" name='del_btn' onclick='deleteFile(this)'></button>
                            <input  type="file" name="add_pic[]" onblur='onFileChoose(event,this)' onchange="onFileChoose(event, this)"  >
                        </div>

                        <div class="added_img" name='img_wrapper[]' style="display: none;" >
                            <img alt="" name='tmp_img[]' src='' >
                            <button  type="button" class="img_del" name='del_btn' onclick='deleteFile(this)'></button>
                            <input  type="file" name="add_pic[]" onblur='onFileChoose(event,this)' onchange="onFileChoose(event, this)"  >
                        </div>
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
                <li><button type="button" class="pop_close" >닫기</button></li>
            </ul>
        </div>
    </div>
</div>
<div class="popup temp_pop">
    <div class="pop_head grd_bg">
        <h2>임시보관함</h2>
        <button type="button" class="pop_close" id="tmp_close"></button>
        <button type="button" class="revise_btn" id="edit_delete" >편집</button>
    </div>
    <div class="pop_body">
        <ul>
            <?while($row = mysqli_fetch_assoc($incomplete_result) ) {?>
                <li>
                    <div class="slide_top">
                        <p class="tlt"><?=date("Y년 m월 d일",strtotime($row['wdate']))?> 임시저장</p>
                        <button type="button" class="temp_del_btn" onclick="deleteReport('<?=$row['idx']?>')"></button>
                    </div>
                    <div class="slide_bot" onclick="onTmpSelected('<?=$row['idx']?>', '<?=$row['content_text']?>', '<?=$row['report_hashtag']?>','<?=$row['category']?>') ">
                        <?=$row['content_text']?>
                    </div>
                </li>
            <?}?>
        </ul>
    </div>
</div>

<!-- 내용 클릭시 임시저장내용 볼러옴 -->
<script>

    function deleteReport(idx) {
        $.ajax({
            url:"delete_report.php",
            data:{"report_idx":idx},
            success:function(response) {
                console.log(response)
            },
            error:function(error) {

            }

        })
    }

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
        "<div class=\"added_img\" name='img_wrapper[]' >"+
        "   <img alt=\"\" name='tmp_img[]' src='../upload_file/report/{0}' >"+
        "   <button  type=\"button\" class=\"img_del\" name='del_btn' onclick=\"deletePrevFile('{0}','{1}')\"></button>"+
        "   <input hidden type=\"file\" name=\"add_pic[]\" onblur='onFileChoose(event,this)' onchange=\"onFileChoose(event, this)\" >"+
        "</div>";

    var tt = "<input type=\"file\" name=\"img_select\" id=\"img_select\" onblur='onFileChoose(event,this)' onchange=\"onFileChoose(event, this)\" style=\"display: none;\" multiple accept=\"image/*\" > <button type=\"button\" class=\"add_img_btn\" id=\"add_btn\" onclick=\"addFile();\"></button>"

    function onTmpSelected(report_idx, content, hashtag, mainCategory) {
        $("#input_text").val(content);
        $('#continue_idx').val(report_idx)

        $("#category_"+mainCategory).on("click", function() {

        })
        $("#category_"+mainCategory).click();
        //var hashtags = $("#hash_tags").val(hashtag).split(",");


        var setint = setInterval(function() {
            var hashtags = hashtag.split(",")

            for(let hash of hashtags) {
                var hshs = hash.replace("#","");
                for(let subs of $("input[name='subcategories[]']") ) {
                    if (subs.value == hshs) {
                        subs.checked=true
                        hashtag = hashtag.replace("#"+subs.value+",", "");
                        break;
                    }else {

                    }
                }

            }
            clearInterval(setint)
            $("#hash_tags").val(hashtag)
        },500)


        $.ajax({
            url:"get_additional_files.php",
            data:{"report_idx":report_idx},
            success:function(response) {
                console.log(response)
                try {
                    var res = JSON.parse(response);
                    var str = ""


                    var i=0;
                    for(let obj of res) {
                        //str += prevAddPicTmp.format(obj.report_file_name, obj.idx);

                        $("div[name='img_wrapper[]']")[i].style.display = "block"
                        $("img[name='tmp_img[]']")[i].src = "../upload_file/report/"+obj.report_file_name

                        i++;
                    }
                    //$('#photo_wrapper').html(tt)
                    //$('#photo_wrapper').append(str);


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
</body>
</html>

<!--

-->