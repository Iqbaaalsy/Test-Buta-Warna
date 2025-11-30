<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <!-- my css -->
    <style>
        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .hidden {
            display: none;
        }

        html.scroll-padding-top {
            scroll-padding-top: 500px; 
        }
    </style>

    <title>Buta Warna</title>
</head>

<body>



    <!-- navbar -->

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
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="test.php">Test</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- end nav -->

    <!-- jumbotron -->

    <div class="container col-xxl-8 px-4 py-5">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="aset/1.png" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700"
                    height="500" loading="lazy">
            </div>
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">Buta Warna</h1>
                <p class="lead">Buta warna adalah kondisi di mana seseorang mengalami kesulitan atau ketidakmampuan
                    untuk melihat dan membedakan warna tertentu. Kondisi ini biasanya disebabkan oleh masalah pada
                    sel-sel kerucut di retina mata, yang bertanggung jawab untuk mendeteksi warna.</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <a href="test.php" type="button" class="btn btn-outline-primary btn-lg px-4 me-md-2">Ayo Test!</a>
                </div>
            </div>
        </div>
    </div>


    <!-- end jumbotron -->

    <div class="b-example-divider"></div>

    <!-- about -->

    <div class="container px-4 py-5 justify-content-center">
        <h2 class="pb-2 border-bottom text-center">Jenis-Jenis</h2>
        <div class="row g-4 py-5 row-cols-1 row-cols-lg-2 m-3">
            <div class="d-flex align-items-start ">
                <div>
                    <h3 class="fs-2 text-body-emphasis" id="Trikromasi">Trikromasi</h3>
                    <p>Kondisi normal di mana mata manusia memiliki tiga jenis sel kerucut di retina yang masing-masing
                        peka terhadap warna merah, hijau, dan biru. Dengan memiliki ketiga jenis sel ini, kita bisa
                        melihat berbagai macam warna yang ada di dunia. Kombinasi rangsangan dari ketiga sel ini
                        memungkinkan kita untuk membedakan warna-warna tersebut dengan baik.</p>
                </div>
            </div>

            <div class="d-flex align-items-start ">
                <div>
                    <h3 class="fs-2 text-body-emphasis" id="Akromasi">Akromasi</h3>
                    <p>Kondisi yang lebih parah di mana seseorang tidak bisa melihat warna sama sekali. Orang dengan
                        akromasi melihat dunia sepenuhnya dalam hitam-putih dan berbagai gradasi abu-abu. Ini adalah
                        bentuk buta warna total dan biasanya disebabkan oleh mutasi genetik yang mempengaruhi semua sel
                        kerucut di retina.</p>
                </div>
            </div>
        </div>
        <hr>
        <div class="row g-4 py-5 row-cols-1 row-cols-lg-2 m-3 ">
            <div class="d-flex align-items-start">
                <div>
                    <h3 class="fs-2 text-body-emphasis" id="Abnormal">Trikromasi Abnormal</h3>
                    <p>Trikromasi abnormal tidak bisa dikategorikan sebagai buta warna karena ketiga jenis sel kerucut
                        masih bisa menangkap warna, akan tetapi salah satu dari tiga jenis sel kerucut tersebut melemah
                        atau mengalami cacat. Kondisi ini lebih cocok disebut sebagai color weakness atau lemah warna.
                    </p>
                </div>
            </div>
            <div class="d-flex align-items-start">
                <div class="d-flex align-items-start">
                    <div>
                        <h5 class="text-body-emphasis">Protanomali</h5>
                        <p>merupakan kelemahan warna merah.</p>
                    </div>
                </div>
                <div class="d-flex align-items-start">
                    <div>
                        <h5 class="text-body-emphasis">Deuteranomali</h5>
                        <p>merupakan kelemahan warna hijau.</p>
                    </div>
                </div>
                <div class="d-flex align-items-start">
                    <div>
                        <h5 class="text-body-emphasis">Tritanomali</h5>
                        <p>merupakan kelemahan warna biru.</p>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row g-4 py-1 row-cols-1 row-cols-lg-1 m-3 ">
            <div class="d-flex align-items-start">
                <div>
                    <h3 class="fs-2 text-body-emphasis" id="Dikromasi">Dikromasi</h3>
                    <p>Kondisi buta warna di mana seseorang hanya memiliki dua jenis sel kerucut yang berfungsi. Hal ini
                        menyebabkan kesulitan dalam membedakan beberapa warna. Dikromasi dapat terjadi karena mutasi
                        genetik yang menyebabkan salah satu jenis sel kerucut tidak berkembang dengan baik atau tidak
                        berfungsi.</p>
                </div>
            </div>
            <div class="d-flex align-items-start ">
                <div class="d-flex align-items-start">
                    <div>
                        <h5 class="text-body-emphasis">Protanopia</h5>
                        <p>jenis buta warna di mana sel-sel kerucut yang peka terhadap warna merah tidak berfungsi
                            dengan baik. Orang yang menderita protanopia tidak dapat melihat warna merah.
                        </p>
                    </div>
                </div>
                <div class="d-flex align-items-start">
                    <div>
                        <h5 class="text-body-emphasis">Deuteranopia</h5>
                        <p>jenis buta warna hijau di mana sel-sel kerucut yang peka terhadap warna hijau tidak berfungsi
                            dengan baik. Orang yang menderita deuteranopia tidak dapat melihat warna hijau.</p>
                    </div>
                </div>
                <div class="d-flex align-items-start">
                    <div>
                        <h5 class="text-body-emphasis">Tritanopia</h5>
                        <p>jenis buta warna biru di mana sel-sel kerucut yang peka terhadap warna biru tidak berfungsi
                            dengan baik. Orang yang menderita tritanopia tidak dapat melihat warna biru.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="b-example-divider"></div>

    <div class="container px-4 py-5">
        <h2 class="pb-2 border-bottom text-center">Penyebab</h2>

        <div class="row row-cols-1 row-cols-md-4 align-items-md-center g-5 py-5">
            <div class="col d-flex flex-column gap-2">
                <div class="card shadow" style="width: 15rem;">
                    <img src="aset/keturunan.png" class="card-img-top" alt="Enchroma">
                    <div class="card-body">
                        <h3>Genetik</h3>
                        <p class="card-text">Buta warna biasanya diwariskan secara genetik atau turunan dari orang tua.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col d-flex flex-column gap-2">
                <div class="card shadow" style="width: 15rem;">
                    <img src="aset/penyakit.jpg" class="card-img-top" alt="Enchroma">
                    <div class="card-body">
                        <h3>Penyakit tertentu</h3>
                        <p class="card-text">Seperti diabetes, glaukoma, dan penyakit retina.</p>
                    </div>
                </div>
            </div>
            <div class="col d-flex flex-column gap-2">
                <div class="card shadow" style="width: 15rem;">
                    <img src="aset/obat2.jpg" class="card-img-top" alt="Enchroma">
                    <div class="card-body">
                        <h3>Penggunaan obat tertentu</h3>
                        <p class="card-text">Obat-obatan tertentu dapat mempengaruhi kemampuan mata untuk
                            melihat warna.</p>
                    </div>
                </div>
            </div>
            <div class="col d-flex flex-column gap-2">
                <div class="card shadow" style="width: 15rem;">
                    <img src="aset/penuaan.jpg" class="card-img-top" alt="Enchroma">
                    <div class="card-body">
                        <h3>Penuaan</h3>
                        <p class="card-text">Kemampuan kamu untuk melihat warna menurun secara perlahan
                            seiring bertambahnya usia.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end about -->


    <div class="b-example-divider"></div>

    <div class="container px-4 py-5">
        <h2 class="pb-2 border-bottom text-center">Diagnosis dan Pengobatan</h2>

        <div class="row row-cols-1 row-cols-md-2 align-items-md-center g-1 py-5">
            <div class="col d-flex flex-column align-items-start gap-2">
                <h2 class="fw-bold text-body-emphasis">Tes ishihara</h2>
                <p class="text-body-secondary">Diagnosis buta warna biasanya dilakukan melalui tes penglihatan warna,
                    seperti tes Ishihara yang menggunakan serangkaian gambar berisi titik-titik berwarna.</p>
                <h2 class="fw-bold text-body-emphasis">Pengobatan</h2>
                <p class="text-body-secondary">
                <p>Saat ini, tidak ada pengobatan yang bisa menyembuhkan buta warna. Namun, ada beberapa alat bantu
                    seperti kacamata atau lensa kontak khusus yang dapat membantu meningkatkan persepsi warna bagi
                    beberapa orang dengan buta warna</p>
                </p>
            </div>

            <div class="col">
                <div class="row row-cols-1 row-cols-sm-2 g-4">
                    <div class="col d-flex flex-column gap-2">
                        <div
                            class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-4 rounded-3">
                        </div>
                        <h4 class="fw-semibold mb-0 text-body-emphasis">EnChroma</h4>
                        <p class="text-body-secondary">merupakan salah satu produk kacamata buta warna yang mengklaim
                            dapat membantu mendeteksi perbedaan antar warna. EnChroma merupakan produk yang
                            paling terkenal saat ini.</p>
                    </div>

                    <div class="col d-flex flex-column gap-2">
                        <div
                            class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-4 rounded-3">
                        </div>
                        <h4 class="fw-semibold mb-0 text-body-emphasis">Color Correction System (CCS)</h4>
                        <p class="text-body-secondary">CCS juga menggunakan filter khusus yang dirancang agar sesuai
                            dengan
                            panjang gelombang cahaya yang tepat untuk
                            kebutuhan masing-masing individu. Filter yang dimiliki oleh CCS dapat diterapkan pada
                            lensa kontak ataupun kacamata.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- footer -->


    <div class="b-example-divider"></div>

    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <div class="col-md-4 d-flex align-items-center">
                <span class="mb-3 mb-md-0 text-body-secondary">Created Muhammad iqbal syaputra</span>
            </div>

            <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                <li class="ms-3"><a class="text-body" href="https://github.com/Iqbaaalsy"><svg
                            xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                            class="bi bi-github" viewBox="0 0 16 16">
                            <path
                                d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8" />
                        </svg>
                <li class="ms-3"><a class="text-body-secondary"
                        href="https://www.instagram.com/iqbaall_sy?utm_source=qr&igsh=MjJpdjY4dm94bXdy">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                            class="bi bi-instagram text-danger" viewBox="0 0 16 16">
                            <path
                                d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                        </svg></use>
                    </a></li>
                <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24">
                            <use xlink:href="#facebook"></use>
                        </svg></a></li>
            </ul>
        </footer>
    </div>

    <!-- end -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>