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

$idx = trim(sqlfilter($_REQUEST['idx']));
$query = "SELECT * FROM member_info WHERE idx=".$idx;
$result = mysqli_query($gconnet,$query);

$row = mysqli_fetch_assoc($result);


$hashtag_query ="SELECT * FROM user_hashtags WHERE member_idx=".$idx;
$hashtag_result = mysqli_query($gconnet, $hashtag_query);

$subscribe_query ="SELECT main_cat.*, sub_cat.sub_name, report_cat.category_name FROM subscribe_list AS main_cat, report_sub_categories AS sub_cat, report_categories AS report_cat  WHERE main_cat.member_idx=".$idx." AND main_cat.sub_category_idx=sub_cat.idx AND main_cat.category_idx=report_cat.idx GROUP BY main_cat.category_idx";
$subscribe_result = mysqli_query($gconnet, $subscribe_query);

?>
<style>
    .setting-btn{
        background: url("../images/sub/write.png");
        background-size: contain;
        background-repeat: no-repeat;
        width: 24px;
        height: 24px;
        border: none;
        vertical-align: middle;
    }
</style>

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

<div   id="wrapper" >
    <? include $_SERVER['DOCUMENT_ROOT']."/master/include/master_left.php" ?>
    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="./?<?=$total_param?>">회원관리</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="./?<?=$total_param?>">회원 리스트</a>
                </li>
                <li class="breadcrumb-item active"><?=$row['real_name']?></li>
            </ol>

            <!-- DataTables Example -->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    회원 정보 페이지
                </div>
                <div class="card-body">
                    <div>
                        <div style="display: inline;">
                            <h3 style="display: inline;"><?=$row['real_name']?></h3>
                            <img style="display: inline;" width="60" src="../../upload_file/member/<?=$row['file_chg']?>">
                        </div>
                        <div>
                            미인증
                        </div>
                        <div>
                            <button data-toggle="modal" data-target="#dmModal">DM</button>
                            <button class="setting-btn" data-toggle="modal" data-target="#editModal"></button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            인증여부
                        </div>
                        <div class="card-body">
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            성별
                        </div>
                        <div class="card-body">
                            <?=$row['gender']=="M"?"남자":"여자"?>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            연령
                        </div>
                        <div class="card-body">
                            <?=$row['birthday']?>년생
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            가입일
                        </div>
                        <div class="card-body">
                            <?=$row['wdate']?>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            관심해시태그
                        </div>
                        <div class="card-body">
                            <?while ($hash_row = mysqli_fetch_assoc($hashtag_result)) {?>
                                <?=$hash_row['hash_tag'].", "?>
                            <?}?>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            구독 정보
                        </div>
                        <div class="card-body">
                            <?while ($subscribe_row = mysqli_fetch_assoc($subscribe_result)) {?>
                                <?=$subscribe_row['category_name'].", "?>
                            <?}?>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-header">
                            그룹상태
                        </div>
                        <div class="card-body">
                            <?=$row['member_type']=="AD"?"관리자":($row['member_type']=="MAN"?"제보 관리자":($row['member_type']=="GEN"?"일반회원":"기타"))?>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            관리자 메모
                        </div>
                        <div class="card-body">
                            <?=$row['admin_memo']?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <div>
                        <label>
                            <input type="radio" name="contents" value="1" onchange=" $('.list-write').hide(); $('#member_report').show(); " checked  >
                            작성글
                        </label>
                        <label>
                            <input type="radio" name="contents" value="2"  onchange="$('.list-write').hide(); $('#member_comment').show();  " >
                            작성댓글
                        </label>
                        <label>
                            <input type="radio" name="contents" value="3" onchange="$('.list-write').hide(); $('#member_likes').show();  " >
                            좋아요한 글
                        </label>

                        <div class="list-write" id="member_report" style="display: block;" >
                            <? include "./member_writes/member_report.php" ?>
                        </div>
                        <div class="list-write" id="member_comment" style="display: none;"  >
                            <? include "./member_writes/member_comment.php" ?>
                        </div>
                        <div class="list-write" id="member_likes" style="display: none;"  >
                            <? include "./member_writes/member_likes.php" ?>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <? include "./edit_member.php"?>
        </div>
    </div>
</div>
<div class="modal fade" id="dmModal" tabindex="-1" role="dialog" aria-labelledby="dmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <? include "./send_dm.php"?>
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
