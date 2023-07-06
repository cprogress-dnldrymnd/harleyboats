<?php
$Theme_Options = new Theme_Options;
$DisplayData  = new DisplayData ;
if ($Theme_Options->copyright_text) {
?>
    <section class="footer-bottom background-secondary light-color text-center xs-padding">
        <div class="container">
            <?php
            $DisplayData->description(array(
                'description' => $Theme_Options->copyright_text
            ), 'extra-small-text');
            ?>
        </div>
    </section>
<?php } ?>