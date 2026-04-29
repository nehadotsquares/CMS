<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Gallery;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FixedImageSeeder extends Seeder
{
    public function run(): void
    {
        // First, download all images
        $this->downloadAllImages();
        
        // Then seed services with image paths
        $this->seedServices();
        
        // Then seed galleries with image paths
        $this->seedGalleries();
        
        $this->command->info('All services and galleries seeded successfully!');
    }
    
    private function downloadAllImages(): void
    {
        // Create directories if they don't exist
        $directories = [
            public_path('uploads/services'),
            public_path('uploads/gallery')
        ];
        
        foreach ($directories as $dir) {
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
                $this->command->info("Created directory: $dir");
            }
        }
        
        // Service images
        $serviceImages = [
            'venetian-plaster-1.jpg' => 'https://images.unsplash.com/photo-1616486029423-aaa4789e8c9a?w=800',
            'media-wall-1.jpg' => 'https://images.unsplash.com/photo-1583847268964-b28dc8f51f92?w=800',
            'cornice-1.jpg' => 'https://images.unsplash.com/photo-1566228015666-4c8e45cc6e36?w=800',
            'mouldings-1.jpg' => 'https://images.unsplash.com/photo-1581093458791-9f3c3900df4b?w=800',
            'marble-1.jpg' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800',
            'textured-1.jpg' => 'https://images.unsplash.com/photo-1581092335871-4d6d0e2b8a7c?w=800',
        ];
        
        // Gallery images
        $galleryImages = [
            'media-wall-1.jpg' => 'https://images.unsplash.com/photo-1583847268964-b28dc8f51f92?w=800',
            'media-wall-2.jpg' => 'https://images.unsplash.com/photo-1574375927938-d5a98e8ffe85?w=800',
            'media-wall-3.jpg' => 'https://images.unsplash.com/photo-1595521624992-48a59aef95f1?w=800',
            'venetian-1.jpg' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?w=800',
            'venetian-2.jpg' => 'https://images.unsplash.com/photo-1600607687644-c7c9f60f4ba8?w=800',
            'venetian-3.jpg' => 'https://images.unsplash.com/photo-1600210492493-0946911123ea?w=800',
            'cornice-1.jpg' => 'https://images.unsplash.com/photo-1566228015666-4c8e45cc6e36?w=800',
            'cornice-2.jpg' => 'https://images.unsplash.com/photo-1581093458791-9f3c3900df4b?w=800',
            'commercial-1.jpg' => 'https://images.unsplash.com/photo-1581092335871-4d6d0e2b8a7c?w=800',
            'commercial-2.jpg' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800',
            'commercial-3.jpg' => 'https://images.unsplash.com/photo-1600607687644-c7c9f60f4ba8?w=800',
            'residential-1.jpg' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?w=800',
            'residential-2.jpg' => 'https://images.unsplash.com/photo-1583847268964-b28dc8f51f92?w=800',
            'residential-3.jpg' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800',
        ];
        
        // Download service images
        $this->command->info('Downloading service images...');
        foreach ($serviceImages as $filename => $url) {
            try {
                $imageContent = @file_get_contents($url);
                if ($imageContent !== false) {
                    file_put_contents(public_path('uploads/services/' . $filename), $imageContent);
                    $this->command->info("✓ Downloaded: $filename");
                } else {
                    $this->command->error("✗ Failed: $filename");
                }
            } catch (\Exception $e) {
                $this->command->error("✗ Error downloading $filename: " . $e->getMessage());
            }
        }
        
        // Download gallery images
        $this->command->info("\nDownloading gallery images...");
        foreach ($galleryImages as $filename => $url) {
            try {
                $imageContent = @file_get_contents($url);
                if ($imageContent !== false) {
                    file_put_contents(public_path('uploads/gallery/' . $filename), $imageContent);
                    $this->command->info("✓ Downloaded: $filename");
                } else {
                    $this->command->error("✗ Failed: $filename");
                }
            } catch (\Exception $e) {
                $this->command->error("✗ Error downloading $filename: " . $e->getMessage());
            }
        }
    }
    
    private function seedServices(): void
    {
        $services = [
            [
                'title' => 'Venetian Plaster Finishes',
                'description' => 'Transform your walls with authentic Venetian plaster. Our premium finishes create stunning marble-like textures that add elegance and sophistication to any space. Perfect for feature walls, entire rooms, or commercial spaces. Available in various colors and finishes including gold, silver, and marble effects.',
                'image' => 'uploads/services/venetian-plaster-1.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Premium Media Walls',
                'description' => 'Custom-designed media walls that combine functionality with stunning aesthetics. We create the perfect backdrop for your entertainment system with integrated storage, ambient LED lighting, and premium plaster finishes. Transform your living room into a cinematic experience.',
                'image' => 'uploads/services/media-wall-1.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Elegant Cornice Work',
                'description' => 'Add architectural elegance with our custom cornice work and mouldings. From classic Victorian to modern minimalist, we create detailed crown mouldings, cornices, and decorative elements that enhance your interior design.',
                'image' => 'uploads/services/cornice-1.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Decorative Mouldings',
                'description' => 'Custom decorative mouldings to enhance your walls and ceilings. Create unique patterns, picture frames, and architectural details that add character and value to your property.',
                'image' => 'uploads/services/mouldings-1.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Marble Effect Walls',
                'description' => 'Achieve the luxurious look of marble without the cost and maintenance. Our marble-effect Venetian plaster creates stunning wall finishes that mimic natural marble with beautiful veining and depth.',
                'image' => 'uploads/services/marble-1.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Textured Wall Finishes',
                'description' => 'Create depth and character with our range of textured wall finishes. From subtle sandstone effects to dramatic stucco textures, we bring your walls to life with unique tactile surfaces.',
                'image' => 'uploads/services/textured-1.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        
        foreach ($services as $service) {
            Service::updateOrCreate(
                ['title' => $service['title']],
                $service
            );
            $this->command->info("✓ Added service: {$service['title']}");
        }
    }
    
    private function seedGalleries(): void
    {
        $galleries = [
            // Media Walls
            [
                'title' => 'Luxury Media Wall with Fireplace',
                'category' => 'Media Walls',
                'image' => 'uploads/gallery/media-wall-1.jpg',
                'description' => 'Stunning media wall combining entertainment center with electric fireplace. Finished in premium Venetian plaster with marble effect.',
                'finish_type' => 'marble',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Modern Entertainment Center',
                'category' => 'Media Walls',
                'image' => 'uploads/gallery/media-wall-2.jpg',
                'description' => 'Sleek modern media wall with floating shelves and ambient LED lighting. Finished in silver-toned Venetian plaster.',
                'finish_type' => 'silver',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Minimalist TV Wall Unit',
                'category' => 'Media Walls',
                'image' => 'uploads/gallery/media-wall-3.jpg',
                'description' => 'Clean, minimalist design with hidden cable management and warm brown plaster finish.',
                'finish_type' => 'brown',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Venetian Plaster Projects
            [
                'title' => 'Classic Venetian Plaster Living Room',
                'category' => 'Venetian Plaster',
                'image' => 'uploads/gallery/venetian-1.jpg',
                'description' => 'Full living room transformation with authentic Venetian plaster in warm cream tones.',
                'finish_type' => 'marble',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Gold Accent Feature Wall',
                'category' => 'Venetian Plaster',
                'image' => 'uploads/gallery/venetian-2.jpg',
                'description' => 'Luxurious gold-accented Venetian plaster wall perfect for formal dining rooms.',
                'finish_type' => 'gold',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Textured Hallway Design',
                'category' => 'Venetian Plaster',
                'image' => 'uploads/gallery/venetian-3.jpg',
                'description' => 'Beautiful textured plaster finish that adds character to hallways and corridors.',
                'finish_type' => 'textured',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Cornice Work
            [
                'title' => 'Elegant Crown Moulding',
                'category' => 'Cornice',
                'image' => 'uploads/gallery/cornice-1.jpg',
                'description' => 'Detailed crown moulding installation that adds architectural interest to any room.',
                'finish_type' => 'silver',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Decorative Ceiling Cornice',
                'category' => 'Cornice',
                'image' => 'uploads/gallery/cornice-2.jpg',
                'description' => 'Intricate ceiling cornice work featuring classic patterns and designs.',
                'finish_type' => 'gold',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Commercial Projects
            [
                'title' => 'Hotel Lobby Feature Wall',
                'category' => 'Commercial',
                'image' => 'uploads/gallery/commercial-1.jpg',
                'description' => 'Stunning feature wall in luxury hotel lobby using premium Venetian plaster.',
                'finish_type' => 'marble',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Restaurant Interior Design',
                'category' => 'Commercial',
                'image' => 'uploads/gallery/commercial-2.jpg',
                'description' => 'Complete restaurant interior transformation with textured plaster walls.',
                'finish_type' => 'brown',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Office Reception Area',
                'category' => 'Commercial',
                'image' => 'uploads/gallery/commercial-3.jpg',
                'description' => 'Professional office reception featuring modern plaster finishes.',
                'finish_type' => 'silver',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Residential Projects
            [
                'title' => 'Master Bedroom Feature Wall',
                'category' => 'Residential',
                'image' => 'uploads/gallery/residential-1.jpg',
                'description' => 'Stunning master bedroom feature wall with gold-accented Venetian plaster.',
                'finish_type' => 'gold',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Modern Living Room',
                'category' => 'Residential',
                'image' => 'uploads/gallery/residential-2.jpg',
                'description' => 'Contemporary living room with marble-effect Venetian plaster walls.',
                'finish_type' => 'marble',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Luxury Bathroom Design',
                'category' => 'Residential',
                'image' => 'uploads/gallery/residential-3.jpg',
                'description' => 'Elegant bathroom featuring moisture-resistant plaster finishes.',
                'finish_type' => 'silver',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        
        foreach ($galleries as $gallery) {
            Gallery::updateOrCreate(
                ['title' => $gallery['title']],
                $gallery
            );
            $this->command->info("✓ Added gallery: {$gallery['title']}");
        }
    }
}