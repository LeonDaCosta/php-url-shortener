<?php

class Database {

private $conn = null;

    public function connect() : void {
        $this->conn = new SQLite3(__DIR__.'/../database/shorturls.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

        $this->conn->query('CREATE TABLE IF NOT EXISTS shorturls (
            id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
            url TEXT,
            created_date DATETIME
        )');
    }

    public function createRecord() : int {
        $this->conn->exec('BEGIN');
        $created_date = date('Y-m-d H:i:s');
        $this->conn->query('INSERT INTO shorturls (id, created_date) VALUES (NULL, "' . $created_date .'" )');
        $this->conn->exec('COMMIT');

        return $this->conn->lastInsertRowID();
    }
    public function updateRecord(int $id, string $url) : bool {
        $this->conn->exec("BEGIN");
        $this->conn->query('UPDATE shorturls SET url="' . $url . '" WHERE id == ' . $id);
        $this->conn->exec("COMMIT");

        return false;
    }

    public function getRecord(int $id):  array {
        $statement = $this->conn->prepare('SELECT "url", "created_date" FROM "shorturls" WHERE "id" = ?');
        $statement->bindValue(1, $id);
        $result = $statement->execute();
        $data = $result->fetchArray(SQLITE3_ASSOC);
        $result->finalize();

        return $data !== false ? $data : [];
    }

    public function closeConnection() : void {
        $this->conn->close();
    }
}
?>