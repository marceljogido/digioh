<?php

namespace Modules\Slider\database\factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SliderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Slider\Models\Slider::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'        => $this->faker->sentence(3),
            'subtitle'     => $this->faker->optional()->sentence(6),
            'image'        => 'img/default_banner.jpg',
            'button_text'  => $this->faker->optional()->randomElement(['Learn more','Get started','Contact us']),
            'button_link'  => $this->faker->optional()->url(),
            'is_active'    => true,
            'sort_order'   => $this->faker->numberBetween(0, 10),
            'created_at'   => Carbon::now(),
            'updated_at'   => Carbon::now(),
        ];
    }
}
