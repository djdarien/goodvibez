<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $product = $_POST['product'];
    $audience = $_POST['audience'];
    $email = $_POST['email'];
    $userID = uniqid('vendor_'); // Generate a unique UserID

    // Send email to admin with form data
    $adminEmail = 'victoria@ampexpos.com';
    $adminSubject = 'New Vendor Application Submission';
    $adminMessage = "A new vendor has submitted their information:\n\n".
                    "Name: $name\n".
                    "Location: $location\n".
                    "Product: $product\n".
                    "Audience: $audience\n".
                    "Email: $email\n".
                    "UserID: $userID";
    $adminHeaders = "From: $email";
    mail($adminEmail, $adminSubject, $adminMessage, $adminHeaders);

    // Save to database
    $conn = new mysqli('localhost', 'username', 'password', 'vendor_application');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }
    $stmt = $conn->prepare("INSERT INTO vendors (userid, name, location, product, audience, email) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $userID, $name, $location, $product, $audience, $email);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    // Send email with UserID to the user
    $userSubject = 'Your Vendor Application - UserID';
    $userMessage = "Thank you for your submission! Your unique UserID is: $userID.\n\nYou can view your submitted data under the Vendor Bio section on our website.";
    $userHeaders = "From: victoria@ampexpos.com";
    mail($email, $userSubject, $userMessage, $userHeaders);

    // Store a flag to allow access to other pages
    session_start();
    $_SESSION['userID'] = $userID;
    $_SESSION['submitted'] = true;

    echo "<p>Thank you for your submission! An email has been sent to you with your UserID.</p>";
} else {
?>
<form method="post" action="?page=questionnaire">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required><br>

    <label for="location">Location:</label>
    <input type="text" name="location" id="location" required><br>

    <label for="product">What do you sell?</label>
    <input type="text" name="product" id="product" required><br>

    <label for="audience">Who do you sell to?</label>
    <input type="text" name="audience" id="audience" required><br>

    <label for="email">Your Email:</label>
    <input type="email" name="email" id="email" required><br>

    <button type="submit">Submit</button>
</form>
<?php
}
?>
