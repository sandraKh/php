<?php

require __DIR__ . "/config.php";
require __DIR__ . "/autoload.php";
// require __DIR__ . "/src/Guess.php";
$object = new Guess(0, 6);
$object->tries = 6;

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_name("saku16");
    session_start();

    if (!isset($_SESSION["guess"])) {
        $_SESSION["guess"] = new Guess(0, 6);
    }
}

$object = $_SESSION["guess"];

//Hantera variabler
$object->tries = 6;
$object->setnumber(rand(1, 100));
$object->number = $_POST["number"] ?? null;
$object->tries = $_POST["tries"] ?? null;
$guess = $_POST["guess"] ?? null;
$btnInit = $_POST["btnInit"] ?? null;
$btnGuess = $_POST["btnGuess"] ?? null;
$btnCheat = $_POST["btnCheat"] ?? null;

if ($btnInit || $object->number === null) {
    // Unset all of the session variables.
    $_SESSION = [];

    // If it's desired to kill the session, also delete the session cookie.
    // Note: This will destroy the session, and not just the session data!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    // Finally, destroy the session.
    session_destroy();
    echo "The session is destroyed.";
        $object->tries = 6;
        $object->setnumber(rand(1, 100));
} elseif ($btnGuess) {
        $res = $object->makeGuess($guess);
}

require __DIR__ . "/view/guess_my_number.php";
