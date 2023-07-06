<?php

$DisplayData = new DisplayData;

$SVG = new SVG;

?>



<section class="product-slider blog-section xl-padding-bottom archive-section search-section">

    <div class="container">

        <div class="row g-4">
            <div class="col-lg-3 ">

                <div class="column-holder content-margin filter-holder background-white p-3 ">
                    <div class="heading-box">
                        <h3>FILTER</h3>
                    </div>

                    <div class="search">

                        <input type="text" placeholder="Search" id="search" class="w-100" name="s" value="<?= $_GET['s'] ?>">

                    </div>

                    <form class="archive-form-filter">


                        <input type="hidden" name="post-type" value="<?= $post_type ?>">

                        <input type="hidden" name="taxonomy" value="<?= $taxonomy ?>">

                        <input type="hidden" name="is_search" value="1">

                        <?php
                        $post_types = array(
                            'page'    => 'Page',
                            'post'     => 'Blogs',
                            'product' => 'Products',
                            'events'  => 'Events',
                            'webinars'  => 'Webinars',
                        );
                        ?>

                        <ul class="filter-style-1 list-inline content-margin-small">
                            <?php foreach ($post_types as $key => $post_type) { ?>
                                <li class="filter-item">

                                    <input class="d-none" type="checkbox" value="<?= $key ?>" id="term-<?= $key ?>" name="post_types[]">

                                    <label class="d-flex align-items-center background-white" for="term-<?= $key ?>">
                                        <span class="ms-3">
                                            <?= $post_type ?>
                                        </span>
                                    </label>
                                </li>
                            <?php } ?>
                        </ul>
                    </form>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="column-holder">
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

                            <?= $SVG->load_more ?>

                            <span class="text">Load more</span>

                        </a>

                    </div>
                </div>
            </div>
        </div>



    </div>

</section>



<script>

    jQuery(document).ready(function ($) {

        jQuery('.archive-form-filter').change();

    });

</script>