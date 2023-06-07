<?php

/**
* Template Name: Pricing
 * @package cetalog
 */

get_header();


?>


<main>

    <!-- price area start -->
    <section class="tp-pricing-area pt-130 pb-100 p-relative z-index-1">
        <div class="container container-large">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tp-pricing-wrapper text-center">
                        <h3 class="tp-section__title">Flexible Plans For Small To Fast- <br> Growing Business</h3>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-5">
                    <div class="tp-pricing-tab-nav tp-tab mb-50 mx-auto">
                        <nav>
                            <div class="nav nav-tabs justify-content-center" id="nav-tab" role=tablist>
                                <div class="nav dxs-block d-sm-flex justify-content-center p-relative z-index-1">
                                    <button class="nav-link tp-monthly" id="nav-monthly-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-monthly" role="tab" aria-controls="nav-monthly"
                                        aria-selected="true">Billed monthly</button>
                                    <button class="nav-link tp-yearly active" id="nav-yearly-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-yearly" role="tab" aria-controls="nav-yearly"
                                        aria-selected="false">Billed yearly <span class="offer">-35%</span></button>
                                    <i class="tp-price-tab-bg-slide"></i>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="tab-content wow fadeInUp" id="nav-tabContent" data-wow-delay=".3s"
                        data-wow-duration="1s">
                        <div class="tab-pane fade" id="nav-monthly" role="tabpanel" aria-labelledby="nav-monthly-tab">
                            <div class="row">
                                <div class="col-xl-4 col-md-6">
                                    <div class="tp-pricing-item d-flex flex-column mb-30">
                                        <div class="tp-pricing-top p-relative black-bg">
                                            <div class="tp-pricing-icon">
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/price/shape.png" alt="cetalog-img">
                                            </div>
                                            <div class="tp-pricing-title-wrapper">
                                                <h3 class="tp-pricing__title">$0<span> / free</span></h3>
                                                <p>Perfect Plan for Starters.</p>
                                            </div>
                                        </div>
                                        <div class="tp-pricing-content">
                                            <div
                                                class="tp-pricing-content-inner d-flex flex-column justify-content-between">
                                                <div class="tp-pricing-feature tp-mb-1">
                                                    <p>Includes:</p>
                                                    <ul>
                                                        <li>Full Access Library</li>
                                                        <li>Business & Financ Analysing</li>
                                                        <li>Exclusive Templates</li>
                                                        <li>24 hour support</li>
                                                    </ul>
                                                </div>
                                                <div class="tp-pricing-btn">
                                                    <a href="https://wphix.com/wp/cetalog/contact/" class="tp-price-btn w-100">Choose Plan</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6">
                                    <div class="tp-pricing-item has-popular pricing-active d-flex flex-column mb-30">
                                        <div class="tp-pricing-popular">
                                            <p>MOST POPULAR</p>
                                        </div>
                                        <div class="tp-pricing-top p-relative black-bg">
                                            <div class="tp-pricing-icon">
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/price/shape.png" alt="cetalog-img">
                                            </div>
                                            <div class="tp-pricing-title-wrapper">
                                                <h3 class="tp-pricing__title">$29<span> / month</span></h3>
                                                <p>Collaborate Professionally.</p>
                                            </div>
                                        </div>
                                        <div class="tp-pricing-content">
                                            <div
                                                class="tp-pricing-content-inner d-flex flex-column justify-content-between">
                                                <div class="tp-pricing-feature tp-mb-2">
                                                    <p>Everything in Personal Plan, plus</p>
                                                    <ul>
                                                        <li>Full Access Library</li>
                                                        <li>Business & Finance Analysing</li>
                                                        <li>Exclusive Templates</li>
                                                        <li>24 hour support</li>
                                                        <li>Customer Management</li>
                                                    </ul>
                                                </div>
                                                <div class="tp-pricing-btn">
                                                    <a href="https://wphix.com/wp/cetalog/contact/" class="tp-price-btn w-100">Choose Plan</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6">
                                    <div class="tp-pricing-item d-flex flex-column mb-30">
                                        <div class="tp-pricing-top p-relative black-bg">
                                            <div class="tp-pricing-icon">
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/price/shape.png" alt="cetalog-img">
                                            </div>
                                            <div class="tp-pricing-title-wrapper">
                                                <h3 class="tp-pricing__title">$49<span> / month</span></h3>
                                                <p>True Power of Management</p>
                                            </div>
                                        </div>
                                        <div class="tp-pricing-content">
                                            <div
                                                class="tp-pricing-content-inner d-flex flex-column justify-content-between">
                                                <div class="tp-pricing-feature tp-mb-2">
                                                    <p>Everything in Team Plan, plus</p>
                                                    <ul>
                                                        <li>User provisioning (SCIM)</li>
                                                        <li>Databases with rich property types</li>
                                                        <li>Custom guest editors</li>
                                                        <li>24 hour support</li>
                                                        <li>Customer Management</li>
                                                    </ul>
                                                </div>
                                                <div class="tp-pricing-btn">
                                                    <a href="https://wphix.com/wp/cetalog/contact/" class="tp-price-btn w-100">Choose Plan</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show active" id="nav-yearly" role="tabpanel"
                            aria-labelledby="nav-yearly-tab">
                            <div class="row">
                                <div class="col-xl-4 col-md-6">
                                    <div class="tp-pricing-item d-flex flex-column mb-30">
                                        <div class="tp-pricing-top p-relative black-bg">
                                            <div class="tp-pricing-icon">
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/price/shape.png" alt="cetalog-img">
                                            </div>
                                            <div class="tp-pricing-title-wrapper">
                                                <h3 class="tp-pricing__title">$50<span> / yearly</span></h3>
                                                <p>Perfect Plan for Starters.</p>
                                            </div>
                                        </div>
                                        <div class="tp-pricing-content">
                                            <div
                                                class="tp-pricing-content-inner d-flex flex-column justify-content-between">
                                                <div class="tp-pricing-feature tp-mb-1">
                                                    <p>Includes:</p>
                                                    <ul>
                                                        <li>Full Access Library</li>
                                                        <li>Business & Financ Analysing</li>
                                                        <li>Exclusive Templates</li>
                                                        <li>24 hour support</li>
                                                    </ul>
                                                </div>
                                                <div class="tp-pricing-btn">
                                                    <a href="https://wphix.com/wp/cetalog/contact/" class="tp-price-btn w-100">Choose Plan</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6">
                                    <div class="tp-pricing-item has-popular pricing-active d-flex flex-column mb-30">
                                        <div class="tp-pricing-popular">
                                            <p>MOST POPULAR</p>
                                        </div>
                                        <div class="tp-pricing-top p-relative black-bg">
                                            <div class="tp-pricing-icon">
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/price/shape.png" alt="cetalog-img">
                                            </div>
                                            <div class="tp-pricing-title-wrapper">
                                                <h3 class="tp-pricing__title">$299<span> / yearly</span></h3>
                                                <p>Collaborate Professionally.</p>
                                            </div>
                                        </div>
                                        <div class="tp-pricing-content">
                                            <div
                                                class="tp-pricing-content-inner d-flex flex-column justify-content-between">
                                                <div class="tp-pricing-feature tp-mb-2">
                                                    <p>Everything in Personal Plan, plus</p>
                                                    <ul>
                                                        <li>Full Access Library</li>
                                                        <li>Business & Finance Analysing</li>
                                                        <li>Exclusive Templates</li>
                                                        <li>24 hour support</li>
                                                        <li>Customer Management</li>
                                                    </ul>
                                                </div>
                                                <div class="tp-pricing-btn">
                                                    <a href="https://wphix.com/wp/cetalog/contact/" class="tp-price-btn w-100">Choose Plan</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6">
                                    <div class="tp-pricing-item d-flex flex-column mb-30">
                                        <div class="tp-pricing-top p-relative black-bg">
                                            <div class="tp-pricing-icon">
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/price/shape.png" alt="cetalog-img">
                                            </div>
                                            <div class="tp-pricing-title-wrapper">
                                                <h3 class="tp-pricing__title">$499<span> / yearly</span></h3>
                                                <p>True Power of Management</p>
                                            </div>
                                        </div>
                                        <div class="tp-pricing-content">
                                            <div
                                                class="tp-pricing-content-inner d-flex flex-column justify-content-between">
                                                <div class="tp-pricing-feature tp-mb-2">
                                                    <p>Everything in Team Plan, plus</p>
                                                    <ul>
                                                        <li>User provisioning (SCIM)</li>
                                                        <li>Databases with rich property types</li>
                                                        <li>Custom guest editors</li>
                                                        <li>24 hour support</li>
                                                        <li>Customer Management</li>
                                                    </ul>
                                                </div>
                                                <div class="tp-pricing-btn">
                                                    <a href="https://wphix.com/wp/cetalog/contact/" class="tp-price-btn w-100">Choose Plan</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- price area end -->

</main>

<?php 
get_footer();