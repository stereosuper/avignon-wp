<?php 
define( 'AVIGNON_APPLY_FORM_ID', 2 );
define( 'AVIGNON_RECOMMENDATION_FORM_ID', 3 );
define( 'AVIGNON_RECOMMENDATION_PAGE_ID', 305 );

/**
 * Génère automatiquement un jeton d'authentification pour le formulaire d'application.
 *
 * On utilise ensuite ce jeton pour le lien vers le formulaire de recommendation.
 *
 * @param  string $value
 * @return string
 */
function avignon_field_value_applicant_token( $value = '' )
{
    $bytes = openssl_random_pseudo_bytes( 32 );
    $hex   = bin2hex( $bytes );
    return $hex;
}
add_filter( 'gform_field_value_applicant_token', 'avignon_field_value_applicant_token' );

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
            $value = get_field( 'first_name' );
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
            $value = get_field( 'last_name' );
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
            $value = get_field( 'reference_' . $_GET['reference'] . '_first_name' );
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
            $value = get_field( 'reference_' . $_GET['reference'] . '_last_name' );
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
            $value = get_field( 'reference_' . $_GET['reference'] . '_email' );
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
function avignon_field_value_reference_token( $value = '' )
{
    if ( isset( $_GET['token'] ) && $_GET['token'] ) {
        $value = $_GET['token'];
    }
    return $value;
}
add_filter( 'gform_field_value_reference_token', 'avignon_field_value_reference_token' );

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
        'birthday'                 => $entry[5],
        'ss_number'                => $entry[6],
        'citizenship'              => $entry[7],
        'passport'                 => $entry[8],
        'email'                    => $entry[9],
        'email2'                   => $entry[10],
        'phone'                    => $entry[11],
        'mobile'                   => $entry[12],
        'photo'                    => $entry[13],
        'canal'                    => $entry[14],
        'address'                  => $entry[17],
        'address2'                 => $entry[18],
        'city'                     => $entry[19],
        'zip_code'                 => $entry[20],
        'state'                    => $entry[21],
        'country'                  => $entry[22],
        'status'                   => $entry[25],
        'secondary_school'         => $entry[26],
        'university'               => $entry[27],
        'year_graduating'          => $entry[28],
        'major_subject'            => $entry[29],
        'previous_foreign_travel'  => $entry[30],
        'reasons'                  => $entry[31],
        'prize'                    => $entry[32],
        'plan_after'               => $entry[33],
        'emergency_first_name'     => ucwords( $entry[37] ),
        'emergency_last_name'      => mb_strtoupper( $entry[38] ),
        'emergency_relationship'   => $entry[39],
        'emergency_phone'          => $entry[40],
        'emergency_address'        => $entry[41],
        'emergency_address2'       => $entry[42],
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
        'token'                    => $entry[69]
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
            update_field( $key, $value, $post_id );
        }
    }

    // On envoi l'email de confirmation
    ob_start();
    include get_stylesheet_directory() . 'email/apply.php';
    $message = ob_get_clean();

    wp_mail( $data['email'], __( 'Pré-inscription enregistrée !', 'avignon' ), $message, array(
            'Content-Type: text/html; charset=UTF-8'
    ) );
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
        'signature_date'       => $entry[23],
        'token'                => $entry[24],
        'reference_number'     => $entry[25],
    );
}
add_action( 'gform_after_submission_' . AVIGNON_RECOMMENDATION_FORM_ID, 'avignon_recommendation_form_submitted' );
?>