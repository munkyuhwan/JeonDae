<style>
    #toast {
        position: fixed;
        bottom: 30px;
        left: 50%;
        padding: 15px 20px;
        transform: translate(-50%, 10px);
        border-radius: 30px;
        overflow: hidden;
        font-size: .8rem;
        opacity: 0;
        visibility: hidden;
        transition: opacity .5s, visibility .5s, transform .5s;
        background: rgba(0, 0, 0, .35);
        color: #fff;
        z-index: 10000;
    }

    #toast.reveal {
        opacity: 1;
        visibility: visible;
        transform: translate(-50%, 0)
    }
</style>
<div id="toast"></div>
<script>
    let removeToast;

    function toast(string) {
        const toast = document.getElementById("toast");

        toast.classList.contains("reveal") ?
            (clearTimeout(removeToast), removeToast = setTimeout(function () {
                document.getElementById("toast").classList.remove("reveal")
            }, 1000)) :
            removeToast = setTimeout(function () {
                document.getElementById("toast").classList.remove("reveal")
            }, 1000)
        toast.classList.add("reveal"),
            toast.innerText = string
    }
</script>