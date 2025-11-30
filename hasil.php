<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tugaspi";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$userAnswers = [];
$ids = []; 

foreach ($_POST as $key => $value) {
    if (strpos($key, 'jawaban') === 0) {
        $id = str_replace('jawaban', '', $key);
        $userAnswers[$id] = $value;
        $ids[] = $id; 
    }
}

// Prepare SQL statement to get correct answers and types
if (count($ids) > 0) {
    $idsPlaceholder = implode(',', array_fill(0, count($ids), '?'));

    $sql = "SELECT id, jawaban, jenis FROM buta_warna WHERE id IN ($idsPlaceholder)";
    $stmt = $conn->prepare($sql);
    $types = str_repeat('i', count($ids)); 
    $stmt->bind_param($types, ...$ids);

    $stmt->execute();
    $result = $stmt->get_result();

    $correctAnswers = [];
    while ($row = $result->fetch_assoc()) {
        $correctAnswers[$row['id']] = [
            'jawaban' => $row['jawaban'],
            'jenis' => $row['jenis']
        ];
    }
    $stmt->close();
} else {
    $correctAnswers = [];
}


$scoreMerah = 0;
$scoreHijau = 0;
$scoreBiru = 0;
$totalQuestions = count($correctAnswers);
$correctCount = 0;
$incorrectCount = 0;

foreach ($userAnswers as $id => $userAnswer) {
    if (isset($correctAnswers[$id])) {
        $correctAnswer = $correctAnswers[$id]['jawaban'];
        $jenis = $correctAnswers[$id]['jenis'];
        $isCorrect = $userAnswer == $correctAnswer;

        if ($isCorrect) {
            $correctCount++;
            if ($jenis == 'merah')
                $scoreMerah++;
            if ($jenis == 'hijau')
                $scoreHijau++;
            if ($jenis == 'biru')
                $scoreBiru++;
        } else {
            $incorrectCount++;
        }
    }
}


$minScore = min($scoreMerah, $scoreHijau, $scoreBiru);
$type = '';

if ($scoreMerah < 4 && $scoreHijau < 4 && $scoreBiru < 2) {
    $type = "akromasi";
    $finalDiagnosis = diagnose($minScore, $type, $conn);
} else {
    if ($minScore == $scoreMerah) {
        $type = 'merah';
    } elseif ($minScore == $scoreHijau) {
        $type = 'hijau';
    } elseif ($minScore == $scoreBiru) {
        $type = 'biru';
    }

    
    $finalDiagnosis = diagnose($minScore, $type, $conn);
}

// Diagnosis function
function diagnose($score, $type, $conn)
{
    $sql = "";
    if ($type == 'merah') {
        if ($score < 6)
            $sql = "SELECT ket FROM hasil WHERE diagnosa = 'Protanopia'";
        elseif ($score == 6 || $score == 7)
            $sql = "SELECT ket FROM hasil WHERE diagnosa = 'Protanomali'";
        elseif ($score >= 8)
            $sql = "SELECT ket FROM hasil WHERE diagnosa = 'Normal'";
    } elseif ($type == 'hijau') {
        if ($score < 6)
            $sql = "SELECT ket FROM hasil WHERE diagnosa = 'Deuteranopia'";
        elseif ($score == 6 || $score == 7)
            $sql = "SELECT ket FROM hasil WHERE diagnosa = 'Deuteranomali'";
        elseif ($score >= 8)
            $sql = "SELECT ket FROM hasil WHERE diagnosa = 'Normal'";
    } elseif ($type == 'biru') {
        if ($score <= 4)
            $sql = "SELECT ket FROM hasil WHERE diagnosa = 'Tritanopia'";
        elseif ($score <= 6)
            $sql = "SELECT ket FROM hasil WHERE diagnosa = 'Tritanomali'";
        elseif ($score == 7)
            $sql = "SELECT ket FROM hasil WHERE diagnosa = 'Normal'";
    } elseif ($type == "akromasi") {
        $sql = "SELECT ket FROM hasil WHERE diagnosa = 'Akromasi'";
    }

    // Execute the query and fetch the result
    if (!empty($sql)) {
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['ket'];
        }
    }
    return "Tidak Terdefinisi";
}


$nama_btw = "Tidak Terdefinisi";
$sql = "SELECT diagnosa FROM hasil WHERE ket = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $finalDiagnosis);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nama_btw = $row['diagnosa'];
}


$sql = "SELECT jenis FROM hasil WHERE diagnosa = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nama_btw);
$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $tujuan = $row['jenis'];
} else {
    $tujuan = "tidak_ditemukan"; 
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Tes Buta Warna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <style>
        .answer {
            border-radius: 50px;
            background-color: rgb(45, 72, 91);
            max-width: 100%;
            width: 500px;
            padding: 5rem;
            margin: 0 auto;
            margin-top: 5rem;
        }

        .answer h1 {
            font-family: Montserrat, sans-serif;
            font-weight: 600;
            text-align: center;
            color: white;
        }

        .answer h3 {
            font-family: Montserrat, sans-serif;
            font-weight: 600;
            text-align: center;
            color: white;
            margin-top: 2rem;
        }

        .alert {
            font-family: Montserrat, sans-serif;
            font-size: 1.2rem;
            text-align: center;
        }

        .container-title {
            text-align: center;
            margin-top: 2rem;
        }

        .table {
            max-width: 500px;
            font-family: Montserrat, sans-serif;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm fs-5 fixed-top" style="background-color:rgb(45, 72, 91);">
        <div class="container">
            <a class="navbar-brand" href="#">Test Buta Warna</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="test.php">Test</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid"
        style="display: grid; place-items: center; height: 100vh; background-color: rgb(245, 245, 245);">
        <div class="container-fluid">
            <div class="answer p-5 text-white">
                <h1>Hasil Tes Buta Warna</h1>
                <hr class="mb-5 pb-1">
                <h3><?php echo $nama_btw; ?></h3>
                <div class="alert alert-info mt-3"><?php echo $finalDiagnosis; ?><a
                        href="index.php?id=<?php echo urlencode($tujuan); ?>#<?php echo urlencode($tujuan); ?>">baca
                        selengkapnya</a></div>
                <div class="container-title">
                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Jumlah Soal</th>
                                <th scope="col">Benar</th>
                                <th scope="col">Salah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $totalQuestions; ?></td>
                                <td><?php echo $correctCount; ?></td>
                                <td><?php echo $incorrectCount; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-center mt-4">
                    <a href="test.php" class="btn btn-primary btn-lg px-4 me-md-2">Test Lagi</a>
                    <a href="index.php" class="btn btn-secondary btn-lg px-4 me-md-2">Kembali</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>