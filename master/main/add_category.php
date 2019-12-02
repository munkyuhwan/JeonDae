<?
$gus_query = "SELECT * FROM gus ";
$gus_result = mysqli_query($gconnet, $gus_query);

$school = "SELECT * FROM uni_list";
$school_result = mysqli_query($gconnet, $school);
?>
<script type="application/javascript">
    function checkRadio() {

        $("input:radio[name='category_type']").each(function(){

            if (!$(this).is(":checked") ){
                $('#'+$(this).val()+"_wrap").css("display","block");
            }else {
                $("#category_type").val( $(this).val() );
                $('#'+$(this).val()+"_wrap").css("display","none");
            }
        });

    }
</script>
<div   id="wrapper" role="document">
    <div class="card card-register mx-auto mt-5">
        <div class="card-header">제보함 추가</div>
        <div class="card-body">
            <form name="frm" id="addFrm" action="add_category_action.php"  method="post" enctype="multipart/form-data">
                <input type="hidden" name="total_param" value="<?=$total_param?>"/>
                <input type="hidden" name="category_type" id="category_type" value="area">
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="text" id="report_name" name="report_name" class="form-control" placeholder="제보함 이름" required="required" autofocus="autofocus">
                                <label for="report_name">제보함 이름</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="file" id="profile_img" name="profile_img" class="form-control" placeholder="프로필 이미지" required="required">
                                <label for="profile_img">프로필 이미지</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="file" id="cover_img" name="cover_img" class="form-control" placeholder="커버 이미지" required="required">
                        <label for="cover_img">커버 이미지</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="category_area" >
                                <input type="radio" onchange="checkRadio()" name="category_type" id="category_area" value="area" checked >지역 제보함
                            </label>
                            <label for="category_uni" >
                                <input type="radio" onchange="checkRadio()" name="category_type" id="category_uni" value="uni" >학교 제보함
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group" id="uni_wrap" style="display: block;" >
                    <div class="form-label-group">
                        <select name="area_idx">
                            <?while($gus_row = mysqli_fetch_assoc($gus_result)) {?>
                                <option value="<?=$gus_row['idx']?>" ><?=$gus_row['gu_name']?></option>
                            <?}?>
                        </select>
                    </div>
                </div>
                <div class="form-group" id="area_wrap" style="display: none;" >
                    <div class="form-label-group" >
                        <select name="school_idx">
                            <?while($school_row = mysqli_fetch_assoc($school_result)) {?>
                                <option value="<?=$school_row['idx']?>" ><?=$school_row['uni_name']?></option>
                            <?}?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="text" id="app_id" name="app_id" class="form-control" placeholder="앱아이디" required="required">
                                <label for="app_id">앱아이디</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="text" id="app_secret" name="app_secret" class="form-control" placeholder="앱 시크릿" required="required">
                                <label for="app_secret">앱 시크릿</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="text" id="page_id" name="page_id" class="form-control" placeholder="페이지 아이디" required="required">
                                <label for="page_id">페이지 아이디</label>
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
