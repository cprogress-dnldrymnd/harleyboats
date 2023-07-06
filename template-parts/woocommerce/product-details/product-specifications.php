<?php
$DisplayData = new DisplayData;
$specifications = get__post_meta_by_id($product_id, 'specifications');
?>
<?php if ($specifications) { ?>

    <section class="icon-section lg-padding">

        <div class="container">

            <div class="row gx-6 gy-6">

                <?php foreach ($specifications as $specs) { ?>

                    <div class="col-lg-3">

                        <div class="column-holder">

                            <div class="icon-box-holder">

                                <?php
                              
                                if ($specs['icon']) {

                                    $DisplayData->image(
                                        array(
                                            'image_id' => $specs['icon'],
                                            'size'     => 'medium'
                                        ),
                                    );
                                }



                                if ($specs['heading']) {
                                    $DisplayData->heading(

                                        array(

                                            'heading' => $specs['heading'],
                                            'tag'     => 'h4'

                                        ),
                                    );
                                }

                                if ($specs['description']) {
                                    $DisplayData->description(
                                        array(

                                            'description' => $specs['description'],
                                        ),
                                        'medium-text'
                                    );
                                }
                                ?>


                            </div>

                        </div>

                    </div>
                <?php } ?>


            </div>

        </div>

    </section>
<?php } ?>