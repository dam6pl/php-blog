<?php
declare(strict_types=1);

namespace Core;

use PDO;
use App\Config;

abstract class AModel
{
    /**
     * Get the PDO database connection
     *
     * @return PDO
     */
    protected static function getDB(): PDO
    {
        static $db = null;

        if ($db === null) {
            $dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8';
            $db = new PDO($dsn, Config::DB_USER, Config::DB_PASS);

            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $db;
    }
}