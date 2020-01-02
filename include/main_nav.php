<?//if ($_SESSION['user_access_idx'] != "") {?>
<nav class="main_nav">
    <ul>
        <li class="main_menu1"><a href="../main1" title="메인" <?= explode("/", $_SERVER['REQUEST_URI'])[1] == "main1" ? "class=\"on\"":"" ?> ></a></li>
        <li class="main_menu2"><a href="../main2" title="" <?= explode("/", $_SERVER['REQUEST_URI'])[1] == "main2" || explode("/", $_SERVER['REQUEST_URI'])[1] == "sub_area"   ? "class=\"on\"":"" ?> ></a></li>
        <li class="main_menu3"><a href="../main3" title="거래" <?= explode("/", $_SERVER['REQUEST_URI'])[1] == "main3" ? "class=\"on\"":"" ?> ></a></li>
        <li class="main_menu4"><a href="../main4" title="알림" <?= explode("/", $_SERVER['REQUEST_URI'])[1] == "main4" ? "class=\"on\"":"" ?>></a></li>
        <li class="main_menu5"><a href="../main5" title="검색" <?= explode("/", $_SERVER['REQUEST_URI'])[1] == "main5" ? "class=\"on\"":"" ?>></a></li>
    </ul>
</nav>
<?//}?>