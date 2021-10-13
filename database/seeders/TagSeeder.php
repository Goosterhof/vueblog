<?php

namespace Database\Seeders;

use App\Models\Tag;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
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

    public function run()
    {
        for($i = 0; $i < count($this->subjects); $i++){
            Tag::create([
                "subject" => $this->subjects[$i]
            ]);
        }

    }
}
