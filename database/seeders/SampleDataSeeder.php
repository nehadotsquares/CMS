<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->truncate();
        DB::table('galleries')->truncate();
        
        // Sample Services
        $services = [
            [
                'title' => 'Venetian Plaster Finishes',
                'description' => 'Transform your walls with authentic Venetian plaster. Our premium finishes create stunning marble-like textures that add elegance and sophistication to any space. Perfect for feature walls, entire rooms, or commercial spaces.',
                'image' => null,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'TV Media Walls',
                'description' => 'Custom-designed media walls that combine functionality with stunning aesthetics. We create the perfect backdrop for your entertainment system with integrated storage, LED lighting, and premium plaster finishes.',
                'image' => null,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Cornice & Mouldings',
                'description' => 'Add architectural elegance with our custom cornice work and mouldings. From classic Victorian to modern minimalist, we create detailed crown mouldings, cornices, and decorative elements.',
                'image' => null,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Exterior Wall Finishes',
                'description' => 'Extend the beauty beyond your interior with our exterior wall finishing services. Weather-resistant plaster finishes that maintain their beauty for years.',
                'image' => null,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Custom Color Matching',
                'description' => 'Get the exact color you desire with our custom color matching service. We can match any color sample to create your perfect plaster finish.',
                'image' => null,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Wall Repair & Restoration',
                'description' => 'Expert repair and restoration of existing plaster walls. We can fix cracks, damage, and restore vintage plaster to its former glory.',
                'image' => null,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        
        DB::table('services')->insert($services);
        
        // Sample Gallery Images
        $galleries = [
            // Media Walls
            [
                'title' => 'Luxury Media Wall with Fireplace',
                'category' => 'Media Walls',
                'image' => null,
                'description' => 'Stunning media wall combining entertainment center with electric fireplace. Finished in premium Venetian plaster with marble effect.',
                'finish_type' => 'marble',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Modern Entertainment Center',
                'category' => 'Media Walls',
                'image' => null,
                'description' => 'Sleek modern media wall with floating shelves and ambient LED lighting. Finished in silver-toned Venetian plaster.',
                'finish_type' => 'silver',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Minimalist TV Wall',
                'category' => 'Media Walls',
                'image' => null,
                'description' => 'Clean, minimalist design with hidden cable management. Features warm brown plaster finish.',
                'finish_type' => 'brown',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Home Theater Wall',
                'category' => 'Media Walls',
                'image' => null,
                'description' => 'Dedicated home theater wall with acoustic considerations and dramatic gold-accented plaster.',
                'finish_type' => 'gold',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Venetian Plaster
            [
                'title' => 'Classic Italian Plaster Living Room',
                'category' => 'Venetian Plaster',
                'image' => null,
                'description' => 'Full living room transformation with authentic Venetian plaster in warm cream tones.',
                'finish_type' => 'marble',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Marble Effect Feature Wall',
                'category' => 'Venetian Plaster',
                'image' => null,
                'description' => 'Dramatic marble-effect wall with beautiful veining and depth. Perfect for formal dining rooms.',
                'finish_type' => 'marble',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Gold Accent Bedroom',
                'category' => 'Venetian Plaster',
                'image' => null,
                'description' => 'Luxurious bedroom with gold-accented Venetian plaster headboard wall.',
                'finish_type' => 'gold',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Textured Hallway',
                'category' => 'Venetian Plaster',
                'image' => null,
                'description' => 'Beautiful textured plaster finish that adds character to this hallway.',
                'finish_type' => 'brown',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Cornice Work
            [
                'title' => 'Elegant Crown Moulding Installation',
                'category' => 'Cornice',
                'image' => null,
                'description' => 'Detailed crown moulding installation that adds architectural interest to any room.',
                'finish_type' => 'silver',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Decorative Ceiling Cornice',
                'category' => 'Cornice',
                'image' => null,
                'description' => 'Intricate ceiling cornice work featuring classic patterns.',
                'finish_type' => 'gold',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Commercial Projects
            [
                'title' => 'Hotel Lobby Feature Wall',
                'category' => 'Commercial',
                'image' => null,
                'description' => 'Stunning feature wall in luxury hotel lobby using premium Venetian plaster.',
                'finish_type' => 'marble',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Restaurant Interior Design',
                'category' => 'Commercial',
                'image' => null,
                'description' => 'Complete restaurant interior with textured plaster walls creating warm ambiance.',
                'finish_type' => 'brown',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Office Reception Area',
                'category' => 'Commercial',
                'image' => null,
                'description' => 'Professional office reception featuring modern plaster finishes.',
                'finish_type' => 'silver',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Additional Projects
            [
                'title' => 'Spa Treatment Room',
                'category' => 'Wellness',
                'image' => null,
                'description' => 'Calming spa environment created with soft plaster textures.',
                'finish_type' => 'brown',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Kids Creative Space',
                'category' => 'Residential',
                'image' => null,
                'description' => 'Playful yet sophisticated finish for children\'s creative space.',
                'finish_type' => 'gold',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        
        DB::table('galleries')->insert($galleries);
        
        $this->command->info('Sample data seeded successfully!');
    }
}
