<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Article ;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MouvementEntree>
 */
class MouvementEntreeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'num_bon_entree'=>'E-' . $this->faker->unique()->numberBEtween(100,999),
           'date_entree'=>$this->faker->date(),
           'qantite_entree'=>$this->faker->numberBetween(1,20),
           'prix_entree'=>$this->faker->randomFloat(2,100,1000),
           'article_id'=>Article::inRandomOrder()->first()->id,
        ];
    }
}
