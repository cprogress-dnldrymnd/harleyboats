<?php
/*-----------------------------------------------------------------------------------*/
/* This template will be called by all other template files to finish 
/* rendering the page and display the footer area/content
/*-----------------------------------------------------------------------------------*/
?>

<footer class="py-2">
  <div class="container">
    <div class="row g-5">
      <div class="col-sm-4 footer-column-1">
        <?php if (is_active_sidebar('footer_column_1')) { ?>

          <div class="column-holder  ">
            <?php dynamic_sidebar('footer_column_1') ?>
          </div>
        </div>
      <?php } ?>
      <?php if (is_active_sidebar('footer_column_2')) { ?>

        <div class="col-sm-4 footer-column-2">
          <div class="column-holder">
            <?php dynamic_sidebar('footer_column_2') ?>
          </div>
        </div>
      <?php } ?>

      <?php if (is_active_sidebar('footer_column_3')) { ?>
        <div class="col-sm-4 footer-column-3">
          <div class="column-holder">
            <?php dynamic_sidebar('footer_column_3') ?>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>

<?php do_action('wp_footer_scripts') ?>