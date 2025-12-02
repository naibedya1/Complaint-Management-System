<?php
session_start();
include 'config.php';

if (!isset($_SESSION['is_admin'])) {
    header("Location: login.php");
    exit;
}

$complaints = $conn->query("SELECT complaints.*, users.name FROM complaints JOIN users ON complaints.user_id = users.id");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $complaintId = $_POST['complaint_id'];
    $status = $_POST['status'];

    $query = "UPDATE complaints SET status = '$status' WHERE id = $complaintId";
    $conn->query($query);
}
?>
<table class="table">
    <tr>
        <th>User</th>
        <th>Title</th>
        <th>Description</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    <?php while ($complaint = $complaints->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($complaint['name']) ?></td>
        <td><?= htmlspecialchars($complaint['title']) ?></td>
        <td><?= htmlspecialchars($complaint['description']) ?></td>
        <td><?= htmlspecialchars($complaint['status']) ?></td>
        <td>
            <form method="post">
                <input type="hidden" name="complaint_id" value="<?= $complaint['id'] ?>">
                <select name="status" class="select">
                    <option <?= $complaint['status'] == 'Pending' ? 'selected' : '' ?> value="Pending">Pending</option>
                    <option <?= $complaint['status'] == 'Resolved' ? 'selected' : '' ?> value="Resolved">Resolved</option>
                </select>
                <button type="submit" class="btn">Update</button>
            </form>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
