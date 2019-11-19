    <div class="card card-register mt-5 mb-5 ml-2 mr-2 ">
        <div class="card-header">사용자 수정</div>
        <div class="card-body">
            <form name="frm" id="addFrm" action="send_dm_action.php"   method="post" enctype="multipart/form-data">
                <input type="hidden" name="member_idx" value="<?=$idx?>">
                <input type="hidden" name="total_param" value="<?=$total_param?>"/>

                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <textarea name="msg" class="form-control" required="required" placeholder="메시지"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary btn-block" type="submit">보내기</button>
                <button class="btn btn-secondary btn-block" type="button" data-dismiss="modal" >닫기</button>
            </form>
        </div>
    </div>

