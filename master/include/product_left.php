		<aside id="lnb">
			<h2 class="tit"><span>상품관리</span></h2>
			<ul class="menu">
				<li <?if($smenu==1){?>class="on"<?}?>>
					<a href="../product/product_list.php?bmenu=<?=$bmenu?>&smenu=1">상품리스트</a>
				</li>
				<li <?if($smenu==2){?>class="on"<?}?>>
					<a href="../product/product_write.php?bmenu=<?=$bmenu?>&smenu=2">상품등록</a>
				</li>
				<li <?if($smenu==3){?>class="on"<?}?>>
					<a href="../product/cate_list.php?bmenu=<?=$bmenu?>&smenu=3">상품 카테고리 관리</a>
				</li>
				<li <?if($smenu==4){?>class="on"<?}?>>
					<a href="../product/mainban_list.php?bmenu=<?=$bmenu?>&smenu=4">메인화면 상품배치</a>
				</li>
				<li <?if($smenu==5){?>class="on"<?}?>>
					<a href="../product/board_list.php?bmenu=<?=$bmenu?>&smenu=5&bbs_code=proafter">상품평</a>
				</li>
				<li <?if($smenu==6){?>class="on"<?}?>>
					<a href="../product/board_list.php?bmenu=<?=$bmenu?>&smenu=6&bbs_code=proqna">상품문의</a>
				</li>
				<li <?if($smenu==7){?>class="on"<?}?>>
					<a href="../product/product_excel_new.php?bmenu=<?=$bmenu?>&smenu=7">신규상품 일괄등록</a>
				</li>
				<li <?if($smenu==8){?>class="on"<?}?>>
					<a href="../product/delv_list.php?bmenu=<?=$bmenu?>&smenu=8">배송.교환.반품 설정</a>
				</li>
			</ul>
		</aside>