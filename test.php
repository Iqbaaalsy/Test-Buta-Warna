<?php
// koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tugaspi";

// membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// query untuk mengambil nilai dari kolom id,file dan jawaban 
$sql = "
        (
            SELECT id, file, jawaban 
            FROM (
                SELECT id, file, jawaban 
                FROM buta_warna 
                WHERE jenis = 'hijau' 
                ORDER BY RAND() 
                LIMIT 9
            ) AS hijau_random
        )
        UNION ALL
        (
            SELECT id, file, jawaban 
            FROM (
                SELECT id, file, jawaban 
                FROM buta_warna 
                WHERE jenis = 'merah' 
                ORDER BY RAND() 
                LIMIT 9
            ) AS merah_random
        )
        UNION ALL
        (
            SELECT id, file, jawaban 
            FROM (
                SELECT id, file, jawaban 
                FROM buta_warna 
                WHERE jenis = 'biru' 
                ORDER BY RAND() 
                LIMIT 7
            ) AS biru_random
        )";


$result = $conn->query($sql);

$stepsData = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $stepsData[] = [
            'id' => $row['id'],
            'imgSrc' => $row['file']
        ];
    }
}
$conn->close();

// Convert PHP array to JavaScript array
$stepsDataJson = json_encode($stepsData);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Buta Warna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <style>
        img {
            box-shadow: 5px 5px 5px 5px rgb(0, 0, 0, 0.2);
            border-radius: 100%;
        }

        .container-title {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input {
            text-align: center;
        }

        .step {
            display: none;
        }

        .step.active {
            display: block;
        }

        .numpad {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            max-width: 300px;
            margin: 20px auto;
        }

        .numpad button {
            font-size: 1.5rem;
            padding: 15px;
        }

        .answer {
            font-size: 40px;
            width: 250px;
            height: 46px;
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
                        <a class="nav-link active" href="test.php">Test</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid text-center mt-5 pt-5 pb-5" style="background-color:#ffff;">
        <div class="container-title">
            <h2 style="font-family: Montserrat, sans-serif; font-weight: 600;">Tes Buta Warna</h2>
            <hr width="200px">
        </div>
        <div class="container mt-4">
            <form id="quizForm" action="hasil.php" method="post">
                
            </form>
        </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="rgb(146, 185, 218)" fill-opacity="1"
            d="M0,96L60,112C120,128,240,160,360,176C480,192,600,192,720,170.7C840,149,960,107,1080,90.7C1200,75,1320,85,1380,90.7L1440,96L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z">
        </path>
    </svg>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script>
        const stepsData = <?php echo $stepsDataJson; ?>;

        // Shuffle function
        function shuffle(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
        }

        // Shuffle steps data
        shuffle(stepsData);

        const quizForm = document.getElementById('quizForm');
        stepsData.forEach((step, index) => {
            const stepDiv = document.createElement('div');
            stepDiv.classList.add('step');
            if (index === 0) stepDiv.classList.add('active');

            stepDiv.innerHTML = `
                <img src="${step.imgSrc}" alt="" height="250px" width="250px">
                <input type="hidden" name="jawaban${step.id}" class="mt-4" id="jawaban${step.id}" placeholder="Jawaban" readonly>
                <div>
                    <label class="answer" id="jawaban${step.id}l"></label>
                </div>
                <div class="numpad">
                    <button type="button" onclick="appendNumber('jawaban${step.id}', 1)">1</button>
                    <button type="button" onclick="appendNumber('jawaban${step.id}', 2)">2</button>
                    <button type="button" onclick="appendNumber('jawaban${step.id}', 3)">3</button>
                    <button type="button" onclick="appendNumber('jawaban${step.id}', 4)">4</button>
                    <button type="button" onclick="appendNumber('jawaban${step.id}', 5)">5</button>
                    <button type="button" onclick="appendNumber('jawaban${step.id}', 6)">6</button>
                    <button type="button" onclick="appendNumber('jawaban${step.id}', 7)">7</button>
                    <button type="button" onclick="appendNumber('jawaban${step.id}', 8)">8</button>
                    <button type="button" onclick="appendNumber('jawaban${step.id}', 9)">9</button>
                    <button type="button" onclick="clearInput('jawaban${step.id}')">Clear</button>
                    <button type="button" onclick="appendNumber('jawaban${step.id}', 0)">0</button>
                    <button type="button" onclick="deleteLast('jawaban${step.id}')">⌫</button>
                </div>
            `;

            quizForm.appendChild(stepDiv);
        });

        // Add navigation buttons
        const buttonsDiv = document.createElement('div');
        buttonsDiv.classList.add('mt-5');
        buttonsDiv.innerHTML = `
            <button type="button" class="btn btn-primary" id="nextBtn" onclick="changeStep(1)">Next</button>
            <button type="submit" class="btn btn-success" id="submitBtn" style="display:none;">Submit</button>
        `;
        quizForm.appendChild(buttonsDiv);

        let currentStep = 0;

        function showStep(n) {
            const steps = document.querySelectorAll('.step');
            steps.forEach((step, index) => {
                step.classList.remove('active');
                if (index === n) {
                    step.classList.add('active');
                }
            });

            document.getElementById('nextBtn').style.display = n === steps.length - 1 ? 'none' : 'inline';
            document.getElementById('submitBtn').style.display = n === steps.length - 1 ? 'inline' : 'none';
        }

        function changeStep(n) {
            const steps = document.querySelectorAll('.step');
            if (n === 1 && !validateStep(currentStep)) return;
            currentStep += n;
            if (currentStep >= steps.length) {
                currentStep = steps.length - 1;
            }
            if (currentStep < 0) {
                currentStep = 0;
            }
            showStep(currentStep);
        }

        function validateStep(stepIndex) {
            return true;
        }

        function appendNumber(inputId, number) {
            const input = document.getElementById(inputId);
            input.value += number;
            document.getElementById(`${inputId}l`).textContent = input.value;
        }

        function clearInput(inputId) {
            document.getElementById(inputId).value = '';
            document.getElementById(`${inputId}l`).textContent = '';
        }

        function deleteLast(inputId) {
            const input = document.getElementById(inputId);
            input.value = input.value.slice(0, -1);
            document.getElementById(`${inputId}l`).textContent = input.value;
        }

        showStep(currentStep);
    </script>
</body>

</html>