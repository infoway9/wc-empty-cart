 <?php
 add_filter('woocommerce_general_settings', 'add_empty_cart_button_setting');

    function add_empty_cart_button_setting($settings) {
        $updated_settings = array();

        foreach ($settings as $section) {

            // at the bottom of the General Options section
            if (isset($section['id']) && 'general_options' == $section['id'] &&
                    isset($section['type']) && 'sectionend' == $section['type']) {

                $updated_settings[] = array(
                    'name' => __('Allow Empty Cart', 'wc_empty_cart'),
                    'desc_tip' => __('This allows your cart to be empty.', 'wc_empty_cart'),
                    'id' => 'woocommerce_empty_cart',
                    'type' => 'checkbox',
                    'css' => 'min-width:300px;',
                    'std' => '1', // WC < 2.0
                    'default' => '1', // WC >= 2.0
                );
                $updated_settings[] = array(
                    'name' => __('Button text for empty cart', 'wc_empty_cart'),
                    //'desc_tip' => __('This allows you to change the button text.', 'wc_empty_cart'),
                    'id' => 'woocommerce_empty_cart_button_text',
                    'type' => 'text',
                    'css' => 'min-width:300px;',
                    'desc'     => __( 'Any text you want can be shown to your button with this option!', 'text-domain' ),
                    'default' => 'Make your cart empty', // WC >= 2.0
                );
            }



            $updated_settings[] = $section;
        }

        return $updated_settings;
    }