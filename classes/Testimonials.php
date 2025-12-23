<?php

class Testimonials extends Section
{
    protected function renderContent(): void
    {
        $items = $this->data['items'] ?? [];
        $c = $this->data['theme_color'] ?? 'indigo';
        ?>
        <section id="testimonials" class="py-16 bg-white overflow-hidden">
          <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="relative">
              <div class="text-center mb-16">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                  <?php echo htmlspecialchars($this->data['title']); ?>
                </h2>
              </div>
              
              <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <?php foreach ($items as $item): ?>
                    <div class="relative bg-<?php echo $c; ?>-600 rounded-2xl p-8 shadow-xl">
                      <div class="relative h-full flex flex-col justify-between">
                        <blockquote class="mt-6 text-white">
                          <p class="text-xl font-medium sm:text-2xl">"<?php echo htmlspecialchars($item['quote']); ?>"</p>
                        </blockquote>
                        <footer class="mt-8">
                          <div class="flex items-center">
                            <div class="ml-4 border-l-2 border-<?php echo $c; ?>-400 pl-4">
                              <div class="text-base font-semibold text-white"><?php echo htmlspecialchars($item['author']); ?></div>
                              <div class="text-base font-medium text-<?php echo $c; ?>-200"><?php echo htmlspecialchars($item['role']); ?></div>
                            </div>
                          </div>
                        </footer>
                      </div>
                    </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </section>
        <?php
    }
}