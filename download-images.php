<?php
// Run with: php download-images.php

$images = [
    // Service Images
    'venetian-plaster-service.jpg' => 'https://images.unsplash.com/photo-1616486029423-aaa4789e8c9a?w=800',
    'media-wall-service.jpg' => 'https://images.unsplash.com/photo-1583847268964-b28dc8f51f92?w=800',
    'cornice-service.jpg' => 'https://images.unsplash.com/photo-1566228015666-4c8e45cc6e36?w=800',
    'mouldings-service.jpg' => 'https://images.unsplash.com/photo-1581093458791-9f3c3900df4b?w=800',
    'marble-service.jpg' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800',
    'textured-service.jpg' => 'https://images.unsplash.com/photo-1581092335871-4d6d0e2b8a7c?w=800',
    
    // Gallery Images - Media Walls
    'media-wall-1.jpg' => 'https://images.unsplash.com/photo-1583847268964-b28dc8f51f92?w=800',
    'media-wall-2.jpg' => 'https://images.unsplash.com/photo-1574375927938-d5a98e8ffe85?w=800',
    'media-wall-3.jpg' => 'https://images.unsplash.com/photo-1595521624992-48a59aef95f1?w=800',
    
    // Gallery Images - Venetian Plaster
    'venetian-1.jpg' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?w=800',
    'venetian-2.jpg' => 'https://images.unsplash.com/photo-1600607687644-c7c9f60f4ba8?w=800',
    'venetian-3.jpg' => 'https://images.unsplash.com/photo-1600210492493-0946911123ea?w=800',
    
    // Gallery Images - Cornice
    'cornice-1.jpg' => 'https://images.unsplash.com/photo-1566228015666-4c8e45cc6e36?w=800',
    'cornice-2.jpg' => 'https://images.unsplash.com/photo-1581093458791-9f3c3900df4b?w=800',
    
    // Additional Images
    'commercial-1.jpg' => 'https://images.unsplash.com/photo-1581092335871-4d6d0e2b8a7c?w=800',
    'commercial-2.jpg' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800',
];

// Create directories if they don't exist
if (!is_dir('public/uploads/services')) {
    mkdir('public/uploads/services', 0777, true);
}
if (!is_dir('public/uploads/gallery')) {
    mkdir('public/uploads/gallery', 0777, true);
}

// Download images
foreach ($images as $filename => $url) {
    $ch = curl_init($url);
    $fp = fopen('public/uploads/gallery/' . $filename, 'wb');
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_exec($ch);
    curl_close($ch);
    fclose($fp);
    
    echo "Downloaded: $filename\n";
}

echo "All images downloaded successfully!\n";