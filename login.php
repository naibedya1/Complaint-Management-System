<?php
include 'config.php';
session_start();
$pageTitle = "Login";
include 'template/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($query);
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['is_admin'] = ($user['role'] == 'Admin') ? true : false;  

        if ($_SESSION["is_admin"]) {
            header("Location: admin_dashboard.php"); 
        } else {
            header("Location: user_dashboard.php"); 
        }
        exit; 
        
    } else {
        echo "<p class='text-red-500 text-center mt-4'>Invalid credentials.</p>";
    }
}
?>
<div class="flex justify-center align-center pt-10">
<div class="w-full max-w-sm bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-semibold text-gray-700 text-center">Login to Your Account</h2>
    <form method="post" class="mt-6">
        <div class="mb-4">
            <label for="email" class="block text-gray-600">Email</label>
            <input type="email" name="email" id="email" placeholder="Email" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500" required>
        </div>
        <div class="mb-6">
            <label for="password" class="block text-gray-600">Password</label>
            <input type="password" name="password" id="password" placeholder="Password" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500" required>
        </div>
        <button type="submit" class="w-full bg-indigo-500 text-white py-2 rounded-md hover:bg-indigo-600 transition duration-200">Login</button>
    </form>
    <p class="text-center text-gray-600 mt-4">Don't have an account? <a href="register.php" class="text-indigo-500 hover:underline">Sign up</a></p>
</div>
</div>

<?php include 'template/footer.php';  ?>
