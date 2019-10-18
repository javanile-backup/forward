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

namespace Javanile\Forward\Directives;

class EmacsTest
{
    /**
     * @param $directive
     * @param $directives
     * @return string
     */
    public function process($directive, $directives)
    {
        if (empty($directive['file'])) {
            return 'Emacs file not attached';
        }

        $branch = isset($directives['branch']) ? $directives['branch']['data'] : 'master';
        $projectFileUrl = '';

        if (isset($directives['github']['data'])) {
            $projectFileUrl = 'https://github.com/'.$directives['github']['data'].'/blob/'.$branch.'/{file}#L{line}';
        } elseif (isset($directives['gitlab']['data'])) {
            $projectFileUrl = 'https://gitlab.com/'.$directives['github']['data'].'/blob/'.$branch.'/{file}#L{line}';
        }

        $output = '<ul>';

        $lines = explode("\n", file_get_contents($directive['file']['tmp_name']));

        foreach ($lines as $line) {
            if (!$line || !trim($line)) {
                continue;
            }

            preg_match('/^([a-z0-9_\.\/-]+):([0-9]+):([0-9]+)/i', $line, $info);

            if ($projectFileUrl) {
                $goto = str_replace(['{file}', '{line}'], [$info[1], $info[2]], $projectFileUrl);
                $line = '<a href="'.$goto.'" target="_blank">'.$info[0].'</a>'.substr($line, strlen($info[0]));
            }

            $output .= '<li>'.$line.'</li>';
        }

        $output .= '</ul>';

        return $output;
    }
}
