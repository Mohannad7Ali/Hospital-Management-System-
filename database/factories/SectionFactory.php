<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Section>
 */
class SectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>$this->faker->unique()->randomElement(['قسم الدماغ والأعصاب ' , 'قسم الأطفال' , 'قسم القلب' , 'قسم العظمية','قسم البولية والتناسلية' ,'قسم النسائية' , 'قسم الجراحة العامة']),
            'description'=>$this->faker->paragraph(),
        ];
    }
}
