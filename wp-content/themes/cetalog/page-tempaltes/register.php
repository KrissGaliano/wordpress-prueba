<?php

/**
* Template Name: Register
 * @package cetalog
 */

get_header();


?>
<main>
    <!-- sign up area start -->
    <section class="signup__area p-relative z-index-1 pt-100 pb-145">
        <div class="sign__shape">
            <img class="man-1" src="<?php echo get_template_directory_uri();?>/assets/img/icon/sign/man-3.png" alt="cetalog-img">
            <img class="man-2 man-22" src="<?php echo get_template_directory_uri();?>/assets/img/icon/sign/man-2.png" alt="cetalog-img">
            <img class="circle" src="<?php echo get_template_directory_uri();?>/assets/img/icon/sign/circle.png" alt="cetalog-img">
            <img class="zigzag" src="<?php echo get_template_directory_uri();?>/assets/img/icon/sign/zigzag.png" alt="cetalog-img">
            <img class="dot" src="<?php echo get_template_directory_uri();?>/assets/img/icon/sign/dot.png" alt="cetalog-img">
            <img class="bg" src="<?php echo get_template_directory_uri();?>/assets/img/icon/sign/sign-up.png" alt="cetalog-img">
            <img class="flower" src="<?php echo get_template_directory_uri();?>/assets/img/icon/sign/flower.png" alt="cetalog-img">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2">
                    <div class="section__title-wrapper text-center mb-55">
                        <h2 class="section__title">Create a free <br> Account</h2>
                        <p>I'm a subhead that goes with a story.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                    <div class="sign__wrapper white-bg">
                        <div class="sign__header mb-35">
                            <div class="sign__in text-center">
                                <a href="#" class="sign__social g-plus text-start mb-15"><i
                                        class="fab fa-google-plus-g"></i>Sign Up with Google</a>
                                <p> <span>........</span> Or, <a href="https://wphix.com/wp/cetalog/register/">sign up</a> with your email<span>
                                        ........</span> </p>
                            </div>
                        </div>
                        <div class="sign__form">
                            <form action="#">
                                <div class="sign__input-wrapper mb-25">
                                    <h5>Full Name</h5>
                                    <div class="sign__input">
                                        <input type="text" placeholder="Full name">
                                        <i class="fal fa-user"></i>
                                    </div>
                                </div>
                                <div class="sign__input-wrapper mb-25">
                                    <h5>Work email</h5>
                                    <div class="sign__input">
                                        <input type="text" placeholder="e-mail address">
                                        <i class="fal fa-envelope"></i>
                                    </div>
                                </div>
                                <div class="sign__input-wrapper mb-25">
                                    <h5>Password</h5>
                                    <div class="sign__input">
                                        <input type="text" placeholder="Password">
                                        <i class="fal fa-lock"></i>
                                    </div>
                                </div>
                                <div class="sign__input-wrapper mb-10">
                                    <h5>Re-Password</h5>
                                    <div class="sign__input">
                                        <input type="text" placeholder="Re-Password">
                                        <i class="fal fa-lock"></i>
                                    </div>
                                </div>
                                <div class="sign__action d-flex justify-content-between mb-30">
                                    <div class="sign__agree d-flex align-items-center">
                                        <input class="m-check-input" type="checkbox" id="m-agree">
                                        <label class="m-check-label" for="m-agree">I agree to the <a href="#">Terms &
                                                Conditions</a>
                                        </label>
                                    </div>
                                </div>
                                <button class="tp-btn w-100"> <span></span> Sign Up</button>
                                <div class="sign__new text-center mt-20">
                                    <p>Already in Cetalog ? <a href="https://wphix.com/wp/cetalog/login/"> Sign In</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- sign up area end -->
</main>

<?php 
get_footer();