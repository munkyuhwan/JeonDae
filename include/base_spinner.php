<style>
    #my-spinner {
        width: 100%; height: 100%;
        top: 0; left: 0;
        display: none;
        opacity: .6;
        background: silver;
        position: fixed;
        z-index:999;
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
    $(document)
        .ajaxStart(function () {
            $('#my-spinner').fadeIn(100);
        })
        .ajaxStop(function () {
            $('#my-spinner').fadeOut(100);
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