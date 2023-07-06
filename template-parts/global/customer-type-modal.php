<!-- Modal -->
<?php
if (is_user_logged_in()) {
  $customer_type = carbon_get_user_meta(get_current_user_id(), 'customer_type');
}
else {
  $customer_type = $_SESSION['customer_type'];
}
if (is_user_logged_in()) {
  if (!$customer_type) {
    ?>
    <div class="modal fade modal-v2" id="customerType" tabindex="-1" aria-labelledby="customerTypeLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content background-white">
          <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="/" method="GET">
            <div class="modal-body p-4">
              <div class="heading-box text-center">
                <h4>Are you part of a business or a consumer?</h4>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row w-100">
                <div class="col-6">
                  <div class="button-box button-secondary button-small">
                    <a href="?customer_type=business" class="w-100"> Business </a>
                  </div>
                </div>
                <div class="col-6">
                  <div class="button-box button-accent button-small">
                    <a href="?customer_type=consumer" class="w-100"> Consumer </a>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php
  }
}
?>