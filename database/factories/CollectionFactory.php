<?php

namespace Database\Factories;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Collection>
 */
class CollectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    
    

    public function definition()
    {
    
     $name = fake()->name(20);
     $slug = Str::slug($name, '-');
     

            return [
                'name' => $name,
                'slug' => $slug,
            ];
        
    }
}
