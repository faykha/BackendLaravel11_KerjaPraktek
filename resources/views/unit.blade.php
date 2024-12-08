<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unit Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        /* General body styling */
body {
    background-color: #f8f9fa; /* Light grey background */
    background-image: url('images/background.jpg'); /* Background image */
    background-size: cover; /* Cover the whole screen */
    background-position: center; /* Center the background image */
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
}

/* Styling for the container */
.container-fluid {
    min-height: 100vh;
    padding-top: 40px;
}

/* Heading styling */
h2 {
    font-size: 2.5rem;
    font-weight: bold;
    color: #343a40;
}

/* Table styling */
.table {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.table th, .table td {
    padding: 12px;
    text-align: center;
}

.table th {
    background-color: #007bff;
    color: white;
}

.table .btn {
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.table .btn-warning {
    background-color: #ffc107;
    border-color: #ffc107;
}

.table .btn-warning:hover {
    background-color: #e0a800;
    border-color: #e0a800;
}

.table .btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
}

.table .btn-danger:hover {
    background-color: #c82333;
    border-color: #c82333;
}

/* Form and input styling */
.form-label {
    font-weight: bold;
    color: #495057;
}

.form-control, .form-select {
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.mb-3 {
    margin-bottom: 1.5rem;
}

/* Modal styling */
.modal-content {
    border-radius: 8px;
}

.modal-header {
    background-color: #007bff;
    color: white;
    border-bottom: 1px solid #ddd;
}

.modal-title {
    font-size: 1.25rem;
}

.modal-footer {
    border-top: 1px solid #ddd;
}

/* Button styling */
.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}

.btn-close {
    color: #fff;
    font-size: 1.5rem;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    h2 {
        font-size: 2rem;
    }

    .table th, .table td {
        font-size: 0.875rem;
        padding: 8px;
    }

    .form-control, .form-select {
        font-size: 0.875rem;
    }

    .modal-dialog {
        max-width: 90%;
    }
}


.container-fluid {
    min-height: 100vh; /* Menggunakan seluruh tinggi layar */
}
    </style>
</head>
<body>
       <!-- Modal Form -->
       <div class="modal fade" id="unitModal" tabindex="-1" aria-labelledby="unitModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="unitModalLabel">Tambah Unit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="unitForm">
                            <div class="mb-3">
                                <label for="unitName" class="form-label">Nama Unit</label>
                                <input type="text" class="form-control" id="unitName" required>
                            </div>
                            <div class="mb-3">
                                <label for="lantai" class="form-label">Lantai</label>
                                <select class="form-select" id="lantai" required>
                                    <!-- Lantai options akan dimuat di sini -->
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <div class="container mt-5">
    <div class="mb-3">
        <a href="/dashboard" class="btn btn-primary">Home</a>
    </div>
        <h2 class="mb-4">Unit Management</h2>
        
        <!-- Filter Lantai tanpa pilihan "Semua Lantai" -->
        <div class="mb-4">
            <label for="lantaiFilter" class="form-label">Pilih Lantai:</label>
            <select class="form-select" id="lantaiFilter">
                <!-- Lantai options akan dimuat di sini -->
            </select>
        </div>

        <!-- Tabel Unit -->
        <table class="table table-bordered" id="unitTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Unit</th>
                    <th>Lantai</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="unitTableBody">
                <!-- Data unit akan dimuat di sini -->
            </tbody>
        </table>

        <!-- Form untuk tambah unit -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#unitModal">Tambah Unit</button>

     
    </div>

    <script>
        $(document).ready(function() {
            loadLantaiOptions();  // Load lantai options
            loadUnitData(); // Load all units initially

            // Menambahkan unit baru
            $('#unitForm').on('submit', function(e) {
                e.preventDefault();
                const unitName = $('#unitName').val();
                const lantai = $('#lantai').val();

                $.ajax({
                    url: 'https://qc-pass.technice.id/api/units',
                    type: 'POST',
                    data: {
                        nama_unit: unitName,
                        lantai: lantai
                    },
                    success: function(response) {
                        alert(response.message);
                        $('#unitModal').modal('hide');
                        loadUnitData(); // Refresh data unit
                    },
                    error: function(error) {
                        alert('Terjadi kesalahan saat menambahkan unit');
                    }
                });
            });

            // Menghapus unit
            $(document).on('click', '.delete-unit', function() {
                const nama_unit = $(this).data('nama_unit');
                $.ajax({
                    url: `https://qc-pass.technice.id/api/units/${nama_unit}`,
                    type: 'DELETE',
                    success: function(response) {
                        alert(response.message);
                        loadUnitData(); // Refresh data unit
                    },
                    error: function(error) {
                        alert('Terjadi kesalahan saat menghapus unit');
                    }
                });
            });

            // Memfilter unit berdasarkan lantai
            $('#lantaiFilter').on('change', function() {
                const lantaiId = $(this).val();
                loadUnitData(lantaiId);
            });

        });

        // Memuat data unit berdasarkan lantai
        function loadUnitData(lantai_id = '') {
            const url = lantai_id ? `https://qc-pass.technice.id/api/units?lantai=${lantai_id}` : 'https://qc-pass.technice.id/api/units';

            $.get(url, function(data) {
                const tableBody = $('#unitTableBody');
                tableBody.empty();
                data.forEach((unit, index) => {
                    tableBody.append(`
                        <tr>
                            <td>${index + 1}</td>
                            <td>${unit.nama_unit}</td>
                            <td>${unit.lantai_relation ? unit.lantai_relation.lantai : '-'}</td>
                            <td>
                                <button class="btn btn-warning">Edit</button>
                                <button class="btn btn-danger delete-unit" data-nama_unit="${unit.nama_unit}">Delete</button>
                            </td>
                        </tr>
                    `);
                });
            });
        }

        // Memuat data lantai untuk filter dan form
        function loadLantaiOptions() {
            $.get('https://qc-pass.technice.id/api/tabel_lantai', function(lantaiData) {
                let lantaiFilter = $('#lantaiFilter');
                let lantaiSelect = $('#lantai');
                lantaiFilter.empty();
                lantaiSelect.empty();
                lantaiData.forEach(lantai => {
                    lantaiFilter.append(`<option value="${lantai.id}">${lantai.lantai}</option>`);
                    lantaiSelect.append(`<option value="${lantai.id}">${lantai.lantai}</option>`);
                });
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
