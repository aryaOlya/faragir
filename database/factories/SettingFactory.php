<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    private $info = [
        "name"=>"arya olya",
        "linkedin"=>"https://www.linkedin.com/in/arya-olya-774a67222/",
        "github"=>"github.com/aryaOlya",
        "email"=>"arya.olya9978@gmail.com",
        "phone"=>"09380524172"
    ];


    public function definition(): array
    {
        return [
            "info"=>json_encode($this->info),
            "min_course_price"=>1000,
            "min_lesson_price"=>1000
        ];
    }
}
