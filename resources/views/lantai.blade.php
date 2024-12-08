<!-- resources/views/tabel_lantai.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Lantai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
       /* Styling for the body */
body {
    background-color: #f8f9fa; /* Light grey background */
    background-image: url('images/background.jpg'); /* Background image */
    background-size: cover; /* Cover the whole area */
    background-position: center; /* Center the background image */
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
}

.container-fluid {
    min-height: 100vh; /* Use full screen height */
    padding-top: 40px;
}

h1 {
    font-size: 2.5rem;
    font-weight: bold;
    color: #343a40;
}

.btn {
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}

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

.form-control {
    border-radius: 8px;
}

table {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

thead {
    background-color: #007bff;
    color: white;
}

th, td {
    padding: 12px;
    text-align: center;
}

.table-responsive {
    margin-top: 20px;
}

/* Custom styling for buttons inside the table */
.btn-warning {
    background-color: #ffc107;
    border-color: #ffc107;
}

.btn-warning:hover {
    background-color: #e0a800;
    border-color: #e0a800;
}

.btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
}

.btn-danger:hover {
    background-color: #c82333;
    border-color: #c82333;
}

.modal-body {
    background-color: #f8f9fa;
}

.modal-footer {
    border-top: 1px solid #ddd;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    h1 {
        font-size: 2rem;
    }
    .table th, .table td {
        font-size: 0.875rem;
        padding: 8px;
    }
}

    </style>
</head>
<body>
    <div class="container mt-5">
    <div class="mb-3">
        <a href="/dashboard" class="btn btn-primary">Home</a>
    </div>
        <h1>Data Lantai</h1>
        <button class="btn btn-primary" data-toggle="modal" data-target="#addLantaiModal">Tambah Lantai</button>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Lantai</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="lantaiTableBody">
                <!-- Data Lantai akan dimuat di sini -->
            </tbody>
        </table>
    </div>

    <!-- Modal untuk menambah lantai -->
    <div class="modal fade" id="addLantaiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Lantai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addLantaiForm">
                        <div class="form-group">
                            <label for="lantai">Nama Lantai</label>
                            <input type="text" class="form-control" id="lantai" name="lantai" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // Load data lantai ketika halaman dimuat
            loadLantaiData();

            // Fungsi untuk memuat data lantai
            function loadLantaiData() {
                $.get("https://qc-pass.technice.id/api/tabel_lantai", function(data) {
                    let tableBody = $("#lantaiTableBody");
                    tableBody.empty(); // Kosongkan tabel sebelum menambah data baru
                    data.forEach((lantai, index) => {
                        tableBody.append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${lantai.lantai}</td>
                                <td>
                                    <button class="btn btn-warning" onclick="editLantai(${lantai.id}, '${lantai.lantai}')">Edit</button>
                                    <button class="btn btn-danger" onclick="deleteLantai(${lantai.id})">Delete</button>
                                </td>
                            </tr>
                        `);
                    });
                });
            }

            // Tambah lantai
            $('#addLantaiForm').submit(function(event) {
                event.preventDefault();
                const lantai = $('#lantai').val();

                $.post("https://qc-pass.technice.id/api/tabel_lantai", { lantai: lantai }, function(data) {
                    $('#addLantaiModal').modal('hide');
                    loadLantaiData(); // Reload data setelah menambah lantai
                    $('#lantai').val(''); // Reset input
                }).fail(function(xhr) {
                    alert("Gagal menambahkan lantai: " + xhr.responseText);
                });
            });

            // Edit lantai
            window.editLantai = function(id, lantai) {
                const newLantai = prompt("Edit Lantai", lantai);
                if (newLantai) {
                    $.ajax({
                        url: `https://qc-pass.technice.id/api/tabel_lantai/${id}`,
                        type: 'PUT',
                        data: { lantai: newLantai },
                        success: function() {
                            loadLantaiData(); // Reload data setelah mengedit lantai
                        },
                        error: function(xhr) {
                            alert("Gagal mengedit lantai: " + xhr.responseText);
                        }
                    });
                }
            };

            // Hapus lantai
            window.deleteLantai = function(id) {
                if (confirm("Anda yakin ingin menghapus lantai ini?")) {
                    $.ajax({
                        url: `https://qc-pass.technice.id/api/tabel_lantai/${id}`,
                        type: 'DELETE',
                        success: function() {
                            loadLantaiData(); // Reload data setelah menghapus lantai
                        },
                        error: function(xhr) {
                            alert("Gagal menghapus lantai: " + xhr.responseText);
                        }
                    });
                }
            };
        });
    </script>
</body>
</html>
