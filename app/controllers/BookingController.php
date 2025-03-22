<?php
namespace App\Controllers;

use App\Models\Database;

class BookingController {
    private $db;
    private $conn;

    public function __construct() {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
    }

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        if (!isset($_GET['movie_id'])) {
            header('Location: /movies');
            exit;
        }

        $movie_id = (int)$_GET['movie_id'];
        
        // Get movie details
        $stmt = $this->conn->prepare("SELECT * FROM movies WHERE id = ?");
        $stmt->bind_param("i", $movie_id);
        $stmt->execute();
        $movie = $stmt->get_result()->fetch_assoc();

        if (!$movie) {
            require_once APP_PATH . '/views/404.php';
            exit;
        }

        // Get available showtimes
        $stmt = $this->conn->prepare("SELECT * FROM showtimes WHERE movie_id = ? AND datetime > NOW()");
        $stmt->bind_param("i", $movie_id);
        $stmt->execute();
        $showtimes = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        require_once APP_PATH . '/views/booking.php';
    }

    public function process() {
        if (!isset($_SESSION['user_id']) || !isset($_POST['showtime_id']) || !isset($_POST['seats'])) {
            header('Location: /movies');
            exit;
        }

        $user_id = $_SESSION['user_id'];
        $showtime_id = (int)$_POST['showtime_id'];
        $seats = $_POST['seats'];
        
        // Start transaction
        $this->db->query("START TRANSACTION");

        try {
            // Check seat availability
            $stmt = $this->conn->prepare("SELECT * FROM bookings WHERE showtime_id = ? AND seat IN (?)");
            $stmt->bind_param("is", $showtime_id, implode(',', $seats));
            $stmt->execute();
            
            if ($stmt->get_result()->num_rows > 0) {
                throw new \Exception("Selected seats are no longer available");
            }

            // Create booking
            foreach ($seats as $seat) {
                $stmt = $this->conn->prepare("INSERT INTO bookings (user_id, showtime_id, seat) VALUES (?, ?, ?)");
                $stmt->bind_param("iis", $user_id, $showtime_id, $seat);
                $stmt->execute();
            }

            $this->db->query("COMMIT");
            header('Location: /booking/success');
        } catch (\Exception $e) {
            $this->db->query("ROLLBACK");
            $_SESSION['error'] = $e->getMessage();
            header('Location: /booking?movie_id=' . $_POST['movie_id']);
        }
    }
} 