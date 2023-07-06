<?php

$DisplayData = new DisplayData;

$SVG = new SVG;
$taxonomy = 'category';
if (is_home()) {

    $post_type = 'post';

}
else {

    $term = get_queried_object();
}
?>



<section class="product-slider blog-section xl-padding-bottom archive-section">

    <div class="container mb-7 extend-right">

        <div class="row line-title line-title-v2 d-flex align-items-start fw-medium">

            <div class="col d-flex align-items-center pt-3">

                <span class="text text-uppercase">

                    CATEGORIES

                </span>

                <span class="line"></span>

                <div class="search">

                    <div class="d-flex align-items-center ">

                        <label for="search">Search</label>

                        <input type="text" id="search" name="s">

                    </div>

                </div>

            </div>

        </div>

        <form class="archive-form-filter">



            <input type="hidden" name="post-type" value="<?= $post_type ?>">

            <input type="hidden" name="taxonomy" value="<?= $taxonomy ?>">

            <input type="hidden" name="is_search" value="0">


            <?php if (is_home()) { ?>

                <div class="category-slider-box md-padding-top sm-padding-bottom">

                    <?php

                    $terms = get_terms(

                        array(

                            'taxonomy'   => 'category',

                            'hide_empty' => false,

                        )

                    );

                    ?>

                    <div class="swiper mySwiper-vendorCategory mySwiper-Category">

                        <div class="swiper-wrapper text-center align-items-center">

                            <?php foreach ($terms as $term) { ?>

                                <?php

                                $image = get__term_meta($term->term_id, 'image');

                                ?>

                                <div class="swiper-slide">

                                    <input type="checkbox" value="<?= $term->term_id ?>" id="term-<?= $term->term_id ?>"

                                        name="terms[]">

                                    <label class="inner background-white d-block" for="term-<?= $term->term_id ?>">

                                        <div class="vendor-title">

                                            <h4 class="mb-0">

                                                <?= $term->name ?>

                                            </h4>

                                        </div>

                                    </label>

                                </div>

                            <?php } ?>

                        </div>

                        <div class="swiper-nav-holder d-inline-flex">

                            <div class="swiper-button-prev"></div>

                            <div class="swiper-button-next"></div>

                        </div>

                    </div>

                </div>

            <?php }

            else { ?>

                <input type="hidden" value="<?= $term->term_id ?>" name="terms-category">

            <?php } ?>

        </form>

    </div>







    <div class="container">

        <div class="product-slider-box">

            <div class="mySwiper-productSwiperPost">

                <div id="results">

                    <div class="results-holder">



                    </div>

                </div>

            </div>

        </div>





        <div class="load-more load-more-box text-center xl-padding-top">

            <a href="#"

                class="load-more d-inline-flex flex-column link-underline fw-medium justify-content-center align-items-center"

                id="load-more">

                <?= $SVG->load_more  ?>

                <span class="text">Load more</span>

            </a>

        </div>



    </div>

</section>



<script>

    jQuery(document).ready(function ($) {

        jQuery('.archive-form-filter').change();

    });

</script>