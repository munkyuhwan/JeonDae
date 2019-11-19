<aside id="lnb">
	<h2 class="tit"><span>호스트회원 관리</span></h2>
	<ul class="menu">
		<li <?if($smenu==1){?>class="on"<?}?>>
			<a href="../partner/member_list.php?bmenu=<?=$bmenu?>&smenu=1&v_sect=PAT">호스트회원 리스트</a>
		</li>
		<li <?if($smenu==2){?>class="on"<?}?>>
			<a href="../partner/yakkwan_set.php?bmenu=<?=$bmenu?>&smenu=2&cate_code1=host1">비슷 호스트소개 설정</a>
		</li>
		<li <?if($smenu==3){?>class="on"<?}?>>
			<a href="../partner/yakkwan_set.php?bmenu=<?=$bmenu?>&smenu=3&cate_code1=host2">비슷 TITLE 설정</a>
		</li>
		<!--<li <?if($smenu == 2){?>class="on"<?}?>>
			<a href="../partner/member_send_push.php?bmenu=<?=$bmenu?>&smenu=2">푸쉬발송</a>
		</li>
		<li <?if($smenu == 3){?>class="on"<?}?>>
			<a href="../partner/push_send_list.php?bmenu=<?=$bmenu?>&smenu=3&mail_gubun=pushp">푸쉬 발송내역</a>
		</li>-->
	</ul>
</aside>