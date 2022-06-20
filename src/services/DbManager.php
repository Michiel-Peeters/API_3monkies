<?php

namespace App\services;

use PDO;
use PDOException;

class DbManager {

    private $db;

    public function __construct() {
        $this->db = $this->connectDB();
    }

    private function connectDB() {
        try {
            $db = new PDO('mysql:host=185.115.218.166;dbname=fs_michiel_ew', 'fs_michiel', 'sVzuD5JBFu8M');
            return $db;
        } catch (PDOException $error) {
            print 'ERROR' . $error->getMessage() . '<br/>';
            die();
        }
    }

    public function getSQL($query) {
        try {
            $conn = $this->connectDB();
            $result = $conn->query($query);

            return $result->rowCount() > 0 ? $result->fetchAll(PDO::FETCH_ASSOC) : [];
        } catch (PDOException $exc) {
            print 'ERROR' . $error->getMessage() . '<br/>';
        }
    }

    private function env(string $string) {
    }



}