<?
$cat_query = "SELECT * FROM report_categories WHERE idx=".$category_idx;
$cat_result = mysqli_query($gconnet, $cat_query);
$cat_row = mysqli_fetch_assoc($cat_result);


$gus_query = "SELECT * FROM gus ";
$gus_result = mysqli_query($gconnet, $gus_query);

?>
<div   id="wrapper" role="document">
    <div class="card card-register mx-auto mt-5">
        <div class="card-header">제보함 수정</div>
        <div class="card-body">
            <form name="frm" id="addFrm" action="edit_category_action.php"   method="post" enctype="multipart/form-data">
                <input type="hidden" name="total_param" value="<?=$total_param?>"/>
                <input type="hidden" name="category_idx"  value="<?=$cat_row['idx']?>">
                <input type="hidden" name="original_profile"  value="<?=$cat_row['profile_img']?>">
                <input type="hidden" name="original_cover"  value="<?=$cat_row['cover_img']?>">

                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="text" id="report_name" name="report_name" class="form-control" placeholder="제보함 이름" required="required" autofocus="autofocus" value="<?=$cat_row['category_name']?>" >
                                <label for="report_name">제보함 이름</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <img src="../../upload_file/category_profile/<?=$cat_row['profile_img']?>" width="40">
                                <input type="file" id="profile_img" name="profile_img" class="form-control" placeholder="프로필 이미지" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <img src="../../upload_file/category_cover/<?=$cat_row['cover_img']?>" width="140">
                        <input type="file" id="cover_img" name="cover_img" class="form-control" placeholder="커버 이미지" >
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <select name="area_idx">
                            <?while($gus_row = mysqli_fetch_assoc($gus_result)) {?>
                                <option value="<?=$gus_row['idx']?>" <?=$cat_row['area_idx']==$gus_row['idx'] ? "selected":""?> ><?=$gus_row['gu_name']?></option>
                            <?}?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="text" id="app_id" name="app_id" class="form-control" placeholder="앱아이디" required="required" value="<?=$cat_row['app_id']?>" >
                                <label for="app_id">앱아이디</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="text" id="app_secret" name="app_secret" class="form-control" placeholder="앱 시크릿" required="required" value="<?=$cat_row['app_secret']?>">
                                <label for="app_secret">앱 시크릿</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="text" id="page_id" name="page_id" class="form-control" placeholder="페이지 아이디" required="required"  value="<?=$cat_row['page_id']?>">
                                <label for="page_id">페이지 아이디</label>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary btn-block" type="submit" >수정완료</button>
                <button class="btn btn-secondary btn-block" type="button" data-dismiss="editModal" data-target="#editModal" onclick="location.reload();" >취소</button>
            </form>
        </div>
    </div>
</div>
