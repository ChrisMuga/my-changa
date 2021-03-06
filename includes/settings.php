<?php
add_action( 'admin_init', 'mc_settings_init' );
function mc_settings_init() {
    // register a new setting for "mc" page
    register_setting( 'mc', 'mc_options' );
    
    // register a new section in the "mc" page
    add_settings_section(
        'mc_section_general',
        __( 'Configure My Changa here.', 'mc' ),
        'mc_section_general_cb',
        'mc'
    );
    
    // register a new section in the "mc" page
    add_settings_section(
        'mc_section_mpesa',
        __( 'Configure MPesa here.', 'mc' ),
        'mc_section_mc_mpesa_cb',
        'mc'
    );
    
    // register a new field in the "mc_section_general" section, inside the "mc" page
    add_settings_field(
        'mc_env_conf',
        __( 'Environment', 'mc' ),
        'mc_fields_env_cb',
        'mc',
        'mc_section_general',
        [
        'label_for' => 'mc_env_conf',
        'class' => 'mc_row',
        'mc_custom_data' => 'custom',
        ]
    );
    
    // register a new field in the "mc_section_mpesa" section, inside the "mc" page
    add_settings_field(
        'mc_mpesa_conf_type',
        __( 'Identifier Type', 'mc' ),
        'mc_fields_mc_mpesa_cb',
        'mc',
        'mc_section_mpesa',
        [
        'label_for' => 'mc_mpesa_conf_type',
        'class' => 'mc_row',
        'mc_custom_data' => 'custom',
        ]
    );
    
    // register a new field in the "mc_section_mpesa" section, inside the "mc" page
    add_settings_field(
        'mc_mpesa_conf_conkey',
        __( 'App Consumer Key', 'mc' ),
        'mc_fields_mc_mpesa_ck_cb',
        'mc',
        'mc_section_mpesa',
        [
        'label_for' => 'mc_mpesa_conkey',
        'class' => 'mc_row',
        'mc_custom_data' => 'custom',
        ]
    );
    
    // register a new field in the "mc_section_mpesa" section, inside the "mc" page
    add_settings_field(
        'mc_mpesa_conf_consec',
        __( 'App Consumer Secret', 'mc' ),
        'mc_fields_mc_mpesa_cs_cb',
        'mc',
        'mc_section_mpesa',
        [
        'label_for' => 'mc_mpesa_consec',
        'class' => 'mc_row',
        'mc_custom_data' => 'custom',
        ]
    );
    
    // register a new field in the "mc_section_mpesa" section, inside the "mc" page
    add_settings_field(
        'mc_mpesa_conf_shortcode',
        __( 'Mpesa Shortcode', 'mc' ),
        'mc_fields_mc_mpesa_shortcode_cb',
        'mc',
        'mc_section_mpesa',
        [
        'label_for' => 'mc_mpesa_conf_shortcode',
        'class' => 'mc_row',
        'mc_custom_data' => 'custom',
        ]
    );
    
    // register a new field in the "mc_section_mpesa" section, inside the "mc" page
    add_settings_field(
        'mc_mpesa_conf_passkey',
        __( 'Online Passkey', 'mc' ),
        'mc_fields_mc_mpesa_pk_cb',
        'mc',
        'mc_section_mpesa',
        [
        'label_for' => 'mc_mpesa_conf_passkey',
        'class' => 'mc_row',
        'mc_custom_data' => 'custom',
        ]
    );
    
    // register a new field in the "mc_section_mpesa" section, inside the "mc" page
    add_settings_field(
        'mc_mpesa_conf_cred',
        __( 'Security Credentials', 'mc' ),
        'mc_fields_mc_mpesa_sc_cb',
        'mc',
        'mc_section_mpesa',
        [
        'label_for' => 'mc_mpesa_conf_cred',
        'class' => 'mc_row',
        'mc_custom_data' => 'custom',
        ]
    );
    
    // register a new field in the "mc_section_mpesa" section, inside the "mc" page
    add_settings_field(
        'mc_mpesa_conf_msg',
        __( 'Message', 'mc' ),
        'mc_fields_mc_mpesa_msg_cb',
        'mc',
        'mc_section_mpesa',
        [
        'label_for' => 'mc_mpesa_conf_msg',
        'class' => 'mc_row',
        'mc_custom_data' => 'custom',
        ]
    );
}
 
function mc_section_general_cb( $args ) {
    ?>
    <p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'General plugin settings.', 'mc' ); ?></p>
    <?php
}
function mc_section_mc_mpesa_cb( $args ) {
    $options = get_option( 'mc_options' );
    ?>
    <p id="<?php echo esc_attr( $args['id'] ); ?>">
        <h4 style="color: red;">IMPORTANT!</h4><li>Please <a href="https://developer.safaricom.co.ke/" target="_blank" >create an app on Daraja</a> if you haven't. Fill in the app's consumer key and secret below.</li><li>For security purposes, and for the MPesa Instant Payment Notification to work, ensure your site is running over https(SSL).</li>
        <li>You can <a href="https://developer.safaricom.co.ke/test_credentials" target="_blank" >generate sandbox test credentials here</a>.</li>
        <li>Click here to <a href="<?php echo home_url( '/?mpesa_ipn_register='.esc_attr( $options['mc_env_conf'] ) ); ?>" target="_blank">register confirmation & validation URLs for <?php echo esc_attr( $options['mc_env_conf'] ); ?> </a></li>
    </p>
    <?php
}

function mc_fields_env_cb( $args ) {
    $options = get_option( 'mc_options' );
    ?>
    <select id="<?php echo esc_attr( $args['label_for'] ); ?>"
    data-custom="<?php echo esc_attr( $args['mc_custom_data'] ); ?>"
    name="mc_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
    >
        <option value="live" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'red', false ) ) : ( '' ); ?>>
        <?php esc_html_e( 'Live', 'mc' ); ?>
        </option>
        <option value="sandbox" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'blue', false ) ) : ( '' ); ?>>
        <?php esc_html_e( 'Sandbox', 'mc' ); ?>
        </option>
    </select>
    <p class="description">
    <?php esc_html_e( 'Environment', 'mc' ); ?>
    </p>
    <?php
}

function mc_fields_mc_mpesa_shortcode_cb( $args ) {
    $options = get_option( 'mc_options' );
    ?>
    <input type="text" id="<?php echo esc_attr( $args['label_for'] ); ?>"
    data-custom="<?php echo esc_attr( $args['mc_custom_data'] ); ?>"
    name="mc_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
    value="<?php echo esc_attr( $options[ $args['label_for'] ] ); ?>"
    >
    <p class="description">
    <?php esc_html_e( 'Paybill/Till or phone number', 'mc' ); ?>
    </p>
    <?php
}

function mc_fields_mc_mpesa_cb( $args ) {
    $options = get_option( 'mc_options' );
    ?>
    <select id="<?php echo esc_attr( $args['label_for'] ); ?>"
    data-custom="<?php echo esc_attr( $args['mc_custom_data'] ); ?>"
    name="mc_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
    >
    <option value="1" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'red', false ) ) : ( '' ); ?>>
    <?php esc_html_e( 'Shortcode', 'mc' ); ?>
    </option>
    <option value="3" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'blue', false ) ) : ( '' ); ?>>
    <?php esc_html_e( 'Till Number', 'mc' ); ?>
    </option>
    <option value="4" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'blue', false ) ) : ( '' ); ?>>
    <?php esc_html_e( 'MSISDN', 'mc' ); ?>
    </option>
    </select>
    <p class="description">
    <?php esc_html_e( 'Business identifier type', 'mc' ); ?>
    </p>
    <?php
}

function mc_fields_mc_mpesa_ck_cb( $args ) {
    $options = get_option( 'mc_options' );
    ?>
    <input type="text" id="<?php echo esc_attr( $args['label_for'] ); ?>"
    data-custom="<?php echo esc_attr( $args['mc_custom_data'] ); ?>"
    name="mc_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
    value="<?php echo esc_attr( $options[ $args['label_for'] ] ); ?>"
    >
    <p class="description">
    <?php esc_html_e( 'Daraja application consumer key.', 'mc' ); ?>
    </p>
    <?php
}

function mc_fields_mc_mpesa_cs_cb( $args ) {
    $options = get_option( 'mc_options' );
    ?>
    <input type="text" id="<?php echo esc_attr( $args['label_for'] ); ?>"
    data-custom="<?php echo esc_attr( $args['mc_custom_data'] ); ?>"
    name="mc_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
    value="<?php echo esc_attr( $options[ $args['label_for'] ] ); ?>"
    >
    <p class="description">
    <?php esc_html_e( 'Daraja application consumer secret', 'mc' ); ?>
    </p>
    <?php
}

function mc_fields_mc_mpesa_pk_cb( $args ) {
    $options = get_option( 'mc_options' );
    ?>
    <textarea id="<?php echo esc_attr( $args['label_for'] ); ?>" name='mc_options[<?php echo esc_attr( $args['label_for'] ); ?>]' rows='7' cols='50' type='textarea'><?php echo esc_attr( $options[ $args['label_for'] ] ); ?></textarea>
    <p class="description">
    <?php esc_html_e( 'Online Pass Key', 'mc' ); ?>
    </p>
    <?php
}

function mc_fields_mc_mpesa_sc_cb( $args ) {
    $options = get_option( 'mc_options' );
    ?>
    <textarea id="<?php echo esc_attr( $args['label_for'] ); ?>" name='mc_options[<?php echo esc_attr( $args['label_for'] ); ?>]' rows='7' cols='50' type='textarea'><?php echo esc_attr( $options[ $args['label_for'] ] ); ?></textarea>
    <p class="description">
    <?php esc_html_e( 'Security Credentials', 'mc' ); ?>
    </p>
    <?php
}

function mc_fields_mc_mpesa_msg_cb( $args ) {
    $options = get_option( 'mc_options' );
    ?>
    <textarea id="<?php echo esc_attr( $args['label_for'] ); ?>" name='mc_options[<?php echo esc_attr( $args['label_for'] ); ?>]' rows='7' cols='50' type='textarea'><?php echo esc_attr( $options[ $args['label_for'] ] ); ?></textarea>
    <p class="description">
    <?php esc_html_e( 'After Contribution Message', 'mc' ); ?>
    </p>
    <?php
}
 
/**
 * top level menu:
 * callback functions
 */
function mc_options_page_html() {
    // check user capabilities
    if ( ! current_user_can( 'manage_options' ) ) {
    return;
    }
    
    // add error/update messages
    
    // check if the user have submitted the settings
    // wordpress will add the "settings-updated" $_GET parameter to the url
    if ( isset( $_GET['settings-updated'] ) ) {
    // add settings saved message with the class of "updated"
    add_settings_error( 'mc_messages', 'mc_message', __( 'Settings Saved', 'mc' ), 'updated' );
    }
    
    // show error/update messages
    settings_errors( 'mc_messages' );
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="options.php" method="post">
            <?php
            // output security fields for the registered setting "mc"
            settings_fields( 'mc' );
            // output setting sections and their fields
            // (sections are registered for "mc", each field is registered to a specific section)
            do_settings_sections( 'mc' );
            // output save settings button
            submit_button( 'Save Settings' );
            ?>
        </form>
    </div>
    <?php
}
