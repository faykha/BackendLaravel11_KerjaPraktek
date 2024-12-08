<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Staff CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
