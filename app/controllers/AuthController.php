<?php
namespace App\Controllers;

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once(__DIR__ . '/../models/Database.php');

use App\Models\Database;
use Exception;

class AuthController {
    private $db;

    public function __construct() {
        try {
            $this->db = new Database();
        } catch (Exception $e) {
            error_log("Database connection error: " . $e->getMessage());
            throw $e;
        }
    }

    public function login($email, $password) {
        try {
            $conn = $this->db->getConnection();
            
            // Prepare statement to prevent SQL injection
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
            if (!$stmt) {
                error_log("Prepare failed: " . $conn->error);
                throw new Exception("Database error occurred");
            }

            $stmt->bind_param("s", $email);
            if (!$stmt->execute()) {
                error_log("Execute failed: " . $stmt->error);
                throw new Exception("Database error occurred");
            }

            $result = $stmt->get_result();
            
            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();
                if (password_verify($password, $user['password'])) {
                    // Remove password from user array before sending to client
                    unset($user['password']);
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['name'];
                    return [
                        'success' => true,
                        'user' => $user,
                        'message' => 'Login successful'
                    ];
                }
            }
            
            return [
                'success' => false,
                'message' => 'Invalid email or password'
            ];
        } catch (Exception $e) {
            error_log("Login error: " . $e->getMessage());
            return [
                'success' => false,
                'message' => 'An error occurred while logging in'
            ];
        }
    }

    public function signup($name, $email, $password, $confirm_password) {
        try {
            if ($password !== $confirm_password) {
                return [
                    'success' => false,
                    'message' => 'Passwords do not match'
                ];
            }

            if (strlen($password) < 6) {
                return [
                    'success' => false,
                    'message' => 'Password must be at least 6 characters long'
                ];
            }

            $conn = $this->db->getConnection();
            
            // Check if email already exists
            $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
            if (!$stmt) {
                error_log("Prepare failed: " . $conn->error);
                throw new Exception("Database error occurred");
            }

            $stmt->bind_param("s", $email);
            if (!$stmt->execute()) {
                error_log("Execute failed: " . $stmt->error);
                throw new Exception("Database error occurred");
            }

            if ($stmt->get_result()->num_rows > 0) {
                return [
                    'success' => false,
                    'message' => 'Email already exists'
                ];
            }
            
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Insert new user
            $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            if (!$stmt) {
                error_log("Prepare failed: " . $conn->error);
                throw new Exception("Database error occurred");
            }

            $stmt->bind_param("sss", $name, $email, $hashed_password);
            
            if (!$stmt->execute()) {
                error_log("Execute failed: " . $stmt->error);
                throw new Exception("Database error occurred");
            }

            if ($stmt->affected_rows > 0) {
                return [
                    'success' => true,
                    'message' => 'Account created successfully'
                ];
            } else {
                throw new Exception("No rows were inserted");
            }
        } catch (Exception $e) {
            error_log("Signup error: " . $e->getMessage());
            return [
                'success' => false,
                'message' => 'An error occurred while creating account: ' . $e->getMessage()
            ];
        }
    }

    public function logout()
    {
        try {
            // Start session if not already started
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // Clear all session variables
            $_SESSION = array();

            // Destroy the session cookie
            if (isset($_COOKIE[session_name()])) {
                setcookie(session_name(), '', time() - 3600, '/');
            }

            // Destroy the session
            session_destroy();

            return [
                'success' => true,
                'message' => 'Logged out successfully'
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Error during logout: ' . $e->getMessage()
            ];
        }
    }
}

// Handle incoming requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    
    try {
        if (!isset($_POST['action'])) {
            throw new Exception('No action specified');
        }

        $auth = new AuthController();
        $response = [];

        switch ($_POST['action']) {
            case 'login':
                if (!isset($_POST['email']) || !isset($_POST['password'])) {
                    throw new Exception('Missing required login fields');
                }
                $response = $auth->login($_POST['email'], $_POST['password']);
                break;
                
            case 'signup':
                if (!isset($_POST['name']) || !isset($_POST['email']) || 
                    !isset($_POST['password']) || !isset($_POST['re_pass'])) {
                    throw new Exception('Missing required signup fields');
                }
                $response = $auth->signup(
                    $_POST['name'],
                    $_POST['email'],
                    $_POST['password'],
                    $_POST['re_pass']
                );
                break;
                
            case 'logout':
                $response = $auth->logout();
                break;
                
            default:
                throw new Exception('Invalid action specified');
        }

        echo json_encode($response);
        exit;

    } catch (Exception $e) {
        error_log("Request error: " . $e->getMessage());
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
        exit;
    }
} 