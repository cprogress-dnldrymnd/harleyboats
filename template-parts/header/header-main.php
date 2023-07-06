<?php
$Theme_Options = new Theme_Options();
$SVG = new SVG();
if (is_404()) {
    $header_type = 'background-transparent';
}
else {
    $header_type = get__post_meta('header_type');
}
if (is_active_sidebar('top_bar_left') || is_active_sidebar('top_bar_right')) {
    get_template_part('template-parts/header/header', 'top-bar');
}
?>

<div
    class="header-inner <?= (is_active_sidebar('top_bar_left') || is_active_sidebar('top_bar_right')) ? 'has-top-bar' : '' ?>">
    <div class="header-main <?= $header_type ?>">

        <div class="container large-container ">
            <div class="row align-items-center justify-content-between align-items-center gy-3 row-holder">
                <div class="col col-lg-auto col-logo">
                    <div class="column-holder">
                        <div class="site-logo-holder position-relative">
                            <a href="<?= get_site_url() ?>" class="site-logo">
                                <svg xmlns="http://www.w3.org/2000/svg" width="256" height="26.026"
                                    viewBox="0 0 256 26.026" class="svg-image replaced-svg">
                                    <g id="Group_170" data-name="Group 170" transform="translate(-99.825 -87.108)">
                                        <g id="Group_172" data-name="Group 172" transform="translate(99.825 87.108)">
                                            <path id="Path_97" data-name="Path 97"
                                                d="M137.86,105.141q0,.52-.037,1.3a8.62,8.62,0,0,1-.26,1.673,7.665,7.665,0,0,1-.706,1.784,5.4,5.4,0,0,1-1.376,1.617,7,7,0,0,1-2.25,1.171,10.9,10.9,0,0,1-3.365.446H107.819a10.9,10.9,0,0,1-3.365-.446,6.989,6.989,0,0,1-2.249-1.171,5.391,5.391,0,0,1-1.376-1.617,7.64,7.64,0,0,1-.706-1.784,8.577,8.577,0,0,1-.261-1.673q-.037-.78-.037-1.3V95.1q0-.484.037-1.265a8.577,8.577,0,0,1,.261-1.673,8,8,0,0,1,.706-1.8,5.334,5.334,0,0,1,1.376-1.635,6.989,6.989,0,0,1,2.249-1.171,10.9,10.9,0,0,1,3.365-.446h22.048a10.9,10.9,0,0,1,3.365.446,7,7,0,0,1,2.25,1.171,5.346,5.346,0,0,1,1.376,1.635,8.027,8.027,0,0,1,.706,1.8,8.621,8.621,0,0,1,.26,1.673q.037.78.037,1.265h-7.994a1.768,1.768,0,0,0-.316-1.134,2.109,2.109,0,0,0-.687-.577,2.606,2.606,0,0,0-1-.26H109.826a2.393,2.393,0,0,0-1,.259,1.677,1.677,0,0,0-1,1.705v10.012a1.923,1.923,0,0,0,.3,1.15,1.785,1.785,0,0,0,.707.593,2.38,2.38,0,0,0,1,.26h18.033a2.641,2.641,0,0,0,1-.256,2.016,2.016,0,0,0,.687-.584,1.789,1.789,0,0,0,.316-1.131Z"
                                                transform="translate(-99.825 -87.108)"></path>
                                            <path id="Path_98" data-name="Path 98"
                                                d="M273.549,87.108a10.9,10.9,0,0,1,3.365.446,7,7,0,0,1,2.25,1.171,5.35,5.35,0,0,1,1.376,1.635,8.013,8.013,0,0,1,.706,1.8,8.6,8.6,0,0,1,.261,1.673q.036.78.037,1.265v10.039q0,.52-.037,1.3a8.6,8.6,0,0,1-.261,1.673,7.651,7.651,0,0,1-.706,1.784,5.407,5.407,0,0,1-1.376,1.617,7,7,0,0,1-2.25,1.171,10.9,10.9,0,0,1-3.365.446H251.5a10.9,10.9,0,0,1-3.365-.446,6.989,6.989,0,0,1-2.249-1.171,5.4,5.4,0,0,1-1.376-1.617,7.639,7.639,0,0,1-.706-1.784,8.577,8.577,0,0,1-.261-1.673q-.037-.78-.037-1.3V95.1q0-.484.037-1.265a8.578,8.578,0,0,1,.261-1.673,8,8,0,0,1,.706-1.8,5.339,5.339,0,0,1,1.376-1.635,6.989,6.989,0,0,1,2.249-1.171,10.9,10.9,0,0,1,3.365-.446Zm-2.007,20a2.6,2.6,0,0,0,1-.26,2.038,2.038,0,0,0,.688-.593,1.843,1.843,0,0,0,.316-1.15V95.1a1.762,1.762,0,0,0-.316-1.131,2.125,2.125,0,0,0-.688-.575,2.618,2.618,0,0,0-1-.259H253.508a2.4,2.4,0,0,0-1,.259,1.677,1.677,0,0,0-1,1.705v10.012a1.923,1.923,0,0,0,.3,1.15,1.786,1.786,0,0,0,.706.593,2.383,2.383,0,0,0,1,.26Z"
                                                transform="translate(-201.754 -87.108)"></path>
                                            <path id="Path_99" data-name="Path 99"
                                                d="M417.23,87.108a10.9,10.9,0,0,1,3.365.446,7,7,0,0,1,2.25,1.171,5.35,5.35,0,0,1,1.376,1.635,8.011,8.011,0,0,1,.706,1.8,8.621,8.621,0,0,1,.261,1.673q.036.78.037,1.265t-.037,1.282a8.653,8.653,0,0,1-.261,1.692,7.993,7.993,0,0,1-.706,1.8,5.148,5.148,0,0,1-1.376,1.617,7.533,7.533,0,0,1-2.25,1.171,10.478,10.478,0,0,1-3.365.465H395.183v10h-7.994V87.108Zm-2.007,10a2.6,2.6,0,0,0,1-.26,2.022,2.022,0,0,0,.688-.595,1.847,1.847,0,0,0,.316-1.152,1.768,1.768,0,0,0-.316-1.134,2.11,2.11,0,0,0-.688-.577,2.6,2.6,0,0,0-1-.26H395.183v3.977Z"
                                                transform="translate(-303.683 -87.108)"></path>
                                            <path id="Path_100" data-name="Path 100"
                                                d="M568.906,87.108v6.024H553.886v20h-7.994v-20H530.871V87.108Z"
                                                transform="translate(-405.611 -87.108)"></path>
                                            <path id="Path_101" data-name="Path 101"
                                                d="M702.587,103.133l10,10h-10l-10-10H682.547v10h-7.994V87.108h30.041a10.9,10.9,0,0,1,3.365.446,7,7,0,0,1,2.25,1.171,5.342,5.342,0,0,1,1.376,1.635,8.024,8.024,0,0,1,.706,1.8,8.594,8.594,0,0,1,.26,1.673q.037.78.037,1.265t-.037,1.282a8.627,8.627,0,0,1-.26,1.692,8.006,8.006,0,0,1-.706,1.8,5.141,5.141,0,0,1-1.376,1.617,7.532,7.532,0,0,1-2.25,1.171,10.479,10.479,0,0,1-3.365.465Zm0-6.024a2.6,2.6,0,0,0,1-.26,2.021,2.021,0,0,0,.687-.595,1.847,1.847,0,0,0,.316-1.152,1.768,1.768,0,0,0-.316-1.134,2.108,2.108,0,0,0-.687-.577,2.6,2.6,0,0,0-1-.26h-20.04v3.977Z"
                                                transform="translate(-507.54 -87.108)"></path>
                                            <path id="Path_102" data-name="Path 102"
                                                d="M856.27,93.12l-28.034,13.991H856.27v6.023H818.235v-7.993l26.026-12.009H818.235V87.108H856.27Z"
                                                transform="translate(-609.469 -87.108)"></path>
                                        </g>
                                        <path id="Path_103" data-name="Path 103"
                                            d="M964.486,87.884l-.041-.007-1.13,2.823h-.34l-1.15-2.916-.041.007V90.7h-.367V87.108h.5l1.209,3.023h.041l1.223-3.023h.461V90.7h-.367Zm-3.589-.395h-1.056V90.7h-.374v-3.21H958.33v-.381H960.9Z"
                                            transform="translate(-609.028)"></path>
                                    </g>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-auto col-menu d-flex align-self-stretch align-items-center justify-content-end">
                    <div class="column-holder h-lg-100">
                        <div class="h-lg-100">
                            <?php
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'header-menu',
                                    'container'      => false,
                                    'menu_class'     => '',
                                    'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
                                    'items_wrap'     => '<ul id="%1$s" class="navbar-nav align-items-center h-100 %2$s">%3$s</ul>',
                                    'depth'          => 3,
                                    'walker'         => new bootstrap_5_wp_nav_menu_walker()
                                )
                            );
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-auto col-right">
                    <div class="column-holder d-inline-flex align-items-center">
                        <?php //dynamic_sidebar('header_right') ?>
                        <div class="header-icons">
                            <ul class="list-unstyled m-0 p-0 d-flex align-items-center">
                                <?php if (!is_search()) { ?>
                                    <li>
                                        <a href="#modalSearch" data-bs-toggle="modal" data-bs-target="#modalSearch">
                                            <?= $SVG->search ?>
                                        </a>
                                    </li>
                                <?php } ?>
                                <li>
                                    <a href="<?= wc_get_page_permalink('myaccount') ?>">
                                        <?= $SVG->user ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" data-bs-toggle="offcanvas" data-bs-target="#offCanvasSideCart"
                                        aria-controls="offCanvasSideCart">
                                        <?= $SVG->cart ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="button-group-box">
                            <div class="button-box button-link button-small d-none d-lg-block">
                                <button class="px-0"
                                    onclick="window.dispatchEvent(new CustomEvent('heyflow-modal-element:open', { detail: { modalId: '9npbleZmTQmuV3CmsLi8q' }}))">Contact
                                    us</button>

                            </div>
                            <div class="button-box button-link button-small d-none d-lg-block">
                                <?= do_shortcode('[login_link]') ?>
                            </div>
                            <div class="button-box button-accent button-small d-none d-lg-block">
                                <button
                                    onclick="window.dispatchEvent(new CustomEvent('heyflow-modal-element:open', { detail: { modalId: 'uXa4D8wfqygIKfamkEoOY' }}))">
                                    ENQUIRE NOW
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>