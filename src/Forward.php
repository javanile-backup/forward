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

namespace Javanile\Forward;

use PHPMailer\PHPMailer\PHPMailer;

class Forward
{
    /**
     *
     */
    protected $config;

    /**
     *
     */
    protected $headers;

    /**
     *
     */
    protected $email;

    /**
     *
     */
    protected $error;

    /**
     * @param mixed $settings
     */
    public function __construct($settings)
    {
        $this->config = isset($settings['config']) ? $settings['config'] : [];
        $this->headers = isset($settings['headers']) ? $settings['headers'] : [];
        $this->server = isset($settings['server']) ? $settings['server'] : [];
        $this->files = isset($settings['files']) ? $settings['files'] : [];
        $this->post = isset($settings['post']) ? $settings['post'] : [];

        $this->email = new PHPMailer();
    }

    /**
     * @return bool
     */
    public function process()
    {
        if (empty($this->config['Hash'])) {
            $this->error = "Missing 'Hash' passphrase on configuration file.";

            return false;
        }

        if (empty($this->headers['Token'])) {
            $this->error = "Missing or empty 'Token:' header.";

            return false;
        }

        if (empty($this->headers['To'])) {
            $this->error = "Missing or empty 'To:' header.";

            return false;
        }

        if (empty($this->headers['To'])) {
            $this->error = "Missing or empty 'To:' header.";

            return false;
        }

        if ($this->buildToken() != $this->headers['Token']) {
            $this->error = "Unauthorized 'Token:' in header.";

            return false;
        }

        $directives = Directives::parse($this->files, $this->post);

        $this->email->setFrom($this->config['From'], $this->config['Name']);
        $this->email->Subject = 'Message Subject';
        $this->email->Body = $this->parseBody($directives);
        $this->email->isHtml(true);
        $this->email->addAddress($this->headers['To']);

        foreach ($_FILES as $file) {
            $this->email->addAttachment($file['tmp_name'], $file['name']);
        }

        return true;
    }

    /**
     *
     */
    protected function buildToken()
    {
        return hash('sha256', strtolower($this->headers['To']).':'.$this->config['Hash']);
    }

    /**
     * @param $directives
     *
     * @return string
     */
    public function parseBody($directives)
    {
        $clientIp = $this->getClientIp();

        ob_start();

        include __DIR__.'/../template/index.php';

        return ob_get_clean();
    }

    /**
     *
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $code
     * @param mixed $response
     *
     * @return string
     */
    public function response($code, $response)
    {
        http_response_code($code);

        return json_encode($response)."\n";
    }

    /**
     * @return string
     */
    public function successResponse()
    {
        return $this->response(200, [
            'info' => 'Message successful sent.',
        ]);
    }

    /**
     * @return string
     */
    public function problemResponse()
    {
        return $this->response(200, [
            'problem' => 'Problem to send message.',
        ]);
    }

    /**
     * @return string
     */
    public function errorResponse()
    {
        return $this->response(200, [
            'error' => $this->error,
        ]);
    }

    /**
     * @param mixed $exception
     *
     * @return string
     */
    public function exceptionResponse($exception)
    {
        return $this->response(400, [
            'exception' => $exception->getMessage(),
        ]);
    }

    /**
     * @return string
     */
    public function getClientIp()
    {
        $ipaddress = '';
        if (isset($this->server['HTTP_CLIENT_IP'])) {
            $ipaddress = $this->server['HTTP_CLIENT_IP'];
        } elseif (isset($this->server['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress = $this->server['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($this->server['HTTP_X_FORWARDED'])) {
            $ipaddress = $this->server['HTTP_X_FORWARDED'];
        } elseif (isset($this->server['HTTP_FORWARDED_FOR'])) {
            $ipaddress = $this->server['HTTP_FORWARDED_FOR'];
        } elseif (isset($this->server['HTTP_FORWARDED'])) {
            $ipaddress = $this->server['HTTP_FORWARDED'];
        } elseif (isset($this->server['REMOTE_ADDR'])) {
            $ipaddress = $this->server['REMOTE_ADDR'];
        } else {
            $ipaddress = 'UNKNOWN';
        }

        return $ipaddress;
    }
}
