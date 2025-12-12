<?php $__env->startSection("title"); ?>
    <?php echo e(__('Products & Services')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
    <section class="relative overflow-hidden bg-[#11224e] text-white">
        <div class="pointer-events-none absolute inset-y-0 left-0 w-1/3 bg-gradient-to-r from-[#5c83c4]/30 to-transparent"></div>
        <div class="pointer-events-none absolute inset-y-0 right-0 w-1/4 bg-gradient-to-l from-[#ffa630]/40 to-transparent animate-pulse-slow"></div>
        <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-12 lg:flex lg:items-center lg:gap-16">
            <div class="flex-1 space-y-6">
                <span data-aos="fade-down" data-aos-delay="100" class="inline-flex items-center gap-2 rounded-full border border-white/20 px-4 py-1 text-xs font-semibold uppercase tracking-[0.4em] text-white/70">
                    <?php echo e(__('Service Portfolio')); ?>

                </span>
                <h1 data-aos="fade-up" data-aos-delay="200" class="text-3xl font-bold leading-tight sm:text-5xl">
                    <?php echo e(__('Products & Services')); ?>

                </h1>
                <p data-aos="fade-up" data-aos-delay="300" class="max-w-2xl text-base text-white/80">
                    <?php echo e(__('Solusi experiential + creative tech + business development untuk eksekusi event tanpa pemborosan.')); ?>

                </p>
            </div>
            <div class="mt-12 flex-1 lg:mt-0" data-aos="fade-left" data-aos-delay="400">
                <div class="rounded-[32px] border border-white/20 bg-white/10 p-8 shadow-2xl backdrop-blur hover-glow">
                    <p class="text-sm font-semibold uppercase tracking-[0.4em] text-white/70"><?php echo e(__('Signature pillars')); ?></p>
                    <ul class="mt-4 space-y-3 text-white/80">
                        <li class="flex items-start gap-3" data-aos="fade-up" data-aos-delay="500">
                            <span class="mt-1 inline-flex h-6 w-6 items-center justify-center rounded-full bg-[#ffa630]/20 text-[#ffa630]">
                                <span class="text-xs font-semibold">1</span>
                            </span>
                            <div>
                                <p class="font-semibold"><?php echo e(__('Creative & Experience Design')); ?></p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3" data-aos="fade-up" data-aos-delay="600">
                            <span class="mt-1 inline-flex h-6 w-6 items-center justify-center rounded-full bg-[#5c83c4]/20 text-[#5c83c4]">
                                <span class="text-xs font-semibold">2</span>
                            </span>
                            <div>
                                <p class="font-semibold"><?php echo e(__('Technology & Production')); ?></p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3" data-aos="fade-up" data-aos-delay="700">
                            <span class="mt-1 inline-flex h-6 w-6 items-center justify-center rounded-full bg-[#f17720]/20 text-[#f17720]">
                                <span class="text-xs font-semibold">3</span>
                            </span>
                            <div>
                                <p class="font-semibold"><?php echo e(__('Business Acceleration')); ?></p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[#f4f6fb]">
        <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-12">

            <?php if($services->count()): ?>
                <div class="mt-10 grid gap-7 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4">
                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php ($detailUrl = route('frontend.services.show', $service->slug)); ?>
                        <article 
                            data-aos="fade-up" 
                            data-aos-delay="<?php echo e(100 + ($index * 100)); ?>"
                            class="group relative overflow-hidden rounded-[32px] border border-[#e0e7f7] bg-white shadow-lg shadow-[#11224e]/10 hover-lift"
                        >
                            <a href="<?php echo e($detailUrl); ?>" class="flex h-full flex-col">
                                <?php if($service->image): ?>
                                    <div class="relative aspect-square w-full overflow-hidden rounded-t-[30px]">
                                        <img src="<?php echo e(asset($service->image)); ?>" alt="<?php echo e($service->name); ?>" class="h-full w-full object-cover transition duration-500 group-hover:scale-110">
                                        <span class="absolute inset-0 bg-gradient-to-t from-black/35 via-black/10 to-transparent"></span>
                                        <?php if($service->category): ?>
                                            <span class="absolute left-4 top-4 inline-flex items-center rounded-full bg-white/85 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.3em] text-[#11224e]">
                                                <?php echo e($service->category); ?>

                                            </span>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <div class="flex flex-1 flex-col gap-4 px-6 py-6">
                                    <?php if($service->category): ?>
                                        <span class="self-start rounded-full border border-[#d5def3] px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.25em] text-[#5c83c4]">
                                            <?php echo e($service->category); ?>

                                        </span>
                                    <?php endif; ?>

                                    <div class="space-y-2">
                                        <h3 class="text-2xl font-semibold leading-snug text-[#11224e] transition group-hover:text-[#5c83c4]">
                                            <?php echo e($service->name); ?>

                                        </h3>
                                        <p class="text-sm text-[#11224e]/80">
                                            <?php echo e(\Str::limit(strip_tags($service->description), 170)); ?>

                                        </p>
                                    </div>

                                    <div class="mt-auto flex items-center justify-between pt-4 text-xs uppercase tracking-[0.4em] text-[#5c83c4]">
                                        <span><?php echo e(__('Tap to explore')); ?></span>
                                        <span class="inline-block h-1 w-14 rounded-full bg-[#d5def3] transition-all duration-300 group-hover:w-20 group-hover:bg-[#ffa630]"></span>
                                    </div>
                                </div>
                            </a>
                        </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <p class="mt-8 rounded-2xl border border-dashed border-[#d5def3] bg-white px-6 py-5 text-sm text-[#11224e]/70">
                    <?php echo e(__('Belum ada layanan yang aktif.')); ?>

                </p>
            <?php endif; ?>
        </div>
    </section>

    <section class="bg-white" data-aos="fade-up">
        <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-12">
            <div class="rounded-[32px] border border-[#d5def3] bg-gradient-to-r from-white to-[#f4f6fb] px-8 py-10 text-center shadow-lg shadow-[#11224e]/5 hover-glow">
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