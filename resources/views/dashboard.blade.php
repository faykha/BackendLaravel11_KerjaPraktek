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
            color: #007bff;
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
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><i class="bi bi-bar-chart"></i> Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-lightning-charge"></i> Data Statik</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-people"></i> User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-building"></i> Lantai</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-box-seam"></i> Unit</a>
                    </li>
                </ul>
                <hr>
                <h6 class="text-muted">Support</h6>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-question-circle"></i> Get Help</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-gear"></i> Settings</a>
                    </li>
                </ul>
                <div class="footer">
                    <p>Administrator</p>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Reports</h2>
                    <a href="#" class="logout">Log Out</a>
                </div>

                <!-- Filter Section -->
                <div class="filters d-flex mb-4">
                    <select class="form-select">
                        <option selected>Lantai</option>
                    </select>
                </div>

                <!-- Stats Cards -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <h5>Data Problem</h5>
                            <h3 id="dataProblemCount">0</h3> <!-- Menampilkan jumlah data problem -->
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
        async function fetchProblematicUnits() {
            try {
                const response = await fetch('http://localhost:8000/api/problematic-units');
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
