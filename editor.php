<?php
// editor.php

// 1. Load Data
$dataFile = 'data.json';
$json = file_get_contents($dataFile);
$data = json_decode($json, true);

if (!$data) {
    die('Error loading configuration data.');
}

// 2. Handle Form Submission
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sectionKey = $_POST['section_key'] ?? null;
    $shouldSave = false;
    
    // Top-level theme_color
    if (isset($_POST['theme_color'])) {
        $data['theme_color'] = $_POST['theme_color'];
        $shouldSave = true;
    }

    if ($sectionKey && isset($data[$sectionKey])) {
        // Iterate through expected keys for this section to grab from POST
        foreach ($data[$sectionKey] as $key => $oldValue) {
            
            // Special handling for boolean 'visible' which might not be sent if unchecked
            if ($key === 'visible') {
                $data[$sectionKey][$key] = isset($_POST[$key]);
                continue;
            }

            if (isset($_POST[$key])) {
                $postedValue = $_POST[$key];

                // Handle Arrays (submitted as JSON string)
                if (is_array($oldValue)) {
                    $decoded = json_decode($postedValue, true);
                    if ($decoded !== null) {
                        $data[$sectionKey][$key] = $decoded;
                    }
                } else {
                    // Strings
                    $data[$sectionKey][$key] = $postedValue;
                }
            }
        }
        $shouldSave = true;
    }

    if ($shouldSave) {
        // Save back to file
        if (file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES))) {
            $message = "Changes saved successfully!";
        } else {
            $message = "Error saving data.";
        }
    }
}

// 3. Determine Current Section
$currentSection = $_GET['section'] ?? array_key_first($data);
if ($currentSection !== 'theme' && !isset($data[$currentSection])) {
    $currentSection = array_key_first($data);
}
$sectionData = ($currentSection === 'theme') ? [] : ($data[$currentSection] ?? []);

$themeColor = $data['theme_color'] ?? 'indigo';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Editor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 h-screen flex overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white flex-shrink-0 overflow-y-auto">
        <div class="p-6">
            <h1 class="text-2xl font-bold">Editor</h1>
            <p class="text-gray-400 text-sm mt-1">Manage your content</p>
        </div>
        <nav class="px-4 pb-4">
            <ul>
                <li>
                    <a href="?section=theme" 
                       class="block px-4 py-3 rounded-md mb-1 transition-colors <?php echo $currentSection === 'theme' ? 'bg-'.$themeColor.'-600 text-white' : 'text-gray-300 hover:bg-gray-800'; ?>">
                        Theme
                    </a>
                </li>
                <?php foreach ($data as $key => $val): if ($key === 'theme_color' || $key === 'meta') continue; ?>
                    <li>
                        <a href="?section=<?php echo $key; ?>" 
                           class="block px-4 py-3 rounded-md mb-1 transition-colors <?php echo $currentSection === $key ? 'bg-'.$themeColor.'-600 text-white' : 'text-gray-300 hover:bg-gray-800'; ?>">
                            <?php echo ucfirst($key); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
        <div class="p-4 mt-auto border-t border-gray-800">
            <a href="index.php" target="_blank" class="flex items-center text-gray-400 hover:text-white transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                View Site
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col min-w-0 overflow-hidden">
        
        <!-- Header -->
        <header class="bg-white shadow-sm z-10 p-6 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Editing: <span class="text-<?php echo $themeColor; ?>-600"><?php echo ucfirst($currentSection); ?></span></h2>
            <?php if ($message): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded relative" role="alert">
                    <span class="block sm:inline"><?php echo $message; ?></span>
                </div>
            <?php endif; ?>
        </header>

        <!-- Form Scroll Area -->
        <div class="flex-1 overflow-y-auto p-6 md:p-12">
            <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">
                <form method="POST" class="p-8 space-y-6">
                    <input type="hidden" name="section_key" value="<?php echo $currentSection; ?>">

                    <?php if ($currentSection === 'theme'): ?>
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700 uppercase tracking-wide">Theme Color</label>
                            <select name="theme_color" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-<?php echo $themeColor; ?>-500 focus:border-<?php echo $themeColor; ?>-500 sm:text-sm rounded-md">
                                <?php 
                                $colors = ['slate', 'gray', 'zinc', 'neutral', 'stone', 'red', 'orange', 'amber', 'yellow', 'lime', 'green', 'emerald', 'teal', 'cyan', 'sky', 'blue', 'indigo', 'violet', 'purple', 'fuchsia', 'pink', 'rose'];
                                foreach ($colors as $color): 
                                ?>
                                    <option value="<?php echo $color; ?>" <?php echo ($data['theme_color'] ?? 'indigo') === $color ? 'selected' : ''; ?>>
                                        <?php echo ucfirst($color); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php else: ?>
                        <?php foreach ($sectionData as $key => $value): ?>
                        
                        <div class="space-y-1">
                            <!-- Label -->
                            <label class="block text-sm font-medium text-gray-700 uppercase tracking-wide">
                                <?php echo str_replace('_', ' ', $key); ?>
                            </label>

                            <!-- Inputs based on type -->
                            <?php if (is_bool($value) && $key === 'visible'): ?>
                                <div class="flex items-center mt-2">
                                    <input type="checkbox" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="1" <?php echo $value ? 'checked' : ''; ?> 
                                           class="h-5 w-5 text-<?php echo $themeColor; ?>-600 focus:ring-<?php echo $themeColor; ?>-500 border-gray-300 rounded">
                                    <label for="<?php echo $key; ?>" class="ml-2 block text-sm text-gray-900">
                                        Show this section on the website
                                    </label>
                                </div>

                            <?php elseif (is_array($value)): ?>
                                <!-- Array -> JSON Textarea -->
                                <p class="text-xs text-gray-500 mb-1">Edit items as JSON structure.</p>
                                <textarea name="<?php echo $key; ?>" rows="10" 
                                          class="shadow-sm focus:ring-<?php echo $themeColor; ?>-500 focus:border-<?php echo $themeColor; ?>-500 block w-full sm:text-sm border-gray-300 rounded-md font-mono bg-gray-50 p-2"><?php echo htmlspecialchars(json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)); ?></textarea>

                            <?php elseif (strlen((string)$value) > 100): ?>
                                <!-- Long Text -> Textarea -->
                                <textarea name="<?php echo $key; ?>" rows="5" 
                                          class="shadow-sm focus:ring-<?php echo $themeColor; ?>-500 focus:border-<?php echo $themeColor; ?>-500 block w-full sm:text-sm border-gray-300 rounded-md p-2"><?php echo htmlspecialchars($value); ?></textarea>

                            <?php else: ?>
                                <!-- Short Text -> Input -->
                                <input type="text" name="<?php echo $key; ?>" value="<?php echo htmlspecialchars($value); ?>" 
                                       class="shadow-sm focus:ring-<?php echo $themeColor; ?>-500 focus:border-<?php echo $themeColor; ?>-500 block w-full sm:text-sm border-gray-300 rounded-md h-10 px-3">
                            <?php endif; ?>
                        </div>

                    <?php endforeach; ?>
                    <?php endif; ?>

                    <div class="pt-6 border-t border-gray-200">
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-<?php echo $themeColor; ?>-600 hover:bg-<?php echo $themeColor; ?>-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-<?php echo $themeColor; ?>-500 transition-colors">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

</body>
</html>
