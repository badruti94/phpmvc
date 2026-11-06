<?php
declare(strict_types=1);

class Database
{
    private PDO $dbh;
    private PDOStatement $stmt;

    public function __construct()
    {
        $dsn = "pgsql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME;

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_PERSISTENT => false,
        ];

        try {
            $this->dbh = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new RuntimeException("Koneksi database gagal.");
        }
    }

    public function query(string $query): void {
        $this->stmt = $this->dbh->prepare($query);
    }

    public function bind(string $param, mixed $value, ?int $type = null) : void {
        if ($type === null){
            $type = match(true){
                is_int($value) => PDO::PARAM_INT,
                is_bool($value) => PDO::PARAM_BOOL,
                is_null($value) => PDO::PARAM_NULL,
                default => PDO::PARAM_STR,
            };
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute() : bool {
        return $this->stmt->execute();
    }

    public function resultSet() : array {
        $this->execute();
        return $this->stmt->fetchAll();
    }

    public function single() : array|false {
        $this->execute();
        return $this->stmt->fetch();
    }

    public function fetchSingle() : array|false {
        return $this->stmt->fetch();
    }

    public function rowCount() : int {
        return $this->stmt->rowCount();
    }
}