<?php

session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: user_dashboard.php");
    exit;
}

$pageTitle = "Home";

include 'template/header.php';
?>
<div class="pt-10 flex justify-center align-center">
<div class="max-w-4xl">

<div class="bg-white shadow-md rounded-lg p-6 text-center">
    <h2 class="text-3xl font-semibold text-blue-600">Welcome to the Complaint Management System</h2>
    <p class="mt-4 text-gray-600">
        Easily lodge complaints, track their status, and stay updated.
    </p>
</div>


<section class="mt-10 grid md:grid-cols-3 gap-6">
    
    <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-xl font-semibold text-blue-600">Launch Complaints</h3>
        <p class="mt-2 text-gray-600">
            Submit complaints quickly with our easy-to-use platform.
        </p>
    </div>
    
    <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-xl font-semibold text-blue-600">Track Status</h3>
        <p class="mt-2 text-gray-600">
            Get real-time updates on the status of your complaints.
        </p>
    </div>
    
    <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-xl font-semibold text-blue-600">Stay Notified</h3>
        <p class="mt-2 text-gray-600">
            Receive email notifications once your issue is resolved.
        </p>
    </div>
</section>


<div class="text-center mt-16">
    <a href="login.php" class="bg-blue-600 text-white py-3 px-6 rounded-md shadow-md hover:bg-blue-700 transition">
        Get Started
    </a>
</div>
<div>
</div>

<?php include 'template/footer.php'; ?>
