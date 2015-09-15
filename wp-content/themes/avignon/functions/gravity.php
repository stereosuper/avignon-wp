<?php

define( 'AVIGNON_APPLY_FORM_ID', 7 );
define( 'AVIGNON_RECOMMENDATION_FORM_ID', 8 );
define( 'AVIGNON_HEALTH_EVALUATION_UPLOAD_FORM_ID', 6 );

define( 'AVIGNON_HOUSING_PAGE_ID', 261 );
define( 'AVIGNON_INFORMATIONS_PAGE_ID', 224 );
define( 'AVIGNON_RECOMMENDATION_PAGE_ID', 316 );
define( 'AVIGNON_HEALTH_EVALUATION_PAGE_ID', 349 );

define( 'AVIGNON_HOUSING_FORM_ID', 11 );

// Remove gravity tabindex which are really really BAD
add_filter( 'gform_tabindex', '__return_false' );

/**
 * Modifie le message d'erreur pour Gravity.
 *
 * @param  string $message
 * @return string
 */
function avignon_gravity_error_message( $message )
{
    $message = '<div class="validation_error">' . __( 'Please check fields filled in red!', 'avignon' ) .  '</div>';
    return $message;
}
add_filter( 'gform_validation_message', 'avignon_gravity_error_message' );

/**
 * Adjusting the HTML of the submit button to match design
 *
 * @param $button string  required  The text string of the button we're editing
 * @param $form   array   required  The whole form object
 * @return string The new HTML for the button
 */
function avignon_form_button( $button, $form = array()){
    // On récupère la valeur de l'attribue "value="
    $matches = array();
    preg_match( "/value='([^']*)'/", $button, $matches );
    $value = isset( $matches[1] ) ? $matches[1] : '';

    $prev_markup = array( '<input', '/>', "class='" );
    $next_markup = array( '<button', "/>$value</button>", "class='btn " );

    $button = str_replace( $prev_markup, $next_markup, $button );
    return $button;
}
add_filter( 'gform_previous_button', '__return_false' );
add_filter( 'gform_next_button', 'avignon_form_button' );
add_filter( 'gform_submit_button', 'avignon_form_button' );

/**
 * Possibilité de cacher les labels des champs Gravity Forms
 */
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

/**
 * Markup pour le formulaire "Housing".
 *
 * @param  string $field_container
 * @return string
 */
function avignon_markup_housing1( $field_container )
{
    if ( ! is_admin() ) {
        $field_container = '<li><ul class="m-top30">' . $field_container;
    }
    return $field_container;
}
add_filter( 'gform_field_container_' . AVIGNON_HOUSING_FORM_ID . '_19', 'avignon_markup_housing1' );

function avignon_markup_housing2( $field_container )
{
    if ( ! is_admin() ) {
        $field_container = $field_container . '</ul>';
    }
    return $field_container;
}
add_filter( 'gform_field_container_' . AVIGNON_HOUSING_FORM_ID . '_20', 'avignon_markup_housing2' );

function avignon_markup_housing3( $field_container )
{
    if ( ! is_admin() ) {
        $field_container = '<ul class="m-top30">' . $field_container;
    }
    return $field_container;
}
add_filter( 'gform_field_container_' . AVIGNON_HOUSING_FORM_ID . '_21', 'avignon_markup_housing3' );

function avignon_markup_housing4( $field_container )
{
    if ( ! is_admin() ) {
        $field_container = $field_container . '</ul></li>';
    }
    return $field_container;
}
add_filter( 'gform_field_container_' . AVIGNON_HOUSING_FORM_ID . '_22', 'avignon_markup_housing4' );

function avignon_markup_housing5( $field_container )
{
    if ( ! is_admin() ) {
        $field_container = '<li><ul>' . $field_container;
    }
    return $field_container;
}
add_filter( 'gform_field_container_' . AVIGNON_HOUSING_FORM_ID . '_48', 'avignon_markup_housing5' );

function avignon_markup_housing6( $field_container )
{
    if ( ! is_admin() ) {
        $field_container = $field_container . '</ul></li>';
    }
    return $field_container;
}
add_filter( 'gform_field_container_' . AVIGNON_HOUSING_FORM_ID . '_49', 'avignon_markup_housing6' );


/**
 * Ajoute la mention "(encrypted)" au champs SS#.
 *
 * @param  string  $field_content
 * @param  object  $field
 * @return string
 */
function avignon_ss_label( $field_content, $field )
{
    if ( $field->formId == AVIGNON_APPLY_FORM_ID && $field->id == 6 ) {
        $field_content = preg_replace("@(<label class='gfield_label')(.*)(<span class='gfield_required'>)@", "$1$2<span class='legend'>(encrypted)</span>$3", $field_content);
    }
    return $field_content;
}
add_filter( 'gform_field_content', 'avignon_ss_label', 10, 2 );

/**
 * Markup pour le début de la partie "Applicant infos".
 *
 * @param  string $field_container
 * @return string
 */
function avignon_markup_applicant_start( $field_container )
{
    if ( ! is_admin() ) {
        $field_container = '<li><ul><li><ul>' . $field_container;
    }
    return $field_container;
}
add_filter( 'gform_field_container_' . AVIGNON_APPLY_FORM_ID . '_3', 'avignon_markup_applicant_start' );

/**
 * Markup pour le début de la partie "Applicant email".
 *
 * @param  string $field_container
 * @return string
 */
function avignon_markup_applicant_email( $field_container )
{
    if ( ! is_admin() ) {
        $field_container = '</ul><ul class="inlineBlock big">' . $field_container;
    }
    return $field_container;
}
add_filter( 'gform_field_container_' . AVIGNON_APPLY_FORM_ID . '_9', 'avignon_markup_applicant_email' );

/**
 * Markup pour le début de la partie "Applicant photo".
 *
 * @param  string $field_container
 * @return string
 */
function avignon_markup_applicant_photo( $field_container )
{
    if ( ! is_admin() ) {
        $field_container = '</ul><ul class="inlineBlock small">' . $field_container;
    }
    return $field_container;
}
add_filter( 'gform_field_container_' . AVIGNON_APPLY_FORM_ID . '_13', 'avignon_markup_applicant_photo' );

/**
 * Markup pour le début de la partie "Applicant current address".
 *
 * @param  string $field_container
 * @return string
 */
function avignon_markup_applicant_current_address( $field_container )
{
    if ( ! is_admin() ) {
        $field_container = '</ul></li><li><ul class="inlineBlock first">' . $field_container;
    }
    return $field_container;
}
add_filter( 'gform_field_container_' . AVIGNON_APPLY_FORM_ID . '_16', 'avignon_markup_applicant_current_address' );

/**
 * Markup pour le début de la partie "Applicant permanent address".
 *
 * @param  string $field_container
 * @return string
 */
function avignon_markup_applicant_permanent_address( $field_container )
{
    if ( ! is_admin() ) {
        $field_container = '</ul><ul class="inlineBlock">' . $field_container;
    }
    return $field_container;
}
add_filter( 'gform_field_container_' . AVIGNON_APPLY_FORM_ID . '_70', 'avignon_markup_applicant_permanent_address' );

/**
 * Markup pour le début de la partie "Applicant mandatory".
 *
 * @param  string $field_container
 * @return string
 */
function avignon_markup_applicant_mandatory( $field_container )
{
    if ( ! is_admin() ) {
        $field_container = '</ul></li>' . $field_container . '</ul></li>';
    }
    return $field_container;
}
add_filter( 'gform_field_container_' . AVIGNON_APPLY_FORM_ID . '_23', 'avignon_markup_applicant_mandatory' );

/**
 * Markup pour le début de la partie "Academic".
 *
 * @param  string $field_container
 * @return string
 */
function avignon_markup_academic_start( $field_container )
{
    if ( ! is_admin() ) {
        $field_container = '<li><ul>' . $field_container;
    }
    return $field_container;
}
add_filter( 'gform_field_container_' . AVIGNON_APPLY_FORM_ID . '_25', 'avignon_markup_academic_start' );

/**
 * Markup pour le début de la partie "Academic".
 *
 * @param  string $field_container
 * @return string
 */
function avignon_markup_academic_infos( $field_container )
{
    if ( ! is_admin() ) {
        $field_container = '</ul><ul>' . $field_container;
    }
    return $field_container;
}
add_filter( 'gform_field_container_' . AVIGNON_APPLY_FORM_ID . '_26', 'avignon_markup_academic_infos' );

/**
 * Markup pour le début de la partie "Academic".
 *
 * @param  string $field_container
 * @return string
 */
function avignon_markup_academic_mandatory( $field_container )
{
    if ( ! is_admin() ) {
        $field_container = '</ul></li>' . $field_container;
    }
    return $field_container;
}
add_filter( 'gform_field_container_' . AVIGNON_APPLY_FORM_ID . '_34', 'avignon_markup_academic_mandatory' );

/**
 * Markup pour le début de la partie "Emergency".
 *
 * @param  string $field_container
 * @return string
 */
function avignon_markup_emergency_start( $field_container )
{
    if ( ! is_admin() ) {
        $field_container = '<li><ul>' . $field_container;
    }
    return $field_container;
}
add_filter( 'gform_field_container_' . AVIGNON_APPLY_FORM_ID . '_37', 'avignon_markup_emergency_start' );

/**
 * Markup pour le début de la partie "Emergency address".
 *
 * @param  string $field_container
 * @return string
 */
function avignon_markup_emergency_address( $field_container )
{
    if ( ! is_admin() ) {
        $field_container = '<li><ul>' . $field_container;
    }
    return $field_container;
}
add_filter( 'gform_field_container_' . AVIGNON_APPLY_FORM_ID . '_41', 'avignon_markup_emergency_address' );

/**
 * Markup pour le début de la partie "Emergency mandatory".
 *
 * @param  string $field_container
 * @return string
 */
function avignon_markup_emergency_mandatory( $field_container )
{
    if ( ! is_admin() ) {
        $field_container = '</ul></li>' . $field_container . '</ul></li>';
    }
    return $field_container;
}
add_filter( 'gform_field_container_' . AVIGNON_APPLY_FORM_ID . '_60', 'avignon_markup_emergency_mandatory' );

/**
 * Markup pour le début de la partie "Reference".
 *
 * @param  string $field_container
 * @return string
 */
function avignon_markup_reference_one( $field_container )
{
    if ( ! is_admin() ) {
        $field_container = '<li><ul class="inlineBlock first">' . $field_container;
    }
    return $field_container;
}
add_filter( 'gform_field_container_' . AVIGNON_APPLY_FORM_ID . '_50', 'avignon_markup_reference_one' );

/**
 * Markup pour le début de la partie "Reference two".
 *
 * @param  string $field_container
 * @return string
 */
function avignon_markup_reference_two( $field_container )
{
    if ( ! is_admin() ) {
        $field_container = '</ul><ul class="inlineBlock">' . $field_container;
    }
    return $field_container;
}
add_filter( 'gform_field_container_' . AVIGNON_APPLY_FORM_ID . '_55', 'avignon_markup_reference_two' );

/**
 * Markup pour le début de la partie "Reference mandatory".
 *
 * @param  string $field_container
 * @return string
 */
function avignon_markup_reference_mandatory( $field_container )
{
    if ( ! is_admin() ) {
        $field_container = '</ul></li>' . $field_container;
    }
    return $field_container;
}
add_filter( 'gform_field_container_' . AVIGNON_APPLY_FORM_ID . '_61', 'avignon_markup_reference_mandatory' );




/**
 * Génère automatiquement un jeton d'authentification pour le formulaire d'application.
 *
 * On utilise ensuite ce jeton pour le lien vers le formulaire de recommendation.
 *
 * @param  string $value
 * @return string
 */
function avignon_field_value_default_token( $value = '' )
{
    $bytes = openssl_random_pseudo_bytes( 32 );
    $hex   = bin2hex( $bytes );
    return $hex;
}
add_filter( 'gform_field_value_default_token', 'avignon_field_value_default_token' );

/**
 * Remplit automatiquement le champ avec le prénom de l'applicant dans le formulaire
 * de recommendation.
 *
 * @param  string $value
 * @return string
 */
function avignon_field_value_applicant_first_name( $value = '' )
{
    if ( isset( $_GET['token'] ) && $_GET['token'] ) {
        $applicants = get_posts( array(
            'post_type'  => 'applicant',
            'meta_key'   => 'token',
            'meta_value' => $_GET['token']
        ) );

        if ( count( $applicants ) > 0 ) {
            $applicant = array_shift( $applicants );
            $value = get_field( 'first_name', $applicant->ID );
        }
    }
    return $value;
}
add_filter( 'gform_field_value_applicant_first_name', 'avignon_field_value_applicant_first_name' );

/**
 * Remplit automatiquement le champ avec le nom de l'applicant dans le formulaire
 * de recommendation.
 *
 * @param  string $value
 * @return string
 */
function avignon_field_value_applicant_last_name( $value = '' )
{
    if ( isset( $_GET['token'] ) && $_GET['token'] ) {
        $applicants = get_posts( array(
            'post_type'  => 'applicant',
            'meta_key'   => 'token',
            'meta_value' => $_GET['token']
        ) );

        if ( count( $applicants ) > 0 ) {
            $applicant = array_shift( $applicants );
            $value = get_field( 'last_name', $applicant->ID );
        }
    }
    return $value;
}
add_filter( 'gform_field_value_applicant_last_name', 'avignon_field_value_applicant_last_name' );

/**
 * Remplit automatiquement le champ avec le prénom du référent dans le formulaire
 * de recommendation.
 *
 * @param  string $value
 * @return string
 */
function avignon_field_value_reference_first_name( $value = '' )
{
    if ( isset( $_GET['token'] ) && $_GET['token'] &&
         isset( $_GET['reference'] ) && $_GET['reference'] ) {
        $applicants = get_posts( array(
            'post_type'  => 'applicant',
            'meta_key'   => 'token',
            'meta_value' => $_GET['token']
        ) );

        if ( count( $applicants ) > 0 ) {
            $applicant = array_shift( $applicants );
            $value = get_field( 'reference_' . $_GET['reference'] . '_first_name', $applicant->ID );
        }
    }
    return $value;
}
add_filter( 'gform_field_value_reference_first_name', 'avignon_field_value_reference_first_name' );

/**
 * Remplit automatiquement le champ avec le nom du référent dans le formulaire
 * de recommendation.
 *
 * @param  string $value
 * @return string
 */
function avignon_field_value_reference_last_name( $value = '' )
{
    if ( isset( $_GET['token'] ) && $_GET['token'] &&
         isset( $_GET['reference'] ) && $_GET['reference'] ) {
        $applicants = get_posts( array(
            'post_type'  => 'applicant',
            'meta_key'   => 'token',
            'meta_value' => $_GET['token']
        ) );

        if ( count( $applicants ) > 0 ) {
            $applicant = array_shift( $applicants );
            $value = get_field( 'reference_' . $_GET['reference'] . '_last_name', $applicant->ID );
        }
    }
    return $value;
}
add_filter( 'gform_field_value_reference_last_name', 'avignon_field_value_reference_last_name' );

/**
 * Remplit automatiquement le champ avec l'email du référent dans le formulaire
 * de recommendation.
 *
 * @param  string $value
 * @return string
 */
function avignon_field_value_reference_email( $value = '' )
{
    if ( isset( $_GET['token'] ) && $_GET['token'] &&
         isset( $_GET['reference'] ) && $_GET['reference'] ) {
        $applicants = get_posts( array(
            'post_type'  => 'applicant',
            'meta_key'   => 'token',
            'meta_value' => $_GET['token']
        ) );

        if ( count( $applicants ) > 0 ) {
            $applicant = array_shift( $applicants );
            $value = get_field( 'reference_' . $_GET['reference'] . '_email', $applicant->ID );
        }
    }
    return $value;
}
add_filter( 'gform_field_value_reference_email', 'avignon_field_value_reference_email' );

/**
 * Remplit automatiquement le champ avec le jeton dans le formulaire
 * de recommendation.
 *
 * @param  string $value
 * @return string
 */
function avignon_field_value_parameter_token( $value = '' )
{
    if ( isset( $_GET['token'] ) && $_GET['token'] ) {
        $value = $_GET['token'];
    }
    return $value;
}
add_filter( 'gform_field_value_parameter_token', 'avignon_field_value_parameter_token' );

/**
 * Remplit automatiquement le champ avec le numéro de référence dans le formulaire
 * de recommendation.
 *
 * @param  string $value
 * @return string
 */
function avignon_field_value_reference_number( $value = '' )
{
    if ( isset( $_GET['reference'] ) && $_GET['reference'] ) {
        $value = $_GET['reference'];
    }
    return $value;
}
add_filter( 'gform_field_value_reference_number', 'avignon_field_value_reference_number' );

/**
 * Vérifie si l'email de l'applicant n'est pas déjà enregistré dans la base de données.
 *
 * @param  array $result
 * @param  string $value
 * @return array
 */
function avignon_validate_email_applicant( $result, $value = '' )
{
    $applicants = get_posts( array(
        'post_type'  => 'applicant',
        'meta_key'   => 'email',
        'meta_value' => $value
    ) );

    if ( count( $applicants ) > 0 ) {
        $result['is_valid'] = false;
        $result['message'] = 'This email address is already used on an application';
    }

    return $result;
}
add_action( 'gform_field_validation_' . AVIGNON_APPLY_FORM_ID . '_9',  'avignon_validate_email_applicant', 10, 2 );
add_action( 'gform_field_validation_' . AVIGNON_APPLY_FORM_ID . '_10', 'avignon_validate_email_applicant', 10, 2 );

/**
 * Soumission du formulaire d'inscription.
 * - Création du dossier
 * - Sauvegarde des informations avec ACF
 * - Envoi de l'email de confirmation d'inscription
 *
 * @param  Array $entry
 * @return void
 */
function avignon_apply_form_submitted( $entry )
{
    $data = array(
        'first_name'               => ucwords( $entry[3] ),
        'last_name'                => mb_strtoupper( $entry[4] ),
        'birthday'                 => $entry[82],
        'ss_number'                => $entry[6],
        'citizenship'              => $entry[7],
        'passport_number'          => $entry[8],
        'email'                    => $entry[9],
        'email_2'                  => $entry[10],
        'phone_number'             => $entry[11],
        'cell_number'              => $entry[12],
        'picture'                  => $entry[13],
        'hear_about'               => $entry[14],
        'street_address'           => $entry[17],
        'address_line_2'           => $entry[18],
        'city'                     => $entry[19],
        'zip_code'                 => $entry[20],
        'state'                    => $entry[21],
        'country'                  => $entry[22],

        'permanent_street_address' => $entry[71],
        'permanent_address_line_2' => $entry[72],
        'permanent_zip_code'       => $entry[76],
        'permanent_city'           => $entry[73],
        'permanent_state'          => $entry[75],
        'permanent_country'        => $entry[74],

        'status'                   => $entry[25],
        'secondary_school'         => $entry[26],
        'university'               => $entry[27],
        'year_graduating'          => $entry[78],
        'major_subject'            => $entry[29],
        'previous_foreign_travel'  => $entry[30],
        'reasons'                  => $entry[31],
        'prize'                    => $entry[32],
        'plans_after'              => $entry[33],
        'emergency_first_name'     => ucwords( $entry[37] ),
        'emergency_last_name'      => mb_strtoupper( $entry[38] ),
        'emergency_relationship'   => $entry[39],
        'emergency_phone_number'   => $entry[40],
        'emergency_street_address' => $entry[41],
        'emergency_address_line_2' => $entry[42],
        'emergency_city'           => $entry[43],
        'emergency_zip_code'       => $entry[44],
        'emergency_state'          => $entry[45],
        'emergency_country'        => $entry[46],
        'reference_1_first_name'   => ucwords( $entry[51] ),
        'reference_1_last_name'    => mb_strtoupper( $entry[52] ),
        'reference_1_affilitation' => $entry[53],
        'reference_1_email'        => $entry[54],
        'reference_2_first_name'   => ucwords( $entry[56] ),
        'reference_2_last_name'    => mb_strtoupper( $entry[57] ),
        'reference_2_affilitation' => $entry[58],
        'reference_2_email'        => $entry[59],
        'signature_first_name'     => ucwords( $entry[66] ),
        'signature_last_name'      => mb_strtoupper( $entry[67] ),
        'signature_date'           => $entry[68],

        'reference_1_ok'           => false,
        'reference_2_ok'           => false,
        'health_form_received'     => false,
        'application_status'       => 'submitted',
    );

    $acf_mapping = array(
        'application_status'       => 'field_55f000bbd8b61',
        'refused_reason'           => 'field_55e86b22e0050',

        'last_name'                => 'field_55efe1d737bc3',
        'first_name'               => 'field_55efe1e137bc4',
        'birthday'                 => 'field_55efe20137bc5',
        'ss_number'                => 'field_55efe20f37bc6',
        'citizenship'              => 'field_55efe21637bc7',
        'passport_number'          => 'field_55efe22037bc8',
        'email'                    => 'field_55efe22e37bc9',
        'email_2'                  => 'field_55efe23137bca',
        'phone_number'             => 'field_55efe23737bcb',
        'cell_number'              => 'field_55efe24237bcc',
        'picture'                  => 'field_55efe25637bcd',
        'hear_about'               => 'field_55efe25d37bce',
        'street_address'           => 'field_55effaea37bd0',
        'address_line_2'           => 'field_55effaf337bd1',
        'zip_code'                 => 'field_55effaf937bd2',
        'city'                     => 'field_55effb0037bd3',
        'state'                    => 'field_55effb0437bd4',
        'country'                  => 'field_55effb1f37bd5',
        'permanent_street_address' => 'field_55effb3937bd7',
        'permanent_address_line_2' => 'field_55effb4837bd8',
        'permanent_zip_code'       => 'field_55effb5337bd9',
        'permanent_city'           => 'field_55effb5c37bda',
        'permanent_state'          => 'field_55effb6337bdb',
        'permanent_country'        => 'field_55effb7237bdc',

        'status'                  => 'field_55effbfcd27b9',
        'secondary_school'        => 'field_55effc18d27ba',
        'university'              => 'field_55effc27d27bb',
        'year_graduating'         => 'field_55effc36d27bc',
        'major_subject'           => 'field_55effc47d27bd',
        'previous_foreign_travel' => 'field_55effc4ed27be',
        'reasons'                 => 'field_55effc5dd27bf',
        'prize'                   => 'field_55effc6ad27c0',
        'plans_after'             => 'field_55effc8cd27c1',

        'emergency_first_name'     => 'field_55efffdfddeda',
        'emergency_last_name'      => 'field_55efffefddedb',
        'emergency_relationship'   => 'field_55effff5ddedc',
        'emergency_phone_number'   => 'field_55f00000ddedd',
        'emergency_street_address' => 'field_55f0000bddede',
        'emergency_address_line_2' => 'field_55f00014ddedf',
        'emergency_city'           => 'field_55f0001cddee0',
        'emergency_zip_code'       => 'field_55f00024ddee1',
        'emergency_state'          => 'field_55f0002addee2',
        'emergency_country'        => 'field_55f00039ddee3',

        'reference_1_ok'           => 'field_55e85a97e6ca0',
        'reference_1_first_name'   => 'field_55e5b1f4bfc5a',
        'reference_1_last_name'    => 'field_55e5b204bfc5b',
        'reference_1_affilitation' => 'field_55e5b20bbfc5c',
        'reference_1_email'        => 'field_55e5b214bfc5d',
        'reference_2_ok'           => 'field_55e85b5e8afa6',
        'reference_2_first_name'   => 'field_55e5b237bfc5f',
        'reference_2_last_name'    => 'field_55e5b245bfc60',
        'reference_2_affilitation' => 'field_55e5b24cbfc61',
        'reference_2_email'        => 'field_55e5b259bfc62',

        'signature_first_name'     => 'field_55f0011b4ff71',
        'signature_last_name'      => 'field_55f0012a4ff72',
        'signature_date'           => 'field_55e5b282bfc66',

        'health_form_received'     => 'field_55f2e5ace86c9',
    );

    // On ajoute un nouveau post dans les "applicant"
    $post_id = wp_insert_post(array(
        'post_title'  => sprintf('%s %s', $data['first_name'], $data['last_name']),
        'post_type'   => 'applicant',
        'post_status' => 'publish'
    ), true );

    // On ajoute les méta-données
    if ( ! is_wp_error( $post_id ) ) {
        foreach ( $data as $key => $value ) {
            update_field( $acf_mapping[$key], $value, $post_id );
        }

        // On ajoute le jeton
        $token = $entry[81];
        add_post_meta( $post_id, 'token', $token, true );
    }

    // On envoi l'email de confirmation
    ob_start();
    include get_stylesheet_directory() . '/email/apply.php';
    $message = ob_get_clean();

    wp_mail( $data['email'], __( 'Application submitted!', 'avignon' ), $message, array(
        'Content-Type: text/html; charset=UTF-8'
    ) );

    // On envoi l'email de références
    for ( $reference = 1 ; $reference <= 2 ; $reference++ ) {
        ob_start();
        include get_stylesheet_directory() . '/email/reference.php';
        $message = ob_get_clean();

        wp_mail( $data['reference_' . $reference . '_email'], sprintf( __( 'Your recommendation for %s %s', 'avignon' ), $data['first_name'], $data['last_name'] ), $message, array(
            'Content-Type: text/html; charset=UTF-8'
        ) );
    }
}
add_action( 'gform_after_submission_' . AVIGNON_APPLY_FORM_ID, 'avignon_apply_form_submitted' );

/**
 * Soumission du formulaire de recommendation :
 * - Sauvegarde des données dans l'applicant
 *
 * @param  array $entry
 * @return void
 */
function avignon_recommendation_form_submitted( $entry )
{
    $data = array(
        'first_name'           => $entry[5],
        'last_name'            => $entry[6],
        'affiliation'          => $entry[7],
        'email'                => $entry[8],
        'address'              => $entry[10],
        'address2'             => $entry[11],
        'zip_code'             => $entry[12],
        'city'                 => $entry[13],
        'state'                => $entry[14],
        'country'              => $entry[15],
        'phone'                => $entry[16],
        'recommendation'       => $entry[18],
        'signature_first_name' => $entry[20],
        'signature_last_name'  => $entry[21],
        'signature_email'      => $entry[22],
        'signature_date'       => $entry[23]
    );

    $acf_mapping = array(
        'reference_1_ok'                        => 'field_55e85a97e6ca0',
        'reference_1_data_first_name'           => 'field_55e85a68e6c9c',
        'reference_1_data_last_name'            => 'field_55e85a7fe6c9d',
        'reference_1_data_affiliation'          => 'field_55e85a87e6c9e',
        'reference_1_data_email'                => 'field_55e85a8fe6c9f',
        'reference_1_data_address'              => 'field_55e85ac7e6ca1',
        'reference_1_data_address2'             => 'field_55e85ad4e6ca2',
        'reference_1_data_zip_code'             => 'field_55e85ae6e6ca3',
        'reference_1_data_city'                 => 'field_55e85af0e6ca4',
        'reference_1_data_state'                => 'field_55e85afae6ca5',
        'reference_1_data_country'              => 'field_55e85b01e6ca6',
        'reference_1_data_phone'                => 'field_55e85b0be6ca7',
        'reference_1_data_recommendation'       => 'field_55e85b15e6ca8',
        'reference_1_data_signature_first_name' => 'field_55e85b2de6caa',
        'reference_1_data_signature_last_name'  => 'field_55e85b38e6cab',
        'reference_1_data_signature_email'      => 'field_55e85b1fe6ca9',
        'reference_1_data_signature_date'       => 'field_55e85b40e6cac',
        'reference_2_ok'                        => 'field_55e85b5e8afa6',
        'reference_2_data_first_name'           => 'field_55e85b718afa7',
        'reference_2_data_last_name'            => 'field_55e85b7f8afa8',
        'reference_2_data_affiliation'          => 'field_55e85b888afa9',
        'reference_2_data_email'                => 'field_55e85b948afaa',
        'reference_2_data_address'              => 'field_55e85b9f8afab',
        'reference_2_data_address2'             => 'field_55e85ba98afac',
        'reference_2_data_zip_code'             => 'field_55e85bb58afad',
        'reference_2_data_city'                 => 'field_55e85bbe8afae',
        'reference_2_data_state'                => 'field_55e85bc78afaf',
        'reference_2_data_country'              => 'field_55e85bd28afb0',
        'reference_2_data_phone'                => 'field_55e85bdc8afb1',
        'reference_2_data_recommendation'       => 'field_55e85be58afb2',
        'reference_2_data_signature_first_name' => 'field_55e85c048afb4',
        'reference_2_data_signature_last_name'  => 'field_55e85c0f8afb5',
        'reference_2_data_signature_email'      => 'field_55e85bf68afb3',
        'reference_2_data_signature_date'       => 'field_55e85c188afb6',
    );

    $token = $entry[24];
    $reference_number = $entry[25];

    // On retrouve la pré-inscription correspondante à partir du jeton
    $applicants = get_posts( array(
        'post_type'  => 'applicant',
        'meta_key'   => 'token',
        'meta_value' => $token
    ) );
    if ( count( $applicants ) > 0 ) {
        $applicant =  array_shift( $applicants );
    } else {
        return;
    }

    // Sauvegarde des données
    update_field( $acf_mapping['reference_' . $reference_number . '_ok'], true, $applicant->ID );
    foreach ( $data as $key => $value ) {
        $input = sprintf( 'reference_%s_data_%s', $reference_number, $key );
        update_field( $acf_mapping[$input] , $value, $applicant->ID );
    }
}
add_action( 'gform_after_submission_' . AVIGNON_RECOMMENDATION_FORM_ID, 'avignon_recommendation_form_submitted' );

/**
 * Soumission du formulaire d'upload de l'évaluation médicale.
 *
 * @param  array $entry
 * @return void
 */
function avignon_health_evaluation_submitted( $entry )
{
    $data = array(
        'health_form' => $entry[1],
    );

    $acf_mapping = array(
        'application_status'   => 'field_55f000bbd8b61',
        'health_form_received' => 'field_55f2e5ace86c9',
        'health_form'          => 'field_55f2e5c5e86ca',
    );


    $token = $entry[2];

    // On récupère le dossier à partir du jeton
    $applicants = get_posts( array(
        'post_type'  => 'applicant',
        'meta_key'   => 'token',
        'meta_value' => $token
    ) );
    if ( count( $applicants ) > 0 ) {
        $applicant =  array_shift( $applicants );
    } else {
        return;
    }

    // Sauvegarde du formulaire dans le dossier
    update_field( $acf_mapping['health_form_received'], true, $applicant->ID );
    update_field( $acf_mapping['health_form'], $data['health_form'], $applicant->ID );

    // Passage du dossier en "completed"
    update_field( $acf_mapping['application_status'], 'completed', $applicant->ID );

    // Envoi de l'email de confirmation
    ob_start();
    include get_stylesheet_directory() . '/email/completed.php';
    $message = ob_get_clean();

    wp_mail( get_field( 'email', $applicant->ID ), __( 'You are officially enrolled', 'avignon' ), $message, array(
        'Content-Type: text/html; charset=UTF-8'
    ) );

}
add_action( 'gform_after_submission_' . AVIGNON_HEALTH_EVALUATION_UPLOAD_FORM_ID, 'avignon_health_evaluation_submitted' );

/**
 * Vérification lors de la modification d'un dossier si le status à changé :
 *
 * - Accepté : on envoi l'email d'acceptation
 * - Refusé : on envoi l'email de refus avec le motif.
 *
 * @param  int $post_id
 * @return void
 */
function avignon_applicant_updated( $post_id )
{
    $prev_status = get_field( 'application_status', $post_id );
    $next_status = $_POST['fields']['field_55f000bbd8b61'];

    if ( $prev_status != $next_status ) {
        $token = get_post_meta( $post_id, 'token', true );
        switch ( $next_status ) {
            case 'accepted':
                // Envoi de l'email d'acceptation
                ob_start();
                include get_stylesheet_directory() . '/email/accepted.php';
                $message = ob_get_clean();

                wp_mail( get_field( 'email', $post_id ), __( 'You are admitted', 'avignon' ), $message, array(
                    'Content-Type: text/html; charset=UTF-8'
                ) );
                break;
            case 'refused':
                // Envoi de l'email de refus
                $refused_reasons = $_POST['fields']['field_55f000e4d8b62'];
                ob_start();
                include get_stylesheet_directory() . '/email/refused.php';
                $message = ob_get_clean();

                wp_mail( get_field( 'email', $post_id ), __( 'Your application has been rejected', 'avignon' ), $message, array(
                    'Content-Type: text/html; charset=UTF-8'
                ) );
                break;
            case 'completed':
                ob_start();
                include get_stylesheet_directory() . '/email/completed.php';
                $message = ob_get_clean();

                wp_mail( get_field( 'email', $post_id ), __( 'You are officially enrolled', 'avignon' ), $message, array(
                    'Content-Type: text/html; charset=UTF-8'
                ) );
                break;
        }
    }
}
add_action( 'acf/save_post', 'avignon_applicant_updated', 1 );

/**
 * Modifie le message de confirmation pour le formulaire de pré-inscription pour ajouter
 * les URLs automatiques vers les différentes étapes à suivre.
 *
 * @param  string/array $message
 * @param  array        $form
 * @param  array        $entry
 * @return string/Array
 */
function avignon_apply_confirmation( $message, $form, $entry )
{
    if ( ! is_string( $message ) ) {
        return $message;
    }

    $token = $entry[81];

    $keys = array(
        'link_reference_1',
        'link_reference_2',
        'link_health'
    );

    $replace = array(
        add_query_arg( array( 'token' => $token, 'reference' => 1 ), get_permalink( AVIGNON_RECOMMENDATION_PAGE_ID ) ),
        add_query_arg( array( 'token' => $token, 'reference' => 2 ), get_permalink( AVIGNON_RECOMMENDATION_PAGE_ID ) ),
        add_query_arg( array( 'token' => $token ), get_permalink( AVIGNON_HEALTH_EVALUATION_PAGE_ID ) )
    );

    $message = str_replace( $keys, $replace, $message );
    return $message;
}
add_filter( 'gform_confirmation_' . AVIGNON_APPLY_FORM_ID, 'avignon_apply_confirmation', 10, 3 );
