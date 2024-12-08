<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Service Solution Project</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS untuk dashboard */
        body, .sidebar, .content {
            font-family: 'Poppins', sans-serif;
        }
        .sidebar {
            background-color: #ffffff;
            min-height: 100vh;
            padding: 20px;
            box-shadow: 2px 0px 8px rgba(0, 0, 0, 0.1);
        }
        .sidebar .logo img {
            width: 100px;
            margin-bottom: 20px;
        }
        .sidebar .nav-link {
            color: #333;
            font-weight: bold;
            margin: 10px 0;
            display: flex;
            align-items: center;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            color: #ffffff;
        }
        .sidebar .footer {
            position: absolute;
            bottom: 20px;
            width: 100%;
            text-align: center;
            color: #777;
        }
        .content {
            padding: 20px;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }
        .filters select, .filters input {
            margin-right: 10px;
        }
        .logout {
            color: #555;
            font-weight: bold;
            text-transform: uppercase;
        }
        .table-title {
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
        }
        .nav-container {
        padding: 10px;
        border: 1px solid #0056b3; /* Border biru */
        border-radius: 20px;
        background-color: #007bff; /* Warna latar belakang biru */
        color: white; /* Warna teks putih agar kontras */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
    }
    .nav-container:hover {
        background-color: #007bff; /* Warna biru lebih gelap saat hover */
        box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3); /* Bayangan biru saat hover */
    }
    .nav-container .nav-link {
        text-decoration: none;
        color: white; /* Warna teks putih */
        font-weight: bold;
        transition: color 0.3s;
    }
    .nav-container .nav-link:hover {
        color: #cce4ff; /* Warna biru terang untuk teks saat hover */
        text-shadow: 0px 0px 5px rgba(255, 255, 255, 0.5); /* Bayangan pada teks */
    }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar">
                <div class="logo text-center">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Service Solution Project Logo">
                    <h6>Service Solution Project</h6>
                </div>
                <ul class="nav flex-column">
    <div class="nav-container mb-3">
        <li class="nav-item">
            <a class="nav-link active" href="#"><i class="bi bi-bar-chart"></i> Reports</a>
        </li>
    </div>
    <div class="nav-container mb-3">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/datastatik') }}"><i class="bi bi-lightning-charge"></i> Data Statik</a>
        </li>
    </div>
    <div class="nav-container mb-3">
        <li class="nav-item">
            <a class="nav-link" href="/user"><i class="bi bi-people"></i> User</a>
        </li>
    </div>
    <div class="nav-container mb-3">
        <li class="nav-item">
            <a class="nav-link" href="/lantai"><i class="bi bi-building"></i> Lantai</a>
        </li>
    </div>
    <div class="nav-container mb-3">
        <li class="nav-item">
            <a class="nav-link" href="/unit"><i class="bi bi-box-seam"></i> Unit</a>
        </li>
    </div>
</ul>

                <div class="footer">
                    <p>Made By CodeCrafter</p>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Reports</h2>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-link logout" style="text-decoration: none; color: #555; font-weight: bold;">Log Out</button>
        </form>
                    </div>

                <!-- Stats Cards -->
                <div class="row">
    <!-- Card untuk Data All -->
    <div class="col-md-3">
        <div class="card">
            <h5>Data All</h5>
            <h3 id="dataAll">0</h3> <!-- Menampilkan jumlah data semua -->
        </div>
    </div>

    <!-- Card untuk Data Problem -->
    <div class="col-md-3">
        <div class="card">
            <h5>Data Problem</h5>
            <h3 id="dataProblemCount">0</h3> <!-- Menampilkan jumlah data bermasalah -->
        </div>
    </div>
</div>


                <!-- Table Section -->
                <div class="table-title">Daftar Unit dan Lantai yang Bermasalah</div>
                <div class="table-container">
                    <table class="table table-bordered table-hover" id="problematicUnitsTable">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Lantai</th>
                                <th scope="col">Unit</th>
                                <th scope="col">Detail Masalah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be inserted here by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS & Icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>

    <script>
        // Fungsi untuk mengambil data dari API dan menampilkannya di tabel

        async function fetchKitchenData() {
        try {
            // Ganti dengan URL yang benar untuk endpoint data_kitchen
            const response = await fetch('https://qc-pass.technice.id/api/data_kitchen'); 
            const data = await response.json();

            if (data) {
                const dataAllCount = document.getElementById('dataAll'); // Card untuk Data All
                // Update jumlah data All
                dataAllCount.textContent = data.length; // Menampilkan jumlah total data

            } else {
                console.error('Data tidak ditemukan');
            }
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    }

    // Panggil fungsi untuk mengambil data kitchen saat halaman dimuat
    document.addEventListener('DOMContentLoaded', fetchKitchenData);
        async function fetchProblematicUnits() {
            try {
                const response = await fetch('https://qc-pass.technice.id/api/problematic-units');
                const data = await response.json();

                if (data && data.data) {
                    const tableBody = document.querySelector('#problematicUnitsTable tbody');
                    const dataProblemCount = document.getElementById('dataProblemCount'); // Jumlah Data Problem
                    tableBody.innerHTML = ''; // Kosongkan isi tabel sebelum memasukkan data baru

                    // Update jumlah data problem
                    dataProblemCount.textContent = data.data.length;

                    // Loop untuk menambah baris data ke tabel
                    data.data.forEach(unit => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${unit.lantai}</td>
                            <td>${unit.unit}</td>
                            <td>${unit.problem_details}</td>
                        `;
                        tableBody.appendChild(row);
                    });
                } else {
                    console.error('Data tidak ditemukan');
                }
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }

        // Panggil fungsi untuk mengambil data saat halaman dimuat
        document.addEventListener('DOMContentLoaded', fetchProblematicUnits);
    </script>
</body>
</html>
