<!-- <?php
use PHPUnit\Framework\TestCase;

require_once 'controllerUserData.php'; // Include the script containing the functions to test

class AuthenticationTest extends TestCase {
    protected $conn; // Connection to the test database

    protected function setUp(): void {
        // Set up the test environment, including initializing the test database connection
        // This may involve creating a temporary database or using a testing framework like PHPUnit's Database Extension
        $this->conn = new mysqli('localhost', 'username', 'password', 'test_database');

        // Handle any errors
        if ($this->conn->connect_error) {
            die('Connection failed: ' . $this->conn->connect_error);
        }
    }

    protected function tearDown(): void {
        // Clean up the test environment, including closing the database connection
        $this->conn->close();
    }

    // Test cases for signup functionality
    public function testSuccessfulSignup() {
        // Simulate a successful signup with valid input
        $_POST['FullName'] = 'John Doe';
        $_POST['Email'] = 'john@example.com';
        $_POST['ContactNumber'] = '1234567890';
        $_POST['Country'] = 'USA';
        $_POST['password'] = 'password';
        $_POST['password_confirm'] = 'password';

        // Call the signup function
        signup($this->conn);

        // Check if user was successfully inserted into the database
        $result = $this->conn->query("SELECT * FROM user WHERE Email = 'john@example.com'");
        $this->assertNotNull($result->fetch_assoc());

        // Check if verification email was sent
        // Assert that the verification email is sent (mock this behavior)
    }

    // Test cases for login functionality
    public function testSuccessfulLogin() {
        // Simulate a successful login with correct credentials
        // Insert a test user into the database with known credentials
        $password_hash = password_hash('password123', PASSWORD_BCRYPT);
        $this->conn->query("INSERT INTO user (FullName, Email, ContactNumber, Country, Password, status) VALUES ('Test User', 'test@example.com', '1234567890', 'USA', '$password_hash', 'verified')");

        // Set up $_POST with correct credentials
        $_POST['email'] = 'test@example.com';
        $_POST['password'] = 'password123';

        // Call the login function
        login($this->conn);

        // Assert that the user is redirected to the expected page
        $headers = headers_list();
        $this->assertContains('Location: home1.php', $headers);

        // Assert that the session variables are correctly set
        $this->assertEquals('Test User', $_SESSION['name']);
        $this->assertEquals('test@example.com', $_SESSION['email']);
    }

    // Add more test cases for other scenarios (incorrect password, non-existing email, etc.)

    // Test cases for error handling (invalid input data, database errors, etc.)
}

?> -->
