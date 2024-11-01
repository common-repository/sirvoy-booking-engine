<?php
/*
Plugin Name: Sirvoy Booking Engine
Version: 4.0
Plugin URI: https://sirvoy.com/topic/booking-engine/installing-on-your-website/installing-the-booking-engine-on-wordpress/
Author: Sirvoy Ltd
Author URI: https://sirvoy.com
Description: With this plugin you can easily add your Sirvoy booking engine to your Wordpress website and accept online bookings. The bookings will be registered in your Sirvoy account. Sirvoy is an online booking system for hotels, B&Bs, guest houses, inns and other accommodations.

Copyright (c) 2011-2022, Sirvoy Ltd
Released under the GPL license
All rights reserved.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT
NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL
THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION)
HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

*/

// filters
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'sirvoy_booking_engine_admin_links' );

// shortcodes
add_shortcode("sirvoy", "sirvoy_booking_engine");

// admin page for Sirvoy Booking Engine
if (is_admin()) {
    add_action('admin_menu', 'sirvoy_booking_engine_menu');
}

/**
 * Adds a link in the admin menu
 */
function sirvoy_booking_engine_menu() {
    add_options_page(
        'Sirvoy Booking Engine',
        'Sirvoy Booking Engine',
        'administrator',
        'sirvoy-booking-engine-admin',
        'sirvoy_booking_engine_admin'
    );
}

/**
 * Add links for the plugin
 *
 * @param $links
 * @return array
 */
function sirvoy_booking_engine_admin_links($links) {
    $links[] = '<a href="'. esc_url( get_admin_url(null, 'options-general.php?page=sirvoy-booking-engine-admin') ) .'">Settings</a>';
    return $links;
}

/**
 * Sirvoy Booking Engine shortcode
 *
 * @param $atts
 * @return string
 */
function sirvoy_booking_engine($atts) {
    // base url
    $str = '<script async src="https://secured.sirvoy.com/widget/sirvoy.js"';
    // add a data parameter with the version, use a special version if deprecated options are in use
    $atts['wp-plugin-version'] = '4.0';

    // set all attributes
    foreach ($atts as $key => $value) {
        $str .= ' data-' . $key . '="' . urlencode($value) . '"';
    }

    $str .= '></script>';
    return $str;
}

/**
 * The admin page for Sirvoy Booking Widget
 */
function sirvoy_booking_engine_admin() {
    ?>
    <style>
        .wrap {
            font-family: 'Varela Round', sans-serif, Arial
        }
        .alert-text {
            background: #fff3cd;
            border: 1px solid #ffeeba;
            border-radius: 4px;
            color: #856404;
            font-size: 14px;
            margin-bottom: 10px;
            padding: 12px 16px;
        }
        a:link {
            color: #c14514;
            text-decoration: underline;
        }
        a:visited {
            color: #c14514;
            text-decoration: underline;
        }
    </style>
    <div class="wrap">
        <h2>Sirvoy Booking Engine</h2>

        <div class="how-to-wrapper">
            <h3>How to use this plugin</h3>
            <ol>
                <li>Log into your Sirvoy account at <a href="https://secured.sirvoy.com" target="_blank">https://secured.sirvoy.com</a></li>
                <li>Go to <span style="font-weight: bold; font-style: italic;">Settings -> Booking engine -> Manage booking engines –> How to install</span></li>
                <li>Select <span style="font-style: italic;">Using our WordPress plugin (install shortcode)</span></li>
                <li>Install the generated shortcode on the pages where you want to display the booking engine.</li>
            </ol>

            <!--
            <p>
                For more information about how to use this plugin, please read this
                <a href="https://sirvoy.com/blog/topic/booking-engine/installing-on-your-website/installing-the-booking-engine-on-wordpress/" target="_blank">
                    support article.
                </a>
            </p>
            -->
        </div>
    </div>
    <?php
}
