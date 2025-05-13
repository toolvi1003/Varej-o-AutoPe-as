<?php
class Database {
  private static $instance;
  private function __construct() {}
  public static function getInstance() {
    if (!self::$instance) {
      self::$instance = new PDO(
        "mysql:host=".DB_HOST.";dbname=".DB_NAME,
        DB_USER, DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
      );
    }
    return self::$instance;
  }
}
