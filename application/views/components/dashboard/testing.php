
<input type="text" id="firstname">
<button id="submitBtn">submit</button>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $("#submitBtn").click(function(){
            alert($("#firstname").val());
        });

        let baseUrl = "<?= base_url() ?>";
        // create script
        $.post(`${baseUrl}Command_patient/create`, {
            firstname: "Joel", 
            middlename: "John",
            lastname: "Centeno",
            age: 22,
            gender: "it depends",
            height: 5, 
            weight: 70,
            civil_status: "single"
        }, function(resp){
            // do some actions here
        });
    });
</script>

