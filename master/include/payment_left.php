		<aside id="lnb">
			<h2 class="tit"><span>쇼핑몰 주문관리</span></h2>
			<ul class="menu">
				<li <?if($smenu == 2){?>class="on"<?}?>>
						<a href="../payment/order_list.php?bmenu=<?=$bmenu?>&smenu=2&v_sect=ingp">입금대기 리스트</a>
				</li>
				<li <?if($smenu == 1){?>class="on""<?}?>>
						<a href="../payment/order_list.php?bmenu=<?=$bmenu?>&smenu=1&v_sect=ing">주문결제 리스트</a>
				</li>
				<li <?if($smenu == 3){?>class="on"<?}?>>
						<a href="../payment/order_list.php?bmenu=<?=$bmenu?>&smenu=3&v_sect=ingb">배송중 리스트</a>
				</li>
				<li <?if($smenu == 4){?>class="on"<?}?>>
						<a href="../payment/order_list.php?bmenu=<?=$bmenu?>&smenu=4&v_sect=incb">배송완료 리스트</a>
				</li>
			</ul>
		</aside>