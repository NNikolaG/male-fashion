<?php
zabeleziPristupStranici($_GET['page']);

?>
<div class="page-content">
    <div class="form-v7-content">

        <form class="form-detail" action="#" method="post" id="myform">
            <div class="form-row">
                <label for="fname">First Name</label>
                <input type="text" name="fname" id="fname" class="input-text" required>
                <span class="help" id="fnameHelp"></span>
            </div>
            <div class="form-row">
                <label for="lname">Last Name</label>
                <input type="text" name="lname" id="lname" class="input-text" required>
                <span class="help" id="lnameHelp"></span>
            </div>
            <div class="form-row">
                <label for="your_email">E-Mail</label>
                <input type="email" name="your_email" id="email" class="input-text" required>
                <span class="help" id="emailHelp"></span>
            </div>
            <div class="form-row">
                <label for="password">Password</label>
                <input type="password" name="password" id="passwordReg" class="input-text" required>
                <span class="help" id="passHelp"></span>
            </div>
            <div class="form-row">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="input-text" required>
                <span class="help" id="passHelpComf"></span>
            </div>
            <div class="form-row-last">
                <input type="button" name="register" id="register" class="register" value="Register">
                <p>Or<a href="index.php?page=login" style="color:black;">Log in</a></p>
            </div>
        </form>
        <div class="form-left">
            <img src="assets/img/clients/register.jpg" alt="form">
            <p class="text-2">Privaci policy & Term of service</p>
        </div>
    </div>
</div>