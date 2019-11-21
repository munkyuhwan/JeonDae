
<div   id="wrapper" role="document">
    <div class="card card-register mx-auto mt-5">
        <div class="card-header">사용자 추가</div>
        <div class="card-body">
            <form name="frm" id="addFrm" action="add_member_action.php"   method="post" enctype="multipart/form-data">
                <input type="hidden" name="total_param" value="<?=$total_param?>"/>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="text" id="user_name" name="user_name" class="form-control" placeholder="사용자 이름" required="required" autofocus="autofocus">
                                <label for="user_name">이름</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <span>미인증</span>
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
                    <div class="form-row">
                        <div class="col-md-6">
                            <select name="gender" class="custom-select custom-select-sm form-control form-control-sm">
                                <option value="" >성별</option>
                                <option value="M" >남</option>
                                <option value="F" >녀</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <? $current_year = date('Y',time())?>
                            <select name="year_birth" class="custom-select custom-select-sm form-control form-control-sm">
                                <option value="" >연령</option>
                                <?for($i=$current_year;$i>1950;$i--) {?>
                                    <option value="<?=$i?>" ><?=$i?></option>
                                <?}?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="text" id="hashtag" name="hashtag" class="form-control" placeholder="관심 해시태그" required="required" autofocus="autofocus">
                                <label for="hashtag">관심 해시태그</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="card">
                                    <div class="card-header">
                                        구독 정보
                                    </div>
                                    <div class="card-body">
                                        <div class="checkbox">
                                            <?for ($i=0; $i<mysqli_num_rows($category_result); $i++) {
                                                $row = mysqli_fetch_array($category_result);?>
                                                <label>
                                                    <input type="checkbox" id="subscribe_<?=$row['id']?>" name="subscribes[]" value="<?=$row['idx']?>" >
                                                    <?=$row['category_name']?>
                                                </label>
                                            <?}?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <? $clean_filter = 5?>
                            <select name="clean_filter" class="custom-select custom-select-sm form-control form-control-sm">
                                <option value="" >클린 필터링</option>
                                <?for($i=$clean_filter;$i>0;$i--) {?>
                                    <option value="<?=$i?>" ><?=$i?>단계</option>
                                <?}?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="card">
                                    <div class="card-header">
                                        그룹 상태
                                    </div>
                                    <div class="card-body">
                                        <div class="checkbox">
                                            <label>
                                               <input type="radio" id="gen" name="memb_type" value="GEN" >
                                                일반 유저
                                            </label>
                                            <label>
                                                <input type="radio" id="manager" name="memb_type" value="MAN" >
                                                제보 관리자
                                            </label>
                                            <label>
                                                <input type="radio" id="admin" name="memb_type" value="AD" >
                                                마스터
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary btn-block" type="button" onclick="addCategory();" >등록</button>
                <button class="btn btn-secondary btn-block" type="button" data-dismiss="modal"  >취소</button>
            </form>
        </div>
    </div>
</div>
