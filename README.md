# Blog Laravel Project

An Api Blog Project to show posts. Admin user can create, update and delete projects that it depends on their permissions.
Other users can see posts and if they are logged in, they can comment on the post or like it.

## How to run ?

Just open terminal in root of project and run "php artisan serve".

## Datebase

Create a database. If you use mysql, you just need to change "DB_DATABASE" to your database name in ".env" file.
Then run this in cmd "php artisan migrate"

## Api documentation

After setting database, you can use api documentation. Go to this address: [api docs](http://127.0.0.1:8000/api/documentation)

## Postman Collection

You can see it in ./BlogLaravelProject.postman_collection.json

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
