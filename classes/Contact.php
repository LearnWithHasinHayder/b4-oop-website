<?php

class Contact extends Section
{
    protected function renderContent(): void
    {
        $d = $this->data;
        $c = $d['theme_color'] ?? 'indigo';
        ?>
        <section id="contact" class="bg-white py-16 lg:py-24">
          <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
              <h2 class="text-3xl font-extrabold text-gray-900"><?php echo htmlspecialchars($d['title']); ?></h2>
              <p class="mt-4 text-lg text-gray-500">Interested in working together? Let's connect.</p>
            </div>
            
            <div class="mt-12 flex justify-center space-x-8">
              
              <?php if (!empty($d['email'])): ?>
                  <a href="mailto:<?php echo htmlspecialchars($d['email']); ?>" class="text-gray-400 hover:text-<?php echo $c; ?>-600 transition-colors duration-200">
                    <span class="sr-only">Email</span>
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                  </a>
              <?php endif; ?>

              <?php
              $socials = ['linkedin', 'github', 'twitter'];
              foreach ($socials as $social) {
                  if (!empty($d[$social])) {
                       ?>
                       <a href="<?php echo htmlspecialchars($d[$social]); ?>" class="text-gray-400 hover:text-<?php echo $c; ?>-600 transition-colors duration-200 capitalize">
                         <span class="sr-only"><?php echo $social; ?></span>
                         <span class="text-lg font-bold"><?php echo ucfirst($social); ?></span>
                       </a>
                       <?php
                  }
              }
              ?>
            </div>
          </div>
        </section>
        <?php
    }
}