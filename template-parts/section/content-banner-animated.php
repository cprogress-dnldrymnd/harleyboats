<?php
$DisplayData = new DisplayData();
$Theme_Options = new Theme_Options();
$heading = get__post_meta('heading');
$description = get__post_meta('description');
$cta_button_text = get__post_meta('cta_button_text');
$cta_button_type = get__post_meta('cta_button_type');
$cta_button_action = get__post_meta('cta_button_action');
$cta_button_icon = get__post_meta('cta_button_icon');
$cta_button_attribute = get__post_meta('cta_button_attribute');
$cta_button_link = get__post_meta('cta_' . $cta_button_type);

$cta_2_button_text = get__post_meta('cta_2_button_text');
$cta_2_button_type = get__post_meta('cta_2_button_type');
$cta_2_button_action = get__post_meta('cta_2_button_action');
$cta_2_button_icon = get__post_meta('cta_2_button_icon');
$cta_2_button_attribute = get__post_meta('cta_2_button_attribute');
$cta_2_button_link = get__post_meta('cta_2_' . $cta_2_button_type);

$floating_image_1 = get__post_meta('floating_image_1');
$floating_image_2 = get__post_meta('floating_image_2');
$logo_image_1 = get__post_meta('logo_image_1');
$logo_image_2 = get__post_meta('logo_image_2');
$logo_image_3 = get__post_meta('logo_image_3');
$vide_background = get__post_meta('vide_background');
?>

<section class="hero-banner background-primary" id="hero-banner">
    <div class="header-content position-relative">
        <div
            class="container large-container text-center position-relative d-flex align-items-center justify-content-center">
            <div class="container-inner content-margin">
                <?php
                $DisplayData->heading(
                    array(
                        'heading' => $heading
                    ),
                    'big-heading'
                );
                $DisplayData->description(
                    array(
                        'description' => $description
                    ),
                    false
                );
                ?>
                <div class="button-group-box justify-content-center">
                    <?php
                    if ($cta_button_type) {
                        $DisplayData->button(
                            $cta_button_text,
                            $cta_button_link,
                            $cta_button_action,
                            $cta_button_icon,
                            'button-accent',
                            false,
                            $cta_button_attribute
                        );
                    }
                    if ($cta_2_button_type) {
                        $DisplayData->button(
                            $cta_2_button_text,
                            $cta_2_button_link,
                            $cta_2_button_action,
                            $cta_2_button_icon,
                            'button-secondary',
                            false,
                            $cta_2_button_attribute
                        );
                    }
                    ?>
                </div>

                <?php if ($logo_image_1 || $logo_image_2) { ?>
                    <div class="left-images d-inline-flex">
                        <?php
                        if ($logo_image_1) {
                            $DisplayData->image(
                                array(
                                    'image_id' => $logo_image_1,
                                    'size'     => 'medium'
                                )
                            );
                        }
                        if ($logo_image_2) {
                            $DisplayData->image(
                                array(
                                    'image_id' => $logo_image_2,
                                    'size'     => 'medium'
                                )
                            );
                        }
                        if ($logo_image_3) {
                            $DisplayData->image(
                                array(
                                    'image_id' => $logo_image_3,
                                    'size'     => 'medium'
                                )
                            );
                        }
                        ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php
    if ($floating_image_1) {
        $DisplayData->image(
            array(
                'image_id' => $floating_image_1,
                'size'     => 'medium'
            ),
            'animated-image animated-image-1'
        );
    }
    if ($floating_image_2) {
        $DisplayData->image(
            array(
                'image_id' => $floating_image_2,
                'size'     => 'medium'
            ),
            'animated-image animated-image-2'
        );
    }

    if ($vide_background) {
        $DisplayData->video(
            array(
                'video_id' => $vide_background,
            ),
            'background-primary'
        );
    }
    ?>
</section>