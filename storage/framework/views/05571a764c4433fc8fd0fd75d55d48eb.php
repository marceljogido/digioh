<?php $__env->startSection("title"); ?>
    <?php echo e(__('Products & Services')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
    
    <section class="relative overflow-hidden bg-[#11224e] text-white">
        <div class="pointer-events-none absolute inset-y-0 left-0 w-1/3 bg-gradient-to-r from-[#5c83c4]/30 to-transparent"></div>
        <div class="pointer-events-none absolute inset-y-0 right-0 w-1/4 bg-gradient-to-l from-[#ffa630]/40 to-transparent animate-pulse-slow"></div>
        <div class="mx-auto max-w-screen-xl px-4 py-12 sm:px-12 lg:py-16">
            <div class="text-center">
                <span data-aos="fade-down" class="inline-flex items-center gap-2 rounded-full border border-white/20 px-4 py-1 text-xs font-semibold uppercase tracking-[0.4em] text-white/70">
                    <?php echo e(__('Service Portfolio')); ?>

                </span>
                <h1 data-aos="fade-up" data-aos-delay="100" class="mt-4 text-3xl font-bold leading-tight sm:text-5xl">
                    <?php echo e(__('Products & Services')); ?>

                </h1>
                <p data-aos="fade-up" data-aos-delay="200" class="mx-auto mt-4 max-w-2xl text-base text-white/80">
                    <?php echo e(__('Solusi experiential + creative tech + business development untuk eksekusi event tanpa pemborosan.')); ?>

                </p>
            </div>
        </div>
    </section>

    
    <section class="bg-white py-16">
        <div class="mx-auto max-w-screen-xl px-4 sm:px-12">
            <?php if($services->count()): ?>
                <div class="space-y-16 lg:space-y-24">
                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $isEven = $index % 2 === 0;
                            $features = $service->features ?? [];
                        ?>
                        
                        <div class="grid items-center gap-8 lg:grid-cols-2 lg:gap-16" data-aos="fade-up" data-aos-delay="<?php echo e($index * 100); ?>">
                            
                            <div class="<?php echo e($isEven ? 'lg:order-1' : 'lg:order-2'); ?>">
                                <div class="aspect-[4/3] overflow-hidden rounded-[24px] bg-gradient-to-br from-slate-100 to-slate-50 shadow-lg">
                                    <?php if($service->image): ?>
                                        <img src="<?php echo e(asset($service->image)); ?>" alt="<?php echo e($service->name); ?>" class="h-full w-full object-cover">
                                    <?php else: ?>
                                        <div class="flex h-full w-full items-center justify-center">
                                            <?php if($service->icon): ?>
                                                <i class="<?php echo e($service->icon); ?> text-6xl text-[#5c83c4]/40"></i>
                                            <?php else: ?>
                                                <svg class="h-24 w-24 text-[#5c83c4]/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            
                            <div class="<?php echo e($isEven ? 'lg:order-2' : 'lg:order-1'); ?>">
                                
                                <div class="flex items-center gap-4">
                                    <?php if($service->icon): ?>
                                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-[#11224e] text-white shadow-lg">
                                            <i class="<?php echo e($service->icon); ?> text-xl"></i>
                                        </div>
                                    <?php endif; ?>
                                    <h2 class="text-2xl font-bold uppercase tracking-wide text-[#11224e]">
                                        <?php echo e($service->name); ?>

                                    </h2>
                                </div>

                                
                                <p class="mt-4 text-slate-600 leading-relaxed">
                                    <?php echo e(strip_tags($service->description)); ?>

                                </p>

                                
                                <?php if(count($features) > 0): ?>
                                    <div class="mt-6 grid gap-3 sm:grid-cols-2">
                                        <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="flex items-center gap-3">
                                                <svg class="h-5 w-5 flex-shrink-0 text-[#5c83c4]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span class="text-sm text-slate-700"><?php echo e($feature); ?></span>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endif; ?>

                                
                                <div class="mt-8 flex flex-wrap items-center gap-4">
                                    <div>
                                        <?php if($service->price): ?>
                                            <p class="text-xl font-bold text-[#5c83c4]"><?php echo e($service->price); ?></p>
                                        <?php else: ?>
                                            <p class="text-xl font-bold text-[#5c83c4]"><?php echo e(__('Custom Quote')); ?></p>
                                        <?php endif; ?>
                                        <?php if($service->price_note): ?>
                                            <p class="text-sm text-[#ffa630]"><?php echo e($service->price_note); ?></p>
                                        <?php else: ?>
                                            <p class="text-sm text-[#ffa630]"><?php echo e(__('Professional setup included')); ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <a href="<?php echo e(route('contact')); ?>" class="inline-flex items-center rounded-lg bg-[#11224e] px-5 py-2.5 text-sm font-semibold text-white shadow-lg transition hover:bg-[#1a3366]">
                                        <?php echo e(__('Get Quote')); ?>

                                    </a>
                                </div>
                            </div>
                        </div>

                        
                        <?php if(!$loop->last): ?>
                            <div class="border-t border-slate-200"></div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <p class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-6 py-8 text-center text-slate-600">
                    <?php echo e(__('Belum ada layanan yang aktif.')); ?>

                </p>
            <?php endif; ?>
        </div>
    </section>

    
    <section class="bg-[#f4f6fb]" data-aos="fade-up">
        <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-12">
            <div class="rounded-[32px] border border-[#d5def3] bg-gradient-to-r from-white to-[#f4f6fb] px-8 py-10 text-center shadow-lg shadow-[#11224e]/5">
                <p class="text-xs font-semibold uppercase tracking-[0.4em] text-[#f17720]"><?php echo e(__('Need a custom activation?')); ?></p>
                <h3 class="mt-4 text-2xl font-bold text-[#11224e] sm:text-3xl">
                    <?php echo e(__('Kolaborasikan ide Anda dengan tim konsultan Digioh')); ?>

                </h3>
                <p class="mt-3 text-sm text-[#11224e]/80">
                    <?php echo e(__('Kami siap membantu merancang blueprint program, memilih teknologi immersive, dan menyiapkan strategi business development yang tepat.')); ?>

                </p>
                <div class="mt-6 flex flex-wrap justify-center gap-4">
                    <a href="<?php echo e(route('contact')); ?>" class="inline-flex items-center rounded-full bg-[#ffa630] px-6 py-3 text-sm font-semibold text-[#11224e] shadow-lg shadow-[#ffa630]/30 transition-all duration-300 hover:-translate-y-1 hover:bg-[#fcbf64] hover:shadow-xl">
                        <?php echo e(__('Hubungi tim kami')); ?>

                    </a>
                    <a href="mailto:<?php echo e(config('mail.from.address')); ?>" class="inline-flex items-center rounded-full border border-[#11224e]/20 px-6 py-3 text-sm font-semibold text-[#11224e] transition-all duration-300 hover:border-[#11224e] hover:bg-[#11224e] hover:text-white">
                        <?php echo e(__('Kirim brief via email')); ?>

                    </a>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("frontend.layouts.app", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Marcel\Music\3.digioh\resources\views/frontend/services/index.blade.php ENDPATH**/ ?>