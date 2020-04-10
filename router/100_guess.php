<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init and play guess game.
 */
$app->router->get("guess/init", function () use ($app) {
    // init session
    $object = new Saku\Guess\Guess();

    $_SESSION["number"] = $object->setnumber(rand(1, 100));
    $_SESSION["tries"] = $object->tries();

    return $app->response->redirect("guess/play");
});



/**
 * Play the game - show game status
 */
$app->router->get("guess/play", function () use ($app) {

    $title = "Gissa mitt nummer";

    $tries = $_SESSION["tries"] ?? null;
    $res = $_SESSION["res"] ?? null;
    $guess = $_SESSION["guess"] ?? null;
    $cheat = $_SESSION["cheat"] ?? null;

    $_SESSION["res"] = null;
    $_SESSION["guess"] = null;
    $_SESSION["cheat"] = null;

    $data = [
        "guess" => $guess ?? null,
        "res" => $res,
        "tries" => $tries,
        "number" => $number ?? null,
        "btnGuess" => $btnGuess ?? null,
        "btnCheat" => $btnCheat ?? null,
        "cheat" => $cheat
    ];

    $app->page->add("guess/play", $data);
    // $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});



/**
 * Play the game - make guess
 */
$app->router->post("guess/play", function () use ($app) {

    $number = $_SESSION["number"] ?? null;
    $tries = $_SESSION["tries"] ?? null;
    $cheat = $_SESSION["cheat"] ?? null;



    $guess = $_POST["guess"] ?? null;
    $btnInit = $_POST["btnInit"] ?? null;
    $btnGuess = $_POST["btnGuess"] ?? null;
    $btnCheat = $_POST["btnCheat"] ?? null;

    $res = null;

    if ($btnGuess) {
        $game =  new Saku\Guess\Guess($number, $tries);
        $res = $game->makeGuess($guess);
        $_SESSION["tries"] = $game->tries();
        $_SESSION["res"] = $res;
        $_SESSION["guess"] = $guess;
        if ($res = "Rätt gissat!") {
        }
    }


    if ($btnCheat) {
        $game = new Saku\Guess\Guess($number, $tries);
        $cheat = $game->cheat();
        $_SESSION["cheat"] = $number;
    }

    if ($btnInit) {
        $game = new Saku\Guess\Guess($number, $tries);
        $_SESSION["tries"] = 6;
        $_SESSION["number"] = rand(1, 100);
    }

    return $app->response->redirect("guess/play");
});
