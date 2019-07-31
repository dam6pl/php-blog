# Travel blog

Travel blog, with the ability to create accounts, add posts and comment. A simple administrative system for users and blog administrators.

**Author:** [Damian Nowak](mailto:me@dnowak.dev)

## Design assumptions
- [x] Editing content is available only after logging in.
- [x] Possibility to register as a user.
- [x] Possibility to add posts, manage own posts and manage comments for users.
- [x] Possibility to manage all posts and users for administrators.
- [x] Possibility to comment on posts for everyone.

## Installation
1. Based on the `.env.example` file, create the `.env` file, and complete the database information.
2. Retrieve all dependencies with the `composer install` command.
3. Run the `http://127.0.0.1:8000` page in the browser.
4. Access to the administrative panel is possible via the address `http://127.0.0.1:8000admin`. The sample database contains the `admin` account with the password `admin`, with administrator privileges.

## The runtime environment
To run the project, it is recommended to use the Laravela server.
1. Go to the directory in which the project is located.
2. Run the server using the `php artisan serve` command.
3. In the case of the first application launch, please migrate with the command `php artisan migrate:refresh --seed`.
3. From now on the blog is available at `http://127.0.0.1:8000`.
