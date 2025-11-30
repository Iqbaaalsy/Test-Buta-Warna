<?php
session_start();

// Pastikan sesuai dengan konfigurasi database Anda
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'tugaspi';

$message = ''; // Pesan untuk kesalahan login

// Jika formulir login dikirimkan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Koneksi ke database
    $conn = new mysqli($host, $username, $password, $database);

    // Periksa koneksi
    if ($conn->connect_error) {
        die("Koneksi ke database gagal: " . $conn->connect_error);
    }

    // Ambil data dari form login
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Lindungi dari SQL Injection
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    // Query untuk mencari admin berdasarkan username dan password
    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    // Periksa apakah hasil query menghasilkan satu baris data
    if ($result->num_rows > 0) {
        // Menyimpan informasi login dalam sesi
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("Location: admin.php");
    } else {
        $message = "Username atau password salah.";
    }

    // Tutup koneksi
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f0f0;
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            max-width: 400px;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-container:hover {
            transform: translateY(-5px);
            box-shadow: 0px 15px 25px rgba(0, 0, 0, 0.15);
        }

        .login-heading {
            margin-bottom: 30px;
            font-size: 28px;
            font-weight: bold;
            color: #333333;
        }

        .login-form .form-control {
            border: none;
            border-radius: 25px;
            padding: 18px 24px;
            margin-bottom: 20px;
            background-color: #f8f9fa;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
            font-size: 16px;
            color: #555555;
        }

        .login-form .form-control:focus {
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.2);
            background-color: #ffffff;
        }

        .login-form .btn {
            border-radius: 25px;
            padding: 14px 20px;
            font-size: 18px;
            font-weight: bold;
            background-color: blue;
            border: none;
            width: 100%;
            transition: all 0.3s;
            color: #ffffff;
        }

        .login-form .btn:hover {
            background-color: blue;
            transform: translateY(-3px);
        }

        .social-icons {
            margin-top: 20px;
        }

        .social-icons a {
            display: inline-block;
            color: #ffffff;
            font-size: 24px;
            margin: 0 10px;
            transition: transform 0.3s;
        }

        .social-icons a:hover {
            transform: translateY(-3px);
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2 class="login-heading">Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="login-form">
            <div class="mb-3">
                <input type="text" id="username" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <input type="password" id="password" name="password" class="form-control" placeholder="Password"
                    required>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn">Login</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <!-- Script to show console log if there is an error message -->
    <script>
        <?php if (!empty($message)): ?>
            console.log("<?php echo $message; ?>");
        <?php endif; ?>
    </script>
</body>

</html>
