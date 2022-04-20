<?php

/*
|--------------------------------------------------------------------------
| GLOBAL Language Lines
|--------------------------------------------------------------------------
|
| The following language lines are used GLOBAL for various
| messages, buttons, etc. that we need to display to the user.
|
*/

return [
    'exhausted' => 'Za szybko! Musisz poczekać ' . config('blog.exhausted_time') . ' sekund między akcjami. Spróbuj ponownie za chwilę',
    'app_name' => 'Mój pierwszy projekt',
    'app_description' => 'To jest mój pierwszy projekt w Laravelu.',
    'blog_page' => 'Blog',
    //vendor/laravel/ui/auth-backend/
    'register_successful' => 'Zarejestrowano i zalogowano pomyślnie!',
    'login_successful' => 'Zalogowano pomyślnie!',
    'logout_successful' => 'Wylogowano pomyślnie',
    //vendor-end
    'navbar' => [
        //left navbar panel (layout/app)
        'whats_new' => 'Co nowego?',
        'new_users' => 'Nowi użytkownicy',
        'new_posts' => 'Nowe posty',
        'new_comments' => 'Nowe komentarze',

        'users' => 'Użytkownicy',
        'all_users' => 'Wszyscy',
        'admins' => 'Administratorzy',
        'banned' => 'Zbanowani',

        //right navbar panel (layout/app)
        'account' => 'Konto',
        'login' => 'Zaloguj się',
        'register' => 'Zarejestruj się',
        'logout' => 'Wyloguj się'
    ],

    'messages' => [
        //middleware/IsAdmin
        'is_not_admin' => 'Nie jesteś administratorem!',
        //middleware/IsBanned
        'is_banned' => 'Jesteś zbanowany, nie możesz tego zrobić!',
        //middleware/IsOwner
        'is_not_own' => 'Ta zawartość nie należy do Ciebie!',
        'not_belongs_to_this_post' => 'ten komentarz nie należy do tego posta!'
    ]
];
