<?php /** @noinspection PhpUndefinedClassInspection */

/** @var Illuminate\Database\Eloquent\Factory $factory */
use App\Comment;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'text' => $faker->sentence,
    ];
});
