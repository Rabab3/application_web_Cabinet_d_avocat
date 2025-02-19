<?php
// Start the session (if not already started)
session_start();

// Destroy the session to log the user out
session_destroy();

// Redirect the user back to the index.php page
header("Location: index.php");
exit();
?>
