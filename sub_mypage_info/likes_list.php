<?
$likes_cnt_query = "SELECT COUNT(*) AS cnt FROM report_likes WHERE member_idx=".$_SESSION['user_access_idx'];
$likes_cnt_result = mysqli_query($gconnet, $likes_cnt_query);
$likes_cnt_row = mysqli_fetch_assoc($likes_cnt_result);

?>
<p class="cnt_row"><span><?=$likes_cnt_row['cnt']?></span>개의 글이 있습니다.</p>
<ul id="like_list">
</ul>
<script>
    var likePage=0;
    var likeBlock=5;
    function getLikeList() {
        $.ajax({
            url:"get_like_list.php",
            data:{"page":likePage,"block":likeBlock},
            method:"POST",
            success:function(response) {
                if (response.toString() != "") {
                    $("#like_list").append(response)
                    likePage += likeBlock;
                }
            },
            error:function(error) {

            }
        })
    }
</script>