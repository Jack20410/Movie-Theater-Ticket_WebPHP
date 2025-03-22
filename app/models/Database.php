<?php
namespace App\Models;

class Database {
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'online_movie_booking';
    private $conn;

    public function __construct() {
        try {
            $this->conn = new \mysqli($this->host, $this->username, $this->password, $this->database);
            if ($this->conn->connect_error) {
                throw new \Exception("Connection failed: " . $this->conn->connect_error);
            }
        } catch (\Exception $e) {
            error_log("Database connection error: " . $e->getMessage());
            throw $e;
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function query($sql) {
        try {
            $result = $this->conn->query($sql);
            if ($result === false) {
                throw new \Exception("Query failed: " . $this->conn->error);
            }
            return $result;
        } catch (\Exception $e) {
            error_log("Query error: " . $e->getMessage());
            throw $e;
        }
    }

    public function getShowingMovies() {
        return $this->query("SELECT * FROM film_available ORDER BY id DESC");
    }

    public function getUpcomingMovies() {
        return $this->query("SELECT * FROM film_upcoming ORDER BY release_date ASC");
    }

    public function getMovieById($id, $type = 'showing') {
        $table = $type === 'showing' ? 'film_available' : 'film_upcoming';
        $stmt = $this->conn->prepare("SELECT * FROM $table WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getUserByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function createUser($name, $email, $password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashed_password);
        return $stmt->execute();
    }

    public function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
} 