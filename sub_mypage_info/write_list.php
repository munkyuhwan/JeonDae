<?
$write_cnt_query = "SELECT COUNT(*) AS cnt FROM report_list WHERE complete_yn='Y' AND del_yn='N' AND member_idx=".$_SESSION['user_access_idx'];
$write_cnt_result = mysqli_query($gconnet, $write_cnt_query);
$cnt_row = mysqli_fetch_assoc($write_cnt_result);
?>
<p class="cnt_row"><span><?=$cnt_row['cnt']?></span>개의 글이 있습니다.</p>
<ul id="write_list">
</ul>
<script>
    var writePage=0;
    var writeBlock=5;
    function getWriteList() {
        $.ajax({
            url:"get_write_list.php",
            data:{"page":writePage,"block":writeBlock},
            method:"POST",
            success:function(response) {
                if (response.toString() != "") {
                    $("#write_list").append(response)
                    writePage += writeBlock;
                }
            },
            error:function(error) {
                console.log(error)
            }
        })
    }
</script>