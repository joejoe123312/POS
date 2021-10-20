

<div style="margin-bottom: 59px;"></div>
<div class="text-center">
    <div id="typed-strings">
        <p>Filling up cavities...</p>

        <p>Waiting for those baby teeth...</p>

        <p>Checking for cavities...</p>

        <p>Applying braces...</p>

        <p>Initializing dental equipments...</p>

        <p>Reviewing patient records...</p>

        <p>Initialization complete...</p>
    </div>
    <img src="<?= base_url() . "assets/img/toothLogo.png" ?>" alt="">
    <h1 id="typed" style="margin-top: 50px;"></h1>
</div>


<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
<!-- do offline not cdn baka mahina yung internet sakanila -->
<script src="<?= base_url() ?>assets/js/libs/jquery/jquery-1.11.2.min.js"></script> 

<script>
    $(document).ready(function(){
        $('body').css("background-color", "#B3E5F0");
        
        var typed = new Typed('#typed', {
            stringsElement: '#typed-strings'
        });
        setTimeout(function(){
            window.location.replace("<?= base_url() . 'Dashboard' ?>");
        }, 10000);
    });   
</script>