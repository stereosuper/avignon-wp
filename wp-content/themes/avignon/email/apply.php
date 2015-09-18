<?php get_template_part( 'email/part/header' ); ?>
<tr width="600">
    <td width="600" valign="top">
        <table cellpadding="0" cellspacing="0" border="0" align="center" width="600" style="table-layout: fixed;">
            <tr width="600">
                <td width="30" valign="top"><img class="image_fix" src="<?php echo get_template_directory_uri(); ?>/email/img/empty.gif" alt=" " width="30" border="0" style="border:0;"></td>
                <td width="540" valign="top">
                    <table cellpadding="0" cellspacing="0" border="0" align="center" width="540" style="table-layout: fixed;">
                        <!-- Titre / Sous-titre -->
                        <tr width="540" height="40">
                            <td width="540" height="40" valign="top" style="background-color: #ffffff;"><img class="image_fix" src="<?php echo get_template_directory_uri(); ?>/email/img/empty.gif" alt=" " width="540" height="40" border="0" style="border:0;"></td>
                        </tr>
                        <tr width="540">
                            <td width="540" valign="top" style="font-family: Georgia, Times, 'Times New Roman', serif; font-weight: bold; font-size: 23px; text-align: center;">
                                <h1 style="font-family: Georgia, Times, 'Times New Roman', serif; font-weight: bold; font-size: 23px; text-align: center; margin: 8px 0;">Thank you!</h1>
                            </td>
                        </tr>
                        <tr width="540" height="5">
                            <td width="540" height="5" valign="top" style="background-color: #ffffff;"><img class="image_fix" src="<?php echo get_template_directory_uri(); ?>/email/img/empty.gif" alt=" " width="540" height="5" border="0" style="border:0;"></td>
                        </tr>
                        <tr width="540" height="1">
                            <td width="540" height="1" valign="top">
                                <table cellpadding="0" cellspacing="0" border="0" align="center" width="540" height="1" style="table-layout: fixed;">
                                    <tr width="540" height="1">
                                        <td width="50" height="1" valign="top" style="background-color: #ffffff;"><img class="image_fix" src="<?php echo get_template_directory_uri(); ?>/email/img/empty.gif" alt=" " width="50" height="1" border="0" style="border:0;"></td>
                                        <td width="440" height="1" valign="top" style="background-color: #d5d9da;"><img class="image_fix" src="<?php echo get_template_directory_uri(); ?>/email/img/empty.gif" alt=" " width="440" height="1" border="0" style="border:0;"></td>
                                        <td width="50" height="1" valign="top" style="background-color: #ffffff;"><img class="image_fix" src="<?php echo get_template_directory_uri(); ?>/email/img/empty.gif" alt=" " width="50" height="1" border="0" style="border:0;"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr width="540">
                            <td width="540" valign="top" style="font-family: Georgia, Times, 'Times New Roman', serif; font-weight: normal; font-size: 18px; text-align: center;">
                                <h2 style="font-family: Georgia, Times, 'Times New Roman', serif; font-weight: normal; font-size: 18px; text-align: center; margin: 8px 0;">Your application has been submitted</h2>
                            </td>
                        </tr>
                        <tr width="540" height="30">
                            <td width="540" height="30" valign="top" style="background-color: #ffffff;"><img class="image_fix" src="<?php echo get_template_directory_uri(); ?>/email/img/empty.gif" alt=" " width="540" height="20" border="0" style="border:0;"></td>
                         </tr>
                        <!-- Fin titre / Sous-titre -->
                        <tr width="540">
                            <td width="540" valign="top" style="font-family: TimesNewRoman, 'Times New Roman', Times, Baskerville, Georgia, serif; font-weight: normal; font-size: 14px;">
                                <p style="color: #000; font-family: TimesNewRoman, 'Times New Roman', Times, Baskerville, Georgia, serif; font-weight: normal; font-size: 14px; line-height: 16px;">Please complete these steps in order to be officially enrolled:</p>
                                <ol style="padding: 20px 0 0; font-family: TimesNewRoman, 'Times New Roman', Times, Baskerville, Georgia, serif; font-weight: normal; font-size: 14px; padding: 0 0 0 17px; line-height: 16px;">
                                    <li style="color: #000; padding: 15px 0; font-family: TimesNewRoman, 'Times New Roman', Times, Baskerville, Georgia, serif; font-weight: normal; font-size: 14px; line-height: 16px;">
                                        <strong style="font-weight: bold;">Your recommenders (French professor and dean, or graduate advisor)</strong> should have received a recommendation request by email. Please confirm that they have received a request from us. If not, they may access the information via this link:<br/><br/>
                                        <?php echo $data['reference_1_complete_name'] ?>: <a href="<?php echo add_query_arg( array( 'token' => $token, 'reference' => 1 ), get_permalink( AVIGNON_RECOMMENDATION_PAGE_ID ) ) ?>" style="font-family: TimesNewRoman, 'Times New Roman', Times, Baskerville, Georgia, serif; font-weight: normal; color: #942814; text-decoration: none;"><?php echo add_query_arg( array( 'token' => $token, 'reference' => 1 ), get_permalink( AVIGNON_RECOMMENDATION_PAGE_ID ) ) ?></a><br/>
                                        <?php echo $data['reference_2_complete_name'] ?>: <a href="<?php echo add_query_arg( array( 'token' => $token, 'reference' => 2 ), get_permalink( AVIGNON_RECOMMENDATION_PAGE_ID ) ) ?>" style="font-family: TimesNewRoman, 'Times New Roman', Times, Baskerville, Georgia, serif; font-weight: normal; color: #942814; text-decoration: none;"><?php echo add_query_arg( array( 'token' => $token, 'reference' => 2 ), get_permalink( AVIGNON_RECOMMENDATION_PAGE_ID ) ) ?></a><br/><br/>
                                        <strong style="font-weight: bold;">NB: please don’t forget to have your official transcripts mailed to us!</strong> (mailing address: see below)
                                    </li>
                                    <li style="color: #000; padding: 15px 0; font-family: TimesNewRoman, 'Times New Roman', Times, Baskerville, Georgia, serif; font-weight: normal; font-size: 14px; line-height: 16px;">
                                        Once you have provided all required materials, including your recommendations and transcripts, your application will be considered for enrollment. 
                                        <em style="font-style: italic;line-height: 16px;">You will be notified by email whether your application has been accepted or rejected.</em>
                                    </li>
                                    <li style="color: #000; padding: 15px 0; font-family: TimesNewRoman, 'Times New Roman', Times, Baskerville, Georgia, serif; font-weight: normal; font-size: 14px; line-height: 16px;">
                                        If your application has been accepted, you will still need to provide us with a signed health evaluation from your primary care doctor in order for you to be officially enrolled in the program.<br/><br/>
                                        Here is the Health Evaluation Form to be completed by you and your doctor: <a href="<?php the_field( 'health_evaluation_file', 'options' ) ?>" style="font-family: TimesNewRoman, 'Times New Roman', Times, Baskerville, Georgia, serif; font-weight: normal; color: #942814; text-decoration: none;"><?php the_field( 'health_evaluation_file', 'options' ) ?></a><br/><br/>
                                        Once this form is submitted, you will receive a link to upload this document.
                                    </li>
                                </ol>
                            </td>
                        </tr>
                        <?php get_template_part( 'email/part/footer' ); ?>