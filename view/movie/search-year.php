<?php

namespace Anax\View;

/**
* Render content within an article.
*/

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?>
<body>

<h1>Sök efter År</h1>

<a href=<?= url("movie")?>>Visa alla Filmer | </a>
<a href=<?= url("movie/search-title")?>>Sök efter Filmtitel | </a>
<a href=<?= url("movie/search-year")?>>Sök efter År | </a>
<a href=<?= url("movie/edit")?>>Lägg till/Ta bort | </a>
<a href=<?= url("movie/change")?>>Ändra film</a>

<form method="get">
    <fieldset>
    <legend>Search</legend>
    <input type="hidden" name="route" value="search-year">
    <p>
        <label>Created between:
        <input type="number" name="year1" value="<?= $year1 ?: 1900 ?>" min="1900" max="2100"/>
        -
        <input type="number" name="year2" value="<?= $year2  ?: 2100 ?>" min="1900" max="2100"/>
        </label>
    </p>
    <p>
        <input type="submit" name="doSearch" value="Search">
    </p>
    </fieldset>
</form>
<table>
    <tr class="first">
        <th>Rad</th>
        <th>Id</th>
        <th>Bild</th>
        <th>Titel</th>
        <th>År</th>
    </tr>
<?php
$id = -1; foreach ($resultset as $row) :
    $id++; ?>
    <tr>
        <td><?= $id ?></td>
        <td><?= $row->id ?></td>
        <td><img class="thumb" src="http://www.student.bth.se/~saku16/dbwebb-kurser/oophp/me/redovisa/htdocs/<?= $row->image ?>"></td>
        <td><?= $row->title ?></td>
        <td><?= $row->year ?></td>
    </tr>
<?php endforeach; ?>
</table>

</body>
