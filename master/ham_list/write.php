<? include $_SERVER['DOCUMENT_ROOT']."/master/include/head.php" ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login.php"; // 관리자 로그인여부 확인?>
<?
$pageNo = trim(sqlfilter($_REQUEST['pageNo']));
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
$query_category = "SELECT category_name, idx, cover_img, profile_img FROM report_categories";
$category_result = mysqli_query($gconnet,$query_category);

$reports = $_REQUEST['report_idx'];


?>
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
    <a class="scroll-to-top rounded" href="#page-top" style="display: inline;">
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
                <li class="breadcrumb-item">
                    <a href="./?<?=$total_param?>">
                        제보 리스트
                    </a>
                </li>
                <li class="breadcrumb-item active">
                    제보 발행
                </li>
            </ol>

            <!-- DataTables Example -->
            <div class="card">
                <div class="card-body">

                    <form name="frm" action="write_action.php" method="post" >
                        <?foreach ($reports as $v) {?>
                            <input type="hidden" name="selected_report[]" value="<?=$v?>" >
                        <?}?>
                    <div class="form">
                        <div class="form-group">
                            <div class="card" >
                                <div class="card-header table" >
                                    발행할 페이지
                                </div>
                                <div class="card-body">
                                    <select name="publish_page" class="custom-select custom-select-sm form-control form-control-sm">
                                        <option value="">페이지를 선택하세요</option>
                                        <?while ($category_row = mysqli_fetch_assoc($category_result)) {?>
                                            <option value="<?=$category_row['idx']?>"><?=$category_row['category_name']?></option>
                                        <?}?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="card" >
                                <div class="card-header table" >
                                    발행 시간
                                </div>
                                <div class="card-body">
                                    <select name="publish_time" class="custom-select custom-select-sm form-control form-control-sm">
                                        <option value="">발행 시간을 선택하세요</option>
                                        <option value="1">지금</option>
                                        <option value="2">5분후</option>
                                        <option value="3">30분후</option>
                                        <option value="4">1시간후</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="card" >
                                <div class="card-header table" >
                                    발행 간격
                                </div>
                                <div class="card-body">
                                    <select name="publish_interval" class="custom-select custom-select-sm form-control form-control-sm">
                                        <option value="">발행 간격을 선택하세요</option>
                                        <option value="1">동시</option>
                                        <option value="2">5분 간격</option>
                                        <option value="3">30분 간격</option>
                                        <option value="4">1시간 간격</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                <!-- div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div -->
                        <button class="btn btn-primary btn-block" type="submit">발행하기</button>
                    </div>
                    </form>



                </div>
            </div>
            <!-- p class="small text-center text-muted my-5">
                <em>More table examples coming soon...</em>
            </p -->

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <!-- footer class="sticky-footer">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright © Your Website 2019</span>
                </div>
            </div>
        </footer -->

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
<? include $_SERVER['DOCUMENT_ROOT']."/master/include/footer.php"?>