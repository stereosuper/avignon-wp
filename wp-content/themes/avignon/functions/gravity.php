<?php

define( 'AVIGNON_APPLY_FORM_ID', 2 );
define( 'AVIGNON_RECOMMENDATION_FORM_ID', 3 );
define( 'AVIGNON_HEALTH_EVALUATION_UPLOAD_FORM_ID', 3 );

define( 'AVIGNON_RECOMMENDATION_PAGE_ID', 305 );
define( 'AVIGNON_HEALTH_EVALUATION_PAGE_ID', 310 );
define( 'AVIGNON_HEALTH_EVALUATION_UPLOAD_PAGE_ID', 312 );

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

    $acf_mapping = array(
        'applicant_status'         => 'field_55e86af1e004f',
        'applicant_reason'         => 'field_55e86b22e0050',
        'first_name'               => 'field_55e5afddbfc2f',
        'last_name'                => 'field_55e5afeabfc30',
        'birthday'                 => 'field_55e5aff3bfc31',
        'ss_number'                => 'field_55e5affbbfc32',
        'citizenship'              => 'field_55e5b002bfc33',
        'passport'                 => 'field_55e5b009bfc34',
        'email'                    => 'field_55e5b016bfc35',
        'email2'                   => 'field_55e5b01dbfc36',
        'phone'                    => 'field_55e5b026bfc37',
        'mobile'                   => 'field_55e5b02fbfc38',
        'photo'                    => 'field_55e5b039bfc39',
        'canal'                    => 'field_55e5b05bbfc3a',
        'address'                  => 'field_55e5b069bfc3b',
        'address2'                 => 'field_55e5b073bfc3c',
        'city'                     => 'field_55e5b07ebfc3d',
        'zip_code'                 => 'field_55e5b082bfc3e',
        'state'                    => 'field_55e5b0adbfc3f',
        'country'                  => 'field_55e5b0b8bfc40',
        'status'                   => 'field_55e5b0e4bfc43',
        'secondary_school'         => 'field_55e5b0ebbfc44',
        'university'               => 'field_55e5b0f6bfc45',
        'year_graduating'          => 'field_55e5b100bfc46',
        'major_subject'            => 'field_55e5b104bfc47',
        'previous_foreign_travel'  => 'field_55e5b10fbfc48',
        'reasons'                  => 'field_55e5b11abfc49',
        'prize'                    => 'field_55e5b12cbfc4a',
        'plan_after'               => 'field_55e5b13abfc4b',
        'emergency_first_name'     => 'field_55e5b14fbfc4d',
        'emergency_last_name'      => 'field_55e5b15cbfc4e',
        'emergency_relationship'   => 'field_55e5b164bfc4f',
        'emergency_phone'          => 'field_55e5b176bfc50',
        'emergency_address'        => 'field_55e5b17dbfc51',
        'emergency_address2'       => 'field_55e5b187bfc52',
        'emergency_city'           => 'field_55e5b191bfc53',
        'emergency_zip_code'       => 'field_55e5b19cbfc54',
        'emergency_state'          => 'field_55e5b1acbfc55',
        'emergency_country'        => 'field_55e5b1bcbfc57',
        'reference_1_first_name'   => 'field_55e5b1f4bfc5a',
        'reference_1_last_name'    => 'field_55e5b204bfc5b',
        'reference_1_affilitation' => 'field_55e5b20bbfc5c',
        'reference_1_email'        => 'field_55e5b214bfc5d',
        'reference_2_first_name'   => 'field_55e5b237bfc5f',
        'reference_2_last_name'    => 'field_55e5b245bfc60',
        'reference_2_affilitation' => 'field_55e5b24cbfc61',
        'reference_2_email'        => 'field_55e5b259bfc62',
        'signature_first_name'     => 'field_55e5b270bfc64',
        'signature_last_name'      => 'field_55e5b278bfc65',
        'signature_date'           => 'field_55e5b282bfc66',
        'token'                    => 'field_55e5d3339416b',
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
    }

    update_field( $acf_mapping['applicant_status'], 'submitted', $post_id );

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
    update_field( 'healt_form', $data['healt_form'], $applicant->ID );

    // Passage du dossier en "completed"
    update_field( 'applicant_status', 'completed', $applicant->ID );

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
    $prev_status = get_field( 'applicant_status' );
    $next_status = $_POST['fields']['field_55e86af1e004f'];

    if ( $prev_status != $next_status ) {
        switch ( $next_status ) {
            case 'accepted':
                // Envoi de l'email d'acceptation
                ob_start();
                include get_stylesheet_directory() . '/email/accepted.php';
                $message = ob_get_clean();

                wp_mail( get_field( 'email' ), __( 'You are admitted', 'avignon' ), $message, array(
                    'Content-Type: text/html; charset=UTF-8'
                ) );
                break;
            case 'refused':
                // Envoi de l'email de refus
                $refused_reasons = $_POST['fields']['field_55e86b22e0050'];
                ob_start();
                include get_stylesheet_directory() . '/email/refused.php';
                $message = ob_get_clean();

                wp_mail( get_field( 'email' ), __( 'Your application has been rejected', 'avignon' ), $message, array(
                    'Content-Type: text/html; charset=UTF-8'
                ) );
                break;
            case 'completed':
                ob_start();
                include get_stylesheet_directory() . '/email/completed.php';
                $message = ob_get_clean();

                wp_mail( get_field( 'email' ), __( 'You are officially enrolled', 'avignon' ), $message, array(
                    'Content-Type: text/html; charset=UTF-8'
                ) );
                break;
        }
    }
}
add_action( 'acf/save_post', 'avignon_applicant_updated', 1 );
