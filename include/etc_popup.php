
<script type="application/javascript">
    function openEtcPopup(reportIdx) {
        $('#report_idx').val(reportIdx);
        $.ajax({
            url:"../include/check_delete_auth.php",
            method:"POST",
            data:{"report_idx":reportIdx},
            success:function(response) {
                try {
                    var res = JSON.parse(response);
                    if(res.result == true) {
                        $("#delete_btn").show();
                    }else {
                        $("#delete_btn").hide();
                    }
                }catch (e) {

                }
            },
            error:function(error) {

            }
        })
    }
    function doScrab() {
        $.ajax({
            url:"../main1/additional_action.php",
            data:{"reportIdx":$('#report_idx').val(), "action":"scrab"},
            success:function(response) {
                responseResult(response)
            },
            error:function(error) {

            }
        })
    }
    function doScrabCancel() {

        $.ajax({
            url:"../main1/additional_action.php",
            data:{"reportIdx":$('#report_idx').val(), "action":"scrab_cancel"},
            success:function(response) {
                responseResult(response)
                location.reload();
            },
            error:function(error) {

            }
        })
    }
    function badReport() {
        $.ajax({
            url:"../main1/additional_action.php",
            data:{"reportIdx":$('#report_idx').val(), "action":"badReport"},
            success:function(response) {
                responseResult(response)
            },
            error:function(error) {

            }
        })
    }
    function cancelSubscribe() {
        $.ajax({
            url:"../main1/additional_action.php",
            data:{"reportIdx":$('#report_idx').val(), "action":"cancelSub"},
            success:function(response) {
                responseResult(response)
            },
            error:function(error) {

            }
        })
    }

    function responseResult(response) {
        try {
            var res = JSON.parse(response);
            toast(res.msg)
        }catch (e) {

        }
    }

    function onDelete() {
        if (confirm("삭제 하시겠습니까?") == true ) {
            $.ajax({
                url: "../include/delete_report.php",
                method: "POST",
                data: {"report_idx": $("#report_idx").val()},
                success: function (response) {
                    console.log(response)
                    try {
                        var res = JSON.parse(response);
                        if (res.result == true) {
                            $(".popup").click();
                            $("#main_list").html("");
                            page=0;
                            getList();
                        }
                    } catch (e) {

                    }
                },
                error: function (error) {

                }
            })
        }

    }

</script>
<div class="popup post_pop" >
    <div class="popup_wrap post_btn">
        <div class="post_btn_wrap">
            <input type="hidden" id="report_idx" name="report_idx" >
            <ul>
                <?if($_SERVER['REQUEST_URI']=="/sub_mypage2/") {?>
                    <li><button type="button" onclick="doScrabCancel()" >스크랩 취소</button></li>
                <?}else {?>
                    <li><button type="button" onclick="doScrab()" >게시물 저장(스크랩)</button></li>
                <?}?>
                <li><a href="javascript:badReport();">해당 게시물 신고하기</a></li>
                <li><button type="button" class="pop_call" data-pop="share_pop" >해당 게시물 공유</button></li>
                <li><button type="button" onclick="cancelSubscribe()">해당 카테고리 구독 취소</button></li>
                <li><button type="button" id="delete_btn" onclick="onDelete();" >삭제</button></li>
            </ul>
        </div>
        <button type="button" class="pop_close">취소</button>
    </div>
</div>