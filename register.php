<?php
include 'config.php';
$pageTitle = "Register"; 
include 'template/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone = $_POST['phone']; 

    $query = "INSERT INTO users (name, email, password, phone) VALUES ('$name', '$email', '$password', '$phone')";
    if ($conn->query($query) === TRUE) {
        header("Location: login.php"); 
        exit;
    } else {
        echo "<p class='text-red-500 text-center mt-4'>Error: " . $conn->error . "</p>";
    }
}
?>
<div class="flex justify-center align-center pt-10">
<div class="w-full max-w-sm bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-semibold text-gray-700 text-center">Create an Account</h2>
    <form method="post" class="mt-6">
        
        <div class="mb-4">
            <label for="name" class="block text-gray-600">Name</label>
            <input type="text" name="name" id="name" placeholder="Name" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500" required>
        </div>
        
        <div class="mb-4">
            <label for="email" class="block text-gray-600">Email</label>
            <input type="email" name="email" id="email" placeholder="Email" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500" required>
        </div>
        
        <div class="mb-4">
            <label for="password" class="block text-gray-600">Password</label>
            <input type="password" name="password" id="password" placeholder="Password" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500" required>
        </div>
        
        <div class="mb-4">
            <label for="phone" class="block text-gray-600">Phone</label>
            <input type="text" name="phone" id="phone" placeholder="Phone Number" require class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500">
        </div>
        
        
        <button type="submit" class="w-full bg-indigo-500 text-white py-2 rounded-md hover:bg-indigo-600 transition duration-200">Register</button>
    </form>
    <p class="text-center text-gray-600 mt-4">Already have an account? <a href="login.php" class="text-indigo-500 hover:underline">Login here</a></p>
</div>
<div>
<?php include 'template/footer.php'; ?>
