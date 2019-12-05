<div id="wrapper" role="document">
    <div class="card card-register mx-auto mt-5">
        <div class="card-header">사용자 수정</div>
        <div class="card-body">
            <form name="frm" id="addFrm" action="edit_member_action.php"   method="post" enctype="multipart/form-data">
            <input type="hidden" name="member_id" value="<?=$idx?>">
            <input type="hidden" name="total_param" value="<?=$total_param?>"/>
            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-label-group">
                            <input type="text" id="user_name" name="user_name" class="form-control" placeholder="사용자 이름" required="required" autofocus="autofocus" value="<?=$row['real_name']?>">
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
                            <input type="file" id="profile_img" name="profile_img" class="form-control" placeholder="프로필 이미지" >
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
                            <option value="M" <?=$row['gender']=="M"?"selected":""?> >남</option>
                            <option value="F"  <?=$row['gender']=="F"?"selected":""?> >녀</option>
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
                                <option value="<?=$i?>"  <?=$row['birthday']==$i?"selected":""?> ><?=$i?></option>
                            <?}?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-label-group">
                            <?
                            //$subscribe_query ="SELECT main_cat.*, sub_cat.sub_name, report_cat.category_name FROM subscribe_list AS main_cat, report_sub_categories AS sub_cat, report_categories AS report_cat  WHERE main_cat.member_idx=".$idx." AND main_cat.sub_category_idx=sub_cat.idx AND main_cat.category_idx=report_cat.idx GROUP BY main_cat.category_idx";
                            $subscribe_query = "SELECT category.category_name  FROM subscribe_list AS subscribe, report_categories AS category  WHERE subscribe.member_idx=".$idx." AND subscribe.category_idx=category.idx GROUP BY category_idx ";
                            $subscribe_result = mysqli_query($gconnet, $subscribe_query);


                            $sub_category_query = "SELECT sub_category.idx, sub_category.sub_name FROM subscribe_list AS subscribe, report_sub_categories AS sub_category WHERE subscribe.member_idx=".$idx." AND subscribe.sub_category_idx=sub_category.idx";
                            $sub_category_result = mysqli_query($gconnet, $sub_category_query);

                            while ($hash_row = mysqli_fetch_assoc($sub_category_result)) {?>
                                <? $hash_str.= "#".$hash_row['sub_name'].", "?>
                            <?}?>
                            <input type="text" id="hashtag" name="hashtag" class="form-control" placeholder="관심 해시태그" autofocus="autofocus" value="<?=$hash_str?>">
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
                                        <?
                                        $subscribe_query ="SELECT main_cat.*, sub_cat.sub_name, report_cat.category_name FROM subscribe_list AS main_cat, report_sub_categories AS sub_cat, report_categories AS report_cat  WHERE main_cat.member_idx=".$idx." AND main_cat.sub_category_idx=sub_cat.idx AND main_cat.category_idx=report_cat.idx GROUP BY main_cat.category_idx";
                                        $subscribe_result = mysqli_query($gconnet, $subscribe_query);
                                        $subscribe_array = array();
                                        while ($subscribe_row = mysqli_fetch_assoc($subscribe_result)) {
                                            array_push($subscribe_array, intval($subscribe_row['category_idx']) );
                                        }
                                        $query_category = "SELECT category_name, idx, cover_img, profile_img FROM report_categories";
                                        $category_result = mysqli_query($gconnet,$query_category);
                                        for ($i=0; $i<mysqli_num_rows($category_result); $i++) {
                                            $row_cat = mysqli_fetch_assoc($category_result);
                                            $key = ( array_search(intval($row_cat['idx']), $subscribe_array) );
                                            ?>
                                            <label>
                                                <input type="checkbox" id="subscribe_<?=$row_cat['idx']?>" <?= false !== $key ? "checked":""  ?> name="subscribes[]" value="<?=$row_cat['idx']?>" >
                                                <?=$row_cat['category_name']?>
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
                                <option value="<?=$i?>" <?=$row['clean_filter']==$i ? "selected":"" ?> ><?=$i?>단계</option>
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
                                            <input type="radio" id="gen" name="memb_type" <?=$row['member_type']=="GEN" ? "checked":"" ?> value="GEN" >
                                            일반 유저
                                        </label>
                                        <label>
                                            <input type="radio" id="manager" name="memb_type" <?=$row['member_type']=="MAN" ? "checked":"" ?> value="MAN" >
                                            제보 관리자
                                        </label>
                                        <label>
                                            <input type="radio" id="admin" name="memb_type" <?=$row['member_type']=="AD" ? "checked":"" ?> value="AD" >
                                            마스터
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary btn-block" type="submit">수정완료</button>
            <button class="btn btn-secondary btn-block" type="button" data-dismiss="modal" >닫기</button>
            </form>
        </div>
    </div>
</div>
