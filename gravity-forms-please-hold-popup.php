<?php
/**
 * Plugin Name: Gravity Forms Popup
 * Description: Shows popup with custom styles when submitting Gravity Form .
 * Version: 1.0
 * Author: Rohit Kumar
 * Author URI: https://iamrohit.net/
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Enqueue the necessary scripts and styles.
// Enqueue the necessary scripts and styles.
function gf_please_hold_popup_enqueue_scripts() {
    // Inline CSS with the correct path to the background image using plugins_url()
    $custom_css = '
        #progress1 {
            display: none;
            background-color: #000;
            opacity: 0.7;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            z-index: 9999;
        }
        #progress1_an {
            display: none;
            position: fixed;
            margin-top: -70px;
            margin-left: -120px;
            top: 50%;
            left: 50%;
            width: 200px;
            height: 100px;
            padding: 20px;
            border-radius: 16px;
            z-index: 10000;
            text-align: center;
            background: url(\'' . plugins_url('/popup_bk.jpg', __FILE__) . '\') repeat right top;
            color: #000;
        }
        #progress_image {
            display: block;
            margin: 0 auto;
        }
    ';
    wp_register_style('gf-please-hold-popup-css', false);
    wp_enqueue_style('gf-please-hold-popup-css');
    wp_add_inline_style('gf-please-hold-popup-css', $custom_css);

    // Enqueue jQuery if it's not included
    wp_enqueue_script('jquery');
}

add_action('wp_enqueue_scripts', 'gf_please_hold_popup_enqueue_scripts');

// Print the popup markup in the footer.
function gf_please_hold_popup_markup() {
    ?>
    <div id="progress1"></div>
    <p id="progress1_an" class="button">
        <img id="progress_image" src="<?php echo esc_url(plugins_url('/ajax-loader.gif', __FILE__)); ?>" alt=""/><br />
        Please hold...
    </p>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('input#gform_submit_button_1').click(function(){
                $('#progress1').show();
                $('#progress1_an').show();
            });
			$('input#gform_submit_button_2').click(function(){
            $('#progress1').show();
            $('#progress1_an').show();
        });
        });
    </script>
    <?php
}

add_action('wp_footer', 'gf_please_hold_popup_markup');