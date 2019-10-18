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

namespace Javanile\Forward;

use PHPMailer\PHPMailer\PHPMailer;
use Javanile\Forward\Directive;

class Forward
{
    /**
     *
     */
    protected $email;

    /**
     *
     */
    public function __construct($config, $headers)
    {
        if (empty($config['Hash'])) {
            die("Missing 'Hash' passphrase on configuration file.");
        }

        if (empty($headers['Token'])) {
            die("Missing or empty 'Token:' header.\n");
        }

        if (empty($headers['To'])) {
            die("Missing or empty 'To:' header.\n");
        }

        if (empty($headers['To'])) {
            die("Missing or empty 'To:' header.\n");
        }

        if (hash("sha256", strtolower($headers['To']).':'.$config['Hash']) != $headers['Token']) {
            die("Unauthorized 'Token:' in header.\n");
        }

        $directives = Directive::getDirectives();

        $this->email = new PHPMailer();
        $this->email->setFrom($config['From'], $config['Name']);
        $this->email->Subject = 'Message Subject';
        $this->email->Body = Forward::getBody($directives);
        $this->email->isHtml(true);
        $this->email->addAddress($headers['To']);

        foreach ($_FILES as $file) {
            $this->email->addAttachment($file['tmp_name'] , $file['name']);
        }
    }

    /**
     * @param $directives
     * @return string
     */
    public function getBody($directives)
    {
        ob_start();

        include __DIR__.'/../template/index.php';

        $html = ob_get_clean();

        return $html;
    }

    /**
     *
     */
    public function send()
    {
        if ($this->email->send()) {
            return "Message successful sent.\n";
        } else {
            return "Problem to send message.\n";
        }
    }
}
