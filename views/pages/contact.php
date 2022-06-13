<?php
zabeleziPristupStranici($_GET['page']);
?>
<!-- Map Begin -->
<div class="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d2998.6183758465386!2d20.43715292204607!3d44.81506638654229!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ssr!2srs!4v1643681026858!5m2!1ssr!2srs" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
</div>
<!-- Map End -->

<!-- Contact Section Begin -->
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="contact__text">
                    <div class="section-title">
                        <span>Information</span>
                        <h2>Contact Us</h2>
                        <p>As you might expect of a company that began as a high-end interiors contractor, we pay
                            strict attention.</p>
                    </div>
                    <ul>
                        <li>
                            <h4>Serbia</h4>
                            <p> Булевар Михајла Пупина 4, Београд 11070 <br />+381112854505</p>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="contact__form">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-lg-6">
                                <span class="help" id="fullNameHelp"></span>
                                <input type="text" placeholder="Full Name" id='fullName'>
                            </div>
                            <div class="col-lg-6">
                                <span class="help" id="emailHelp"></span>
                                <input type="text" placeholder="Email" id='email'>
                            </div>
                            <div class="col-lg-12">
                                <span class="help" id="msgHelp"></span>
                                <textarea placeholder="Message" id='msg'></textarea>
                                <button type="button" id='sendMsg' class="site-btn">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->