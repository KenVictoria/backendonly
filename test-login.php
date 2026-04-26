<?php

// Simple test script to verify login functionality
require_once 'vendor/autoload.php';

use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

// Test if users exist in database
$adminUser = User::where('email', 'admin@ccs.edu')->first();
$studentUser = Student::where('email', 'alex.rivera@student.ccs.edu')->first();

echo "Database Check:\n";
echo "Admin user exists: " . ($adminUser ? "YES" : "NO") . "\n";
echo "Student user exists: " . ($studentUser ? "YES" : "NO") . "\n";

if ($adminUser) {
    echo "Admin password hash: " . $adminUser->password . "\n";
}

if ($studentUser) {
    echo "Student password hash: " . $studentUser->password . "\n";
}

// Test password verification
if ($adminUser) {
    $passwordCheck = Hash::check('password', $adminUser->password);
    echo "Admin password verification: " . ($passwordCheck ? "PASS" : "FAIL") . "\n";
}

?>
