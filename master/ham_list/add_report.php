
<script>
    var imgListFormat = "<div class=\"form-label-group border text-align-right file-add-group\" >\n" +
        "                    <button type=\"button\" style=\"border: none; background: none;\" name=\"minus_btn[]\" onclick=\"removeFile(this)\" >\n" +
        "                         <i class=\"fas fa-minus\" ></i>\n" +
        "                    </button>\n" +
        "                    <input type=\"file\" name=\"img_add[]\" autofocus=\"autofocus\"  >\n" +
        "               </div>\n"

    function fileAddition() {
        $('#file_list').append(imgListFormat)
    }

    function removeFile(el) {
        $('.file-add-group')[$("button[name='minus_btn[]']").index(el)].remove()
    }



</script>
<div class="container">
    <div class="card card-register mx-auto mt-5">
        <div class="card-header">제보 추가</div>
        <div class="card-body">
            <form name="frm" id="addFrm" action="add_report_action.php"   method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <textarea style="width: 100%;" id="input_text" name="input_text"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="text" id="hash_tags" name="hash_tags" class="form-control" placeholder="해시태그" required="required" autofocus="autofocus">
                                <label for="hash_tags">해시태그</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    첨부파일
                                    <button type="button" style="border: none; background: none;" onclick="fileAddition()">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>

                                <div class="card-body" id="file_list">

                                    <div class="form-label-group border text-align-right file-add-group" >
                                        <button type="button" style="border: none; background: none;" name="minus_btn[]" onclick="removeFile(this)" >
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="file" name="img_add[]" autofocus="autofocus" >
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary btn-block" type="submit"  >등록</button>
                <button class="btn btn-secondary btn-block" type="button" data-dismiss="modal"  >취소</button>
            </form>
        </div>
    </div>
</div>