<?php
session_start();
include 'config.php';


if (!isset($_SESSION['is_admin'])) {
    header("Location: login.php");
    exit;
}

$complaints = $conn->query("SELECT complaints.*, users.name FROM complaints JOIN users ON complaints.user_id = users.id");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update'])) {
        $complaintId = $_POST['complaint_id'];
        $status = $_POST['status'];

        $query = "UPDATE complaints SET status = '$status' WHERE id = $complaintId";
        $conn->query($query);
    }
    if (isset($_POST['delete'])) {
        $complaintId = $_POST['complaint_id'];

        $query = "DELETE FROM complaints WHERE id = $complaintId";
        $conn->query($query);
    }
}
?>

<?php include 'template/header.php'; ?>

<div class="container mx-auto mt-6 px-4">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Manage Complaints</h1>

    
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full table-auto">
            <thead class="bg-indigo-600  text-white">
                <tr>
                    <th class="px-4 py-2 text-left">User</th>
                    <th class="px-4 py-2 text-left">Title</th>
                    <th class="px-4 py-2 text-left">Description</th>
                    <th class="px-4 py-2 text-left">Category</th>
                    <th class="px-4 py-2 text-left">Priority</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="bg-gray-50">
                <?php while ($complaint = $complaints->fetch_assoc()): ?>
                <tr class="border-b hover:bg-gray-100">
                    <td class="px-4 py-2"><?= htmlspecialchars($complaint['name']) ?></td>
                    <td class="px-4 py-2"><?= htmlspecialchars($complaint['title']) ?></td>
                    <td class="px-4 py-2"><?= htmlspecialchars($complaint['description']) ?></td>
                    <td class="px-4 py-2"><?= htmlspecialchars($complaint['category']) ?></td>
                    <td class="px-4 py-2"><?= htmlspecialchars($complaint['priority']) ?></td>
                    <td class="px-4 py-2"><?= htmlspecialchars($complaint['status']) ?></td>
                    <td class="px-4 py-2">
                        <form method="post" class="inline-block">
                            <input type="hidden" name="complaint_id" value="<?= $complaint['id'] ?>">
                            
                            
                            <select name="status" class="px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option <?= $complaint['status'] == 'Pending' ? 'selected' : '' ?> value="Pending">Pending</option>
                                <option <?= $complaint['status'] == 'In Progress' ? 'selected' : '' ?> value="In Progress">In Progress</option>
                                <option <?= $complaint['status'] == 'Resolved' ? 'selected' : '' ?> value="Resolved">Resolved</option>
                            </select>

                            

                            <button type="submit" name="update" class="ml-2 bg-indigo-500 text-white py-2 px-4 rounded-md hover:bg-indigo-600 transition duration-200">Update</button>
                        </form>
                        
                        
                        <form method="post" class="inline-block ml-2">
                            <input type="hidden" name="complaint_id" value="<?= $complaint['id'] ?>">
                            <button type="submit" name="delete" class="bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600 transition duration-200">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'template/footer.php'; ?>

