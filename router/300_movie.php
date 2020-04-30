
<?php

/**
 * Show all movies.
 */
$app->router->get("movie", function () use ($app) {
    $title = "Movie database | oophp";

    $app->db->connect();
    $sql = "SELECT * FROM movie;";
    $res = $app->db->executeFetchAll($sql);

    $app->page->add("movie/index", [
        "res" => $res
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});


$app->router->get("movie/search-title", function () use ($app) {
    $title = "Movie database | oophp";

    $app->db->connect();


    $searchTitle = getGet("searchTitle");
    // $searchTitle = getGet("p");
    // if ($searchTitle == "p") {
        $sql = "SELECT * FROM movie WHERE title LIKE ?;";
        $resultset = $app->db->executeFetchAll($sql, [$searchTitle]);
    // }

    $app->page->add("movie/search-title", [
        "resultset" => $resultset,
        "searchTitle" => $searchTitle
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});

$app->router->get("movie/search-year", function () use ($app) {
    $title = "Movie database | oophp";

    $app->db->connect();

    $year1 = getGet("year1") ?? null;
    $year2 = getGet("year2") ?? null;

    $sql = "SELECT * FROM movie WHERE year >= ? AND year <= ?;";
    $resultset =  $app->db->executeFetchAll($sql, [$year1, $year2]);

    $app->page->add("movie/search-year", [
        "resultset" => $resultset,
        "year1" => $year1,
        "year2" => $year2
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});

$app->router->get("movie/edit", function () use ($app) {
    $title = "Movie database | oophp";

    $app->db->connect();


    $movieId = getPost("movieId");



    $title = "Select a movie";
    // $view[] = "view/movie-select.php";
    $sql = "SELECT id, title FROM movie;";
    $movies = $app->db->executeFetchAll($sql);

    $app->page->add("movie/edit", [
        "movies" => $movies,

    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});

$app->router->post("movie/edit", function () use ($app) {


    $app->db->connect();


    $movieId = getPost("movieId");

    if (getPost("doDelete")) {
        $sql = "DELETE FROM movie WHERE id = ?;";
        $app->db->execute($sql, [$movieId]);
    } elseif (getPost("doAdd")) {
        $sql = "INSERT INTO movie (title, year, image) VALUES (?, ?, ?);";
        $app->db->execute($sql, ["A title", 2017, "img/noimage.png"]);
        $movieId = $app->db->lastInsertId();
    }

    return $app->response->redirect("movie/");
});

$app->router->get("movie/change", function () use ($app) {
    $title = "Movie database | oophp";

    $app->db->connect();


    $movie = getPost("movieId");
    $movietitle = getPost("movieTitle") ?? null;
    $year  = getPost("movieYear") ?? null;
    $image = getPost("movieImage") ?? null;


    $title = "Select a movie";
    $sql = "SELECT id, title FROM movie;";
    $movies = $app->db->executeFetchAll($sql);

    $app->page->add("movie/change", [
        "movies" => $movies,
        "movietitle" => $movietitle,
        "movie" => $movie,
         "year" => $year,
        "image" => $image
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});

$app->router->post("movie/change", function () use ($app) {


    $app->db->connect();

    $movieId    = getPost("movieId") ?: getGet("movieId");
    $movieTitle = getPost("movieTitle");
    $movieYear  = getPost("movieYear");
    $movieImage = getPost("movieImage");

    if (getPost("doSave")) {
        $sql = "UPDATE movie SET title = ?, year = ?, image = ? WHERE id = ?;";
        $app->db->execute($sql, [$movieTitle, $movieYear, $movieImage, $movieId]);
    }

    $sql = "SELECT * FROM movie WHERE id = ?;";
    $movie = $app->db->executeFetchAll($sql, [$movieId]);
    $movie = $movie[0];

    return $app->response->redirect("movie/");
});
