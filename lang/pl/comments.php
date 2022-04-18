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
    'editing' => 'Edycja komentarza',
    'editing_desc' => 'Zmień coś w swoim komentarzu ;)',
    'content' => 'Treść',

    'buttons' => [
        'save' => 'Zapisz',
    ],

    'messages' => [
        //CommentsController
        'has_been_added' => 'Twój komentarz został dodany!',
        'has_been_updated' => 'Twój komentarz został zaktualizowany!',
        'has_been_deleted' => 'Twój komentarz został usunięty!',

        //middleware/IsCommentOwner
        'is_not_own' => 'Ten komentarz nie należy do Ciebie!',
        'not_belongs_to_this_post' => 'ten komentarz nie należy do tego posta!'
    ],
];
