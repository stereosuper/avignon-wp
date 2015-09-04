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
