<?php

// 1. Load Data
$json = file_get_contents('data.json');
$data = json_decode($json, true);

if (!$data) {
    die('Error loading configuration data.');
}

// 2. Simple Autoloader (or manual includes)
require_once 'classes/Section.php';
require_once 'classes/Navigation.php';
require_once 'classes/Hero.php';
require_once 'classes/About.php';
require_once 'classes/Skills.php';
require_once 'classes/Projects.php';
require_once 'classes/Testimonials.php';
require_once 'classes/Contact.php';
require_once 'classes/Footer.php';

// 3. Instantiate Sections
$themeColor = $data['theme_color'] ?? 'indigo';

$nav = new Navigation($data['navigation'] ?? []);
$hero = new Hero(array_merge($data['hero'] ?? [], ['theme_color' => $themeColor]));
$about = new About(array_merge($data['about'] ?? [], ['theme_color' => $themeColor]));
$skills = new Skills(array_merge($data['skills'] ?? [], ['theme_color' => $themeColor]));
$projects = new Projects(array_merge($data['projects'] ?? [], ['theme_color' => $themeColor]));
$testimonials = new Testimonials(array_merge($data['testimonials'] ?? [], ['theme_color' => $themeColor]));
$contact = new Contact(array_merge($data['contact'] ?? [], ['theme_color' => $themeColor]));
$footer = new Footer($data['footer'] ?? []);

?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($data['meta']['title'] ?? 'Portfolio'); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($data['meta']['description'] ?? ''); ?>">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Custom Styles -->
    <link rel="stylesheet" href="assets/styles.css">

    <!-- Inter Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased">

    <?php
    // 4. Render Layout
    // The main entry point contains NO logic about what shows up.
    // It simply asks every section to "render yourself if you want".
    
    $nav->render();
    
    $hero->render();
    $skills->render();
    $about->render();
    $projects->render();
    $testimonials->render();
    $contact->render();
    
    $footer->render();
    ?>

</body>
</html>
