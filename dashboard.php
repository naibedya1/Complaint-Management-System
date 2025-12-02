<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];

    $query = "INSERT INTO complaints (user_id, title, description) VALUES ('$userId', '$title', '$description')";
    $conn->query($query);
}

$complaints = $conn->query("SELECT * FROM complaints WHERE user_id = $userId");
?>
<form method="post">
    <input type="text" name="title" placeholder="Title" class="input" required>
    <textarea name="description" placeholder="Description" class="input" required></textarea>
    <button type="submit" class="btn">Submit Complaint</button>
</form>

<h2>Your Complaints</h2>
<table class="table">
    <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Status</th>
        <th>Created At</th>
    </tr>
    <?php while ($complaint = $complaints->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($complaint['title']) ?></td>
        <td><?= htmlspecialchars($complaint['description']) ?></td>
        <td><?= htmlspecialchars($complaint['status']) ?></td>
        <td><?= htmlspecialchars($complaint['created_at']) ?></td>
    </tr>
    <?php endwhile; ?>
</table>
