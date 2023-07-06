<?php
$DisplayData = new DisplayData;

$heading = get__post_meta('heading');
$revealing_bg_1 = get__post_meta('revealing_bg_1');
$revealing_bg_2 = get__post_meta('revealing_bg_2');

$title = $heading ? $heading : get_the_title();

?>

<section class="breadcrumbs-title hero-revealing xxs-padding md-padding">
    <div class="container position-relative">
        <div class="breadcrumbs-holder">
            <ul class="breadcrumbs list-unstyled d-flex ">
                <li>
                    <a href="<?= get_site_url() ?>"> Home </a>
                </li>

                <?php if (is_single()) { ?>
                    <li>
                        <a href="<?= get_permalink(get_option('page_for_postts')) ?>"> Blog </a>
                    </li>
                <?php } ?>
                <li>
                    <span><?= $title ?></span>
                </li>
            </ul>
        </div>
    </div>

    <?php
    $DisplayData->heading(
        array(
            'heading' => $title
        ),
        'big-heading'
    );
    $DisplayData->image(
        array(
            'image_id' => $revealing_bg_1,
        ), 'hero-bg background-image-1'
    );
    $DisplayData->image(
        array(
            'image_id' => $revealing_bg_2,
        ),
        'hero-bg background-image-2'
    );
    ?>

</section>

<div class="background-body position-relative content-wrapper">