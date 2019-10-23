<?php
/**
 * Short description for class.
 *
 * @author    Francesco Bianco <bianco@javanile.org>
 * @copyright 2019 Javanile
 * @license   https://github.com/javanile/forward/blob/master/LICENSE  MIT License
 *
 * @version   Release: 0.0.1
 *
 * @link      https://github.com/javanile/forward
 */
use Javanile\Forward\Directives;

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title></title>

    <?php include __DIR__.'/style.php'; ?>
</head>
<body style="margin:0; padding:0; background-color:#FFFFFF;">
<center>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <?php if (is_array($directives) && count($directives) > 0) { ?>
            <?php foreach ($directives as $directive) { ?>
                <?php if (Directives::check($directive)) { ?>
                    <tr>
                        <td align="left" valign="top">
                            <?php Directives::process($directive, $directives); ?>

                        </td>
                    </tr>
                    <tr>
                        <td height="10" style="font-size:10px; line-height:10px;"><hr/></td>
                    </tr>
                <?php } ?>
            <?php } ?>
        <?php } ?>

        <tr>
            <td align="left" valign="top">
                <small>
                    IP of client: <!--?=$clientIp?-->
                </small>
            </td>
        </tr>

        <!-- START FOOTER -->
        <tr>
            <td align="left" valign="top">
                <div class="footer" style="clear: both; Margin-top: 10px; text-align: left; width: 100%;">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                        <tr>
                            <td class="content-block" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: left;">
                                <span class="apple-link" style="color: #999999; font-size: 12px; text-align: left;">Company Inc, 3 Abbey Road, San Francisco CA 94102</span>
                                <br> Don't like these emails? <a href="http://i.imgur.com/CScmqnj.gif" style="text-decoration: underline; color: #999999; font-size: 12px; text-align: left;">Unsubscribe</a>.
                            </td>
                        </tr>
                        <tr>
                            <td class="content-block powered-by" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: left;">
                                Powered by <a href="https://github.com/javanile/forward" style="color: #999999; font-size: 12px; text-align: left; text-decoration: none;">Javanile Forward</a>.
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
        <!-- END FOOTER -->


    </table>
</center>
</body>
</html>
