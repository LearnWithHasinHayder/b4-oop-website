<?php

class Hero extends Section {
        protected function renderContent(): void
        {
            $d = $this->data; // Shorthand
            $c = $d['theme_color'] ?? 'indigo';
            ?>
            <section id="hero" class="pt-32 pb-16 md:pt-48 md:pb-32 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:grid lg:grid-cols-12 lg:gap-8 items-center">
    
                    <!-- Text Content -->
                    <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-6 lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block"><?php echo htmlspecialchars($d['title']); ?></span>
                            <?php if (!empty($d['subtitle'])): ?>
                                <span class="block text-<?php echo $c; ?>-600 text-3xl sm:text-4xl mt-2"><?php echo htmlspecialchars($d['subtitle']); ?></span>
                            <?php endif; ?>
                        </h1>
                        <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            <?php echo htmlspecialchars($d['description']); ?>
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                <a href="<?php echo htmlspecialchars($d['cta_link']); ?>" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-<?php echo $c; ?>-600 hover:bg-<?php echo $c; ?>-700 md:py-4 md:text-lg transition-colors duration-200">
                                    <?php echo htmlspecialchars($d['cta_text']); ?>
                                </a>
                            </div>
                        </div>
                    </div>

                <!-- Image Content -->
                <?php if (!empty($d['image_url'])): ?>
                    <div class="mt-12 relative sm:max-w-lg sm:mx-auto lg:mt-0 lg:max-w-none lg:mx-0 lg:col-span-6 lg:flex lg:items-center">
                        <div class="relative mx-auto w-full rounded-lg shadow-lg lg:max-w-md overflow-hidden">
                            <img class="w-full h-full object-cover" src="<?php echo htmlspecialchars($d['image_url']); ?>" alt="Hero Image">
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </section>
        <?php
    }
}
