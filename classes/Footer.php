<?php

class Footer extends Section
{
    protected function renderContent(): void
    {
        ?>
        <footer class="bg-gray-800">
          <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-base text-gray-400">
              <?php echo htmlspecialchars($this->data['copyright']); ?>
            </p>
          </div>
        </footer>
        <?php
    }
}