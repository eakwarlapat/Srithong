<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cus_name' => $this->faker->firstName(),
            'cus_surname' => $this->faker->lastName,
            'cus_tel' => $this->faker->e164PhoneNumber,
            'cus_email' => $this->faker->email,
            'cus_add' => $this->faker->address,
            'personalid' => $this->faker->creditCardNumber
        ];
    }
}
