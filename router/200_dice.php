<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));


namespace Saku\Guess;

$app->router->get("dice/init", function () use ($app) {

    // $object =  new \Saku\Guess\DiceHand();
    $object =  new Guess();

    $_SESSION["sum"] = 0;
    $_SESSION["totalsum"] = 0;
    $_SESSION["savedsum"] = 0;
    $_SESSION["computer"] = 0;
    $_SESSION["computercurr"] = 0;
    $_SESSION["next"] = false;

    return $app->response->redirect("dice/play");
});

$app->router->get("dice/play", function () use ($app) {

    $title = "Tärningspel";

    $throw = $_SESSION["throw"] ?? null;
    $sum = $_SESSION["sum"];
    $totalsum = $_SESSION["totalsum"] ?? null;
    $computer = $_SESSION["computer"] ?? null;
    $computercurr = $_SESSION["computercurr"] ?? null;
    $savedsum = $_SESSION["savedsum"] ?? null;

    $next = $_SESSION["next"] ?? null;

    $_SESSION["newthrow"] = null;


    $data = [
        "throw" => $throw,
        "sum" => $sum,
        "btnthrow" => $btnthrow ?? null,
        "btnsave" => $btnsave ?? null,
        "next" => $next ?? null,
        "totalsum" => $totalsum,
        "savedsum" => $savedsum ?? null,
        "computer" => $computer ?? null,
        "btnInit" => $btnInit ?? null,
        "computercurr" => $computercurr ?? null
    ];

    $app->page->add("dice/play", $data);
    // $app->page->add("dice/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});

$app->router->post("dice/play", function () use ($app) {

    $throw = $_SESSION["throw"] ?? null;
    $sum = $_SESSION["sum"] ?? null;

    $next = $_SESSION["next"] ?? null;

    $newthrow = $_SESSION["newthrow"] ?? null;

    $btnthrow = $_POST["btnthrow"] ?? null;
    $btnsave = $_POST["btnsave"] ?? null;
    $btnInit = $_POST["btnInit"] ?? null;


    $res = null;

    if ($btnthrow) {
        $game = new \Saku\Guess\Dicehand();
        $throw = $game->roll();
        $_SESSION["throw"] = $throw;
        if ($game->ifOne() != false) {
            $_SESSION["sum"] = 0;
            $_SESSION["totalsum"] = 0;
            $_SESSION["next"] = true;
            $computerclass = new \Saku\Guess\Dicehand();
            $computer = $computerclass->roll();
            if ($computerclass->ifOne() == false) {
                $_SESSION["computer"] += $computerclass->sum();
                $_SESSION["computercurr"] = $computerclass->sum();
            } else {
                $_SESSION["computercurr"] = 0;
            }
        } else {
            $_SESSION["sum"] = $game->sum();
            $_SESSION["totalsum"] += $game->totalsum();
            $_SESSION["next"] = false;
        }
    }

    if ($btnsave) {
        $_SESSION["savedsum"] += $_SESSION["totalsum"];
        $_SESSION["sum"] = 0;
        $_SESSION["totalsum"] = 0;
        $_SESSION["next"] = true;
        $computerclass = new Dicehand();
        $computer = $computerclass->roll();
        if ($computerclass->ifOne() == false) {
            $_SESSION["computer"] += $computerclass->sum();
            $_SESSION["computercurr"] = $computerclass->sum();
            $_SESSION["next"] = true;
        } else {
            $_SESSION["computercurr"] = 0;
        }
    }

    if ($btnInit) {
        $game =  new \Saku\Guess\Dicehand();
        $_SESSION["sum"] = 0;
        $_SESSION["totalsum"] = 0;
        $_SESSION["computer"] = 0;
        $_SESSION["savedsum"] = 0;
        $_SESSION["computercurr"] = 0;
    }

    return $app->response->redirect("dice/play");
});
