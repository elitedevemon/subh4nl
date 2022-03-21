<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {


        function make_slug($string) {
            return preg_replace('/\s+/u', '-', trim($string));
            }
            $name = $this->faker->name;
        return [
            'name' => $name,
            'slug' => make_slug($name),
            'des' => $this->faker->sentence,
            'image' => $this->faker->image('public/storage/upload/product',400,300, null, false),
            'category_id' => 1,
            'offer_price' => 200,
            'regular_price' => 100
        ];
    }
}
