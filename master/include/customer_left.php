	  <aside id="lnb">
			<h2 class="tit"><span>게시판 관리</span></h2>
			<ul class="menu">
				<li <?if($smenu==1){?>class="on"<?}?>>
					<a href="../customer/board_list.php?bmenu=<?=$bmenu?>&smenu=1&bbs_code=notice">공지사항</a>
				</li>
				<li <?if($smenu==2){?>class="on"<?}?>>
					<a href="../customer/board_list.php?bmenu=<?=$bmenu?>&smenu=2&bbs_code=faq">자주묻는질문</a>
				</li>
			</ul>
		</aside>