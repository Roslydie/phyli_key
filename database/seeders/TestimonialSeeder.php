<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'prenom' => 'Maya',
                'nom' => 'Laurent',
                'message' => 'Fast and highly professional service. I was helped in under 20 minutes after losing my keys.',
                'published' => true,
            ],
            [
                'prenom' => 'Daniel',
                'nom' => 'Ramos',
                'message' => 'The locksmith arrived quickly, explained the options clearly, and fixed the issue neatly.',
                'published' => true,
            ],
            [
                'prenom' => 'Sophie',
                'nom' => 'Barnes',
                'message' => 'Very satisfied with the work. They replaced the lock with precision and at a fair price.',
                'published' => true,
            ],
            [
                'prenom' => 'Jonathan',
                'nom' => 'Miller',
                'message' => 'Quick response, transparent pricing, and efficient service. I recommend them without hesitation.',
                'published' => false,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
