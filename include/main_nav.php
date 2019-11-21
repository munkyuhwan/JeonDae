
<header>
    <div class="header grd_bg">
        <h1><a href="main1.html"><img src="../images/logo_txt.png" alt="전대전 - 전국 대신 전해드립니다"></a></h1>
        <button type="button" class="snb_btn"></button>
    </div>
</header>
<nav class="main_nav">
    <ul>
        <li class="main_menu1"><a href="../main1" title="메인" <?= $_SERVER['REQUEST_URI']=="/main1/" ? "class=\"on\"":"" ?> ></a></li>
        <li class="main_menu2"><a href="../main2" title="" <?= $_SERVER['REQUEST_URI']=="/main2/" ? "class=\"on\"":"" ?> ></a></li>
        <li class="main_menu3"><a href="../main3" title="거래" <?= $_SERVER['REQUEST_URI']=="/main3/" ? "class=\"on\"":"" ?> ></a></li>
        <li class="main_menu4"><a href="../main4" title="알림" <?= $_SERVER['REQUEST_URI']=="/main4/" ? "class=\"on\"":"" ?>></a></li>
        <li class="main_menu5"><a href="../main5" title="검색" <?= $_SERVER['REQUEST_URI']=="/main5/" ? "class=\"on\"":"" ?>></a></li>
    </ul>
</nav>