<?php

namespace Anax\View;

/**
* Render content within an article.
*/

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

if (!$res) {
    return;
}
?>

<a href=<?= url("movie")?>>Visa alla Filmer | </a>
<a href=<?= url("movie/search-title")?>>Sök efter Filmtitel | </a>
<a href=<?= url("movie/search-year")?>>Sök efter År | </a>
<a href=<?= url("movie/edit")?>>Lägg till/Ta bort | </a>
<a href=<?= url("movie/change")?>>Ändra film</a>

<h1>Alla Filmer</h1>

<table>
    <tr class="first">
        <th>Rad</th>
        <th>Id</th>
        <th>Bild</th>
        <th>Titel</th>
        <th>År</th>
    </tr>
<?php $id = -1; foreach ($res as $row) :
    $id++; ?>
    <tr>
        <td><?= $id ?></td>
        <td><?= $row->id ?></td>
        <td><img class="thumb" src="<?= $row->image ?>"></td>
        <td><?= $row->title ?></td>
        <td><?= $row->year ?></td>
    </tr>
<?php endforeach; ?>
</table>
