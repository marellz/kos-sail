<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->name;
        $email = fake()->email;
        $user_id = null;

        if(fake()->boolean){
            $user = User::inRandomOrder()->first();
            $name = $user->name;
            $email = $user->email;
            $user_id = $user->id;
        } 
        return [
            //
            'name' => $name,
            'email' => $email,
            'user_id' => $user_id,
            // 'subject' => fake()->words(fake()->numberBetween(4, 10), true),
            'subject' => fake()->realText(100, 1),
            'phone' => fake()->phoneNumber,
            'message' => fake()->realText(fake()->numberBetween(100, 1000), 2),
            'reply_to' => null,
            'read' => false,
            'resolved' => false,
        ];
    }
}
