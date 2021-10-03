<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    protected $imageArray = [
        "https://images.nrc.nl/HO0MjNcD7jZ9DcUs0UoKb61BEgU=/0x0:6000x3603/640x/filters:no_upscale():format(webp)/s3/static.nrc.nl/images/gn4/stripped/data76826329-37bef9.jpg",
        "https://images.nrc.nl/0tN7CNitH7G8JMdHU5VWfLiWFiQ=/640x384/smart/filters:no_upscale():format(webp)/s3/static.nrc.nl/wp-content/uploads/2021/09/web-2809ecoford.jpg",
        "https://images.nrc.nl/kV1PgpkIE6qy75nb81fKYhb_tvo=/640x384/smart/filters:no_upscale():format(webp)/s3/static.nrc.nl/bvhw/files/2021/09/data76500628-4d7816.jpg",
        "https://images.nrc.nl/x9vZp4mGR1qZfw1PWRrLrn0Nh6k=/640x384/smart/filters:no_upscale():format(webp)/s3/static.nrc.nl/bvhw/files/2021/09/data76565615-0a64e3.jpg",
        "https://images.nrc.nl/zQvOQRIXL77w4s8O9cELyCd079w=/0x0:3614x2170/320x/filters:no_upscale():format(webp)/s3/static.nrc.nl/images/gn4/stripped/data76794005-9ef573.jpg",
        "https://images.nrc.nl/ekQOtDwj-EaiAMs39iMk_OtZR8U=/0x0:2048x1231/640x/filters:no_upscale():format(webp)/s3/static.nrc.nl/inbeeld/files/2021/09/2509zatinbeeld3.jpg",
        "https://images.nrc.nl/3ETpwVIgH_-Y6I71-SrkPBT1dCI=/640x384/smart/filters:no_upscale():format(webp)/s3/static.nrc.nl/images/gn4/stripped/data76655625-2e2508.jpg"

    ];
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "title" => $this->faker->sentence(5),
            "description" => $this->faker->sentence(25),
            "body" => $this->faker->text(5000),
            'imageUrl'=> $this->imageArray[rand(0, 6)]
        ];
    }
}
