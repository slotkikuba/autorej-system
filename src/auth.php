<?php

    // Usuń i inne operacje administracyjne są dostępne tylko po zalogowaniu.
    @session_start();

    if(!isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit;
    }

    // Sama obecność sesji nie wystarcza: ta strona wymaga roli administratora.
    if ($_SESSION['role'] !== "admin") {
        http_response_code(403);
        die("brak dostepu!!");
    }

?>