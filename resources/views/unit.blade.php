<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unit Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
                    url: 'http://localhost:8000/api/units',
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
                    url: `http://localhost:8000/api/units/${nama_unit}`,
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
            const url = lantai_id ? `http://localhost:8000/api/units?lantai=${lantai_id}` : 'http://localhost:8000/api/units';

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
            $.get('http://localhost:8000/api/tabel_lantai', function(lantaiData) {
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
