<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Statik CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: auto;
        }
        .table-title {
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
        }
        .table-responsive {
            overflow-x: auto;
        }
    </style>
</head>
<body>

<div class="container">
<div class="mb-3">
        <a href="/dashboard" class="btn btn-primary">Home</a>
    </div>
    <h2 class="table-title">Data Statik CRUD</h2>

    <!-- Form untuk Menambah atau Memperbarui Data -->
    <form id="dataForm" class="mb-4">
        <div class="mb-3">
            <label for="type_unit" class="form-label">Type Unit</label>
            <input type="text" class="form-control" id="type_unit" required>
        </div>
        <div class="mb-3">
            <label for="LEBAR_BIDANG_static" class="form-label">LEBAR BIDANG Static</label>
            <input type="number" class="form-control" id="LEBAR_BIDANG_static">
        </div>
        <div class="mb-3">
            <label for="TINGGI_BALOK_A_static" class="form-label">TINGGI BALOK A Static</label>
            <input type="number" class="form-control" id="TINGGI_BALOK_A_static">
        </div>
        <div class="mb-3">
            <label for="TINGGI_BALOK_B_static" class="form-label">TINGGI BALOK B Static</label>
            <input type="number" class="form-control" id="TINGGI_BALOK_B_static">
        </div>
        <div class="mb-3">
            <label for="TINGGI_CEILING_A_static" class="form-label">TINGGI CEILING A Static</label>
            <input type="number" class="form-control" id="TINGGI_CEILING_A_static">
        </div>
        <div class="mb-3">
            <label for="TINGGI_CEILING_B_static" class="form-label">TINGGI CEILING B Static</label>
            <input type="number" class="form-control" id="TINGGI_CEILING_B_static">
        </div>
        <div class="mb-3">
            <label for="TINGGI_CEILING_C_static" class="form-label">TINGGI CEILING C Static</label>
            <input type="number" class="form-control" id="TINGGI_CEILING_C_static">
        </div>
        <div class="mb-3">
            <label for="Siku_Dinding_base_static" class="form-label">Siku Dinding Base Static</label>
            <input type="number" class="form-control" id="Siku_Dinding_base_static">
        </div>
        <div class="mb-3">
            <label for="Siku_Dinding_wall_static" class="form-label">Siku Dinding Wall Static</label>
            <input type="number" class="form-control" id="Siku_Dinding_wall_static">
        </div>
        <div class="mb-3">
            <label for="Sudut_Lantai_x_Dinding_static" class="form-label">Sudut Lantai x Dinding Static</label>
            <input type="number" class="form-control" id="Sudut_Lantai_x_Dinding_static">
        </div>
        <div class="mb-3">
            <label for="TITIK_KRAN_AIR_L_static" class="form-label">TITIK KRAN AIR L Static</label>
            <input type="number" class="form-control" id="TITIK_KRAN_AIR_L_static">
        </div>
        <div class="mb-3">
            <label for="TITIK_KRAN_AIR_T_static" class="form-label">TITIK KRAN AIR T Static</label>
            <input type="number" class="form-control" id="TITIK_KRAN_AIR_T_static">
        </div>
        <div class="mb-3">
            <label for="TITIK_DISPOSAL_PIPE_static" class="form-label">TITIK DISPOSAL PIPE Static</label>
            <input type="number" class="form-control" id="TITIK_DISPOSAL_PIPE_static">
        </div>
        <div class="mb-3">
            <label for="LEBAR_MINIMAL_MCB_static" class="form-label">LEBAR MINIMAL MCB Static</label>
            <input type="number" class="form-control" id="LEBAR_MINIMAL_MCB_static">
        </div>
        <div class="mb-3">
            <label for="LEBAR_MAXIMAL_MCB_static" class="form-label">LEBAR MAXIMAL MCB Static</label>
            <input type="number" class="form-control" id="LEBAR_MAXIMAL_MCB_static">
        </div>
        <div class="mb-3">
            <label for="TINGGI_MCB_static" class="form-label">TINGGI MCB Static</label>
            <input type="number" class="form-control" id="TINGGI_MCB_static">
        </div>
        <button type="submit" class="btn btn-primary" id="saveBtn">Simpan</button>
    </form>

    <!-- Tabel Data -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Type Unit</th>
                    <th>LEBAR BIDANG</th>
                    <th>TINGGI BALOK A</th>
                    <th>TINGGI BALOK B</th>
                    <th>TINGGI CEILING A</th>
                    <th>TINGGI CEILING B</th>
                    <th>TINGGI CEILING C</th>
                    <th>Siku Dinding Base</th>
                    <th>Siku Dinding Wall</th>
                    <th>Sudut Lantai x Dinding</th>
                    <th>TITIK KRAN AIR L</th>
                    <th>TITIK KRAN AIR T</th>
                    <th>TITIK DISPOSAL PIPE</th>
                    <th>LEBAR MINIMAL MCB</th>
                    <th>LEBAR MAXIMAL MCB</th>
                    <th>TINGGI MCB</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="dataTableBody">
                <!-- Data akan dimasukkan secara dinamis di sini -->
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const apiUrl = 'https://qc-pass.technice.id/api/data-statik';

    // Fungsi untuk mengambil dan menampilkan semua data
    async function fetchData() {
        try {
            const response = await fetch(apiUrl);
            const data = await response.json();
            const tableBody = document.getElementById('dataTableBody');
            tableBody.innerHTML = ''; // Kosongkan tabel sebelum memasukkan data baru

            data.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.type_unit}</td>
                    <td>${item.LEBAR_BIDANG_static || '-'}</td>
                    <td>${item.TINGGI_BALOK_A_static || '-'}</td>
                    <td>${item.TINGGI_BALOK_B_static || '-'}</td>
                    <td>${item.TINGGI_CEILING_A_static || '-'}</td>
                    <td>${item.TINGGI_CEILING_B_static || '-'}</td>
                    <td>${item.TINGGI_CEILING_C_static || '-'}</td>
                    <td>${item.Siku_Dinding_base_static || '-'}</td>
                    <td>${item.Siku_Dinding_wall_static || '-'}</td>
                    <td>${item.Sudut_Lantai_x_Dinding_static || '-'}</td>
                    <td>${item.TITIK_KRAN_AIR_L_static || '-'}</td>
                    <td>${item.TITIK_KRAN_AIR_T_static || '-'}</td>
                    <td>${item.TITIK_DISPOSAL_PIPE_static || '-'}</td>
                    <td>${item.LEBAR_MINIMAL_MCB_static || '-'}</td>
                    <td>${item.LEBAR_MAXIMAL_MCB_static || '-'}</td>
                    <td>${item.TINGGI_MCB_static || '-'}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="editData('${item.type_unit}')">Edit</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteData('${item.type_unit}')">Delete</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    }

    // Fungsi untuk menambah data (POST)
    document.getElementById('dataForm').addEventListener('submit', async function(event) {
        event.preventDefault();

        const data = {
            type_unit: document.getElementById('type_unit').value,
            LEBAR_BIDANG_static: document.getElementById('LEBAR_BIDANG_static').value || null,
            TINGGI_BALOK_A_static: document.getElementById('TINGGI_BALOK_A_static').value || null,
            TINGGI_BALOK_B_static: document.getElementById('TINGGI_BALOK_B_static').value || null,
            TINGGI_CEILING_A_static: document.getElementById('TINGGI_CEILING_A_static').value || null,
            TINGGI_CEILING_B_static: document.getElementById('TINGGI_CEILING_B_static').value || null,
            TINGGI_CEILING_C_static: document.getElementById('TINGGI_CEILING_C_static').value || null,
            Siku_Dinding_base_static: document.getElementById('Siku_Dinding_base_static').value || null,
            Siku_Dinding_wall_static: document.getElementById('Siku_Dinding_wall_static').value || null,
            Sudut_Lantai_x_Dinding_static: document.getElementById('Sudut_Lantai_x_Dinding_static').value || null,
            TITIK_KRAN_AIR_L_static: document.getElementById('TITIK_KRAN_AIR_L_static').value || null,
            TITIK_KRAN_AIR_T_static: document.getElementById('TITIK_KRAN_AIR_T_static').value || null,
            TITIK_DISPOSAL_PIPE_static: document.getElementById('TITIK_DISPOSAL_PIPE_static').value || null,
            LEBAR_MINIMAL_MCB_static: document.getElementById('LEBAR_MINIMAL_MCB_static').value || null,
            LEBAR_MAXIMAL_MCB_static: document.getElementById('LEBAR_MAXIMAL_MCB_static').value || null,
            TINGGI_MCB_static: document.getElementById('TINGGI_MCB_static').value || null,
        };

        // POST request untuk menambah data baru
        try {
            const response = await fetch(apiUrl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data),
            });

            if (response.ok) {
                fetchData();  // Ambil dan tampilkan data terbaru
                alert('Data berhasil disimpan');
                document.getElementById('dataForm').reset(); // Reset form setelah simpan
            } else {
                alert('Gagal menyimpan data');
            }
        } catch (error) {
            console.error('Error saving data:', error);
        }
    });

    // Fungsi untuk edit data (memuat data ke form)
    async function editData(type_unit) {
        try {
            const response = await fetch(`${apiUrl}/${type_unit}`);
            const data = await response.json();

            // Isi form dengan data yang akan diedit
            document.getElementById('type_unit').value = data.type_unit;
            document.getElementById('LEBAR_BIDANG_static').value = data.LEBAR_BIDANG_static;
            document.getElementById('TINGGI_BALOK_A_static').value = data.TINGGI_BALOK_A_static;
            document.getElementById('TINGGI_BALOK_B_static').value = data.TINGGI_BALOK_B_static;
            document.getElementById('TINGGI_CEILING_A_static').value = data.TINGGI_CEILING_A_static;
            document.getElementById('TINGGI_CEILING_B_static').value = data.TINGGI_CEILING_B_static;
            document.getElementById('TINGGI_CEILING_C_static').value = data.TINGGI_CEILING_C_static;
            document.getElementById('Siku_Dinding_base_static').value = data.Siku_Dinding_base_static;
            document.getElementById('Siku_Dinding_wall_static').value = data.Siku_Dinding_wall_static;
            document.getElementById('Sudut_Lantai_x_Dinding_static').value = data.Sudut_Lantai_x_Dinding_static;
            document.getElementById('TITIK_KRAN_AIR_L_static').value = data.TITIK_KRAN_AIR_L_static;
            document.getElementById('TITIK_KRAN_AIR_T_static').value = data.TITIK_KRAN_AIR_T_static;
            document.getElementById('TITIK_DISPOSAL_PIPE_static').value = data.TITIK_DISPOSAL_PIPE_static;
            document.getElementById('LEBAR_MINIMAL_MCB_static').value = data.LEBAR_MINIMAL_MCB_static;
            document.getElementById('LEBAR_MAXIMAL_MCB_static').value = data.LEBAR_MAXIMAL_MCB_static;
            document.getElementById('TINGGI_MCB_static').value = data.TINGGI_MCB_static;

            // Ubah tombol simpan menjadi update
            const saveButton = document.getElementById('saveBtn');
            saveButton.textContent = 'Update';
            saveButton.onclick = () => updateData(type_unit); // Panggil fungsi update ketika tombol diklik
        } catch (error) {
            console.error('Error editing data:', error);
        }
    }

    // Fungsi untuk update data (PUT)
    async function updateData(type_unit) {
        const data = {
            type_unit: document.getElementById('type_unit').value,
            LEBAR_BIDANG_static: document.getElementById('LEBAR_BIDANG_static').value || null,
            TINGGI_BALOK_A_static: document.getElementById('TINGGI_BALOK_A_static').value || null,
            TINGGI_BALOK_B_static: document.getElementById('TINGGI_BALOK_B_static').value || null,
            TINGGI_CEILING_A_static: document.getElementById('TINGGI_CEILING_A_static').value || null,
            TINGGI_CEILING_B_static: document.getElementById('TINGGI_CEILING_B_static').value || null,
            TINGGI_CEILING_C_static: document.getElementById('TINGGI_CEILING_C_static').value || null,
            Siku_Dinding_base_static: document.getElementById('Siku_Dinding_base_static').value || null,
            Siku_Dinding_wall_static: document.getElementById('Siku_Dinding_wall_static').value || null,
            Sudut_Lantai_x_Dinding_static: document.getElementById('Sudut_Lantai_x_Dinding_static').value || null,
            TITIK_KRAN_AIR_L_static: document.getElementById('TITIK_KRAN_AIR_L_static').value || null,
            TITIK_KRAN_AIR_T_static: document.getElementById('TITIK_KRAN_AIR_T_static').value || null,
            TITIK_DISPOSAL_PIPE_static: document.getElementById('TITIK_DISPOSAL_PIPE_static').value || null,
            LEBAR_MINIMAL_MCB_static: document.getElementById('LEBAR_MINIMAL_MCB_static').value || null,
            LEBAR_MAXIMAL_MCB_static: document.getElementById('LEBAR_MAXIMAL_MCB_static').value || null,
            TINGGI_MCB_static: document.getElementById('TINGGI_MCB_static').value || null,
        };

        try {
            const response = await fetch(`${apiUrl}/${type_unit}`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data),
            });

            if (response.ok) {
                fetchData(); // Ambil data terbaru
                alert('Data berhasil diperbarui');
                document.getElementById('dataForm').reset(); // Reset form setelah update
                const saveButton = document.getElementById('saveBtn');
                saveButton.textContent = 'Simpan'; // Reset tombol ke "Simpan"
            } else {
                alert('Gagal memperbarui data');
            }
        } catch (error) {
            console.error('Error updating data:', error);
        }
    }

    // Fungsi untuk menghapus data
    async function deleteData(type_unit) {
        try {
            const response = await fetch(`${apiUrl}/${type_unit}`, {
                method: 'DELETE',
            });

            if (response.ok) {
                fetchData();  // Ambil dan tampilkan data terbaru setelah dihapus
                alert('Data berhasil dihapus');
            } else {
                alert('Gagal menghapus data');
            }
        } catch (error) {
            console.error('Error deleting data:', error);
        }
    }

    // Ambil data ketika halaman dimuat
    fetchData();
</script>

</body>
</html>
