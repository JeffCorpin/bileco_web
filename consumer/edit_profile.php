<?php
ob_start(); // Start output buffering
session_start();

include 'header.php'; // Include your header

$servername = "localhost"; // Your database server
$username = "root"; // Your MySQL username (default is "root" in XAMPP)
$password = ""; // Your MySQL password (default is empty in XAMPP)
$database = "bileco_system"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character encoding to UTF-8
$conn->set_charset("utf8");

$user_id = $_SESSION['id']; // Get the logged-in user's ID from session

// Fetch the user details from the consumer table
$sql = "SELECT * FROM consumer WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// If the form is submitted, update the user's profile in the database
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the updated profile data from the form submission
    $accountnum   = $_POST['accountnum'];
    $firstname    = $_POST['firstname'];
    $middlename   = $_POST['middlename'];
    $lastname     = $_POST['lastname'];
    $email        = $_POST['email'];
    $address      = $_POST['address'];
    $contactnumber= $_POST['contactnumber'];

    // Set the default profile image path to the existing one
    $profileImagePath = isset($user['profile_image']) ? $user['profile_image'] : null;


    // Check if a file was uploaded without errors
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath   = $_FILES['profile_image']['tmp_name'];
        $fileName      = $_FILES['profile_image']['name'];
        $fileSize      = $_FILES['profile_image']['size'];
        $fileType      = $_FILES['profile_image']['type'];
        $fileNameCmps  = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Define allowed file extensions
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");

        if (in_array($fileExtension, $allowedExtensions)) {
            // Generate a new unique file name
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            // Define the upload directory
            $uploadFileDir = './uploads/';
            if (!file_exists($uploadFileDir)) {
                mkdir($uploadFileDir, 0777, true);
            }
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $profileImagePath = $dest_path;
            } else {
                echo "There was an error moving the uploaded file.";
            }
        } else {
            echo "Upload failed. Allowed file types: " . implode(', ', $allowedExtensions);
        }
    }

    // Update the user's profile in the database including the profile image path
    $update_sql = "UPDATE consumer SET accountnum = ?, firstname = ?, middlename = ?, lastname = ?, email = ?, address = ?, contactnumber = ?, profile_image = ? WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ssssssssi", $accountnum, $firstname, $middlename, $lastname, $email, $address, $contactnumber, $profileImagePath, $user_id);

    if ($stmt->execute()) {
        // Redirect to profile.php after successful update
        header("Location: profile.php");
        exit();
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}

ob_end_flush(); // Flush output buffer
?>

<html>
<head>
    <title>Edit Profile</title>
    <style>
        .profile-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h2>Edit Profile</h2>

    <?php if ($user): ?>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="accountnum">Account Number:</label>
                <input type="text" class="form-control" id="accountnum" name="accountnum" value="<?= htmlspecialchars($user['accountnum']); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="firstname">First Name:</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="<?= htmlspecialchars($user['firstname']); ?>" required>
            </div>
            <div class="form-group">
                <label for="middlename">Middle Name:</label>
                <input type="text" class="form-control" id="middlename" name="middlename" value="<?= htmlspecialchars($user['middlename']); ?>">
            </div>
            <div class="form-group">
                <label for="lastname">Last Name:</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="<?= htmlspecialchars($user['lastname']); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" name="address" value="<?= htmlspecialchars($user['address']); ?>" required>
            </div>
            <div class="form-group">
                <label for="contactnumber">Contact Number:</label>
                <input type="text" class="form-control" id="contactnumber" name="contactnumber" value="<?= htmlspecialchars($user['contactnumber']); ?>" required>
            </div>
            <div class="form-group">
                <label for="profile_image">Profile Image:</label><br>
                <?php if (!empty($user['profile_image'])): ?>
                    <img src="<?= htmlspecialchars($user['profile_image']); ?>" alt="Profile Picture" class="profile-image"><br>
                <?php endif; ?>
                <input type="file" class="form-control-file" id="profile_image" name="profile_image">
            </div>
            <button type="submit" class="btn btn-success mt-3">Save Changes</button>
        </form>
    <?php else: ?>
        <p>User not found.</p>
    <?php endif; ?>
</div>
</body>
</html>
