<?php
global $product_id_global;
$DisplayData = new DisplayData;
$product_modal_description = get__post_meta_by_id($product_id, 'product_modal_description');
$product_id_global = $product_id;
$wrapper_class_1 = '';
$wrapper_class_2 = '';
$wrapper_class_3 = '';
if ($images) {
    $wrapper_class_1 = 'swiper mySwiperMain';
    $wrapper_class_2 = 'swiper-wrapper';
    $wrapper_class_3 = 'swiper-slide';
}
else {
    $wrapper_class_1 = '';
    $wrapper_class_2 = '';
    $wrapper_class_3 = '';
}
?>



<section class="product-summary <?= is_single() ? 'sm-padding' : '' ?>" id="product-summary">

    <div class="container">

        <?php wc_print_notices(); ?>

        <div class="row gy-4">

            <div class="col-lg-5">

                <div class="column-holder">

                    <div class="product-gallery">

                        <div style="--swiper-navigation-color: #000; --swiper-pagination-color: #000"
                            class="<?= $wrapper_class_1 ?> mb-4 background-light">

                            <div class="<?= $wrapper_class_2 ?>">

                                <div class="<?= $wrapper_class_3 ?>">

                                    <div class="image-box">

                                        <img src="<?= wp_get_attachment_image_url($main_image, 'large') ?>" />

                                    </div>

                                </div>
                                <?php if ($images) { ?>
                                    <?php foreach ($images as $image) { ?>

                                        <div class="swiper-slide">

                                            <div class="image-box">

                                                <img src="<?= wp_get_attachment_image_url($image, 'large') ?>" />

                                            </div>

                                        </div>



                                    <?php } ?>
                                <?php } ?>



                            </div>
                            <?php if ($images) { ?>
                                <div class="swiper-button-next d-none d-sm-flex"></div>

                                <div class="swiper-button-prev d-none d-sm-flex"></div>

                            <?php } ?>

                        </div>
                        <?php if ($images) { ?>
                            <div thumbsSlider="" class="swiper mySwiperThumb">

                                <div class="swiper-wrapper">

                                    <div class="swiper-slide">

                                        <div class="image-box">

                                            <img src="<?= wp_get_attachment_image_url($main_image, 'thumbnail') ?>" />

                                        </div>

                                    </div>



                                    <?php foreach ($images as $image) { ?>

                                        <div class="swiper-slide">

                                            <div class="image-box">

                                                <img src="<?= wp_get_attachment_image_url($image, 'thumbnail') ?>" />

                                            </div>

                                        </div>



                                    <?php } ?>

                                </div>


                                <div class="swiper-pagination-holder d-flex d-sm-none">
                                    <div class="swiper-pagination"></div>
                                </div>

                            </div>

                        <?php } ?>

                    </div>

                </div>

            </div>

            <div class="col-lg-7">

                <div class="column-holder content-margin">

                    <?php if (is_archive()) { ?>

                        <div class="heading-box">

                            <h3>

                                Product Details

                            </h3>

                        </div>

                    <?php }
                    else { ?>

                        <div class="heading-box">

                            <h2>

                                <?= get_the_title() ?>

                            </h2>

                        </div>

                    <?php } ?>

                    <?php if (is_product()) { ?>

                        <?php
                        echo $GetData->add_to_cart($product_id);
                        ?>

                    <?php } ?>

                    <div class="description-box content-margin">

                        <?php

                        if ($type == 'modal') {

                            $description = $product_modal_description ? $product_modal_description : $product->get_short_description();
                        }
                        else {
                            if (is_product()) {
                                $description = $product->get_short_description();
                            }
                            else {
                                $description = $product_modal_description . $product->get_short_description();
                            }
                        }
                        ?>

                        <?= wpautop($description) ?>

                    </div>


                    <?php if (is_product()) { ?>
                        <?php
                        echo $GetData->need_help($product_id);
                        ?>
                    <?php } ?>
                </div>

            </div>

        </div>





    </div>

</section>