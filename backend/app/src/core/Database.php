<?php

namespace App\core;

use App\handlers\HandlerException;
use Exception;
use PDO;
use PDOStatement;

require __DIR__ . "/../../../config.php";

class Database {

    private string $query;

    private static Database | null $instance = null;

    public static function getInstance(): self {

        if(null === static::$instance) {
            static::$instance = new self();
        }

        return static::$instance;
    }

    private function __construct() {
        $this->doCon();
    }

    private function doCon(): void {
        try {
            $this->con();

        } catch (\Throwable $th) {
            throw $th;
        }
    }
    
    private function con(): PDO {
        try {
            global $config;
            $host = $config['host'];
            $port = $config['port'];
            $dbuser = $config['user'];
            $dbpassword = $config['password'];

            $pdo = new PDO("mysql:host=$host:$port;dbname=cursoai", "$dbuser", "$dbpassword");
            return $pdo;
            
        } catch (\Throwable $th) {
            $pdo = new PDO("mysql:host=$host:$port;", "$dbuser", "$dbpassword");
            return $pdo;
        }
    }

    protected function query(string $query): PDOStatement {
        try {
            $pdo = $this->con();
            return $pdo->query($query);

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    protected function insert(array $columnsAndValues, string $table): void {
        try {
            $pdo = $this->con();
            $columns = implode(", ", array_keys($columnsAndValues));
            $values = implode(", :", array_keys($columnsAndValues));
            
            $pdo->prepare("INSERT INTO $table ($columns) VALUES (:$values)")->execute($columnsAndValues);

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    protected function update(array $columnsAndValues, string $table, string $where): void {
        try {
            $pdo = $this->con();
            $set = implode("=?, ", array_keys($columnsAndValues));

            $pdo->prepare("UPDATE $table SET $set = ? WHERE $where")->execute(array_values($columnsAndValues));
            $pdo->prepare("UPDATE $table SET updated_at = ? WHERE $where")->execute([date('Y-m-d H:i:s')]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    protected function delete(string $table, string $where): void {
        try {
            $pdo = $this->con();
            
            $pdo->prepare("UPDATE $table SET deleted_at = ? WHERE $where")->execute([date('Y-m-d H:i:s')]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    protected function deletePermanent(string $table): self {
        try {
            $this->query = "DELETE FROM $table";
            return $this;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    protected function select(string $columns, string $table): self {
        $this->query = "SELECT $columns FROM $table";
        return $this;
    }

    protected function where(string $column): self {
        $this->query = $this->query . " WHERE $column";
        return $this;
    }

    protected function equals(string | int $value): self {
        $this->query = $this->query . " = '$value'";
        return $this;
    }

    protected function like(string $value): self {
        $this->query = $this->query . " LIKE '%$value%'";
        return $this;
    }

    protected function and(string $condition): self {
        $this->query = $this->query . " AND $condition";
        return $this;
    }

    protected function orderDesc(string $column): self {
        $this->query = $this->query . " ORDER BY $column DESC";
        return $this;
    }

    protected function orderAsc(string $column): self {
        $this->query = $this->query . " ORDER BY $column ASC";
        return $this;
    }

    protected function isNull(): self {
        $this->query = $this->query . " IS NULL";
        return $this;
    }

    protected function toArray(): array {
        try {
            $pdo = $this->con();
            $array = $pdo->query($this->query)->fetchAll(PDO::FETCH_ASSOC);
            return $array;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    protected function toSingle(): array | null {
        $pdo = $this->con();
        $array = $pdo->query($this->query)->fetchAll(PDO::FETCH_ASSOC)[0];
        return $array;
    }

    protected function toExecute(): void {
        $pdo = $this->con();
        $pdo->query($this->query)->execute();
    }
}