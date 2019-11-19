<aside id="lnb">
	<h2 class="tit"><span>회원관리</span></h2>
	<ul class="menu">
		<li <?if($smenu==1){?>class="on"<?}?>>
			<a href="../member/member_list.php?bmenu=<?=$bmenu?>&smenu=1&v_sect=GEN&s_gubun=NOR">일반회원 리스트</a>
		</li>
		<li <?if($smenu == 2){?>class="on"<?}?>>
			<a href="../member/point_set.php?bmenu=<?=$bmenu?>&smenu=2&point_sect=refund">포인트 적립비율 설정</a>
		</li>
		<li <?if($smenu == 3){?>class="on"<?}?>>
			<a href="../member/member_point_list.php?bmenu=<?=$bmenu?>&smenu=3&point_sect=refund">회원별 포인트 관리</a>
		</li>
		<li <?if($smenu==4){?>class="on"<?}?>>
			<a href="../partner/yakkwan_set.php?bmenu=<?=$bmenu?>&smenu=4&cate_code1=mem1">회원가입 약관설정</a>
		</li>
		<li <?if($smenu==5){?>class="on"<?}?>>
			<a href="../partner/yakkwan_set.php?bmenu=<?=$bmenu?>&smenu=5&cate_code1=mem2">개인정보 보호정책설정</a>
		</li>
		
		<!--<li <?if($smenu == 5){?>class="on"<?}?>>
			<a href="../member/mcoupon_write.php?bmenu=<?=$bmenu?>&smenu=5">쿠폰 발급</a>
		</li>
		<li <?if($smenu == 6){?>class="on"<?}?>>
			<a href="../member/mcoupon_list.php?bmenu=<?=$bmenu?>&smenu=6">발급 쿠폰 리스트</a>
		</li>
		<li <?if($smenu == 7){?>class="on"<?}?>>
			<a href="../member/member_coupon_list.php?bmenu=<?=$bmenu?>&smenu=7">회원별 쿠폰내역 보기</a>
		</li>
		<li <?if($smenu == 8){?>class="on"<?}?>>
			<a href="../member/member_memo_write.php?bmenu=<?=$bmenu?>&smenu=8">전체쪽지 발송</a>
		</li>
		<li <?if($smenu == 9){?>class="on"<?}?>>
			<a href="../member/mail_send_list.php?bmenu=<?=$bmenu?>&smenu=9&mail_gubun=memo&v_sect=GEN">발송한 쪽지 목록</a>
		</li>
		<li <?if($smenu == 4){?>class="on"<?}?>>
			<a href="../member/member_send_push.php?bmenu=<?=$bmenu?>&smenu=4">푸쉬발송</a>
		</li>
		<li <?if($smenu == 5){?>class="on"<?}?>>
			<a href="../member/push_send_list.php?bmenu=<?=$bmenu?>&smenu=5&mail_gubun=push">푸쉬 발송내역</a>
		</li>-->
	</ul>
</aside>