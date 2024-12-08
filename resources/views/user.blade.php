<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Staff CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      /* General body styling */
body {
    background-color: #f0f0f0; /* Light grey background */
    background-image: url('images/background.jpg'); /* Background image */
    background-size: cover; /* Cover the whole screen */
    background-position: center; /* Center the background image */
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
}

/* Container styling */
.container {
    min-height: 100vh;
    padding-top: 40px;
}

/* Heading styling */
h2 {
    font-size: 2.5rem;
    font-weight: bold;
    color: #343a40;
}

/* Form styling */
.form-label {
    font-weight: bold;
    color: #495057;
}

.form-control, .form-select {
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    border-radius: 5px;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}

/* Message box styling */
#message {
    font-size: 1.2rem;
    padding: 10px;
    border-radius: 8px;
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

/* Button styling */
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
<div class="container">
<div class="mb-3">
        <a href="/dashboard" class="btn btn-primary">Home</a>
    </div>
    <h2 class="my-4">User Staff Management</h2>

    <form id="userForm" class="mb-4">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password">
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select" id="role" required>
                <option value="admin">Admin</option>
                <option value="staff">Staff</option>
                <option value="vendor">Vendor</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" id="submitBtn">Tambah User</button>
    </form>

    <div id="message" class="alert alert-info" style="display: none;"></div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
                <!-- Data will be inserted dynamically -->
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const apiUrl = 'https://qc-pass.technice.id/api/user';

    // Fetch and display all users
    async function fetchUsers() {
        const response = await fetch(apiUrl);
        const users = await response.json();
        const tableBody = document.getElementById('userTableBody');
        tableBody.innerHTML = '';
        
        users.forEach(user => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${user.username}</td>
                <td>${user.role}</td>
                <td>
                    <button class="btn btn-warning btn-sm" onclick="editUser('${user.username}')">Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="deleteUser('${user.username}')">Delete</button>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }

    // Handle form submission (POST or PUT)
    document.getElementById('userForm').addEventListener('submit', async function(event) {
        event.preventDefault();
        
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;
        const role = document.getElementById('role').value;

        const data = { username, role };
        if (password) {
            data.password = password;
        }

        const method = document.getElementById('submitBtn').textContent === 'Tambah User' ? 'POST' : 'PUT';
        const url = method === 'PUT' ? `${apiUrl}/${username}` : apiUrl;
        
        try {
            const response = await fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            });

            const result = await response.json();
            document.getElementById('message').style.display = 'block';
            document.getElementById('message').textContent = result.message;
            fetchUsers();  // Reload the user list
            document.getElementById('userForm').reset();
            document.getElementById('submitBtn').textContent = 'Tambah User';  // Reset form button
        } catch (error) {
            console.error(error);
        }
    });

    // Edit user (pre-fill the form)
    async function editUser(username) {
        const response = await fetch(`${apiUrl}/${username}`);
        const user = await response.json();

        document.getElementById('username').value = user.username;
        document.getElementById('password').value = '';
        document.getElementById('role').value = user.role;
        document.getElementById('submitBtn').textContent = 'Perbarui User';  // Change button text to "Update"
    }

    // Delete user
    async function deleteUser(username) {
        if (confirm('Are you sure you want to delete this user?')) {
            try {
                const response = await fetch(`${apiUrl}/${username}`, { method: 'DELETE' });
                const result = await response.json();
                alert(result.message);
                fetchUsers();  // Reload the user list
            } catch (error) {
                console.error(error);
            }
        }
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', fetchUsers);
</script>
</body>
</html>
