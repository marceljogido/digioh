<?php $__env->startSection("title"); ?>
    <?php echo e($service->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
    
    <section class="relative min-h-[60vh] overflow-hidden">
        
        <?php if($service->image): ?>
            <div class="absolute inset-0">
                <img src="<?php echo e(asset($service->image)); ?>" alt="<?php echo e($service->name); ?>" class="h-full w-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-[#11224e] via-[#11224e]/70 to-[#11224e]/30"></div>
            </div>
        <?php else: ?>
            <div class="absolute inset-0 bg-gradient-to-br from-[#11224e] via-[#1a2d5c] to-[#0d1a3a] animate-gradient"></div>
        <?php endif; ?>

        
        <div class="pointer-events-none absolute inset-y-0 left-0 w-1/3 bg-gradient-to-r from-[#5c83c4]/20 to-transparent"></div>
        <div class="pointer-events-none absolute inset-y-0 right-0 w-1/4 bg-gradient-to-l from-[#ffa630]/20 to-transparent animate-pulse-slow"></div>

        
        <div class="relative flex min-h-[60vh] items-end">
            <div class="mx-auto w-full max-w-screen-xl px-4 pb-16 pt-32 sm:px-12">
                <div class="max-w-3xl">
                    
                    <?php if($service->category): ?>
                        <span data-aos="fade-down" data-aos-delay="100" class="mb-6 inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-white/80 backdrop-blur-sm">
                            <?php echo e($service->category); ?>

                        </span>
                    <?php endif; ?>

                    
                    <h1 data-aos="fade-up" data-aos-delay="200" class="text-4xl font-bold leading-tight text-white sm:text-5xl lg:text-6xl">
                        <?php echo e($service->name); ?>

                    </h1>

                    
                    <p data-aos="fade-up" data-aos-delay="300" class="mt-6 max-w-2xl text-lg text-white/80">
                        <?php echo e(__('Solusi profesional untuk memperkuat pengalaman event dan aktivasi brand Anda.')); ?>

                    </p>

                    
                    <div class="mt-10 flex flex-wrap gap-6">
                        <?php if($relatedWorks->count()): ?>
                            <div data-aos="zoom-in" data-aos-delay="400" class="rounded-2xl border border-white/20 bg-white/10 px-6 py-4 backdrop-blur-sm hover-glow">
                                <p class="text-3xl font-bold text-[#ffa630]"><?php echo e($relatedWorks->count()); ?>+</p>
                                <p class="mt-1 text-xs uppercase tracking-[0.2em] text-white/70"><?php echo e(__('Projects')); ?></p>
                            </div>
                        <?php endif; ?>
                        <div data-aos="zoom-in" data-aos-delay="500" class="rounded-2xl border border-white/20 bg-white/10 px-6 py-4 backdrop-blur-sm hover-glow">
                            <p class="text-3xl font-bold text-[#5c83c4]">100%</p>
                            <p class="mt-1 text-xs uppercase tracking-[0.2em] text-white/70"><?php echo e(__('Satisfaction')); ?></p>
                        </div>
                        <div data-aos="zoom-in" data-aos-delay="600" class="rounded-2xl border border-white/20 bg-white/10 px-6 py-4 backdrop-blur-sm hover-glow">
                            <p class="text-3xl font-bold text-[#f17720]">24/7</p>
                            <p class="mt-1 text-xs uppercase tracking-[0.2em] text-white/70"><?php echo e(__('Support')); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 animate-bounce">
            <svg class="h-6 w-6 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </div>
    </section>

    
    <?php if($service->description): ?>
        <section class="bg-white">
            <div class="mx-auto max-w-screen-xl px-4 py-20 sm:px-12">
                <div class="grid gap-12 lg:grid-cols-12">
                    
                    <div class="lg:col-span-4" data-aos="fade-right">
                        <div class="lg:sticky lg:top-24">
                            <span class="text-xs font-semibold uppercase tracking-[0.3em] text-[#ffa630]"><?php echo e(__('About this service')); ?></span>
                            <h2 class="mt-4 text-3xl font-bold text-[#11224e]"><?php echo e(__('Apa yang kami tawarkan')); ?></h2>
                            <p class="mt-4 text-sm text-[#11224e]/70"><?php echo e(__('Solusi lengkap dari konsep hingga eksekusi.')); ?></p>

                            <div class="mt-8">
                                <a href="<?php echo e(route('contact')); ?>" class="inline-flex items-center gap-3 rounded-full bg-[#ffa630] px-8 py-4 font-semibold text-[#11224e] shadow-lg shadow-[#ffa630]/30 transition-all duration-300 hover:-translate-y-1 hover:bg-[#fcbf64] hover:shadow-xl">
                                    <span><?php echo e(__('Konsultasi Gratis')); ?></span>
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    
                    <div class="lg:col-span-8" data-aos="fade-left" data-aos-delay="200">
                        <div class="prose prose-lg max-w-none prose-headings:font-bold prose-headings:text-[#11224e] prose-p:text-[#11224e]/80 prose-a:text-[#5c83c4] prose-strong:text-[#11224e]">
                            <?php echo $service->description; ?>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    
    <?php if($relatedWorks->count()): ?>
        <section class="bg-[#f4f6fb]">
            <div class="mx-auto max-w-screen-xl px-4 py-20 sm:px-12">
                
                <div class="mb-12 text-center" data-aos="fade-up">
                    <span class="text-xs font-semibold uppercase tracking-[0.3em] text-[#5c83c4]"><?php echo e(__('Portfolio')); ?></span>
                    <h2 class="mt-4 text-3xl font-bold text-[#11224e] sm:text-4xl"><?php echo e(__('Projects menggunakan layanan ini')); ?></h2>
                    <p class="mx-auto mt-4 max-w-2xl text-[#11224e]/70"><?php echo e(__('Lihat bagaimana kami menerapkan layanan ini untuk berbagai klien dan event.')); ?></p>
                </div>

                
                <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <?php $__currentLoopData = $relatedWorks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $work): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php ($url = route('frontend.ourwork.show', [$work->id, $work->slug])); ?>
                        <article 
                            data-aos="fade-up" 
                            data-aos-delay="<?php echo e(100 + ($index * 150)); ?>"
                            class="group relative overflow-hidden rounded-[32px] bg-white shadow-lg shadow-[#11224e]/10 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover-lift"
                        >
                            
                            <div class="relative aspect-[4/3] overflow-hidden">
                                <img src="<?php echo e(asset($work->image ?: 'img/default_post.svg')); ?>" alt="<?php echo e($work->name); ?>" class="h-full w-full object-cover transition duration-500 group-hover:scale-110">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 transition group-hover:opacity-100"></div>

                                
                                <?php ($start = $work->event_start_date); ?>
                                <?php if($start): ?>
                                    <span class="absolute left-4 top-4 rounded-full bg-white/90 px-4 py-2 text-xs font-semibold text-[#11224e] shadow-lg backdrop-blur-sm">
                                        <?php echo e($start->isoFormat('MMM YYYY')); ?>

                                    </span>
                                <?php endif; ?>
                            </div>

                            
                            <div class="p-6">
                                <?php if(!empty($work->event_location)): ?>
                                    <div class="mb-3 flex items-center gap-2 text-xs text-[#5c83c4]">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <span><?php echo e($work->event_location); ?></span>
                                    </div>
                                <?php endif; ?>

                                <h3 class="text-xl font-bold text-[#11224e] transition group-hover:text-[#5c83c4]"><?php echo e($work->name); ?></h3>
                                <p class="mt-3 line-clamp-2 text-sm text-[#11224e]/70"><?php echo e(Str::limit(strip_tags($work->intro ?: $work->content), 120)); ?></p>

                                <a href="<?php echo e($url); ?>" class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-[#ffa630] transition-all duration-300 hover:gap-3">
                                    <?php echo e(__('Lihat Project')); ?>

                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </a>
                            </div>
                        </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    
    <section class="relative overflow-hidden bg-[#11224e]">
        
        <div class="pointer-events-none absolute inset-0 opacity-30">
            <div class="absolute -right-20 -top-20 h-96 w-96 rounded-full bg-[#5c83c4] blur-3xl animate-pulse-slow"></div>
            <div class="absolute -bottom-20 -left-20 h-96 w-96 rounded-full bg-[#ffa630] blur-3xl animate-pulse-slow"></div>
        </div>

        <div class="relative mx-auto max-w-screen-xl px-4 py-20 sm:px-12">
            <div class="mx-auto max-w-3xl text-center" data-aos="zoom-in">
                <span class="text-xs font-semibold uppercase tracking-[0.3em] text-[#ffa630]"><?php echo e(__('Ready to start?')); ?></span>
                <h2 class="mt-6 text-3xl font-bold text-white sm:text-4xl lg:text-5xl"><?php echo e(__('Wujudkan event impian Anda bersama kami')); ?></h2>
                <p class="mt-6 text-lg text-white/80"><?php echo e(__('Konsultasikan kebutuhan Anda dan dapatkan proposal khusus dari tim expert kami.')); ?></p>

                <div class="mt-10 flex flex-wrap justify-center gap-4">
                    <a href="<?php echo e(route('contact')); ?>" class="inline-flex items-center gap-3 rounded-full bg-[#ffa630] px-8 py-4 font-semibold text-[#11224e] shadow-lg transition-all duration-300 hover:-translate-y-1 hover:bg-[#fcbf64] hover:shadow-xl">
                        <span><?php echo e(__('Hubungi Kami')); ?></span>
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    <a href="<?php echo e(route('frontend.services.index')); ?>" class="inline-flex items-center gap-3 rounded-full border-2 border-white/30 px-8 py-4 font-semibold text-white transition-all duration-300 hover:border-white hover:bg-white/10">
                        <span><?php echo e(__('Lihat Semua Layanan')); ?></span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    
    <?php if(isset($otherServices) && $otherServices->count()): ?>
        <section class="bg-white">
            <div class="mx-auto max-w-screen-xl px-4 py-20 sm:px-12">
                <div class="mb-12 text-center" data-aos="fade-up">
                    <span class="text-xs font-semibold uppercase tracking-[0.3em] text-[#f17720]"><?php echo e(__('Explore more')); ?></span>
                    <h2 class="mt-4 text-3xl font-bold text-[#11224e]"><?php echo e(__('Layanan lainnya')); ?></h2>
                </div>

                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <?php $__currentLoopData = $otherServices->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $otherService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a 
                            href="<?php echo e(route('frontend.services.show', $otherService->slug)); ?>" 
                            data-aos="fade-up" 
                            data-aos-delay="<?php echo e(100 + ($index * 100)); ?>"
                            class="group flex items-center gap-5 rounded-2xl border border-[#e0e7f7] bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-[#5c83c4]/30 hover:shadow-lg hover-lift"
                        >
                            <?php if($otherService->image): ?>
                                <div class="h-16 w-16 flex-shrink-0 overflow-hidden rounded-xl">
                                    <img src="<?php echo e(asset($otherService->image)); ?>" alt="<?php echo e($otherService->name); ?>" class="h-full w-full object-cover transition duration-300 group-hover:scale-110">
                                </div>
                            <?php else: ?>
                                <div class="flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-xl bg-[#f4f6fb]">
                                    <svg class="h-8 w-8 text-[#5c83c4]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                </div>
                            <?php endif; ?>
                            <div class="flex-1">
                                <h3 class="font-semibold text-[#11224e] transition group-hover:text-[#5c83c4]"><?php echo e($otherService->name); ?></h3>
                                <p class="mt-1 line-clamp-1 text-sm text-[#11224e]/60"><?php echo e(Str::limit(strip_tags($otherService->description), 60)); ?></p>
                            </div>
                            <svg class="h-5 w-5 flex-shrink-0 text-[#11224e]/30 transition-all duration-300 group-hover:translate-x-1 group-hover:text-[#ffa630]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("frontend.layouts.app", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Marcel\Music\3.digioh\resources\views/frontend/services/show.blade.php ENDPATH**/ ?>