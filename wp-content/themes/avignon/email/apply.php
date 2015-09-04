<<<<<<< HEAD
<h1>Merci ! </h1>

<p>Votre pré-inscription à bien été enregistrée. Il reste encore quelques étapes pour finaliser cette inscription :</p>

<ol>
    <li>
        <p><strong>Réception des recommandations (votre professeur de français, et directeur des études ou conseiller pédagogique)</strong></p>
        <p>Un email à été envoyé aux “recommanders” que vous avez renseignés dans le formulaire de pré-inscription. Assurez vous qu’il aient bien reçu cet email. Si ce n’est pas le cas, voici le lien à leur transmettre : </p>
        <p><?php echo $data['refrence_1_first_name'] ?> <?php echo $data['refrence_1_last_name'] ?> : <?php echo add_query_args( array( 'token' => $data['token'], 'reference' => 1 ), get_permalink( AVIGNON_RECOMMENDATION_PAGE_ID ) ) ?></p>
        <p><?php echo $data['refrence_2_first_name'] ?> <?php echo $data['refrence_2_last_name'] ?> : <?php echo add_query_args( array( 'token' => $data['token'], 'reference' => 2 ), get_permalink( AVIGNON_RECOMMENDATION_PAGE_ID ) ) ?></p>

        <p>En parallèle, n’oubliez pas d’envoyer par courrier postal vos “officials transcripts” ! (à l’adresse indiquée en bas de ce mail)</p>
    </li>
    <li>
        <p>Une fois les recommandations et “transcripts” reçues, l’institut vérifie la conformité de votre demande et accepte ou refuse votre candidature. </p>
        <p>En cas de refus, l’institut vous donnera les raisons de ce refus.</p>
    </li>
    <li>
        <p>Une fois votre inscription acceptée, il vous restera à fournir un certificat médical. </p>
        <p>Le document à remplir (par vous et votre médecin) est disponible ici : [ lien url généré automatiquement ]</p>
        <p>Le lien pour uploader ce document vous sera communiqué ultérieurement.</p>
    </li>
</ol>

<p>L’institut d’Avignon</p>
=======
<h1>Thank you!</h1>

<p>Your application has been submitted. Please complete these steps in order to be officially enrolled:</p>

<ol>
    <li>
        <p>Your recommenders (French professor and dean, or graduate advisor) should have received a recommendation request by email. Please confirm that they have received a request from us. If not, they may access the information via this link:</strong></p>
        <p><?php echo $data['reference_1_first_name'] ?> <?php echo $data['reference_1_last_name'] ?> : <?php echo add_query_arg( array( 'token' => $data['token'], 'reference' => 1 ), get_permalink( AVIGNON_RECOMMENDATION_PAGE_ID ) ) ?></p>
        <p><?php echo $data['reference_2_first_name'] ?> <?php echo $data['reference_2_last_name'] ?> : <?php echo add_query_arg( array( 'token' => $data['token'], 'reference' => 2 ), get_permalink( AVIGNON_RECOMMENDATION_PAGE_ID ) ) ?></p>

        <p>NB: please don’t forget to have your official transcripts mailed to us! (mailing address: see below)</p>
    </li>
    <li>
        <p>Once you have provided all required materials, including your recommendations and transcripts, your application will be considered for enrollment. You will be notified by email whether your application has been accepted or rejected. </p>
    </li>
    <li>
        <p>If your application has been accepted, you will still need to provide us with a signed health evaluation from your primary care doctor in order for you to be officially enrolled in the program.</p>
        <p>Here is the Health Evaluation Form  (or health clearance form?) to be completed by you and your doctor: [ lien url généré automatiquement ]</p>
        <p>Once this form is submitted, you will receive a link to upload this document.</p>
    </li>
</ol>

<p>Institut d’Avignon</p>
>>>>>>> origin/master
