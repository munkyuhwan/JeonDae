<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 

	$sns_type = trim(sqlfilter($_REQUEST['sns_type']));
	$sns_url_org = trim(sqlfilter($_REQUEST['sns_url_org']));
	$sns_url_img = trim(sqlfilter($_REQUEST['sns_url_img']));
	$sns_url_title = trim(sqlfilter($_REQUEST['sns_url_title']));
	$sns_url_content = trim(sqlfilter($_REQUEST['sns_url_content']));
?>
<html>
<head>
  <title><?=$sns_url_title?></title>
  <!-- Comment #1: OG Tags -->
 <meta property="og:type" content="website">
<meta property="og:url" content="<?=$sns_url_org?>">
<meta property="og:title" content="<?=$sns_url_title?>">
<meta property="og:description" content="<?=$sns_url_content?>">
<meta property="og:image" content="<?=$sns_url_img?>">
</head>
<body>

 <img src="<?=$sns_url_img?>">

 <script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
<script type="text/javascript">
<!--
 Kakao.init('5d31e5a47779e2ec3efaf567cd2fc99f');
  // 카카오톡 공유하기
    function sendKakaoTalk(){
		Kakao.Link.sendTalkLink({
			label: '<?=$sns_url_title?>',
			image: {
				src: '<?=$sns_url_img?>',
				width: '1200',
				height: '627'
			},
		    webButton: {
				text: '코인코잉 바로가기',
				url: '<?=$sns_url_org?>' // 앱 설정의 웹 플랫폼에 등록한 도메인의 URL이어야 합니다.
			}
	    });
    }
// 카카오톡으로 보내기
    Kakao.Link.createTalkLinkButton({
      container: '#kakao-link-btn',
      label: '<?=$sns_url_title?>',
      image: {
        src: '<?=$sns_url_img?>',
        width: '1200',
        height: '627'
      },
      webButton: {
			text: '코인코잉 바로가기',
			url: '<?=$sns_url_org?>' // 앱 설정의 웹 플랫폼에 등록한 도메인의 URL이어야 합니다.
      }
    });
 
 function share_tw(){
	  var content = "<?=$sns_url_content?>";
	  var link = "<?=$sns_url_org?>";
	  var popOption = "width=370, height=360, resizable=no, scrollbars=no, status=no;";
	  var wp = window.open("http://twitter.com/share?url=" + encodeURIComponent(link) + "&text=" + encodeURIComponent(content), 'twitter', popOption); 
	  if ( wp ) {
		wp.focus();
	 } 	
}

function facebook_share(){
	var text = "<?=$sns_url_title?>";
	var url = "<?=$sns_url_org?>";
	var image = "<?=$sns_url_img?>";
	var summary = "<?=$sns_url_content?>";
	var snsUrl = "http://www.facebook.com/sharer.php?u="+encodeURIComponent(url)+"&t="+encodeURIComponent(summary)+"&i="+encodeURIComponent(image);
	var popup= window.open(snsUrl, "_snsPopupWindow", "width=500, height=500");
	popup.focus();
 }

function kakaostory_share(){
	var title = "<?=$sns_url_title?>";
     title = title.substring(0,100);
     //title = unescapeXml(title);
     title = title.replace(/\&(amp;)?/ig, ""); // 카스인경우 &amp; 등록시 글자 짤림
	var url = "<?=$sns_url_org?>";
	var snsUrl = "https://story.kakao.com/share?url="+encodeURIComponent(url);
	var popup= window.open(snsUrl, "_snsPopupWindow", "width=500, height=500");
	popup.focus();
 }

//SNS 등 sharer 처리
 function unescapeXml(str){
	// str = str.replaceAll("&amp;", "&");
	str = str.replaceAll("&lt;", "<");
	str = str.replaceAll("&gt;", ">");
	str = str.replaceAll("&apos;", "'");
	str = str.replaceAll("&quot;", "\"");
	str = str.replaceAll("&#039;", "'");
	return str;
 }

<?if($sns_type == "face"){?>
	$(document).ready(function(){
		facebook_share();
	});
<?}?>
//-->
</script>

</body>
</html>