![calendarecycle homepage image](https://lucabettini.com/images/calendarecycle_2.jpg)

# [CALENDARECYCLE](https://calendarecycle.lucabettini.com)

<i>Completed and deployed on Heroku on May 23, 2021 - new deploy on DigitalOcean droplet on October 2, 2021</i>

This website was created as a personal project while following the [Start2Impact](https://www.start2impact.it/) PHP & mySQL course.

The requirements were:

-   A webapp built to track garbage collection days
-   API endpoints or views to perform basic CRUD operations
-   Ability to specify the hour range
-   An endpoint or section with the weekly summary
-   And endpoint or section with today's summary
-   The app stack must be PHP and SQL and it must follow the MVC pattern

I decided to use Laravel (for the first time), providing a basic authentication system and some Blade templates with a [customized version ](https://github.com/lucabettini/calendarecycle/blob/main/resources/sass/_variables.scss)of Bootstrap 5 to create a simple frontend.

<br>

## USERS AND AUTHENTICATION

In order to delve deeply into Laravel structure and understanding a little bit better, I did not use neither Laravel Breeze nor Laravel Jetstrem, but created my custom authentication system reading carefully the Laravel docs.

The user can register, login and logout into the website. He can modify both his/her email and name and the password while logged in, or can ask for a reset link to create a new password if the old one was forgotten. Below is a simple schema of authentication endpoints:

|        | ROUTE                   | CONTROLLER                                                                                                                                 | ACTION                                                                                                                                  |
| ------ | ----------------------- | ------------------------------------------------------------------------------------------------------------------------------------------ | --------------------------------------------------------------------------------------------------------------------------------------- |
| GET    | /register               | [RegisterController](https://github.com/lucabettini/calendarecycle/blob/main/app/Http/Controllers/Auth/RegisterController.php)             | [Register form view](https://github.com/lucabettini/calendarecycle/blob/main/resources/views/auth/register.blade.php)                   |
| POST   | /register               | [RegisterController](https://github.com/lucabettini/calendarecycle/blob/main/app/Http/Controllers/Auth/RegisterController.php)             | Register a new user                                                                                                                     |
| GET    | /login                  | [LoginController](https://github.com/lucabettini/calendarecycle/blob/main/app/Http/Controllers/Auth/LoginController.php)                   | [Login form view](https://github.com/lucabettini/calendarecycle/blob/main/resources/views/auth/login.blade.php)                         |
| POST   | /login                  | [LoginController](https://github.com/lucabettini/calendarecycle/blob/main/app/Http/Controllers/Auth/LoginController.php)                   | Login user                                                                                                                              |
| GET    | /editAccount            | [EditAccountController](https://github.com/lucabettini/calendarecycle/blob/main/app/Http/Controllers/Auth/EditAccountController.php)       | [Edit profile view](https://github.com/lucabettini/calendarecycle/blob/main/resources/views/auth/edit-profile.blade.php)                |
| POST   | /editAccount            | [EditAccountController](https://github.com/lucabettini/calendarecycle/blob/main/app/Http/Controllers/Auth/EditAccountController.php)       | Edit profile                                                                                                                            |
| DELETE | /editAccount            | [EditAccountController](https://github.com/lucabettini/calendarecycle/blob/main/app/Http/Controllers/Auth/EditAccountController.php)       | Delete account                                                                                                                          |
| POST   | /logout                 | [LogoutController](https://github.com/lucabettini/calendarecycle/blob/main/app/Http/Controllers/Auth/LogoutController.php)                 | Logout user                                                                                                                             |
| GET    | /changePassword         | [ChangePasswordController](https://github.com/lucabettini/calendarecycle/blob/main/app/Http/Controllers/Auth/ChangePasswordController.php) | [Change password form view](https://github.com/lucabettini/calendarecycle/blob/main/resources/views/auth/change-password.blade.php)     |
| POST   | /changePassword         | [ChangePasswordController](https://github.com/lucabettini/calendarecycle/blob/main/app/Http/Controllers/Auth/ChangePasswordController.php) | Change password while logged in                                                                                                         |
| GET    | /forgotPassword         | [ForgotPasswordController](https://github.com/lucabettini/calendarecycle/blob/main/app/Http/Controllers/Auth/ForgotPasswordController.php) | [Send reset email view](https://github.com/lucabettini/calendarecycle/blob/main/resources/views/auth/forgot-password.blade.php)         |
| POST   | /forgotPassword         | [ForgotPasswordController](https://github.com/lucabettini/calendarecycle/blob/main/app/Http/Controllers/Auth/ForgotPasswordController.php) | Send reset email                                                                                                                        |
| GET    | /reset-password/{token} | [ResetPasswordController](https://github.com/lucabettini/calendarecycle/blob/main/app/Http/Controllers/Auth/ResetPasswordController.php)   | [Change forgotten password view](https://github.com/lucabettini/calendarecycle/blob/main/resources/views/auth/reset-password.blade.php) |
| POST   | /reset-password         | [ResetPasswordController](https://github.com/lucabettini/calendarecycle/blob/main/app/Http/Controllers/Auth/ResetPasswordController.php)   | Change forgotten password                                                                                                               |

<br>

I created a one-to-many Eloquent relationship inside the [User model](https://github.com/lucabettini/calendarecycle/blob/main/app/Models/User.php), connecting every user to his own bins (a similar one was added to the [Bin model](https://github.com/lucabettini/calendarecycle/blob/main/app/Models/Bin.php)).

I also added a 'timezone' field to the User model (see the relative [migration](https://github.com/lucabettini/calendarecycle/blob/main/database/migrations/2021_05_14_110503_add_timezone_to_users_table.php)). A simple JS scripts inside the [register view](https://github.com/lucabettini/calendarecycle/blob/main/resources/views/auth/register.blade.php) changes the value of an hidden input before sending the request to the controller (more on this later).

## BINS

Every user has the ability to add a 'bin', providing its name, color, collection day of the week and hour range. Every bin is connected to its creator by a foreign key user field (see relative [migration](https://github.com/lucabettini/calendarecycle/blob/main/database/migrations/2021_05_14_081529_create_bins_table.php)), allowing me to use Laravel model binding inside the various controllers.

Only the owner can view, edit or delete his bin. I accomplished this by creating a dedicated [policy](https://github.com/lucabettini/calendarecycle/blob/main/app/Policies/BinPolicy.php).

Since both the store and the update method of [BinController](https://github.com/lucabettini/calendarecycle/blob/main/app/Http/Controllers/BinController.php) had very similar validation, I also decided to abstract that logic into a [separate request](https://github.com/lucabettini/calendarecycle/blob/main/app/Http/Requests/BinRequest.php).

On the frontend, the user can choose between three different visualizations: one with bins collected today, another with bin collected tomorrow (both with the hour range specification) and a last one with a summary of all week.

Instead of creating three different views, I added a simple [controller](https://github.com/lucabettini/calendarecycle/blob/main/app/Http/Controllers/HomeController.php) on which, using the Eloquent relationship and Laravel query builder, I passed different data inside the view itself.

The timezone field, filled during the user registration, is used here to create a Carbon date and get the user day of week to correctly display and sort the bins.

Below is a simple schema of endpoints pertaining to bins creation, manipulation and visualization:

|        | ROUTE            | CONTROLLER                                                                                                        | ACTION               |
| ------ | ---------------- | ----------------------------------------------------------------------------------------------------------------- | -------------------- |
| GET    | /bins            | [BinController](https://github.com/lucabettini/calendarecycle/blob/main/app/Http/Controllers/BinController.php)   | Add bin form view    |
| POST   | /bins            | [BinController](https://github.com/lucabettini/calendarecycle/blob/main/app/Http/Controllers/BinController.php)   | Add a new bin        |
| GET    | /bins/edit/{bin} | [BinController](https://github.com/lucabettini/calendarecycle/blob/main/app/Http/Controllers/BinController.php)   | Edit bin form view   |
| POST   | /bins/edit/{bin} | [BinController](https://github.com/lucabettini/calendarecycle/blob/main/app/Http/Controllers/BinController.php)   | Edit bin             |
| DELETE | /bins/edit/{bin} | [BinController](https://github.com/lucabettini/calendarecycle/blob/main/app/Http/Controllers/BinController.php)   | Delete bin           |
| GET    | /home            | [HomeController](https://github.com/lucabettini/calendarecycle/blob/main/app/Http/Controllers/HomeController.php) | Show today's bins    |
| GET    | /tomorrow        | [HomeController](https://github.com/lucabettini/calendarecycle/blob/main/app/Http/Controllers/HomeController.php) | Show tomorrow's bins |
| GET    | /week            | [HomeController](https://github.com/lucabettini/calendarecycle/blob/main/app/Http/Controllers/HomeController.php) | Show all week bins   |

<br>

## SECURITY

All private routes are protected using the auth middleware, usually declared inside the controller constructor, while some routes can only be accesed as guests (like /login and /register).

All user input is validated with Laravel validator before any action on the database.

I also declared a simple rate limiter inside [Route Service Provider](https://github.com/lucabettini/calendarecycle/blob/main/app/Providers/RouteServiceProvider.php).

Finally, after the deploy, I realised that https redirection wasn't enabled by default, resulting in some browser display the unsecure version. After a quick visit on StackOverflow, I created a simple [middleware](https://github.com/lucabettini/calendarecycle/blob/main/app/Http/Middleware/EnforceHttps.php) to enforce htpps and then added it to the global list of middleware inside the [kernel file](https://github.com/lucabettini/calendarecycle/blob/main/app/Http/Kernel.php).

<br>

#### CREDITS

Icons from [Font Awesome](https://fontawesome.com/ "Font Awesome"), fonts by [Google Fonts](https://fonts.google.com/ "Google Fonts").

---

Made by [Luca Bettini](https://lucabettini.com).
