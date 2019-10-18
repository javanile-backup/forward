<?php
/**
 * Short description for class
 *
 * @package   Javanile\Forward
 * @author    Francesco Bianco <bianco@javanile.org>
 * @copyright 2019 Javanile
 * @license   https://github.com/javanile/forward/blob/master/LICENSE  MIT License
 * @version   Release: 0.0.1
 * @link      https://github.com/javanile/forward
 */

use Javanile\Forward\DirectiveTest;

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
        <?php foreach ($directives as $directive) { ?>
            <?php if (DirectiveTest::check($directive)) { ?>
                <tr>
                    <td align="left" valign="top">
                        <?php DirectiveTest::process($directive, $directives); ?>
                    </td>
                </tr>
            <?php } ?>
        <?php } ?>
    </table>
</center>
</body>
</html>
