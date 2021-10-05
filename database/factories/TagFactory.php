<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tag::class;

    protected $subjects = [
        "Lifestyle",
        "International",
        "Sports",
        "Science",
        "History",
        "Economy",
        "Celebrity",
        "Infrastructure",
        "Mythology",
        "Finance",
        "Travel",
        "Politics",
        "Technology",
    ];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "subject" => $this->subjects[rand(0, array_rand($this->subjects))]
        ];
    }
}
