<?php

$genres[] = 'Novel';
$genres[] = 'Bildungsroman';
$genres[] = 'Coming-of-age story';
$genres[] = 'Fiction';
$genres[] = 'Poetry';
$genres[] = 'First-person narrative';
$genres[] = 'Realism';
$genres[] = 'Non-fiction';
$genres[] = 'Fantasy';
$genres[] = 'Historical fiction';
$genres[] = 'Mystery';
$genres[] = 'Childrens literature';
$genres[] = 'Romance';
$genres[] = 'Thriller';
$genres[] = 'Horror';
$genres[] = 'History';
$genres[] = 'Biography';
$genres[] = 'Autobiography';
$genres[] = 'Adventure fiction';

$query = $_REQUEST['query'];
$suggestion = "";  // responseText

if ($query !== "") {
    $query = strtolower($query);
    $length = strlen($query);

    foreach ($genres as $genre) {
        if (stristr($query, substr($genre, 0, $length))) {
            if ($suggestion == "") {
                $suggestion = $genre;
            } else {
                $suggestion .= ", $genre";
            }
        }
    }
}
if ($suggestion == "") {
    echo 'No suggestions';
} else {
    echo $suggestion;
}
