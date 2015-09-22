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
                                <h1 style="font-family: Georgia, Times, 'Times New Roman', serif; font-weight: bold; font-size: 23px; text-align: center; margin: 8px 0;">Please complete your application:</h1>
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
                        <tr width="540" height="30">
                            <td width="540" height="30" valign="top" style="background-color: #ffffff;"><img class="image_fix" src="<?php echo get_template_directory_uri(); ?>/email/img/empty.gif" alt=" " width="540" height="20" border="0" style="border:0;"></td>
                         </tr>
                        <!-- Fin titre / Sous-titre -->
                        <tr width="540">
                            <td width="540" valign="top" style="font-family: TimesNewRoman, 'Times New Roman', Times, Baskerville, Georgia, serif; font-weight: normal; font-size: 14px;">
                                <p style="color: #000; font-family: TimesNewRoman, 'Times New Roman', Times, Baskerville, Georgia, serif; font-weight: normal; font-size: 14px; line-height: 16px;">
                                    Your application is incomplete. You may complete the form at any time by using this link:<br/><br/>
                                    <a href="<?php echo $resume_url ?>" style="font-family: TimesNewRoman, 'Times New Roman', Times, Baskerville, Georgia, serif; font-weight: normal; color: #942814; text-decoration: none;"><?php echo $resume_url ?></a><br/><br/>
                                </p>
                                <p style="color: #000; font-family: TimesNewRoman, 'Times New Roman', Times, Baskerville, Georgia, serif; font-weight: normal; font-size: 14px; line-height: 16px;">
                                    Your email address <?php echo $reminder['email'] ?> is linked to this application. You may not submit another application associated with the same email address.
                                </p>
                            </td>
                        </tr>
                        <?php get_template_part( 'email/part/footer' ); ?>