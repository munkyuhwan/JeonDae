
<script type="application/javascript">
    function openEtcPopup(reportIdx) {
        $('#report_idx').val(reportIdx);
    }
    function doScrab() {
        $.ajax({
            url:"additional_action.php",
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
            url:"additional_action.php",
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
            url:"additional_action.php",
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
            url:"additional_action.php",
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

</script>
<div class="popup post_pop">
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
            </ul>
        </div>
        <button type="button" class="pop_close">취소</button>
    </div>
</div>