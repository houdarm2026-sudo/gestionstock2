<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code_article'=>'ART-'.$this->faker->unique()->numberBetween(0,100),
            'designation'=>$this->faker->word(),
            'quantite_en_stock_reel'=>$this->faker->numberBetween(0,100),
            'stock_min'=>$this->faker->numberBetween(1,5),
            'stock_max'=>$this->faker->numberBetween(50,200),
            'prix'=>$this->faker->randomFloat(0,100,5000),
        ];
    }
}
