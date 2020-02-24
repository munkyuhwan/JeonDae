<iframe name="_fra_submit" width="90%" height="300" style="display: none;;"></iframe>
<script src="../js/ptr.js"></script>
<script>
    /* global PullToRefresh */
    PullToRefresh.init({
        mainElement: '#mainWrapper',
        onRefresh: function() {
            page = 0;
            $("#main_list").html("")
            getList();
        }
    });
</script>
