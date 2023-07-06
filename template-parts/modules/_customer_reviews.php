<?php
$DisplayData = new DisplayData;
$Helpers = new Helpers;
$GetData = new GetData;
$SVG = new SVG;
$testimonials = $GetData->get_posts_ids('testimonials');
?>
<div class="container">
    <div class="row g-4 white-color mb-7 justify-content-between">
        <div class="col-auto ">
            <span class="text-style-1  left fw-medium">
                COPTRZ CUSTOMER REVIEWS
            </span>
        </div>
        <div class="col-auto">
            <div class="heading-box mb-6">
                <h2>
                    Trusted by over 2,000 clients
                </h2>

            </div>
            <div class="review-score d-flex align-items-center">
                <div class="score">
                    4.8
                </div>
                <div class="stars-holder">
                    <div class="stars d-flex">
                        <?= $SVG->star ?>
                        <?= $SVG->star ?>
                        <?= $SVG->star ?>
                        <?= $SVG->star ?>
                        <?= $SVG->star_half ?>
                    </div>
                    <div class="star-text">
                        <span>Score on <a targe="_blank" style="color: #fff" href="https://www.google.com/search?q=coptrz+google+review&rlz=1C1VDKB_enPH1019PH1019&oq=coptrz+google+review&aqs=chrome..69i57j69i64l2.3639j0j7&sourceid=chrome&ie=UTF-8">Google</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="review-holder">
    <div class="swiper mySwiper-Reviews">
        <div class="swiper-wrapper align-items-center">
            <?php foreach ($testimonials as $key => $testimonial) { ?>
                <div class="swiper-slide">
                    <div class="review-box background-secondary d-flex">
                        <div class="quote">
                            <?= $SVG->quote ?>
                        </div>
                        <div class="review-content">
                            <?php
                            $DisplayData->description(
                                array(
                                    'description' => get__post_meta_by_id($key, 'testimonial_content'),
                                ),
                                'review-text'
                            );
                            ?>
                            <div class="author d-flex align-items-center">
                                <span>
                                    <?= $testimonial ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>

        </div>
    </div>
</div>