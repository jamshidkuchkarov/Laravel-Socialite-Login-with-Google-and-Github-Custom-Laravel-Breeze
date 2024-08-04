
# Laravel-Socialite-Login-with-Google-and-Github-Custom-Laravel-Breeze

Here are the steps you need to follow to customize the Laravel Breeze system that supports login with GitHub and Google accounts.


## Roadmap

- Obtain your first personal `client_id` and `client_secret` tokens from Google and GitHub,
   And add it to the environment configuration file (`.env`) in this format.

    `GITHUB_CLIENT_ID`=your_id

    `GITHUB_CLIENT_SECRET`=your_secret

    `GOOGLE_CLIENT_ID`=your_id

    `GOOGLE_CLIENT_SECRET`=your_secret

- And configure the `services.php` file in the `config` directory, for example:
```php
'github' => [
        'client_id' => env('GITHUB_CLIENT_ID'),
        'client_secret' => env('GITHUB_CLIENT_SECRET'),
        'redirect' => '/auth/github/callback',
    ],
    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => '/auth/google/callback',
    ],
```


