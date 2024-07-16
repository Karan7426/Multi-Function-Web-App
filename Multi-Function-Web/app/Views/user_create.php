<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="mb-3">
            <a href="/" class="btn btn-secondary mb-3">Back to User List</a>
        </div>

        <h2 class="mb-4">Create User</h2>

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="/create/" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="<?= old('name') ?>">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" id="email" class="form-control" value="<?= old('email') ?>">
            </div>

            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile:</label>
                <input type="text" name="mobile" id="mobile" class="form-control" value="<?= old('mobile') ?>">
            </div>

            <div class="mb-3">
                <label for="profile_pic" class="form-label">Profile Pic:</label>
                <input type="file" name="profile_pic" id="profile_pic" class="form-control">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
