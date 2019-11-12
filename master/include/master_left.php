<style>
    .side-menu {
        position: absolute;
        z-index: 99999;
    }
</style>
<ul class="sidebar navbar-nav toggled side-menu">
    <li class="nav-item <?= $bmenu == '1' ? "active":"" ?>">
        <a class="nav-link" href="../main/?bmenu=1&smenu=1<?='&field='.$field.'&keyword='.$keyword.'&v_sect='.$v_sect.'&s_gubun='.$s_gubun.'&s_level='.$s_level.'&s_gender='.$s_gender.'&s_sect1='.$s_sect1.'&s_sect2='.$s_sect2.'&s_cnt='.$s_cnt.'&s_order='.$s_order?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>홈</span>
        </a>
    </li>
    <li class="nav-item <?= $bmenu == '2' ? "active":"" ?>">
        <a class="nav-link" href="../ham_list/?bmenu=2&smenu=1<?='&field='.$field.'&keyword='.$keyword.'&v_sect='.$v_sect.'&s_gubun='.$s_gubun.'&s_level='.$s_level.'&s_gender='.$s_gender.'&s_sect1='.$s_sect1.'&s_sect2='.$s_sect2.'&s_cnt='.$s_cnt.'&s_order='.$s_order?>">
            <i class="fas fa-fw fa-folder"></i>
            <span>제보관리</span>
        </a>
    </li>
    <li class="nav-item <?= $bmenu == '3' ? "active":"" ?>">
        <a class="nav-link" href="../members/?bmenu=3&smenu=1<?='&field='.$field.'&keyword='.$keyword.'&v_sect='.$v_sect.'&s_gubun='.$s_gubun.'&s_level='.$s_level.'&s_gender='.$s_gender.'&s_sect1='.$s_sect1.'&s_sect2='.$s_sect2.'&s_cnt='.$s_cnt.'&s_order='.$s_order?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>회원관리</span>
        </a>
    </li>
    <li class="nav-item <?= $bmenu == '4' ? "active":"" ?>">
        <a class="nav-link" href="../settings?bmenu=4&smenu=1<?='&field='.$field.'&keyword='.$keyword.'&v_sect='.$v_sect.'&s_gubun='.$s_gubun.'&s_level='.$s_level.'&s_gender='.$s_gender.'&s_sect1='.$s_sect1.'&s_sect2='.$s_sect2.'&s_cnt='.$s_cnt.'&s_order='.$s_order?>">
            <i class="fas fa-fw fa-table"></i>
            <span>설정</span>
        </a>
    </li>
</ul>