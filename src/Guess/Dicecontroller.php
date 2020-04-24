<?php

namespace Saku\Guess;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
* A sample controller to show how a controller class can be implemented.
* The controller will be injected with $app if implementing the interface
* AppInjectableInterface, like this sample class does.
* The controller is mounted on a particular route and can then handle all
* requests for that mount point.
*
* @SuppressWarnings(PHPMD.TooManyPublicMethods)
*/
class Dicecontroller implements AppInjectableInterface
{
    use AppInjectableTrait;

    public function debugAction() : string
    {
        // Deal with the action and return a response.
        return "Debug my game";
    }

    public function indexAction() : string
    {
        return "Index";
    }

    public function initAction() : object
    {

        // $object =  new DiceHistogram2();
        // $histogram = new Histogram();

        $this->app->session->set("sum", 0);
        $this->app->session->set("savedsum", 0);
        $this->app->session->set("computer", 0);
        $this->app->session->set("computercurr", 0);
        $this->app->session->set("next", false);
        $this->app->session->set("histogram", null);
        $this->app->session->set("newarr", null);
        $this->app->session->set("oldhis", null);
        $this->app->session->set("oldhiscomp", null);
        $this->app->session->set("histogramcomp", null);

        // $hist = $histogram->getSerie();

        // $this->app->session->set("histogram", $h);

        return $this->app->response->redirect("dice1/play");
    }

    public function playActionGet() : object
    {

        $title = "Tärningspel";

        $throw = $this->app->session->get("throw", null);
        $sum = $this->app->session->get("sum", null);
        $totalsum = $this->app->session->get("totalsum", null);
        $computer = $this->app->session->get("computer", null);
        $computercurr = $this->app->session->get("computercurr", null);
        $savedsum = $this->app->session->get("savedsum", null);
        $next = $this->app->session->get("next", null);
        $histogram = $this->app->session->get("histogram", null);
        $newarr = $this->app->session->get("newarr", null);
        // $oldhis = $this->app->session->get("oldhis", null);
        // $oldhiscomp = $this->app->session->get("oldhiscomp", null);
        $histogramcomp = $this->app->session->get("histogramcomp", null);



        // $gameplayer = $this->app->session->get("gameplayer", null);

        $this->app->session->set("newthrow", null);
        $data = [
            "throw" => $throw,
            "sum" => $sum,
            // "btnthrow" => $btnthrow ?? null,
            // "btnsave" => $btnsave ?? null,
            "next" => $next ?? null,
            "totalsum" => $totalsum,
            "savedsum" => $savedsum ?? null,
            "computer" => $computer ?? null,
            // "btnInit" => $btnInit ?? null,
            "computercurr" => $computercurr ?? null,
            "histogram" => $histogram ?? null,
            "histogramcomp" => $histogramcomp ?? null,
            "newarr" => $newarr ?? null

        ];

        $this->app->page->add("dice1/play", $data);
        // $app->page->add("dice/debug");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function initGame()
    {
        // $game =  new \Saku\Guess\DiceHistogram2();
        $this->app->session->set("sum", 0);
        $this->app->session->set("savedsum", 0);
        $this->app->session->set("computer", 0);
        $this->app->session->set("computercurr", 0);
        $this->app->session->set("totalsum", 0);
        $this->app->session->set("histogram", null);
        $this->app->session->set("histogramcomp", null);
        $this->app->session->set("oldhis", null);
        $this->app->session->set("oldhiscomp", null);
    }

    public function btnSave()
    {
        $savedsum = $this->app->session->get("savedsum", null);

        // $oldhis = $this->app->session->get("oldhis", null);
        $oldhiscomp = $this->app->session->get("oldhiscomp", null);
        $this->app->session->set("savedsum", $savedsum + $this->app->session->get("totalsum"));
        $this->app->session->set("sum", 0);
        $this->app->session->set("totalsum", 0);
        $this->app->session->set("next", true);
        $computerclass = new DiceHistogram2();
        $computerclass->roll();

        $histogramcomp = new Histogram();
        $histogramcomp->injectData($computerclass);
        $histcomp = $histogramcomp->getAsText();

        for ($i = 0; $i < count($histcomp); $i++) {
            $newcomp[] = $histcomp[$i] + $oldhiscomp[$i];
        }
        $this->app->session->set("histogramcomp", $newcomp);
        $this->app->session->set("oldhiscomp", $newcomp);

        if ($computerclass->ifOne() == false) {
            if ($computerclass->sum() > 50) {
                $computerclass2 = new DiceHistogram2();
                $computerclass2->roll();
                if ($computerclass2->ifOne() == false) {
                    $this->app->session->set("computer", $this->app->session->get("computer", null) + $computerclass->sum());
                    $this->app->session->set("computercurr", $computerclass->sum());
                    $this->app->session->set("next", true);
                } else {
                    $this->app->session->set("computercurr", 0);
                }
            } else {
                $this->app->session->set("computer", $this->app->session->get("computer", null) + $computerclass->sum());
                $this->app->session->set("computercurr", $computerclass->sum());
                $this->app->session->set("next", true);
            }
        } else {
            $this->app->session->set("computercurr", 0);
        }
    }

    public function btnThrow()
    {

        $throw = $this->app->session->get("throw", null);
        // $sum = $this->app->session->get("sum", null);
        // $savedsum = $this->app->session->get("savedsum", null);
        $totalsum = $this->app->session->get("totalsum", null);
        // $newthrow = $this->app->session->get("newthrow", null);
        // $next = $this->app->session->get("next", null);
        $oldhis = $this->app->session->get("oldhis", null);
        $oldhiscomp = $this->app->session->get("oldhiscomp", null);

        $game = new \Saku\Guess\DiceHistogram2();
        $throw = $game->roll();
        $histogram = new Histogram();
        $histogram->injectData($game);
        $hist = $histogram->getAsText();
        // $newhis = $this->app->session->get("histogram", null);

        for ($i = 0; $i < count($hist); $i++) {
            $new[] = $hist[$i] + $oldhis[$i];
        }
        $this->app->session->set("histogram", $new);
        $this->app->session->set("oldhis", $new);
        $this->app->session->set("throw", $throw);
        // $old = $new;

        if ($game->ifOne() != false) {
            $this->app->session->set("sum", 0);
            $this->app->session->set("totalsum", 0);
            $this->app->session->set("next", true);

            $computerclass = new \Saku\Guess\DiceHistogram2();
            $computerclass->roll();
            $histogramcomp = new Histogram();
            $histogramcomp->injectData($computerclass);
            $histcomp = $histogramcomp->getAsText();

            // $newhiscomp = $this->app->session->get("histogramcomp", null);

            for ($i = 0; $i < count($histcomp); $i++) {
                $newcomp[] = $histcomp[$i] + $oldhiscomp[$i];
            }
            $this->app->session->set("histogramcomp", $newcomp);
            $this->app->session->set("oldhiscomp", $newcomp);
            // $this->app->session->set("throwcomp", $throwcomp);

            if ($computerclass->ifOne() == false) {
                if ($computerclass->sum() < 20) {
                    $computerclass1 = new \Saku\Guess\DiceHistogram2();
                    $computerclass1->roll();
                    if ($computerclass1->ifOne() == false) {
                        $this->app->session->set("computer", $this->app->session->get("computer", null) + $computerclass1->sum() + $computerclass->sum());
                        $this->app->session->set("computercurr", $computerclass1->sum() + $computerclass->sum());
                    } else {
                        $this->app->session->set("computercurr", 0);
                    }
                } else {
                    $this->app->session->set("computer", $this->app->session->get("computer", null) + $computerclass->sum());
                    $this->app->session->set("computercurr", $computerclass->sum());
                }
            } else {
                // $_SESSION["computercurr"] = 0;
                $this->app->session->set("computercurr", 0);
            }
        } else {
            // $_SESSION["sum"] = $game->sum();
            // $_SESSION["totalsum"] += $game->totalsum();
            // $_SESSION["next"] = false;
            $this->app->session->set("sum", $game->sum());
            $this->app->session->set("totalsum", $totalsum + $game->totalsum());
            $this->app->session->set("next", false);
        }
    }

    public function playActionPost() : object
    {

        $btnthrow = $this->app->request->getPost("btnthrow", null);
        $btnsave = $this->app->request->getPost("btnsave", null);
        $btnInit = $this->app->request->getPost("btnInit", null);


        // $res = null;
        if ($btnthrow) {
            $this->btnThrow();
        }

        if ($btnsave) {
            $this->btnSave();
        }

        if ($btnInit) {
            $this->initGame();
        }

        return $this->app->response->redirect("dice1/play");
    }
}
