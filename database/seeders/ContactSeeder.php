<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Contact::factory(100)->create();

        $contacts = Contact::inRandomOrder()->limit(10);

        foreach($contacts as $contact){
            
            $contact->update(['read'=> true]);

            Contact::factory()->create([
                'reply_to' => $contact->id,
            ]);
        }
    }
}
