<?php
// Dima kanbdaw b session_start()
session_start();

// Kanms7o koulchi les variables dyal la session
session_unset();

// Kanhedmo (destroy) la session
session_destroy();

// Kanreje3o l'utilisateur l page dyal sign in
header("Location: sign_in.php?logout=success");
exit(); // Darori exit() bach nwaqfo l'code hna
?>