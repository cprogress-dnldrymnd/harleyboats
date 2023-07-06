<?php
$DisplayData = new DisplayData;
$suggested_articles = get__theme_option('suggested_articles');
$categories = get_the_category(get_the_ID());
?>

<section class="product-slider lg-padding">
    <div class="container mb-7">
        <div class="row line-title line-title-v2 d-flex align-items-start fw-medium">
            <div class="col d-flex align-items-center pt-3">
                <span class="text text-uppercase">
                    RELATED POSTS
                </span>

                <span class="line"></span>
            </div>
        </div>
    </div>
    <div class="container extend-right">

        <div class="product-slider-box">
            <div class="swiper mySwiper-productSwiper mySwiper-productSwiper-medium ">
                <div class="swiper-wrapper product-holder post-box-PostSlider align-items-stretch">

                    <?php
                    $args = array(
                        'posts_per_page' => 10,

                        'post_type'      => array('post'),

                        'post_status'    => 'publish',

                        'category__and ' => $categories,
                        
                        'orderby' => 'rand'

                    );
                    $query = new WP_Query($args);
                    ?>
                    <?php if ($query->have_posts()) { ?>

                        <?php while ($query->have_posts()) { ?>
                            <?php
                            $query->the_post();
                            $post_id = get_the_ID();
                            ?>
                            <div class="swiper-slide product-box">
                                <div class="inner background-white d-block ">
                                    <a href="<?= get_permalink($post_id) ?>" class="box-link"></a>
                                    <?php
                                    $DisplayData->image(
                                        array(
                                            'image_id'    => get_post_thumbnail_id($post_id),
                                            'size'        => 'medium',
                                            'placeholder' => true
                                        ),
                                        'position-relative image-cover-transform'
                                    );
                                    ?>

                                    <?php
                                    $DisplayData->heading(
                                        array(
                                            'heading' => get_the_title($post_id),
                                            'tag'     => 'h4'
                                        )
                                    );
                                    ?>
                                    <div class="bottom-box">
                                        <div class="meta-box d-flex">
                                            <span class="date">
                                                <?= get_the_date('d/m/Y', $post_id) ?>
                                            </span>
                                            <div class="bull">&bull;</div>
                                            <span class="author">
                                                <?php
                                                $author_id = get_post_field('post_author', $post_id);
                                                $author_name = get_the_author_meta('display_name', $author_id);
                                                ?>
                                                <?= $author_name ?>
                                            </span>
                                        </div>

                                        <div class="link-box">
                                            <a href="<?= get_permalink($post_id) ?>" class="link-underline fw-medium">Read
                                                more</a>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        <?php } ?>
                    <?php } ?>
                </div>
                <div class="swiper-nav-holder d-none d-sm-inline-flex">

                    <div class="swiper-button-prev"></div>

                    <div class="swiper-button-next"></div>

                </div>
                <div class="swiper-pagination-holder d-flex d-sm-none">
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</section>