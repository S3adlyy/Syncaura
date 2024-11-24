<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Message</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Update Message</h2>
        <form action="contact.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $messageData['id']; ?>" required>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo htmlspecialchars($messageData['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="<?php echo htmlspecialchars($messageData['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea name="message" id="message" class="form-control" rows="4" required><?php echo htmlspecialchars($messageData['message']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="dash.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
