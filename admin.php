<?php
session_start();

// Periksa apakah pengguna telah login
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}

// Database connection
$servername = "localhost";  // Sesuaikan dengan konfigurasi Anda
$username = "root";         // Sesuaikan dengan konfigurasi Anda
$password = "";             // Sesuaikan dengan konfigurasi Anda
$dbname = "tugaspi";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Menangani penghapusan entri
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM buta_warna WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Menangani pembaruan entri
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['id'];
    $jenis = $_POST['jenis'];
    $jawaban = $_POST['jawaban'];
    $file = $_FILES['file'];
    // Jika file di-upload
    if (!empty($file['name'])) {
        $target_dir = "img/";
        $target_file = $target_dir . basename($file["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($file["tmp_name"]);
        if ($check === false) {
            echo "File bukan gambar.";
            $uploadOk = 0;
        }
        if ($file["size"] > 5000000) {
            echo "Maaf, ukuran file terlalu besar.";
            $uploadOk = 0;
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "Maaf, hanya file JPG, JPEG, dan PNG yang diperbolehkan.";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            echo "Maaf, file Anda tidak dapat diunggah.";
        } else {
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                $file_path = $target_file;
            } else {
                echo "Maaf, terjadi kesalahan saat mengunggah file.";
                $file_path = $_POST['old_file']; // Menjaga file lama jika gagal diunggah
            }
        }
    } else {
        $file_path = $_POST['old_file']; // Menjaga file lama jika tidak ada file baru
    }
    $sql = "UPDATE buta_warna SET file = ?, jenis = ?, jawaban = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $file_path, $jenis, $jawaban, $id);
    $stmt->execute();
    $stmt->close();
}

// Menangani penambahan entri baru
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['update'])) {
    $jenis = $_POST['jenis'];
    $jawaban = $_POST['jawaban'];
    $file = $_FILES['file'];
    // Jika file di-upload
    if (!empty($file['name'])) {
        $target_dir = "img/";
        $target_file = $target_dir . basename($file["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($file["tmp_name"]);
        if ($check === false) {
            echo "File bukan gambar.";
            $uploadOk = 0;
        }
        if ($file["size"] > 5000000) {
            echo "Maaf, ukuran file terlalu besar.";
            $uploadOk = 0;
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "Maaf, hanya file JPG, JPEG, dan PNG yang diperbolehkan.";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            echo "Maaf, file Anda tidak dapat diunggah.";
        } else {
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                $file_path = $target_file;
            } else {
                echo "Maaf, terjadi kesalahan saat mengunggah file.";
                $file_path = ""; // Tidak ada file yang berhasil diunggah
            }
        }
    } else {
        $file_path = ""; // Tidak ada file yang diunggah
    }

    $sql = "INSERT INTO buta_warna (file, jenis, jawaban) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $file_path, $jenis, $jawaban);
    $stmt->execute();
    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hidden {
            display: none;
        }

        .scrollable-table {
            max-height: 600px;
            overflow-y: auto;
            overflow-x: auto;
        }

        /* Sidebar styles */
        #sidebar {
            background-color: #343a40;
            height: 100vh;
            top: 0;
            left: 0;
            transition: width 0.3s;
        }

        #sidebar .nav-link {
            color: #fff;
        }

        #sidebar .nav-link.active {
            background-color: #495057;
        }

        #sidebar .offcanvas {
            width: 250px;
        }

        #sidebar .offcanvas-header {
            background-color: #343a40;
            color: #fff;
        }

        #sidebar .offcanvas-body {
            background-color: #495057;
        }

        @media (max-width: 767.98px) {
            #sidebar {
                width: 80px;
                height: 100vh;
            }
        }


        @media (min-width: 768px) {
            #sidebar {
                width: 280px;
            }
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <div class="d-flex flex-column flex-shrink-0 p-3 text-dark bg-dark" id="sidebar">
            <button class="btn btn-dark d-md-none mb-3" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list"
                    viewBox="0 0 16 16">
                    <path
                        d="M1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 0 2H2a1 1 0 0 1-1-1zM1 8a1 1 0 0 1 1-1h12a1 1 0 0 1 0 2H2a1 1 0 0 1-1-1zM1 12a1 1 0 0 1 1-1h12a1 1 0 0 1 0 2H2a1 1 0 0 1-1-1z" />
                </svg>
            </button>

            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidebar"
                aria-labelledby="offcanvasSidebarLabel">
                <div class="offcanvas-header">
                    <h5 id="offcanvasSidebarLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="?section=dashboard" class="nav-link text-white active" id="dashboardLink"
                                aria-current="page">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-speedometer" viewBox="0 0 16 16">
                                    <path
                                        d="M8 2a.5.5 0 0 1 .5.5V4a.5.5 0 0 1-1 0V2.5A.5.5 0 0 1 8 2M3.732 3.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707M2 8a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8m9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5m.754-4.246a.39.39 0 0 0-.527-.02L7.547 7.31A.91.91 0 1 0 8.85 8.569l3.434-4.297a.39.39 0 0 0-.029-.518z" />
                                    <path fill-rule="evenodd"
                                        d="M6.664 15.889A8 8 0 1 1 9.336.11a8 8 0 0 1-2.672 15.78zm-4.665-4.283A11.95 11.95 0 0 1 8 10c2.186 0 4.236.585 6.001 1.606a7 7 0 1 0-12.002 0" />
                                </svg>
                                Dashboard
                            </a>
                            <a href="?section=dataSoal" class="nav-link text-white" id="tambahDataLink"
                                aria-current="page">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-database-add" viewBox="0 0 16 16">
                                    <path
                                        d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0" />
                                    <path
                                        d="M12.096 6.223A5 5 0 0 0 13 5.698V7c0 .289-.213.654-.753 1.007a4.5 4.5 0 0 1 1.753.25V4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.5 4.5 0 0 1-.813-.927Q8.378 15 8 15c-1.464 0-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13h.027a4.6 4.6 0 0 1 0-1H8c-1.464 0-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10q.393 0 .774-.024a4.5 4.5 0 0 1 1.102-1.132C9.298 8.944 8.666 9 8 9c-1.464 0-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777M3 4c0-.374.356-.875 1.318-1.313C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4z" />
                                </svg>
                                Data Soal
                            </a>
                            <a href="logout.php" class="nav-link text-white" aria-current="page"
                                onclick="return confirm('Apakah Anda yakin ingin keluar?');">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                                    <path fill-rule="evenodd"
                                        d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                                </svg>
                                Log Out
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Sidebar for large screens -->
            <div class="d-none d-md-block">
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="?section=dashboard" class="nav-link text-white active" id="dashboardLink"
                            aria-current="page">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-speedometer" viewBox="0 0 16 16">
                                <path
                                    d="M8 2a.5.5 0 0 1 .5.5V4a.5.5 0 0 1-1 0V2.5A.5.5 0 0 1 8 2M3.732 3.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707M2 8a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8m9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5m.754-4.246a.39.39 0 0 0-.527-.02L7.547 7.31A.91.91 0 1 0 8.85 8.569l3.434-4.297a.39.39 0 0 0-.029-.518z" />
                                <path fill-rule="evenodd"
                                    d="M6.664 15.889A8 8 0 1 1 9.336.11a8 8 0 0 1-2.672 15.78zm-4.665-4.283A11.95 11.95 0 0 1 8 10c2.186 0 4.236.585 6.001 1.606a7 7 0 1 0-12.002 0" />
                            </svg>
                            Dashboard
                        </a>
                        <a href="?section=dataSoal" class="nav-link text-white" id="tambahDataLink" aria-current="page">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-database-add" viewBox="0 0 16 16">
                                <path
                                    d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0" />
                                <path
                                    d="M12.096 6.223A5 5 0 0 0 13 5.698V7c0 .289-.213.654-.753 1.007a4.5 4.5 0 0 1 1.753.25V4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.5 4.5 0 0 1-.813-.927Q8.378 15 8 15c-1.464 0-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13h.027a4.6 4.6 0 0 1 0-1H8c-1.464 0-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10q.393 0 .774-.024a4.5 4.5 0 0 1 1.102-1.132C9.298 8.944 8.666 9 8 9c-1.464 0-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777M3 4c0-.374.356-.875 1.318-1.313C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4z" />
                            </svg>
                            Data Soal
                        </a>
                        <a href="logout.php" class="nav-link text-white" aria-current="page"
                            onclick="return confirm('Apakah Anda yakin ingin keluar?');">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                                <path fill-rule="evenodd"
                                    d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                            </svg>
                            Log Out
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div id="dashboard" class="container mt-5">
            <h2>Dashboard</h2>
            <p>Selamat datang di halaman admin.</p>

            <!-- Tabel jenis dan jumlah -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Jenis</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT jenis, COUNT(*) as jumlah FROM buta_warna GROUP BY jenis";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['jenis']); ?></td>
                                <td><?php echo htmlspecialchars($row['jumlah']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2">Tidak ada data tersedia.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>


        <div id="dataSoal" class="container mt-5 hidden">
            <h3>Data Soal Buta Warna</h3>
            <div class="scrollable-table">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>File</th>
                            <th>Jenis</th>
                            <th>Jawaban</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM buta_warna";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><img src="<?php echo $row['file']; ?>" alt="Image" width="80"></td>
                                <td><?php echo $row['jenis']; ?></td>
                                <td><?php echo $row['jawaban']; ?></td>
                                <td>
                                    <a href="?section=updateData&update=<?php echo $row['id']; ?>"
                                        class="btn btn-warning btn-sm">Update</a>
                                    <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus?');">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <a href="?section=tambahData" class="btn btn-primary mt-3">Tambah Data</a>
        </div>

        <div id="tambahData" class="container mt-5 hidden">
            <h2>Unggah Gambar untuk Tes Buta Warna</h2>
            <form action="admin.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="file" class="form-label">Pilih Gambar</label>
                    <input class="form-control" type="file" name="file" id="file" required>
                </div>
                <div class="mb-3">
                    <label for="jenis" class="form-label">Jenis</label>
                    <select class="form-select" name="jenis" id="jenis" required>
                        <option value="" disabled selected>Pilih jenis warna</option>
                        <option value="hijau">Hijau</option>
                        <option value="merah">Merah</option>
                        <option value="biru">Biru</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jawaban" class="form-label">Jawaban</label>
                    <input type="number" class="form-control" name="jawaban" id="jawaban"
                        placeholder="input jawaban gambar" required>
                </div>
                <button type="submit" class="btn btn-primary">Unggah</button>
            </form>
        </div>

        <div id="updateData" class="container mt-5 hidden">
            <h2>Update Gambar untuk Tes Buta Warna</h2>
            <?php
            if (isset($_GET['update'])) {
                $id = $_GET['update'];
                $sql = "SELECT * FROM buta_warna WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_assoc();
                $stmt->close();
            }
            ?>
            <?php if (isset($data)): ?>
                <form action="admin.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                    <input type="hidden" name="old_file" value="<?php echo $data['file']; ?>">
                    <div class="d-flex mb-3">
                        <div class="mb-3">
                            <label for="file" class="form-label">Pilih Gambar Baru (Opsional)</label>
                            <input class="form-control" type="file" name="file" id="file">
                        </div>
                        <div class="mb-3">
                            <img src="<?php echo $data['file']; ?>" alt="" width="300px" height="300px">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="jenis" class="form-label">Jenis</label>
                        <select class="form-select" name="jenis" id="jenis" required>
                            <option value="hijau" <?php echo $data['jenis'] == 'hijau' ? 'selected' : ''; ?>>Hijau</option>
                            <option value="merah" <?php echo $data['jenis'] == 'merah' ? 'selected' : ''; ?>>Merah</option>
                            <option value="biru" <?php echo $data['jenis'] == 'biru' ? 'selected' : ''; ?>>Biru</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jawaban" class="form-label">Jawaban</label>
                        <input type="number" class="form-control" name="jawaban" id="jawaban"
                            value="<?php echo $data['jawaban']; ?>" required>
                    </div>
                    <button type="submit" name="update" class="btn btn-primary"
                        onclick="return confirm('Apakah Anda yakin ingin mengupdate?');">Update</button>
                </form>
            <?php else: ?>
                <p>Data tidak ditemukan.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showSection(sectionId) {
            document.querySelectorAll('.container').forEach(function (container) {
                container.classList.add('hidden');
            });
            document.getElementById(sectionId).classList.remove('hidden');
        }

        function getUrlParameter(name) {
            const regex = new RegExp('[?&]' + name + '=([^&#]*)');
            const results = regex.exec(window.location.search);
            return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
        }

        document.addEventListener('DOMContentLoaded', function () {
            const section = getUrlParameter('section');
            if (section) {
                showSection(section);
            } else {
                showSection('dashboard');
            }
        });

        document.querySelectorAll('[href*="?section="]').forEach(function (link) {
            link.addEventListener('click', function () {
                const section = new URL(this.href).searchParams.get('section');
                showSection(section);
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            var links = document.querySelectorAll('#sidebar .nav-link');
            var currentLocation = location.search;

            links.forEach(function (link) {
                if (link.getAttribute('href').includes(currentLocation)) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
        });
    </script>
</body>

</html>

<?php $conn->close(); ?>