<h1>Thank you!</h1>

<p>Your application has been submitted. Please complete these steps in order to be officially enrolled:</p>

<ol>
    <li>
        <p><strong>Your recommenders (French professor and dean, or graduate advisor) should have received a recommendation request by email. Please confirm that they have received a request from us. If not, they may access the information via this link:</strong></p>
        <p><?php echo $data['reference_1_first_name'] ?> <?php echo $data['reference_1_last_name'] ?> : <?php echo add_query_arg( array( 'token' => $token, 'reference' => 1 ), get_permalink( AVIGNON_RECOMMENDATION_PAGE_ID ) ) ?></p>
        <p><?php echo $data['reference_2_first_name'] ?> <?php echo $data['reference_2_last_name'] ?> : <?php echo add_query_arg( array( 'token' => $token, 'reference' => 2 ), get_permalink( AVIGNON_RECOMMENDATION_PAGE_ID ) ) ?></p>

        <p>NB: please don’t forget to have your official transcripts mailed to us! (mailing address: see below)</p>
    </li>
    <li>
        <p>Once you have provided all required materials, including your recommendations and transcripts, your application will be considered for enrollment. You will be notified by email whether your application has been accepted or rejected. </p>
    </li>
    <li>
        <p>If your application has been accepted, you will still need to provide us with a signed health evaluation from your primary care doctor in order for you to be officially enrolled in the program.</p>
        <p>Here is the Health Evaluation Form  (or health clearance form?) to be completed by you and your doctor: <?php echo add_query_arg( 'token', $token, get_permalink( AVIGNON_HEALTH_EVALUATION_PAGE_ID ) ) ?></p>
        <p>Once this form is submitted, you will receive a link to upload this document.</p>
    </li>
</ol>

<p>Institut d’Avignon</p>
