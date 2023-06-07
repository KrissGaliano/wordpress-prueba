<?php

/**
* Template Name: Contact us
 * @package cetalog
 */

get_header();


?>


<main>
    <!-- contact area start -->
    <section class="tp-contact-area pt-130 pb-85">
        <div class="container container-large">
            <div class="row">
                <div class="col-md-12 col-lg-6">
                    <div class="tp-contact-wrapper pr-130 mb-30">
                        <div class="tp-contact-section-wrapper-breadcrumb mb-55">
                            <span class="tp-section__title-pre has-before has-after">Contact us</span>
                            <h3 class="tp-section__title">Just have a quick any questions?</h3>
                            <p>Within the hive is a structure made from wax called honeycomb. The honeycomb is made up
                                of hundreds or thousands of hexagonal cells, into which the bees regurgitate honey for
                                storage. Other honey- producing species. urgitate honey for storage.</p>
                        </div>
                        <div class="tp-contact-icons">
                            <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="#"><i class="fa-brands fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fa-brands fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6">
                    <div class="tp-contact__form-breadcrumb mb-30 wow fadeInRight" data-wow-delay=".3s"
                        data-wow-duration="1s">
                        <form id="contact-form" action="assets/mail.php" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="tp-contact__input">
                                        <input name="name" type="text" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="tp-contact__input">
                                        <input name="l_name" type="text" placeholder="Enter Mail">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="tp-contact__input">
                                        <input name="phone" type="text" placeholder="Website">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="tp-contact__input">
                                        <textarea name="message" placeholder="Enter your message "></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="tp-contact__btn contact-3">
                                        <button type="submit" class="tp-btn button-bounce-shine">Send Message</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <p class="ajax-response"></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact area end -->

    <!-- contact details area start -->
    <section class="pb-130">
        <div class="container container-large">
            <div class="row">
                <div class="col-lg-6 col-md-12 wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".3s">
                    <div class="tp-contact-map">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d9889.507346062348!2d29.407172805877835!3d38.67187778612447!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1672285510601!5m2!1sen!2sbd"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="tp-contact-info">
                        <h3 class="tp-section__title">Contact info</h3>
                        <ul class="tp-contact-details">
                            <li>
                                <a href="tel:099-406-7592"><i class="fa-light fa-headset"></i> +(528) 406-7592</a>
                            </li>
                            <li>
                                <a href="https://www.google.com/maps/place/4517+Washington+Ave,+Manchester,+KY+39495,+USA/@29.7703163,-95.4088436,17z/data=!3m1!4b1!4m5!3m4!1s0x8640c0b2dbc150fb:0x8d7660bc65ed9511!8m2!3d29.7703117!4d-95.4066549"
                                    target="_blank"><i class="fa-regular fa-location-dot"></i> 4517 Washington Ave.
                                    Manchester, <br> Kentucky 39495</a>
                            </li>
                            <li>
                                <a href="mailto:themepure@gmail.com"><i class="fa-light fa-envelope"></i>
                                    themepurebd@gmail.com</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact details area end -->

</main>

<?php 
get_footer();