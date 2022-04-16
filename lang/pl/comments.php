<?php

/*
|--------------------------------------------------------------------------
| Comments Language Lines
|--------------------------------------------------------------------------
|
| The following language lines are used in comments blade's and controller for various
| messages, buttons, etc. that we need to display to the user.
|
*/

return [
    'page_edit_title' => 'Edycja komentarza',
    'content' => 'Treść',
    'buttons' => [
        'save' => 'Zapisz',
    ],

    //CommentsController
    'messages' => [
        'has_been_added' => 'Twój komentarz został dodany!',
        'has_been_updated' => 'Twój komentarz został zaktualizowany!',
        'has_been_deleted' => 'Twój komentarz został usunięty!',
    ],
    'errors' => [
        'not_own_edit' => 'nie możesz edytować czyjegoś komentarza!',
        'not_own_delete' => 'nie możesz usunąć czyjegoś komentarza!',
        'not_belongs_to_this_post' => 'ten komentarz nie należy do tego posta!',
    ],
];
