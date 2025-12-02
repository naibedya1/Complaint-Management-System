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
    $priority = $_POST['priority'];
    $category = $_POST['category'];

    $query = "INSERT INTO complaints (user_id, title, description, priority, category) 
              VALUES ('$userId', '$title', '$description', '$priority', '$category')";
    if($conn->query($query)){
        header("Location: user_dashboard.php");
    }else{
        echo "Failed to add Complain";
    }
}  
?>
<?php include 'template/header.php'; ?>
<div class="pt-10">
<div class="w-full max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg ">
        <h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">Submit a Complaint</h2>
        <form method="post" class="space-y-4">
            <!-- Title -->
            <div>
                <label for="title" class="block text-gray-700">Title</label>
                <input type="text" name="title" id="title" placeholder="Enter complaint title" 
                       class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:outline-none" required>
            </div>
            
            <div>
                <label for="description" class="block text-gray-700">Description</label>
                <textarea name="description" id="description" placeholder="Enter complaint description" 
                          class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:outline-none" rows="4" required></textarea>
            </div>
            
            <div>
                <label for="priority" class="block text-gray-700">Priority</label>
                <select name="priority" id="priority" 
                        class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:outline-none" required>
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="High">High</option>
                </select>
            </div>
            
            <div>
                <label for="category" class="block text-gray-700">Category</label>
                <select name="category" id="category" 
                        class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:outline-none" required>
                    <option value="Technical">Technical</option>
                    <option value="Billing">Billing</option>
                    <option value="General">General</option>
                </select>
            </div>
            
            <div class="flex justify-center">
                <button type="submit" class="bg-indigo-500 text-white px-6 py-2 rounded-md hover:bg-indigo-600 transition duration-200">Submit Complaint</button>
            </div>
        </form>
    </div>
</div>

    <?php include 'template/footer.php'; ?>
