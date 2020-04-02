<?php

include_once './src/Input.php';


$commands = [
    'build' => function(array $args){
        Input::write("Builder in process...");
        if (Input::isin('build prod')) {
            Input::write("Building production distribution is finished!");
        } else {
            Input::write("Launched Development mode...");
        }
    },
    '-h' => function(array $args){
        Input::write("Help:\n\tbuild - Run builder [prod]\n\t-v - Show version\n\t-h - This help");
    },
    '-v' => function(array $args){
        Input::write("Version: 0.1");
    },
    '-z' => function () {
        Input::write("Default");
    },
];



if (empty(Input::argument())) {
    Input::write("Reload");
    $result = shell_exec('php ./index.php -h');
    Input::write($result);
}

Input::register($commands);
Input::abort();


//
