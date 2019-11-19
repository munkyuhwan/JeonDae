
<div  id="wrapper" role="document">
    <div class="card card-register mx-auto mt-5">
        <div class="card-header">제보함 추가</div>
        <div class="card-body">
            <form name="frm" id="addFrm" action="add_subcategory_action.php"   method="post" enctype="multipart/form-data">
                <input type="hidden" name="total_param" value="<?=$total_param?>"/>
                <input type="hidden" id="main_category" name="main_category" value="">
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="text" id="category_name" name="category_name" class="form-control" placeholder="카테고리 이름" required="required" autofocus="autofocus">
                                <label for="category_name">카테고리 이름</label>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary btn-block" type="button" onclick="addCategory();" >등록</button>
                <button class="btn btn-secondary btn-block" type="button" data-dismiss="addModal" data-target="#addModal" onclick="location.reload();" >취소</button>
            </form>
        </div>
    </div>
</div>
