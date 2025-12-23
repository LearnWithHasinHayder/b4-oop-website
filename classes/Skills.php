<?php

class Skills extends Section
{
    protected function renderContent(): void
    {
        $skills = $this->data['items'] ?? [];
        $c = $this->data['theme_color'] ?? 'indigo';
        ?>
        <section id="skills" class="py-16 bg-white">
          <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
              <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                <?php echo htmlspecialchars($this->data['title']); ?>
              </h2>
            </div>
            
            <div class="flex flex-wrap justify-center gap-4 max-w-4xl mx-auto">
                <?php foreach ($skills as $skill): ?>
                    <span class="inline-flex items-center px-6 py-3 rounded-full text-base font-medium bg-<?php echo $c; ?>-100 text-<?php echo $c; ?>-800 transition-transform hover:scale-105 cursor-default">
                        <?php echo htmlspecialchars($skill); ?>
                    </span>
                <?php endforeach; ?>
            </div>
          </div>
        </section>
        <?php
    }
}