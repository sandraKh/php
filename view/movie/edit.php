<?php

namespace Anax\View;

/**
* Render content within an article.
*/

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?>

<a href=<?= url("movie")?>>Visa alla Filmer | </a>
<a href=<?= url("movie/search-title")?>>Sök efter Filmtitel | </a>
<a href=<?= url("movie/search-year")?>>Sök efter År | </a>
<a href=<?= url("movie/edit")?>>Lägg till/Ta bort | </a>
<a href=<?= url("movie/change")?>>Ändra film</a>

<h1>Lägga til eller Ta bort film</h1>
<form method="post">
    <fieldset>
    <legend>Select Movie</legend>

    <p>
        <label>Movie:<br>
        <select name="movieId">
            <option value="">Select movie...</option>
            <?php foreach ($movies as $movie) : ?>
            <option value="<?= $movie->id ?>"><?= $movie->title ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    </p>

    <p>
        <input type="submit" name="doAdd" value="Add">
        <input type="submit" name="doDelete" value="Delete">
    </p>
    </fieldset>
</form>
