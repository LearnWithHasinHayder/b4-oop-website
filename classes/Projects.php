<?php

class Projects extends Section
{
    protected function renderContent(): void
    {
        $projects = $this->data['items'] ?? [];
        ?>
        <section id="projects" class="py-16 bg-gray-50">
          <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
              <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl"><?php echo htmlspecialchars($this->data['title']); ?></h2>
              <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-500 sm:mt-4">Some of my recent work.</p>
            </div>

            <div class="mt-12 grid gap-8 max-w-lg mx-auto lg:grid-cols-3 lg:max-w-none">
                <?php foreach ($projects as $project): ?>
                    <?php $this->renderProjectCard($project); ?>
                <?php endforeach; ?>
            </div>
          </div>
        </section>
        <?php
    }

    private function renderProjectCard($project)
    {
        ?>
        <div class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-white hover:shadow-xl transition-shadow duration-300">
          <div class="flex-shrink-0">
            <img class="h-48 w-full object-cover" src="<?php echo htmlspecialchars($project['image']); ?>" alt="<?php echo htmlspecialchars($project['name']); ?>">
          </div>
          <div class="flex-1 p-6 flex flex-col justify-between">
            <div class="flex-1">
              <a href="<?php echo htmlspecialchars($project['link']); ?>" class="block mt-2">
                <p class="text-xl font-semibold text-gray-900"><?php echo htmlspecialchars($project['name']); ?></p>
                <p class="mt-3 text-base text-gray-500"><?php echo htmlspecialchars($project['description']); ?></p>
              </a>
            </div>
            
            <div class="mt-6 flex items-center flex-wrap gap-2">
                <?php foreach ($project['tags'] as $tag): ?>
                  <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium bg-gray-100 text-gray-800">
                    <?php echo htmlspecialchars($tag); ?>
                  </span>
                <?php endforeach; ?>
            </div>
          </div>
        </div>
        <?php
    }
}