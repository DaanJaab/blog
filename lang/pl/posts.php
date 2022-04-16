<?php

/*
|--------------------------------------------------------------------------
| Posts Language Lines
|--------------------------------------------------------------------------
|
| The following language lines are used in posts blade's and controller for various
| messages, buttons, etc. that we need to display to the user.
|
*/

return [
    'page_show_title' => 'Edycja posta: ',
    'title' => 'Tytuł',
    'description' => 'Opis',

    'updated_at' => 'Edytowano dnia',
    'author_name' => 'Dodano przez',

    //show.blade.php
    'user' => [
        'created_at' => 'Dołączył dnia:',
        'posts_count' => 'Postów: ',
        'comments_count' => 'Komentarzy: ',
    ],
    'comments' => [
        'created_at' => 'Napisano: ',
        'none' => 'Nie ma komentarzy do tego posta.',
        'add' => 'Twój komentarz:',
        'login_to_put' => 'Musisz być zalogowany, by dodać komentarz!'
    ],
    'buttons' => [
        'add_comment' => 'Dodaj komentarz',
        'delete' => 'usuń',
        'edit' => 'edytuj',
        'report' => 'zgłoś',
    ],
];
