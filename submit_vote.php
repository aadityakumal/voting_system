<?php
include("admin/dbcon.php");
session_start();

if (isset($_SESSION['voters_id']) && isset($_SESSION['id'])) {
    // Store session variables in local variables for easier handling
    $voter_id = $_SESSION['voters_id'];
    $candidate_id = $_SESSION['cids'];
    print_r($_SESSION['cids']);
    foreach ($candidate_id as $cid) {
        echo $cid;
        // Prepare the SQL statement for inserting votes
        $stmt = $conn->prepare("INSERT INTO `votes` (`candidate_id`, `voters_id`) VALUES (?, ?)");
        $stmt->bind_param("ii", $cid, $voter_id);

        // Execute the statement and check for errors
        if ($stmt->execute()) {
            echo "Vote recorded for candidate ID: $cid with voter ID: $voter_id";
        } else {
            die(mysqli_error($conn));
        }

        // Close the prepared statement
        $stmt->close();
    }
    // Update the voter's status to 'Voted'
    $updateStmt = $conn->prepare("UPDATE `voters` SET `status` = 'Voted' WHERE `voters_id` = ?");
    $updateStmt->bind_param("i", $voter_id);
    if ($updateStmt->execute()) {
        echo "Voter status updated to 'Voted'";
    } else {
        die(mysqli_error($conn));
    }

    // Close the update statement
    $updateStmt->close();

    // Destroy the session to prevent reuse of session data
    session_destroy();

    // Redirect to the home page
    header("location:index.php");
    exit;
} else {
    // If necessary session variables are not set, redirect to an error page or handle the error
    echo "Required session data missing. Unable to process vote.";
    // Optionally, redirect to a login page or error page
    header("location:error_page.php");  // Adjust according to your error handling
    exit;
}
