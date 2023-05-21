<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Course;
use App\Models\CourseLesson;
use App\Models\Lesson;
use App\Models\Price;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(1)->create();

        Lesson::factory(1)->create();

        Course::factory(1)->create();

        CourseLesson::query()->create([
            "course_id"=>1,
            "lesson_id"=>1
        ]);

        Price::query()->insert([
            ["priceable_type" => "App\Models\Lesson", "priceable_id" => 1, "price" => 2000],
            ["priceable_type" => "App\Models\Course", "priceable_id" => 1, "price" => 3000]
        ]);

        Setting::factory(1)->create();
    }
}
