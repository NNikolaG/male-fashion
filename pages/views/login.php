<?php
zabeleziPristupStranici($_GET['page']);

?>
<body class="form-v7">
    <div class="page-content">
        <div class="form-v7-content">
            <div class="form-left">
                <img src="assets/img/clients/login.jpg" alt="form">

                <p class="text-2">Privaci policy & Term of service</p>
            </div>
            <form class="form-detail" action="#" method="post" id="myform">
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
                <span class="help" id="msg"></span>
                <div class="form-row-last">
                    <input type="button" name="register" id="LogIn" class="register" value="Log in">
                    <p>Or<a href="index.php?page=register" style="color:black;">Register</a></p>
                </div>
            </form>
        </div>
    </div>