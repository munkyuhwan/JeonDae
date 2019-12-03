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
################## 파라미터 조합 #####################
$total_param = 'bmenu='.$bmenu.'&smenu='.$smenu.'&field='.$field.'&keyword='.$keyword.'&v_sect='.$v_sect.'&s_gubun='.$s_gubun.'&s_level='.$s_level.'&s_gender='.$s_gender.'&s_sect1='.$s_sect1.'&s_sect2='.$s_sect2.'&s_cnt='.$s_cnt.'&s_order='.$s_order;

$query = "SELECT report.idx AS report_idx, report.content_text, report.report_hashtag, report.category, report.likes, member.real_name, member.file_chg  FROM report_list AS report, member_info AS member WHERE report.del_yn='N' AND report.member_idx=member.idx ";
$query .= " ORDER BY report.idx DESC ";
$query_limit .= $query." LIMIT ".$StarRowNum." , ".$EndRowNum ;
$result = mysqli_query($gconnet,$query_limit);

//$cnt_query = "SELECT COUNT(*) AS cnt  FROM report_list AS report, member_info AS member WHERE report.del_yn='N' AND report.member_idx=member.idx ";
$cnt_result = mysqli_query($gconnet,$query);
$cnt = mysqli_fetch_all($cnt_result);

$num = count($cnt);
$iTotalSubCnt = $num;
$totalpage	= ($iTotalSubCnt - 1)/$pageScale  + 1;

?>
<style>
    .text-align-right {
        text-align: right;
    }
    .float-btn {
        position: fixed;
        right: 15px;
        bottom: 15px;
        display: none;
        width: 50px;
        height: 50px;
        text-align: center;
        color: #fff;
        background: rgba(52, 58, 64, 0.5);
        line-height: 46px;
        z-index: 9999;
    }
</style>
<script>

    function frmSubmit() {
        if ( $("input:checkbox[name='report_idx[]']:checked").length > 0) {
            $('#nextFrm').submit();
        }else {
            alert('1개 이상 선택 해 주세요.')
        }
    }
    function deleteItem(idx) {
        if(confirm("삭제 하시겠습니까?")) {
            $.ajax({
                url: "./delete_report.php",
                data: {"idx": idx},
                success: function (response) {
                    console.log(response)
                },
                error: function (error) {

                }
            })
        }
    }

    function addComment(idx) {
        $('#report_idx').val(idx)
    }

</script>
<body id="page-top">
<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>
</nav>

<div id="wrapper">
    <a class="float-btn rounded" href="javascript:frmSubmit();" style="display: inline;">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Sidebar -->
    <? include $_SERVER['DOCUMENT_ROOT']."/master/include/master_left.php" ?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">제보 관리</a>
                </li>
                <li class="breadcrumb-item active">제보 리스트</li>
            </ol>

            <!-- DataTables Example -->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    제보 리스트
                    <i class="fas fa-plus fa-pull-right" href="#" data-toggle="modal" data-target="#addModal"></i>
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
                                                <div style="display: table-cell; text-align: left; " >
                                                    <input type="checkbox" name="report_idx[]" value="<?=$row['report_idx']?>" required="required" >
                                                </div>
                                                <div class="dropdown" style="display: table-cell; vertical-align: middle; " >
                                                    <button type="button" id="menu_btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border: none; background-color: transparent; display: table; vertical-align: middle" >
                                                        <img src="../../master/images/common/dot.png" style=" display: table-row; margin-bottom: 2px; ">
                                                        <img src="../../master/images/common/dot.png" style=" display: table-row; margin-bottom: 2px; ">
                                                        <img src="../../master/images/common/dot.png" style=" display: table-row;  ">
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="menu_btn">
                                                        <a class="dropdown-item" href="edit.php?idx=<?=$row['report_idx']?>">수정</a>
                                                        <a class="dropdown-item" href="javascript:deleteItem(<?=$row['report_idx']?>)">삭제</a>
                                                        <a class="dropdown-item" data-toggle="modal" data-target="#commentModal" onclick="addComment(<?=$row['report_idx']?>)">댓글 추가</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <p class="sorting_1">
                                                    <?=$row['content_text']?>
                                                </p>
                                                <div>
                                                    <?= $row['category']==null || $row['category']==0 ? "<span style='font-size: 10px; color: red;'>미발행</span>":"<span  style='font-size: 10px; color: blue;'>발행</span>" ?>
                                                    <span>추천수 <?=$row['likes']?> </span>
                                                    <?
                                                        $child_comment_query = "SELECT COUNT(*) cnt FROM report_comments WHERE del_yn='N' AND report_idx=".$row['report_idx'];
                                                        $child_result = mysqli_query($gconnet, $child_comment_query);
                                                        $child_row = mysqli_fetch_assoc($child_result);
                                                    ?>
                                                    <span>댓글수 <?=$child_row['cnt']?></span>
                                                </div>
                                            </div>
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
                    <div class="pagination mt-1 mb-1 ml-2 mr-2">
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
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <? include "./add_report.php"?>
        </div>
    </div>
</div>
<div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <? include "./add_comment.php"?>
        </div>
    </div>
</div>

<? include $_SERVER['DOCUMENT_ROOT']."/master/include/footer.php"?>