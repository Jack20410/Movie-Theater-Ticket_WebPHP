<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../app/models/Database.php';
require_once '../app/controllers/AuthController.php';

try {
    $db = new App\Models\Database();
    echo "<h2>Database and Authentication Test</h2>";
    echo "✅ Database connection successful!<br><br>";

    // Check if users table exists
    $result = $db->query("SHOW TABLES LIKE 'users'");
    if ($result->num_rows > 0) {
        echo "✅ Users table exists!<br>";

        // Check table structure
        $result = $db->query("DESCRIBE users");
        echo "<h3>Users Table Structure:</h3>";
        while ($row = $result->fetch_assoc()) {
            echo "{$row['Field']} - {$row['Type']}<br>";
        }

        // Count users
        $result = $db->query("SELECT COUNT(*) as count FROM users");
        $count = $result->fetch_assoc()['count'];
        echo "<br>Total users in database: {$count}<br>";

        // Show existing users (without passwords)
        $result = $db->query("SELECT id, name, email FROM users");
        echo "<h3>Existing Users:</h3>";
        echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
        echo "<tr><th>ID</th><th>Name</th><th>Email</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['email']}</td>";
            echo "</tr>";
        }
        echo "</table>";

        // Test signup functionality
        echo "<h3>Testing Signup:</h3>";
        $auth = new App\Controllers\AuthController();
        
        // Test case 1: New user signup
        $testUser = [
            'name' => 'Test User',
            'email' => 'test_' . time() . '@example.com',
            'password' => 'password123',
            're_pass' => 'password123'
        ];
        
        echo "Testing signup with:<br>";
        echo "Name: {$testUser['name']}<br>";
        echo "Email: {$testUser['email']}<br>";
        echo "Password: {$testUser['password']}<br>";
        echo "Confirm Password: {$testUser['re_pass']}<br><br>";
        
        $result = $auth->signup($testUser['name'], $testUser['email'], $testUser['password'], $testUser['re_pass']);
        echo "Signup Result: ";
        echo "<pre>" . print_r($result, true) . "</pre>";

        // Test case 2: Duplicate email
        echo "<br>Testing duplicate email signup:<br>";
        $result = $auth->signup($testUser['name'], $testUser['email'], $testUser['password'], $testUser['re_pass']);
        echo "Duplicate Signup Result: ";
        echo "<pre>" . print_r($result, true) . "</pre>";

        // Test login functionality
        echo "<h3>Testing Login:</h3>";
        
        // Test case 1: Valid login
        echo "Testing valid login:<br>";
        $result = $auth->login($testUser['email'], $testUser['password']);
        echo "Login Result: ";
        echo "<pre>" . print_r($result, true) . "</pre>";

        // Test case 2: Invalid password
        echo "<br>Testing invalid password:<br>";
        $result = $auth->login($testUser['email'], 'wrongpassword');
        echo "Invalid Password Result: ";
        echo "<pre>" . print_r($result, true) . "</pre>";

        // Test case 3: Non-existent user
        echo "<br>Testing non-existent user:<br>";
        $result = $auth->login('nonexistent@example.com', 'password123');
        echo "Non-existent User Result: ";
        echo "<pre>" . print_r($result, true) . "</pre>";

    } else {
        echo "❌ Users table does not exist!<br>";
        echo "Creating users table...<br>";
        
        // Create users table
        $sql = "CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        
        $db->query($sql);
        echo "✅ Users table created successfully!<br>";
    }

    // Show all tables
    $result = $db->query("SHOW TABLES");
    echo "<h3>All Tables in Database:</h3>";
    while ($row = $result->fetch_row()) {
        echo "📁 {$row[0]}<br>";
    }

} catch (Exception $e) {
    echo "<h2>❌ Error:</h2>";
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