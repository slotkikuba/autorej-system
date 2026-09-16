<?php
    session_start();

    $db_host = getenv('DB_HOST') ?: 'db';
    $db_user = getenv('DB_USER') ?: 'root';
    $db_pass = getenv('DB_PASSWORD') ?: '';
    $db_name = getenv('DB_NAME') ?: 'projekt';


    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    
    if (!$conn) {
        die("Błąd połączenia z bazą: " . mysqli_connect_error());
    }

    function baza($conn) {
        $query = "SELECT * FROM pojazdy";
        $result = mysqli_query($conn, $query);
        if(!$result) {
            die("Błąd w wykonaniu zapytania: " . mysqli_error($conn));
        }
        $numberOfRows = mysqli_num_rows($result);
        return [$result, $numberOfRows];
    };

?>