<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../app/models/Database.php';

try {
    $db = new App\Models\Database();
    echo "<h2>Database Connection Test</h2>";
    echo "✅ Database connection successful!<br><br>";

    // Test users table
    $result = $db->query("SELECT COUNT(*) as count FROM users");
    $userCount = $result->fetch_assoc()['count'];
    echo "<h3>Users Table:</h3>";
    echo "Total users: {$userCount}<br>";
    
    // Show users table structure
    $result = $db->query("DESCRIBE users");
    echo "<h4>Users Table Structure:</h4>";
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>{$row['Field']} - {$row['Type']}</li>";
    }
    echo "</ul>";

    // Test film_available table
    $result = $db->query("SELECT COUNT(*) as count FROM film_available");
    $filmCount = $result->fetch_assoc()['count'];
    echo "<h3>Film Available Table:</h3>";
    echo "Total films: {$filmCount}<br>";

    // Test film_upcoming table
    $result = $db->query("SELECT COUNT(*) as count FROM film_upcoming");
    $upcomingCount = $result->fetch_assoc()['count'];
    echo "<h3>Film Upcoming Table:</h3>";
    echo "Total upcoming films: {$upcomingCount}<br>";

    // Test carousel table
    $result = $db->query("SELECT COUNT(*) as count FROM carousel");
    $carouselCount = $result->fetch_assoc()['count'];
    echo "<h3>Carousel Table:</h3>";
    echo "Total carousel items: {$carouselCount}<br>";

    // Show all tables
    $result = $db->query("SHOW TABLES");
    echo "<h3>All Tables in Database:</h3>";
    echo "<ul>";
    while ($row = $result->fetch_row()) {
        echo "<li>📁 {$row[0]}</li>";
    }
    echo "</ul>";

} catch (Exception $e) {
    echo "<h2>❌ Database Error:</h2>";
    echo "<p style='color: red;'>" . $e->getMessage() . "</p>";
    
    // Check if database exists
    try {
        $conn = new mysqli('localhost', 'root', '');
        $result = $conn->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'online_movie_booking'");
        if ($result->num_rows == 0) {
            echo "<p>The database 'online_movie_booking' does not exist. Please import the SQL file.</p>";
        }
    } catch (Exception $e) {
        echo "<p>Could not connect to MySQL server. Please check if MySQL is running.</p>";
    }
} 