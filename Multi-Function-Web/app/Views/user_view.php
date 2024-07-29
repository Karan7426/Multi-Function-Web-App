<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">User List</h2>
        <a href="/create/" class="btn btn-success mb-3">Create User</a>
        <a href="/exportCSV/" class="btn btn-info mb-3">Export to CSV</a>

        <input type="text" id="search" class="form-control mb-4" placeholder="Search by name...">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Profile Pic</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="user-list">
                <?php if (!empty($users) && is_array($users)): ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $user['id']; ?></td>
                            <td><?= $user['name']; ?></td>
                            <td><?= $user['email']; ?></td>
                            <td><?= $user['mobile']; ?></td>
                            <td><img src="/uploads/<?= $user['profile_pic']; ?>" width="50" height="50" class="img-thumbnail"></td>
                            <td>
                                <a href="/update/<?= $user['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                <form action="/delete/<?= $user['id']; ?>" method="post" style="display:inline;">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">No users found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                var query = $(this).val();
                $.ajax({
                    url: "/filter-users",
                    type: "GET",
                    data: {'query': query},
                    success: function(data) {
                        $('#user-list').html(data);
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
