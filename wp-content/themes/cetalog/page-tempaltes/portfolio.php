<?php

/**
 * Template Name: Portfolio
 * @package cetalog
 */

get_header();


?>

<main>

    <!-- Case Studies start -->
    <section class="pt-120 pb-110 fix">
        <div class="container container-large">
            <div class="row">
                <div class="col-xl-12">
                    <div class="tp-case-studies-tab-button masonary-menu">
                        <button class="active" data-filter="*"><span>See All</span></button>
                        <button data-filter=".cat2"><span>Seo Optimization</span></button>
                        <button data-filter=".cat3"><span>Marketing</span></button>
                        <button data-filter=".cat4" class=""><span>Branding</span></button>
                        <button data-filter=".cat5" class=""><span>Web Desigin</span></button>
                        <button data-filter=".cat6" class=""><span>Digital Marketing</span></button>
                    </div>
                </div>
            </div>
            <div class="row grid tp-gx-20">
                <div class="col-lg-6 col-md-6 grid-item cat2 cat5 cat3">
                    <div class="tp-portfolio-item-2 tp-img-reveal tp-img-reveal-item mb-20" data-fx="24"
                        data-meta-tag="Development" data-title="Website developer hippie">
                        <div class="tp-portfolio-thumb-4">
                            <a href="https://wphix.com/wp/cetalog/portfolio-details/">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/case-studies/case-1.jpg" alt="cetalog-img">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 grid-item cat3 cat4 cat5 ">
                    <div class="tp-portfolio-item-2 tp-img-reveal tp-img-reveal-item mb-20" data-fx="24"
                        data-meta-tag="Development" data-title="Web developer hippie">
                        <div class="tp-portfolio-thumb-4">
                            <a href="https://wphix.com/wp/cetalog/portfolio-details/">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/case-studies/case-2.jpg" alt="cetalog-img">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 grid-item cat2 cat5 cat4 cat6">
                    <div class="tp-portfolio-item-2 tp-img-reveal tp-img-reveal-item mb-20" data-fx="24"
                        data-meta-tag="Development" data-title="Graphics developer hippie">
                        <div class="tp-portfolio-thumb-4">
                            <a href="https://wphix.com/wp/cetalog/portfolio-details/">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/case-studies/case-3.jpg" alt="cetalog-img">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 grid-item cat2 cat4 cat6 ">
                    <div class="tp-portfolio-item-2 tp-img-reveal tp-img-reveal-item mb-20" data-fx="24"
                        data-meta-tag="Development" data-title="App developer hippie">
                        <div class="tp-portfolio-thumb-4">
                            <a href="https://wphix.com/wp/cetalog/portfolio-details/">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/case-studies/case-4.jpg" alt="cetalog-img">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 grid-item cat2 cat5 cat4">
                    <div class="tp-portfolio-item-2 tp-img-reveal tp-img-reveal-item mb-20" data-fx="24"
                        data-meta-tag="Development" data-title="Android developer hippie">
                        <div class="tp-portfolio-thumb-4">
                            <a href="https://wphix.com/wp/cetalog/portfolio-details/">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/case-studies/case-5.jpg" alt="cetalog-img">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 grid-item cat2 cat4 cat3">
                    <div class="tp-portfolio-item-2 tp-img-reveal tp-img-reveal-item mb-20" data-fx="24"
                        data-meta-tag="Development" data-title="Website developer hippie">
                        <div class="tp-portfolio-thumb-4">
                            <a href="https://wphix.com/wp/cetalog/portfolio-details/">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/case-studies/case-6.jpg" alt="cetalog-img">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 grid-item cat2 cat4 cat6">
                    <div class="tp-portfolio-item-2 tp-img-reveal tp-img-reveal-item mb-20" data-fx="24"
                        data-meta-tag="Development" data-title="Wordpress developer hippie">
                        <div class="tp-portfolio-thumb-4">
                            <a href="https://wphix.com/wp/cetalog/portfolio-details/">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/case-studies/case-7.jpg" alt="cetalog-img">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 grid-item cat2 cat5 cat3 ">
                    <div class="tp-portfolio-item-2 tp-img-reveal tp-img-reveal-item mb-20" data-fx="24"
                        data-meta-tag="Development" data-title="Web developer hippie">
                        <div class="tp-portfolio-thumb-4">
                            <a href="https://wphix.com/wp/cetalog/portfolio-details/">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/case-studies/case-8.jpg" alt="cetalog-img">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Case Studies end -->

</main>

<?php
get_footer();