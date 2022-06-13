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

    let s = 5;
    window.setInterval(() => {
        if (s == 0) {
            localStorage.clear();
            window.location.href = './index.php?page=home';
        }
        document.querySelector('#responseMsg').innerHTML = response + " " + s + "s";
        s--;
    }, 1000)
</script>