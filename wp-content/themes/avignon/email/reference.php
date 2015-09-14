<h1>Your recommendation</h1>

<p>According to our records, you are willing to recommend <?php echo $data['first_name'] ?> <?php echo $data['last_name'] ?> for the Institut d’Avignon (Bryn Mawr Summer Institute in French Studies). Please complete this recommendation by March 1st:</p>

<p><?php echo add_query_arg( array( 'token' => $token, 'reference' => $reference ), get_permalink( AVIGNON_RECOMMENDATION_PAGE_ID ) ) ?></p>

<p>Thank you for your consideration,</p>

<p>Institut d’Avignon</p>
