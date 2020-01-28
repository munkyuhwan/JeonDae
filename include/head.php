<?ob_start();
session_start(); ?>
<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi">
        <meta name="format-detection" content="telephone=no, address=no, email=no">
        <title> 전대전 - 전국대신전해드립니다  </title>
        <link rel="stylesheet" type="text/css" href="../css/reset.css?ver=<?=time()?>">
        <link rel="stylesheet" type="text/css" href="../css/style.css?ver=<?=time()?>">
        <link rel="stylesheet" type="text/css" href="../css/notosans.css?ver=<?=time()?>">
        <link rel="stylesheet" type="text/css" href="../css/swiper.css?ver=<?=time()?>">

        <script type="text/javascript" src="../js/jquery-1.12.0.min.js?ver=<?=time()?>"></script>
        <script type="text/javascript" src="../js/main.js?ver=<?=time()?>"></script>
        <script type="text/javascript" src="../js/swiper.min.js"></script>
        <script src="//developers.kakao.com/sdk/js/kakao.min.js" ></script>
        <script type="text/javascript" src="../js/functions.js?ver=<?=time()?>"></script>
        <script async defer src="https://connect.facebook.net/en_US/sdk.js"></script>

    </head>
    <?include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php";?>
    <?include $_SERVER["DOCUMENT_ROOT"]."/include/toast_msg.php";?>


    <style>
        .main_content {
            overflow: hidden;
            text-overflow: ellipsis;
            word-wrap: break-word;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            display: -webkit-box !important;
        }
        .main_content_open {
            display: inline !important;
        }
    </style>