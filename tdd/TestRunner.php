<?php

require_once __DIR__ . '/../vendor/autoload.php';

class TestRunner
{
    public static function main()
    {
        $command = "C:\\xampp\\php\\php.exe vendor\\bin\\phpunit tdd\\AuthenticationTest.php";

        $output = [];
        $resultCode = 0;

        exec($command, $output, $resultCode);

        echo "<pre>";

        foreach ($output as $line) {
            echo $line . PHP_EOL;
        }

        echo PHP_EOL;

        if ($resultCode == 0) {
            echo "Is the test successful?: True";
        } else {
            echo "Is the test successful?: False";
        }

        echo "</pre>";
    }
}

TestRunner::main();