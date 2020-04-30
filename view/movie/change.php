<?php

namespace Anax\View;

/**
* Render content within an article.
*/

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?>
<body>

<a href=<?= url("movie")?>>Visa alla Filmer | </a>
<a href=<?= url("movie/search-title")?>>Sök efter Filmtitel | </a>
<a href=<?= url("movie/search-year")?>>Sök efter År | </a>
<a href=<?= url("movie/edit")?>>Lägg till/Ta bort | </a>
<a href=<?= url("movie/change")?>>Ändra film</a>

    <form method="post">
        <fieldset>
            <label>ID:<br>
            <input type="text" name="movieId" value="<?= $movie ?>"/>
            </label>

        <p>
            <label>Title:<br>
            <input type="text" name="movieTitle" value="<?= $movietitle ?>"/>
            </label>
        </p>

        <p>
            <label>Year:<br>
            <input type="number" name="movieYear" value="<?= $year ?>"/>
        </p>

        <p>
            <label>Image:<br>
            <input type="text" name="movieImage" value="<?= $image ?>"/>
            </label>
        </p>

        <p>
            <input type="submit" name="doSave" value="Save">
        </p>
        </fieldset>
    </form>
