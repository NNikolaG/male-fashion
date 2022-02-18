<?php
zabeleziPristupStranici($_GET['page']);



?>
<div class='d-flex justify-content-center pt-5 pb-5'>

    <div class="col-6 alert alert-success pt-5 pb-5" role="alert" id='responseMsg'>

    </div>
</div>
<script>
    var response = localStorage.getItem('responseMsg');
    document.querySelector('#responseMsg').innerHTML = response;

    window.setTimeout(function() {
        localStorage.clear();
        window.location.href = 'http://127.0.0.1/malefashion-master/index.php?page=home';
    }, 5000);
</script>