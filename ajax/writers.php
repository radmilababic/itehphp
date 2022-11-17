<?php

$writers[] = 'Fyodor Dostoevsky';
$writers[] = 'J. D. Salinger';
$writers[] = 'Franz Kafka';
$writers[] = 'George Orwell';
$writers[] = 'Mikhail Bulgakov';
$writers[] = 'Charles Bukowski';
$writers[] = 'Edgar Allan Poe';


if (isset($_REQUEST['query'])) {
    $query = $_REQUEST['query'];
    $suggestion = "";

    if ($query !== "") {
        $query = strtolower($query);
        $length = strlen($query);

        foreach ($writers as $writer) {
            if (stristr($query, substr($writer, 0, $length))) {
                if ($suggestion == "") {
                    $suggestion = $writer;
                } else {
                    $suggestion .= ", $writer";
                }
            }
        }
    }
    if ($suggestion == "") {
        echo 'No suggestions';
    } else {
        echo $suggestion;
    }
}
