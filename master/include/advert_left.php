<aside id="lnb">
	<h2 class="tit"><span>프로그램관리</span></h2>
	<ul class="menu">
		<li <?if($smenu==1){?>class="on"<?}?>>
			<a href="../advert/ad_list.php?bmenu=<?=$bmenu?>&smenu=1">프로그램 리스트</a>
		</li>
		<!--<li <?if($smenu==2){?>class="on"<?}?>>
			<a href="../advert/mainban_list.php?bmenu=<?=$bmenu?>&smenu=3">메인화면 프로그램배치</a>
		</li>
		<li <?if($smenu ==4){?>class="on"<?}?>>
			<a href="../advert/point_set.php?bmenu=<?=$bmenu?>&smenu=4&point_sect=refund">코인 적립설정</a>
		</li>-->
		<li <?if($smenu==2){?>class="on"<?}?>>
			<a href="../advert/board_list.php?bmenu=<?=$bmenu?>&smenu=2&bbs_code=adreview">프로그램리뷰</a>
		</li>
		<!--<li <?if($smenu==3){?>class="on"<?}?>>
			<a href="../advert/board_list.php?bmenu=<?=$bmenu?>&smenu=3&bbs_code=adidea">프로그램 아이디어</a>
		</li>
		<li <?if($smenu==8){?>class="on"<?}?>>
			<a href="../advert/share_list.php?bmenu=<?=$bmenu?>&smenu=8">프로그램 공유내역</a>
		</li>-->
		<li <?if($smenu==3){?>class="on"<?}?>>
			<a href="../advert/ad_regist_list.php?bmenu=<?=$bmenu?>&smenu=3">프로그램 참가신청 리스트</a>
		</li>
	</ul>
</aside>