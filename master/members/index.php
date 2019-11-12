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

$query = "SELECT * FROM member_info WHERE 1 AND ";
$query .= " member_type='GEN'";
$query_limit .= $query." LIMIT ".$StarRowNum." , ".$EndRowNum ;
$result = mysqli_query($gconnet,$query_limit);

$cnt_result = mysqli_query($gconnet,$query);
$cnt = mysqli_fetch_all($cnt_result);

$num = count($cnt);
$iTotalSubCnt = $num;
$totalpage	= ($iTotalSubCnt - 1)/$pageScale  + 1;

$query_category = "SELECT category_name, idx, cover_img, profile_img FROM report_categories";
$category_result = mysqli_query($gconnet,$query_category);



?>
<script>
    function addCategory() {
        $("#addFrm").submit();
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

<div id="wrapper" >

    <? include $_SERVER['DOCUMENT_ROOT']."/master/include/master_left.php" ?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">회원관리</a>
                </li>
                <li class="breadcrumb-item active">회원 리스트</li>
            </ol>

            <!-- DataTables Example -->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    회원관리 페이지
                    <i class="fas fa-plus fa-pull-right" href="#" data-toggle="modal" data-target="#addModal"></i>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <tbody>
                            <?
                            for ($i=0; $i<mysqli_num_rows($result); $i++){
                                $row = mysqli_fetch_array($result);?>
                                <tr>
                                    <td data-toggle="modal" data-target="#viewModal" onclick="location.href='./view_member.php?idx=<?=$row['idx']?>&<?=$total_param?>' " >
                                        <?=$row['real_name']?>
                                    </td>
                                </tr>

                            <?}?>
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
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

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
            <? include "./add_member.php"?>
        </div>
    </div>
</div>
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="../vendor/datatables/jquery.dataTables.js"></script>
<script src="../vendor/datatables/dataTables.bootstrap4.js"></script>
<script src="../js/sb-admin.min.js"></script>
<script src="../js/demo/datatables-demo.js?ver=<?=time()?>"></script>

</body>
</html>
