<?php


class Input
{
    protected static $_commands;
    protected static $_script;
    protected static $_arguments;
    protected static $_argv = [];

    public function __construct (){}

    public static function register(array $commands = [])
    {
        self::$_commands = $commands;

        global $argv;
        self::$_argv = $argv;
        self::$_script = array_slice($argv, 0, 1);
        self::$_arguments = array_slice($argv, 1);

        if (self::$_commands) {
            for ($i = 0; $i < count(self::$_arguments); $i ++){
                $line = trim(self::$_arguments[$i]);
                if (in_array($line, array_keys(self::$_commands))) {
                    call_user_func(self::$_commands[$line], self::$_arguments);
                }
            }
        }
    }

    public static function argument ($key = null)
    {
        if ($key)
            return isset(self::$_arguments[$key])
                ? self::$_arguments[$key]
                : null;

        return self::$_arguments;
    }


    public static function isin ($key)
    {
        $string = join(' ', (array) self::$_arguments);
        return strpos($string, $key) !== false;
    }

    public static function confirm ($text, $callback)
    {
        echo "$text\n\tType 'yes' to continue: ";
        $handle = fopen ("php://stdin","r");
        $line = fgets($handle);
        if(trim($line) != 'yes'){
            echo "ABORTING!\n";
            exit;
        } else {
            echo "\n";
            echo "Confirmed...\n";
        }

        if (is_callable($callback)) {
            return call_user_func($callback);
        }

    }

    public static function options ($text, $array) {}

    public static function write ($text)
    {
        print_r("$text\n");
    }

    public static function abort ()
    {
        exit;
    }
}
