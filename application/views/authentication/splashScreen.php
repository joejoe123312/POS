<style>
    .cogRotate {
        -webkit-animation: spin 4s linear infinite;
        -moz-animation: spin 4s linear infinite;
        animation: spin 4s linear infinite;
    }

    @-moz-keyframes spin {
        100% {
            -moz-transform: rotate(360deg);
        }
    }

    @-webkit-keyframes spin {
        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }
</style>
<div style="margin-bottom: 59px;"></div>
<div class="text-center">
    <div id="typed-strings">

        <p>Reviewing patient records...</p>

        <p>Initialization complete...</p>
    </div>
    <img src="<?= base_url() . "assets/img/logo.png" ?>" alt="">
    <h1 id="typed" style="margin-top: 50px;"></h1>
    <h1 class="cogRotate"> <i class="fa fa-cog"></i>
    </h1>
</div>


<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
<!-- do offline not cdn baka mahina yung internet sakanila -->
<script src="<?= base_url() ?>assets/js/libs/jquery/jquery-1.11.2.min.js"></script>

<script>
    $(document).ready(function() {
        $('body').css("background-color", "#B3E5F0");

        var typed = new Typed('#typed', {
            stringsElement: '#typed-strings'
        });
        setTimeout(function() {
            window.location.replace("<?= base_url() . 'Dashboard' ?>");
        }, 5000);
    });
</script>