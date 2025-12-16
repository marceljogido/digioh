<?php $__env->startSection('title'); ?> <?php echo e(__($module_title)); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section class="relative overflow-hidden bg-[#11224e] pt-28 md:pt-32 lg:pt-12 pb-16 text-white scroll-mt-32">
    <div class="pointer-events-none absolute inset-y-0 left-0 w-1/3 bg-gradient-to-r from-[#ffa630]/30 to-transparent animate-pulse-slow"></div>
    <div class="pointer-events-none absolute inset-y-0 right-0 w-1/3 bg-gradient-to-l from-[#5c83c4]/35 to-transparent"></div>
    <div class="relative mx-auto flex max-w-screen-xl flex-col gap-8 px-4 sm:px-10 lg:flex-row lg:items-center lg:justify-between">
        <div class="flex-1 space-y-5">
            <p data-aos="fade-down" class="inline-flex items-center gap-2 rounded-full border border-white/20 px-4 py-1 text-xs font-semibold uppercase tracking-[0.4em] text-white/80">
                <?php echo e(__('Showcase Portfolio')); ?>

            </p>
            <h1 data-aos="fade-up" data-aos-delay="100" class="text-3xl font-black tracking-tight sm:text-4xl">
                <?php echo e(__('Our Work & Experience Gallery')); ?>

            </h1>
            <p class="text-sm leading-relaxed text-white/75 sm:text-base">
                <?php echo e(__('Kumpulan studi kasus, event, dan project experiential yang kami orkestrasi untuk brand & institusi. Gunakan filter di samping untuk menemukan referensi yang paling relevan.')); ?>

            </p>
            <div class="grid gap-4 text-sm text-white/80 sm:grid-cols-3">
                <div class="rounded-2xl border border-white/30 bg-white/10 px-4 py-3 backdrop-blur">
                    <p class="text-xs uppercase tracking-wide text-white/60"><?php echo e(__('Total project')); ?></p>
                    <p class="text-2xl font-black"><?php echo e($posts->total()); ?></p>
                </div>
            </div>
        </div>
        <div data-aos="fade-left" data-aos-delay="300" class="w-full max-w-lg rounded-[32px] border border-white/20 bg-white/10 p-6 shadow-2xl backdrop-blur hover-glow">
            <h2 class="text-sm font-semibold uppercase tracking-[0.4em] text-white/70"><?php echo e(__('Filter project')); ?></h2>
            <form method="GET" class="mt-4 space-y-4">
                <div class="flex flex-col space-y-2">
                    <label for="q" class="text-xs font-semibold uppercase tracking-wide text-white/60"><?php echo e(__('Cari judul / insight')); ?></label>
                    <div class="relative">
                        <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-white/40">
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                        </span>
                        <input type="text" id="q" name="q" value="<?php echo e(request('q')); ?>" placeholder="<?php echo e(__('Misal: expo, AR, launching')); ?>" class="w-full rounded-2xl border border-white/15 bg-white/10 pl-9 pr-3 py-2 text-sm text-white placeholder:text-white/40 focus:border-white focus:outline-none focus:ring-0" />
                    </div>
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="service" class="text-xs font-semibold uppercase tracking-wide text-white/60"><?php echo e(__('Layanan')); ?></label>
                    <select id="service" name="service" class="rounded-2xl border border-white/20 bg-white/90 px-3 py-2 text-sm text-[#0b152e] focus:border-white focus:outline-none focus:ring-0">
                        <option value=""><?php echo e(__('Semua layanan')); ?></option>
                        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $svc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($svc->slug); ?>" <?php if(request('service') === $svc->slug): echo 'selected'; endif; ?>><?php echo e($svc->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="year" class="text-xs font-semibold uppercase tracking-wide text-white/60"><?php echo e(__('Tahun event')); ?></label>
                    <select id="year" name="year" class="rounded-2xl border border-white/20 bg-white/90 px-3 py-2 text-sm text-[#0b152e] focus:border-white focus:outline-none focus:ring-0">
                        <option value=""><?php echo e(__('Semua tahun')); ?></option>
                        <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $yearOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($yearOption); ?>" <?php if((int)request('year') === (int)$yearOption): echo 'selected'; endif; ?>><?php echo e($yearOption); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="flex flex-wrap gap-3">
                    <button type="submit" class="inline-flex items-center rounded-full bg-[#ffa630] px-5 py-2 text-sm font-semibold text-[#11224e] shadow hover:bg-[#fcbf64] transition">
                        <?php echo e(__('Terapkan filter')); ?>

                    </button>
                    <?php if(request()->hasAny(['q','service','year'])): ?>
                        <a href="<?php echo e(route('frontend.ourwork.index')); ?>" class="inline-flex items-center rounded-full border border-white/30 px-5 py-2 text-sm font-semibold text-white hover:bg-white/10">
                            <?php echo e(__('Reset')); ?>

                        </a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</section>

<section class="bg-[#f4f6fb] text-gray-600 p-6 sm:p-12">
    <div class="mx-auto max-w-screen-xl space-y-10">
        <?php if($posts->count()): ?>
            <div class="flex flex-col gap-2 text-sm text-[#11224e]/80 sm:flex-row sm:items-center sm:justify-between">
                <?php
                    $from = $posts->firstItem();
                    $to = $posts->lastItem();
                ?>
                <div class="flex flex-wrap items-center gap-3">
                    <span class="font-semibold text-[#11224e]">
                        <?php echo e($from && $to
                            ? __('Proyek :from-:to dari :total', ['from' => $from, 'to' => $to, 'total' => $posts->total()])
                            : __('Menampilkan :count item', ['count' => $posts->count()])); ?>

                    </span>
                </div>
                <form method="GET" class="flex items-center gap-2 text-xs text-[#11224e]">
                    <?php $__currentLoopData = request()->except('per_page', 'page'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(is_array($value)): ?>
                            <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <input type="hidden" name="<?php echo e($key); ?>[]" value="<?php echo e($subValue); ?>">
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <input type="hidden" name="<?php echo e($key); ?>" value="<?php echo e($value); ?>">
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <label for="per_page" class="font-semibold uppercase tracking-wide"><?php echo e(__('Jumlah per halaman')); ?></label>
                    <select id="per_page" name="per_page" class="rounded-xl border border-[#d5def3] bg-white px-2 py-1 text-sm text-[#0b152e]" onchange="this.form.submit()">
                        <?php $__currentLoopData = $perPageOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($option); ?>" <?php if($perPage === $option): echo 'selected'; endif; ?>><?php echo e($option); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </form>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $details_url = route('frontend.posts.show', [encode_id($post->id), $post->slug]);
                    ?>
                    <a href="<?php echo e($details_url); ?>" data-aos="fade-up" data-aos-delay="<?php echo e(($index % 6) * 100); ?>" class="flex h-full flex-col overflow-hidden rounded-[32px] border border-[#d5def3] bg-white shadow-lg shadow-[#11224e]/5 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover-lift focus:outline-none focus:ring-2 focus:ring-[#ffa630]/60">
                        <div class="relative aspect-[16/9] w-full overflow-hidden bg-slate-100">
                            <img src="<?php echo e(asset($post->image ?: 'img/default_post.svg')); ?>" alt="<?php echo e($post->name); ?>" class="h-full w-full object-cover">
                        </div>
                        <div class="flex flex-1 flex-col gap-4 p-5">
                            <?php
                                $dateLabel = '';
                                $startDate = $post->event_start_date;
                                $endDate = $post->event_end_date;
                                if ($startDate) {
                                    if ($endDate && !$startDate->isSameDay($endDate)) {
                                        $sameMonth = $startDate->format('mY') === $endDate->format('mY');
                                        $startFormat = $sameMonth ? $startDate->isoFormat('D') : $startDate->isoFormat('D MMM');
                                        $endFormat = $endDate->isoFormat('D MMM YYYY');
                                        $dateLabel = "{$startFormat} - {$endFormat}";
                                    } else {
                                        $dateLabel = $startDate->isoFormat('D MMM YYYY');
                                    }
                                } elseif ($post->published_at) {
                                    $dateLabel = $post->published_at->isoFormat('D MMM YYYY');
                                } elseif ($post->created_at) {
                                    $dateLabel = $post->created_at->isoFormat('D MMM YYYY');
                                }
                            ?>
                            <div class="flex items-center justify-between text-xs text-[#5c83c4] font-semibold">
                                <span><?php echo e($dateLabel ?? ''); ?></span>
                                <?php if($post->event_location): ?>
                                    <span class="flex items-center gap-1">
                                        <svg class="h-3.5 w-3.5 text-[#f17720]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                                        <?php echo e($post->event_location); ?>

                                    </span>
                                <?php endif; ?>
                            </div>

                            <h3 class="text-lg font-semibold text-[#11224e]"><?php echo e($post->name); ?></h3>
                            <p class="text-sm text-[#11224e]/80"><?php echo e(\Str::limit(strip_tags($post->intro ?: $post->content), 160)); ?></p>

                            <?php if($post->services->count()): ?>
                                <div class="flex flex-wrap gap-2 text-xs font-semibold uppercase tracking-wide text-[#5c83c4]">
                                    <span><?php echo e(__('Layanan')); ?>:</span>
                                    <span><?php echo e($post->services->sortBy('name')->pluck('name')->join(', ')); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if(!empty($post->scope_of_work_list)): ?>
                                <div class="flex flex-wrap gap-2 text-xs text-[#11224e]/70">
                                    <?php $__currentLoopData = $post->scope_of_work_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scope): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="inline-flex items-center rounded-full bg-[#eef2ff] px-3 py-1 font-semibold capitalize text-[#11224e]"><?php echo e($scope); ?></span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="pt-6">
                <?php echo e($posts->links('pagination::bootstrap-5')); ?>

            </div>
        <?php else: ?>
            <div class="rounded-3xl border border-dashed border-gray-300 p-8 text-center text-sm text-gray-500">
                <?php echo e(__('Belum ada konten sesuai filter.')); ?>

            </div>
        <?php endif; ?>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Marcel\Music\3.digioh\Modules/OurWork/Resources/views/frontend/ourworks/index.blade.php ENDPATH**/ ?>