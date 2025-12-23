<?php

class About extends Section
{
    protected function renderContent(): void
    {
        $c = $this->data['theme_color'] ?? 'indigo';
        ?>
        <section id="about" class="py-16 bg-gray-50">
          <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
              <h2 class="text-base text-<?php echo $c; ?>-600 font-semibold tracking-wide uppercase">About</h2>
              <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                <?php echo htmlspecialchars($this->data['title']); ?>
              </p>
              <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                <?php echo nl2br(htmlspecialchars($this->data['content'])); ?>
              </p>
            </div>
          </div>
        </section>
        <?php
    }
}