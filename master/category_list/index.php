<? include $_SERVER['DOCUMENT_ROOT']."/master/include/head.php" ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login.php"; // 관리자 로그인여부 확인?>
<?
$pageNo = trim(sqlfilter($_REQUEST['pageNo']));
if(!$pageNo){
    $pageNo = 1;
}
if(!$s_cnt){
    $s_cnt = 10; // 기본목록 10개
}
if(!$s_order){
    $s_order = 1;
}
$pageScale = $s_cnt;
$start = ($pageNo-1)*$pageScale;
$StarRowNum = (($pageNo-1) * $pageScale);
$EndRowNum = $pageScale;

$field = trim(sqlfilter($_REQUEST['field']));
$keyword = sqlfilter($_REQUEST['keyword']);
$v_sect = sqlfilter($_REQUEST['v_sect']); // 회원, 지점
$s_gubun = sqlfilter($_REQUEST['s_gubun']); // 일반, VIP
$s_level = sqlfilter($_REQUEST['s_level']); // 회원등급
$s_gender = sqlfilter($_REQUEST['s_gender']); // 성별
$s_sect1 = trim(sqlfilter($_REQUEST['s_sect1'])); // 로그인 구분
$s_sect2 = trim(sqlfilter($_REQUEST['s_sect2'])); // 추천인 (지점) 별
$s_cnt = trim(sqlfilter($_REQUEST['s_cnt'])); // 목록 갯수
$s_order = trim(sqlfilter($_REQUEST['s_order'])); // 목록 정렬
$sub_category = trim(sqlfilter($_REQUEST['sub_category'])); //검색 카테고리
$category_idx = trim(sqlfilter($_REQUEST['idx']));
################## 파라미터 조합 #####################
$total_param = 'bmenu='.$bmenu.'&smenu='.$smenu.'&field='.$field.'&keyword='.$keyword.'&v_sect='.$v_sect.'&s_gubun='.$s_gubun.'&s_level='.$s_level.'&s_gender='.$s_gender.'&s_sect1='.$s_sect1.'&s_sect2='.$s_sect2.'&s_cnt='.$s_cnt.'&s_order='.$s_order."&idx=".$category_idx;

$query = "SELECT report.idx AS report_idx, report.content_text, report.report_hashtag, member.real_name, member.file_chg, category.category_name  FROM report_list AS report, member_info AS member, report_categories AS category WHERE report.member_idx=member.idx AND report.category=category.idx AND report.category=".$category_idx;

if (str_replace(" ","", $keyword) != "") {
    if ($sub_category == "category") {
        $query .= " AND sub_category.sub_name LIKE '%".$keyword."%' ";
    } else if ($sub_category == "likes_cnt") {
        $query .= " AND report.likes LIKE '%".$keyword."%' ";
    } else if ($sub_category == "bad_report_cnt") {
        $query .= " AND report.bad_report LIKE '%".$keyword."%' ";
    }
}
$query_limit .= $query."ORDER BY idx DESC LIMIT ".$StarRowNum." , ".$EndRowNum ;

$result = mysqli_query($gconnet,$query_limit);

$cnt_result = mysqli_query($gconnet,$query);
$cnt = mysqli_num_rows($cnt_result);

$num = ($cnt);
$iTotalSubCnt = $num;
$totalpage	= ($iTotalSubCnt - 1)/$pageScale  + 1;

$num = ($cnt);
$iTotalSubCnt = $num;
$totalpage	= ($iTotalSubCnt - 1)/$pageScale  + 1;

$category_query = "SELECT category_name, profile_img, cover_img FROM report_categories WHERE idx=".$category_idx;
$category_result = mysqli_query($gconnet, $category_query);
$jaeboham = mysqli_fetch_assoc($category_result);

?>
<style>
    .header-style {
        background: url('../../upload_file/category_cover/<?=$jaeboham['cover_img']?>'); background-size: contain; background-repeat: no-repeat; height: 137px; display: block;
    }
    .profile-img{
        width: 40px;
    }
    .setting-btn{
        background: url("../images/sub/write.png");
        background-size: contain;
        background-repeat: no-repeat;
        width: 24px;
        height: 24px;
        border: none;
        vertical-align: middle;
    }
    .title-wrapper {
        width: 100%;
        vertical-align: middle;
        display: inline-block;
    }
</style>
<script>

    function frmSubmit() {
        $('#nextFrm').submit();
    }

    function modiBtn() {
        
    }

</script>
<body id="page-top">
<nav class="navbar navbar-expand navbar-dark bg-dark static-top header-style" >

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>
    <!-- Navbar Search -->
</nav>

<div id="wrapper">

    <!-- Sidebar -->
    <? include $_SERVER['DOCUMENT_ROOT']."/master/include/master_left.php" ?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <div class="title-wrapper">
                    <img class="profile-img" src="../../upload_file/category_profile/<?=$jaeboham['profile_img']?>"><?=$jaeboham['category_name']?><button class="setting-btn" data-toggle="modal" data-target="#editModal" onclick="modiBtn()" ></button>
                </div>
                <span><a href="https://djund.com/sub_area/?idx=<?=$category_idx?>" target="_blank" >https://djund.com/sub_area/?idx=<?=$category_idx?></a></span>
            </ol>

            <!-- DataTables Example -->
            <div class="card mb-3">

                <div class="card-header">
                    <form class="d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" name="frm" action="index.php" >
                        <input type="hidden" name="bmenu" value="<?=$bmenu?>" >
                        <input type="hidden" name="smenu" value="<?=$bmenu?>" >
                        <input type="hidden" name="keyword" value="<?=$keyword?>" >
                        <input type="hidden" name="idx" value="<?=$category_idx?>" >
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for..." name="keyword" aria-label="Search" aria-describedby="basic-addon2" value="<?=$keyword?>">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="input-group">
                            <div class="input-group-append">
                                <select name="sub_category" class="custom-select custom-select-sm form-control form-control-sm" >
                                    <option value="" >필터</option>
                                    <option value="category" <?= $sub_category=="category" ? "selected":""  ?> >카테고리</option>
                                    <option value="likes_cnt" <?= $sub_category=="likes_cnt" ? "selected":""  ?> >추천수</option>
                                    <option value="bad_report_cnt" <?= $sub_category=="bad_report_cnt" ? "selected":""  ?> >신고 갯수</option>
                                </select>
                            </div>
                        </div>
                    </form>

                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <tbody>
                            <form name="nextFrm" id="nextFrm" action="./write.php" hidden >

                                <?while ($row = mysqli_fetch_assoc($result)) {?>
                                    <tr>
                                        <td>
                                            <div class="card" >
                                                <div class="card-header table" >
                                                    <div style="display: table-cell; " >
                                                        <img width="40" src="../../upload_file/member/<?=$row['file_chg']?>" ><?=$row['real_name']?> <?=$row['report_idx']?>번째 제보 | <?=$row['report_hashtag']?>
                                                    </div>

                                                    <div class="dropdown" style="display: table-cell; vertical-align: middle; " >
                                                        <button type="button" id="menu_btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border: none; background-color: transparent; display: table; vertical-align: middle" >
                                                            <img src="../../master/images/common/dot.png" style=" display: table-row; margin-bottom: 2px; ">
                                                            <img src="../../master/images/common/dot.png" style=" display: table-row; margin-bottom: 2px; ">
                                                            <img src="../../master/images/common/dot.png" style=" display: table-row;  ">
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="menu_btn">
                                                            <a class="dropdown-item" href="edit.php?idx=<?=$row['report_idx']?>">수정</a>
                                                            <a class="dropdown-item" href="#">삭제</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <p class="sorting_1">
                                                        <?=$row['content_text']?>
                                                    </p>
                                                </div>
                                                <?
                                                $child_comment_query = "SELECT report.*, member.file_chg, member.real_name FROM report_comments AS report, member_info AS member WHERE report.del_yn='N' AND report.report_idx=".$row['report_idx']." AND member.idx=report.member_idx";
                                                $child_result = mysqli_query($gconnet, $child_comment_query);
                                                ?>
                                            </div>
                                            <div>
                                                댓글
                                                <table class="" id="dataTable" width="100%" cellspacing="0">
                                                    <?while ($child_row = mysqli_fetch_assoc($child_result)) {?>
                                                        <tr>
                                                            <td>
                                                                <div>
                                                                    <img width="30" src="../../upload_file/member/<?=$child_row['file_chg']?>"><?=$child_row['real_name']?>
                                                                </div>
                                                                <div>
                                                                    <?=$child_row['comment_txt']?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?}?>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                <?}?>
                            </form>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
                    <div class="pagination mt0">
                        <?include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/paging.php";?>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <? include "./edit_category.php"?>
</div>
<? include $_SERVER['DOCUMENT_ROOT']."/master/include/footer.php"?>