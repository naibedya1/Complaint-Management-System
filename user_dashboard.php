<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['user_id'];
 
$query = "SELECT name, email FROM users WHERE id = $userId";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $userName = $user['name'];
    $userEmail = $user['email'];
} else {
    echo "User not found";
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $priority = $_POST['priority'];
    $category = $_POST['category'];

    $query = "INSERT INTO complaints (user_id, title, description, priority, category) 
              VALUES ('$userId', '$title', '$description', '$priority', '$category')";
    $conn->query($query);
}


$complaints = $conn->query("SELECT * FROM complaints WHERE user_id = $userId");
?>

<?php include 'template/header.php'; ?>
<div class="w-full  px-10">
    <div class="flex justify-between items-center px-10 py-4 ">
        <div class="flex flex-col gap-3">
           <h1 class="text-4xl font-semibold text-blue-700 "> Welcome, <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 via-purple-600 to-pink-500">  <?= $userName ?></span>
           </h1>
            <p class="text-gray-700">Email: <?=$userEmail ?></p>
</div>

    <a href="add_complain.php" class="bg-indigo-500 text-white px-6 py-2 rounded-md hover:bg-indigo-600 transition duration-200">Raise a Complain</a>
    </div>

    <!-- Complaints List -->
    <div class="w-full  mx-auto mt-10">
        <h2 class="text-3xl font-semibold  text-gray-800 mb-6">Your Complaints</h2>
        <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
    <thead>
        <tr>
            <th class="py-3 px-6 text-left text-sm font-semibold text-gray-600">Title</th>
            <th class="py-3 px-6 text-left text-sm font-semibold text-gray-600">Description</th>
            <th class="py-3 px-6 text-left text-sm font-semibold text-gray-600">Priority</th>
            <th class="py-3 px-6 text-left text-sm font-semibold text-gray-600">Category</th>
            <th class="py-3 px-6 text-left text-sm font-semibold text-gray-600">Status</th>
            <th class="py-3 px-6 text-left text-sm font-semibold text-gray-600">Created At</th>
            <!-- <th class="py-3 px-6 text-left text-sm font-semibold text-gray-600">Action</th> -->
        </tr>
    </thead>
    <tbody>
        <?php while ($complaint = $complaints->fetch_assoc()): ?>
        <tr class="border-b hover:bg-gray-50">
            <td class="py-3 px-6 text-sm text-gray-700"><?= $complaint['title'] ?></td>
            <td class="py-3 px-6 text-sm text-gray-700"><?= $complaint['description'] ?></td>
            <td class="py-3 px-6 text-sm text-gray-700"><?= $complaint['priority'] ?></td>
            <td class="py-3 px-6 text-sm text-gray-700"><?= $complaint['category'] ?></td>
            <td class="py-3 px-6 text-sm text-gray-700"><?= $complaint['status'] ?></td>
            <td class="py-3 px-6 text-sm text-gray-700"><?= $complaint['created_at'] ?></td>
            <td class="py-3 px-6 text-sm text-gray-700">
                <form method="post" action="delete_complaint.php" class="inline-block">
                    <input type="hidden" name="complaint_id" value="<?= $complaint['id'] ?>">
                    <button type="submit" class="text-red-600 hover:text-red-800" title="Delete">
                        <i class="fa fa-trash fa-2x"></i>
                    </button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
        </div>
    </div>
</div>
<?php include 'template/footer.php'; ?>
