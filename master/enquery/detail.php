<? include $_SERVER['DOCUMENT_ROOT']."/master/include/head.php" ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login.php"; // 관리자 로그인여부 확인?>
<?
$idx = trim(sqlfilter($_REQUEST['idx']));
$total_param = 'bmenu='.$bmenu.'&smenu='.$smenu.'&field='.$field.'&keyword='.$keyword.'&bbs_code='.$bbs_code.'&v_sect='.$v_sect.'&s_cate_code='.$s_cate_code.'&s_sect1='.$s_sect1.'&s_sect2='.$s_sect2.'&s_gender='.$s_gender.'&s_level='.$s_level;
$query = "SELECT enquery.*, member.real_name FROM enquries_list AS enquery, member_info AS member WHERE enquery.idx=".$idx." AND enquery.member_idx=member.idx ";
$result = mysqli_query($gconnet, $query);
$result = mysqli_fetch_assoc($result);
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

    <!-- Sidebar -->
    <? include $_SERVER['DOCUMENT_ROOT']."/master/include/master_left.php" ?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="../settings/?<?=$total_param?>">설정</a>
                </li>
                <li class="breadcrumb-item active">1:1문의</li>
            </ol>

            <!-- DataTables Example -->
            <div class="card mb-3">
                <form name="frm" action="action.php" method="post" >
                    <input type="hidden" name="idx" value="<?=$result['idx']?>" >
                    <input type="hidden" name="total_param" value="<?=$total_param?>" >
                    <div class="card-header">
                       1:1문의 제목
                    </div>
                    <div class="card-body">
                        <div class="form-label-group">
                            <?=$result['q_title']?>
                        </div>
                    </div>

                    <div class="card-header">
                        1:1문의 내용
                    </div>
                    <div class="card-body">
                        <div class="form-label-group">
                            <p>
                                <?=$result['q_text']?>
                            </p>
                        </div>
                    </div>

                    <div class="card-header">
                        1:1문의 답변
                    </div>
                    <div class="card-body">
                        <div class="form-label-group">
                            <textarea style="width: 100%;" name="reply" ></textarea>
                        </div>
                    </div>

                    <button class="btn btn-primary btn-block" type="submit" >답변완료</button>
                    <button class="btn btn-secondary btn-block" type="button" onclick="location.href='board_list.php?<?=$total_param?>'; "  >취소</button>
                </form>
            </div>
        </div>

    </div>

</div>
<!-- /#wrapper -->

<? include $_SERVER['DOCUMENT_ROOT']."/master/include/footer.php"?>
