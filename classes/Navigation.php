<?php

class Navigation extends Section
{

    protected function renderContent(): void
    {
        $items = $this->data['items'] ?? [];
        ?>
        <nav class="fixed w-full bg-white/90 backdrop-blur-sm shadow-sm z-50">
          <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
              <div class="flex-shrink-0 flex items-center">
                <span class="font-bold text-xl text-gray-800"><?php echo htmlspecialchars($this->data['brand_name'] ?? 'Portfolio'); ?></span>
              </div>
              <div class="hidden sm:ml-6 sm:flex sm:space-x-8 items-center">
                <?php foreach ($items as $item): ?>
                    <a href="<?php echo htmlspecialchars($item['link']); ?>" class="text-gray-500 hover:text-gray-900 px-3 py-2 text-sm font-medium transition-colors duration-200">
                        <?php echo htmlspecialchars($item['label']); ?>
                    </a>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </nav>
        <?php
    }
}