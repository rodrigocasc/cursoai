<?php

namespace App\core;

use App\handlers\HandlerException;
use Exception;

    class Migrations extends Database {
        
        public static function auto(string $fileSQL): void {
            try {
                $file = file_get_contents("app/migrations/$fileSQL");
                if(!$file) {
                    throw new Exception("Não foi possível encontrar arquivo de migração.");
                }
                $migration = str_replace(["CREATE TABLE", "INSERT INTO"], ["CREATE TABLE IF NOT EXISTS", "REPLACE INTO"], $file);
                self::getInstance()->query($migration);
                
            } catch (\Throwable $th) {
                throw new HandlerException($th->getMessage(), 500);
            }
        }
    }