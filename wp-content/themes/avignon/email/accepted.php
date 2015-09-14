<h1>Congratulations!</h1>

<p>Your application was accepted.</p>

<h2>Health evaluation</h2>

<p>You still need to provide us with a signed health evaluation for you to be officially enrolled in the program.</p>

<p>Here is the health evaluation form to be completed by you and your doctor:</p>

<p><?php echo get_permalink( AVIGNON_HEALTH_EVALUATION_PAGE_ID ) ?></p>

<p>Une fois ce document rempli, vous pouvez nous le faire parvenir via le formulaire prévu a cet effet : </p>

<p><?php echo add_query_arg( 'token', $token, get_permalink( AVIGNON_HEALTH_EVALUATION_PAGE_ID ) ) ?></p>

<h2>Information for admitted students</h2>

<p>Here are some helpful tips on the best way to prepare for your trip to France: <?php echo get_permalink( AVIGNON_INFORMATIONS_PAGE_ID ) ?></p>

<h2>Housing</h2>

<p>Please complete the housing form ASAP. Some options have limited availability and students’ preferences are handled on a first come first served basis: <?php echo get_permalink( AVIGNON_HOUSING_PAGE_ID ) ?></p>

<p>Institut d’Avignon</p>
