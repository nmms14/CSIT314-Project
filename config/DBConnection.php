<?php

class DBConnection {
    private const HOST = 'localhost';
    private const USER = 'root';
    private const PASS = '';
    private const NAME = 'csit314';

    private static ?mysqli $instance = null;

    public static function getInstance(): mysqli {
        if (self::$instance === null) {
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            self::$instance = new mysqli(self::HOST, self::USER, self::PASS, self::NAME);
            self::$instance->set_charset('utf8mb4');
        }
        return self::$instance;
    }
}
