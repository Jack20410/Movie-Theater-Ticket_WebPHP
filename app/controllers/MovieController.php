<?php
namespace App\Controllers;

use App\Models\Database;

class MovieController {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function index() {
        // Get list of all movies
        $result = $this->db->query("SELECT * FROM movies WHERE status = 'showing'");
        
        // Include the view
        require_once APP_PATH . '/views/movies.php';
    }

    public function show() {
        if (!isset($_GET['id'])) {
            header('Location: /movies');
            exit;
        }

        $id = (int)$_GET['id'];
        $movie = $this->db->getMovieById($id);

        if (!$movie) {
            require_once APP_PATH . '/views/404.php';
            exit;
        }

        require_once APP_PATH . '/views/movie-detail.php';
    }
} 