
<style>
    #my-spinner {
        width: 100%; height: 100%;
        top: 0; left: 0;
        display: none;
        opacity: .6;
        background: silver;
        position: fixed;
    }
    #my-spinner div {
        width: 100%; height: 100%;
        display: table;
    }
    #my-spinner span {
        display: table-cell;
        text-align: center;
        vertical-align: middle;
    }
    #my-spinner img {
        background: white;
        padding: 1em;
        border-radius: .7em;
    }
</style>
<div id='my-spinner'>
    <div><span>
		<img src='//cdnjs.cloudflare.com/ajax/libs/galleriffic/2.0.1/css/loader.gif'>
	</span></div>
</div>
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
<script>
    $(document)
        .ajaxStart(function () {
            $('#my-spinner').show();
        })
        .ajaxStop(function () {
            $('#my-spinner').hide();
        });

    $(function() {
        $('#btn-load-data').click(function () {
            $.ajax({
                url: 'http://zetawiki.com/ex/php/sleep3.json.php',
                data: { num: Math.floor(Math.random() * 100) }
            }).done(function( data ) {
                $('#result').val( data );
            });
        });
    });
</script>
