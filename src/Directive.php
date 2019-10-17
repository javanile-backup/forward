<?php

namespace Javanile\Forward;

class Directive
{
    /**
     * @var array
     */
    protected static $directives = [
        'file' => 'Javanile\\Forward\\Directives\\File',
        'report' => 'Javanile\\Forward\\Directives\\Report',
    ];

    /**
     * @return array
     */
    public static function getDirectives()
    {
        $directives = [];

        foreach ($_POST as $name => $data) {
            $type = self::getTypeByName($name);
            $directives[$name] = [
                'name' => $name,
                'type' => $type,
                'data' => $data,
            ];
        }

        foreach ($_FILES as $name => $file) {
            $type = self::getTypeByName($name);
            $directives[$name] = [
                'name' => $name,
                'type' => $type,
                'file' => $file,
            ];
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

        call_user_func_array([$directiveObject, 'process'], func_get_args());
    }

    /**
     *
     */
    public static function getTypeByName($name)
    {
        return $name;
    }
}
