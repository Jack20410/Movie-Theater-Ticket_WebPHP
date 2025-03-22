<?php
namespace App\Controllers;

class HomeController {
    public function index() {
        try {
            // Get movies data
            $db = new \App\Models\Database();
            
            // Get now showing movies from film_available table
            $showing = $db->query("SELECT * FROM film_available");
            if (!$showing) {
                error_log("Error fetching showing movies: " . $db->getConnection()->error);
            }
            
            // Get upcoming movies from film_upcoming table
            $upcoming = $db->query("SELECT * FROM film_upcoming");
            if (!$upcoming) {
                error_log("Error fetching upcoming movies: " . $db->getConnection()->error);
            }

            // Debug information
            error_log("Showing movies count: " . ($showing ? $showing->num_rows : 0));
            error_log("Upcoming movies count: " . ($upcoming ? $upcoming->num_rows : 0));
            
            // Pass data to the view
            $data = [
                'showing' => $showing,
                'upcoming' => $upcoming
            ];
            
            // Include the movies view
            extract($data);
            require_once APP_PATH . '/views/movies.php';
        } catch (\Exception $e) {
            error_log("Error in HomeController: " . $e->getMessage());
            // Show a user-friendly error message
            echo "An error occurred. Please try again later.";
        }
    }
} 