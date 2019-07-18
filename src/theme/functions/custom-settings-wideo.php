<?php 
/******************************************************************************
 * custom-setting-wideo.php
 * 
 * Table of contents:
 * 
 * 1. DEFINITIONS
 * 2. HOOKS
 * 3. RENDER FUNCTIONS
 * 4. SANITIZE FUNCTIONS
 * 5. CUSTOM SCRIPTS
 * 6. OTHER FUNCTIONS
 *****************************************************************************/
/******************************************************************************
 * 1. DEFINITIONS
 *****************************************************************************/
/*
 * Section information.
 */
$wideo_sections = [
    'section-theme-settings' => [
        'title' => 'Settaggi tema',
        'desc'  => 'Settaggi generali .'
    ],
   
];
/*
 * Field information.
 */
$wideo_fields = [
    'wideo-image-blog' => [
        'title'    => 'Immagine hero blog',
        'type'     => 'immagine_hero',
        'section'  => 'section-theme-settings',
        'default'  => '',
        'desc'     => "Inserisci l'immagine della hero del blog",
        'sanitize' => ''
    ],
   
    'wideo-image-search' => [
        'title'    => 'Immagine hero search',
        'type'     => 'immagine_search',
        'section'  => 'section-theme-settings',
        'default'  => '',
        'desc'     => "Inserisci l'immagine della hero della pagina di ricerca",
        'sanitize' => ''
    ],
    'wideo-image-404' => [
        'title'    => 'Immagine 404',
        'type'     => 'immagine_404',
        'section'  => 'section-theme-settings',
        'default'  => '',
        'desc'     => "Inserisci l'immagine della hero della pagina 404",
        'sanitize' => ''
    ],
    'wideo-email-client' => [
        'title'    => 'Email',
        'type'     => 'email_client',
        'section'  => 'section-theme-settings',
        'default'  => '',
        'desc'     => "Inserisci l'email",
        'sanitize' => 'full'
    ],
    
];
/******************************************************************************
 * 2. HOOKS
 *****************************************************************************/
add_action( 'after_setup_theme', 'wideo_init_option' );
add_action( 'admin_menu', 'wideo_update_menu' );
add_action( 'admin_init', 'wideo_init_settings' );
add_action( 'admin_enqueue_scripts', 'wideo_options_custom_scripts' );
/******************************************************************************
 * 3. RENDER FUNCTIONS
 *****************************************************************************/
/*
 * Renders a section description.
 */
function wideo_render_section( $args ) {
    global $wideo_sections;
    echo "<p>" . $wideo_sections[ $args['id'] ]['desc'] . "</p>";
    echo "<hr />";
}
/*
 * Renders a field.
 */
function wideo_render_field( $id ) {
    global $wideo_fields;
    $options = get_option( 'wideo_options' );
    // If options are not set yet for that ID, grab the default value.
    $field_value = isset( $options[ $id ] ) ? $options[ $id ] : wideo_get_field_default( $id );
    // Generate HTML markup based on field type.
    switch ( $wideo_fields[ $id ]['type'] ) {

        case 'immagine_hero':
          $visibility_class = ( '' != $field_value ) ? "" : "hide";
          echo "<img src='" . $field_value . "' alt='hero' class='wideo-custom-thumbnail " . $visibility_class . "' id='" . $id . "-thumbnail' />";
          echo "<input type='hidden' name='wideo_options[" . $id . "]' id='" . $id . "-upload-field' value='" . $field_value . "' />";
          echo "<input type='button' class='btn-upload-img button' value='carica immagine' data-field-id='" . $id . "' />";
          echo "<input type='button' class='btn-remove-img button " . $visibility_class . "' value='Rimuovi immagine' data-field-id='" . $id . "' id='" . $id . "-remove-button' />";
          echo "<p class='description'>" . $wideo_fields[ $id ]['desc'] . "</p>";
          break;
        case 'immagine_search':
          $visibility_class = ( '' != $field_value ) ? "" : "hide";
          echo "<img src='" . $field_value . "' alt='hero' class='wideo-custom-thumbnail " . $visibility_class . "' id='" . $id . "-thumbnail' />";
          echo "<input type='hidden' name='wideo_options[" . $id . "]' id='" . $id . "-upload-field' value='" . $field_value . "' />";
          echo "<input type='button' class='btn-upload-img button' value='carica immagine' data-field-id='" . $id . "' />";
          echo "<input type='button' class='btn-remove-img button " . $visibility_class . "' value='Rimuovi immagine' data-field-id='" . $id . "' id='" . $id . "-remove-button' />";
          echo "<p class='description'>" . $wideo_fields[ $id ]['desc'] . "</p>";
          
          break;
        case 'immagine_404':
          $visibility_class = ( '' != $field_value ) ? "" : "hide";
          echo "<img src='" . $field_value . "' alt='hero' class='wideo-custom-thumbnail " . $visibility_class . "' id='" . $id . "-thumbnail' />";
          echo "<input type='hidden' name='wideo_options[" . $id . "]' id='" . $id . "-upload-field' value='" . $field_value . "' />";
          echo "<input type='button' class='btn-upload-img button' value='carica immagine' data-field-id='" . $id . "' />";
          echo "<input type='button' class='btn-remove-img button " . $visibility_class . "' value='Rimuovi immagine' data-field-id='" . $id . "' id='" . $id . "-remove-button' />";
          echo "<p class='description'>" . $wideo_fields[ $id ]['desc'] . "</p>";
          
          break;
        case 'email_client':
          $visibility_class = ( '' != $field_value ) ? "" : "hide";
          echo "<input type='email' value='" . $field_value . "' name='wideo_options[" . $id . "]' class='wideo-custom-email' id='" . $id . "' />";
          echo "<p class='description'>" . $wideo_fields[ $id ]['desc'] . "</p>";
          
          break;
    }
}
/*
 * Renders the theme options page.
 */
function wideo_render_theme_options() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'Non hai i permessi per accedere a questa pagina.' );
    } ?>

    <div class="wrap">
        <h1>Theme options</h1>

        <?php settings_errors(); ?>

        <form action="options.php" method="post">
            <?php
                settings_fields( "wideo_options" );
                do_settings_sections( "wideo-theme-options" );
                echo "<hr />";
                submit_button();
            ?>
        </form>
    </div>
<?php }
/******************************************************************************
 * 4. SANITIZE FUNCTIONS
 *****************************************************************************/
/*
 * Sanitizes the settings.
 */
function wideo_options_validate( $input ) {
    // Define a blank array for the output.
    $output = [];
    // Do a general sanitization for every field.
    foreach ( $input as $key => $value ) {
        // Grab the sanitize option for this field.
        $field_sanitize = wideo_get_field_sanitize( $key );
        switch ( $field_sanitize ) {
            case 'default':
                $output[ $key ] = strip_tags( stripslashes( $input[ $key ] ) );
                break;
            
            case 'full':
                $output[ $key ] = esc_url_raw( strip_tags( stripslashes( $input[ $key ] ) ) );
                break;
            case 'google-analytics':
                $output[ $key ] = ( preg_match('/^UA-[0-9]+-[0-9]+$/', $input[ $key ] ) ) ? $input[ $key ] : '';
                break;
            default:
                $output[ $key ] = $input[ $key ];
                break;
        }
    }
    return $output;
}
/******************************************************************************
 * 5. CUSTOM SCRIPTS
 *****************************************************************************/
/*
 * Registers and loads custom JavaScript and CSS.
 */
function wideo_options_custom_scripts() {
    // Get information about the current page.
    $screen = get_current_screen();
    // Register a custom script that depends on jQuery, Media Upload and Thickbox (available from the Core).
    wp_register_script( 'wideo-custom-admin-scripts', get_template_directory_uri() .'/assets/vendor/js/options_panel.js', array( 'jquery' ) );
    // Register custom styles.
    wp_register_style( 'wideo-custom-admin-styles', get_template_directory_uri() .'/assets/vendor/css/options_panel.css' );
    
    // Only load these scripts if we're on the theme options page.
    if ( 'appearance_page_wideo-theme-options' == $screen->id ) {
        // Enqueues all scripts, styles, settings, and templates necessary to use all media JavaScript APIs.
        wp_enqueue_media();
        
        // Load our custom scripts.
        wp_enqueue_script( 'wideo-custom-admin-scripts' );
        // Load our custom styles.
        wp_enqueue_style( 'wideo-custom-admin-styles' );
    }    
}
/******************************************************************************
 * 6. OTHER FUNCTIONS
 *****************************************************************************/
/*
 * Returns the default value of a field.
 */
function wideo_get_field_default( $id ) {
    global $wideo_fields;
    return $wideo_fields[ $id ]['default'];
}
/*
 * Checks if the options exists in the database.
 */
function wideo_init_option() {
    $options = get_option( 'wideo_options' );
    if ( false === $options ) {
        add_option( 'wideo_options' );
    }
}
/*
 * Creates a sub-menu under Appearance.
 */
function wideo_update_menu() {
    add_theme_page( 'Settaggi tema', 'Settaggi tema', 'manage_options', 'wideo-theme-options', 'wideo_render_theme_options' );
}
/*
 * Registers and adds settings, sections and fields.
 */
function wideo_init_settings() {
    // Declare $wideo_sections and $wideo_fields as global.
    global $wideo_fields, $wideo_sections;
    // Register a general setting.
    // The $option_group is the same as $option_name to prevent the "Error: options page not found." problem.
    register_setting( "wideo_options", "wideo_options", "wideo_options_validate" );
    // Add sections as defined in the $wideo_sections array.
    foreach ($wideo_sections as $section_id => $section_value) {
        add_settings_section( $section_id, $section_value['title'], "wideo_render_section", "wideo-theme-options" );
    }
    // Add fields as defined in the $wideo_fields array.
    foreach ($wideo_fields as $field_id => $field_value) {
        add_settings_field( $field_id, $field_value['title'], "wideo_render_field", "wideo-theme-options", $field_value['section'], $field_id );
    }
}
/*
 * Returns the sanitize value of a field.
 */
function wideo_get_field_sanitize( $id ) {
    global $wideo_fields;
    return $wideo_fields[ $id ]['sanitize'];
}