
<div class="container">
    <div class="card card-register mx-auto mt-5">
        <div class="card-header">댓글 추가</div>
        <div class="card-body">
            <form name="frm" id="addFrm" action="add_comment_action.php"   method="post" enctype="multipart/form-data">
                <input type="hidden" name="report_idx" id="report_idx" >
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
                                <?
                                $mem_query = "SELECT idx, user_id FROM member_info WHERE del_yn='N' AND member_type='GEN' ";
                                $mem_result = mysqli_query($gconnet, $mem_query);
                                ?>
                                <select name="member_idx">
                                    <?while($row = mysqli_fetch_assoc($mem_result)) {?>
                                        <option value="<?=$row['idx']?>"><?=$row['user_id']?></option>
                                    <?}?>
                                </select>
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
