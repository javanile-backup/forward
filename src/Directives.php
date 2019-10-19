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

class Directives
{
    /**
     * @var array
     */
    protected static $directives = [
        'file'   => 'Javanile\\Forward\\Directives\\File',
        'emacs'  => 'Javanile\\Forward\\Directives\\Emacs',
        'report' => 'Javanile\\Forward\\Directives\\Report',
    ];

    /**
     * @return array
     */
    public static function parse($files, $post)
    {
        $directives = [];

        foreach ($post as $name => $data) {
            self::appendData($directives, $name, $data);
        }

        foreach ($files as $name => $file) {
            if (!is_array($file['name'])) {
                self::appendFile($directives, $name, $file);
                continue;
            }
            foreach (self::splitFiles($name, $file) as $subName => $subFile) {
                self::appendFile($directives, $subName, $subFile);
            }
        }

        return $directives;
    }

    /**
     * @param $directive
     */
    public static function check($directive)
    {
        if (empty($directive) || empty($directive['type']) || empty(self::$directives[$directive['type']])) {
            return false;
        }

        return class_exists(self::$directives[$directive['type']]);
    }

    /**
     * @param $directive
     */
    public static function process($directive, $directives)
    {
        $directiveClass = self::$directives[$directive['type']];
        $directiveObject = new $directiveClass();

        echo call_user_func_array([$directiveObject, 'process'], func_get_args());
    }

    /**
     * @param $files
     */
    public static function splitFiles($name, $files)
    {
        $filesList = [];

        foreach ($files as $key => $values) {
            foreach ($values as $subName => $value) {
                $filesList[$name.'['.$subName.']'][$key] = $value;
            }
        }

        return $filesList;
    }

    /**
     * @param $directives
     * @param $name
     * @param $file
     */
    public static function appendFile(&$directives, $name, $file)
    {
        $type = self::getTypeByName($name);
        $directives[$name] = [
            'name' => $name,
            'type' => $type,
            'file' => $file,
        ];
    }

    /**
     * @param $directives
     * @param $name
     * @param $file
     */
    public static function appendData(&$directives, $name, $data)
    {
        $directives[$name] = [
            'name' => $name,
            'type' => self::getTypeByName($name),
            'data' => $data,
        ];
    }

    /**
     *
     */
    public static function getTypeByName($name)
    {
        preg_match('/^[a-z]+/i', $name, $info);

        return isset($info[0]) && $info[0] ? $info[0] : 'none';
    }

    /**
     *
     */
    public static function getFileSchema($file)
    {
        return [
            'name' => basename($file),
            'type' => 'text/plain',
            'tmp_name' => $file,
            'error' => 0,
            'size' => filesize($file),
        ];
    }

    /**
     *
     */
    public static function getFilesSchema($files)
    {
        $filesSchema = [
            'name' => [],
            'type' => [],
            'tmp_name' => [],
            'error' => [],
            'size' => [],
        ];

        foreach ($files as $name => $file) {
            $fileSchema = self::getFileSchema($file);
            foreach ($fileSchema as $key => $value) {
                $filesSchema[$key][$name] = $value;
            }
        }

        return $filesSchema;
    }
}
