<?php $__env->startSection('title', __('Contact')); ?>

<?php $__env->startSection('content'); ?>
<?php
    $defaultContactEmail = 'dukunganteknis@digioh.com';
    $defaultContactAddress = 'Fatmawati Festival Blok A-7, Jalan RS Fatmawati no. 50 Seberang Rumah Duka Fatmawati, Jl. RS. Fatmawati Raya No.50, RT.4/RW.4, West Cilandak, Cilandak, South Jakarta City, Jakarta 12430';
?>
<section class="relative overflow-hidden bg-[#11224e] text-white">
    <div class="pointer-events-none absolute inset-y-0 left-0 w-1/3 bg-gradient-to-r from-[#5c83c4]/30 to-transparent"></div>
    <div class="pointer-events-none absolute inset-y-0 right-0 w-1/4 bg-gradient-to-l from-[#ffa630]/40 to-transparent animate-pulse-slow"></div>
    <div class="mx-auto flex max-w-screen-xl flex-col gap-8 px-4 py-12 sm:px-12 lg:flex-row lg:items-center">
        <div class="flex-1 space-y-6">
            <span data-aos="fade-down" class="inline-flex items-center gap-2 rounded-full border border-white/20 px-4 py-1 text-xs font-semibold uppercase tracking-[0.4em] text-white/70">
                <?php echo e(__('Let us collaborate')); ?>

            </span>
            <h1 data-aos="fade-up" data-aos-delay="100" class="text-3xl font-bold leading-tight sm:text-5xl">
                <?php echo e(__('Cerita dan kebutuhan Anda adalah titik awal ide kami')); ?>

            </h1>
            <p data-aos="fade-up" data-aos-delay="200" class="max-w-2xl text-sm text-white/80">
                <?php echo e(__('Hubungi tim Digioh untuk mendiskusikan event, experiential marketing, atau proyek business development berikutnya.')); ?>

            </p>
        </div>
    </div>
</section>

<section class="bg-[#f4f6fb]">
    <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-12">
        <?php if(session('flash_success')): ?>
            <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-green-800">
                <?php echo e(session('flash_success')); ?>

            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-800" role="alert">
                <p class="font-semibold"><?php echo e(__('Terjadi kesalahan. Mohon periksa isian berikut:')); ?></p>
                <ul class="mt-2 list-disc pl-5">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="grid gap-10 lg:grid-cols-[1.1fr_0.9fr] lg:items-start">
            <div data-aos="fade-right" class="rounded-[40px] border border-[#d5def3] bg-gradient-to-br from-white via-[#f8faff] to-[#eef2ff] px-6 py-8 shadow-2xl shadow-[#11224e]/10 space-y-6 hover-glow">
                <p class="text-xs font-semibold uppercase tracking-[0.4em] text-[#5c83c4]"><?php echo e(__('Kunjungi')); ?></p>
                <?php
                    $mapAddress = setting('contact_address') ?? $defaultContactAddress;
                    $mapLink = 'https://www.google.com/maps/search/?api=1&query=' . urlencode($mapAddress);
                    $mapEmbedCode = setting('contact_map_embed');
                ?>
                <div class="overflow-hidden rounded-3xl border border-[#d5def3] bg-white shadow-lg shadow-[#11224e]/5">
                    <?php if($mapEmbedCode): ?>
                        
                        <div class="contact-map-embed [&>iframe]:w-full [&>iframe]:h-[320px] [&>iframe]:border-0">
                            <?php echo $mapEmbedCode; ?>

                        </div>
                    <?php else: ?>
                        
                        <?php
                            $mapEmbed = 'https://maps.google.com/maps?q=' . urlencode($mapAddress) . '&z=16&output=embed';
                        ?>
                        <iframe
                            src="<?php echo e($mapEmbed); ?>"
                            width="100%"
                            height="320"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    <?php endif; ?>
                </div>

                <div class="relative overflow-hidden rounded-3xl border border-[#e2e9fb] bg-gradient-to-br from-[#eef3ff] to-white px-6 py-5 shadow-[0_25px_45px_rgba(17,34,78,0.07)]">
                    <div class="flex items-start gap-4">
                        <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#e9efff] text-[#5c83c4] shadow-inner shadow-white/60">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21c4.243 0 7.5-3.134 7.5-7.5S16.243 6 12 6 4.5 9.134 4.5 13.5 7.757 21 12 21z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 11.25a2.25 2.25 0 100 4.5 2.25 2.25 0 000-4.5z"/></svg>
                        </span>
                        <div class="space-y-1">
                            <p class="text-xs font-semibold uppercase tracking-wide text-[#11224e]/60"><?php echo e(__('Lokasi studio')); ?></p>
                            <p class="text-sm font-semibold leading-relaxed text-[#11224e]">
                                <?php echo e($mapAddress); ?>

                            </p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="<?php echo e($mapLink); ?>" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-wide text-[#5c83c4] transition hover:text-[#324a7d]">
                            <?php echo e(__('Buka di Google Maps')); ?>

                            <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75v6.5a3 3 0 01-3 3h-6.5M17.25 6.75h-6.5a3 3 0 00-3 3v6.5M17.25 6.75L6.75 17.25"/></svg>
                        </a>
                    </div>
                </div>

                <div class="rounded-3xl border border-[#dee6fb] bg-white/70 px-5 py-4">
                    <div class="flex flex-wrap items-center gap-3">
                        <p class="text-xs font-semibold uppercase tracking-[0.3em] text-[#11224e]/60"><?php echo e(__('Terhubung di sosial media')); ?></p>
                        <div class="flex flex-wrap gap-2 text-[#11224e] [&>a]:inline-flex [&>a]:h-10 [&>a]:w-10 [&>a]:items-center [&>a]:justify-center [&>a]:rounded-full [&>a]:border [&>a]:border-[#e4e9fb] [&>a]:bg-[#f6f8ff] [&>a]:transition [&>a]:hover:-translate-y-0.5 [&>a]:hover:bg-white">
                            <?php if (isset($component)) { $__componentOriginal7cb3ac0e6d29b71866d61c1cdc3467a5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7cb3ac0e6d29b71866d61c1cdc3467a5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.social.website_url','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.social.website_url'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7cb3ac0e6d29b71866d61c1cdc3467a5)): ?>
<?php $attributes = $__attributesOriginal7cb3ac0e6d29b71866d61c1cdc3467a5; ?>
<?php unset($__attributesOriginal7cb3ac0e6d29b71866d61c1cdc3467a5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7cb3ac0e6d29b71866d61c1cdc3467a5)): ?>
<?php $component = $__componentOriginal7cb3ac0e6d29b71866d61c1cdc3467a5; ?>
<?php unset($__componentOriginal7cb3ac0e6d29b71866d61c1cdc3467a5); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginala179f6485965f9712e9f4438282a6da4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala179f6485965f9712e9f4438282a6da4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.social.instagram_url','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.social.instagram_url'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala179f6485965f9712e9f4438282a6da4)): ?>
<?php $attributes = $__attributesOriginala179f6485965f9712e9f4438282a6da4; ?>
<?php unset($__attributesOriginala179f6485965f9712e9f4438282a6da4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala179f6485965f9712e9f4438282a6da4)): ?>
<?php $component = $__componentOriginala179f6485965f9712e9f4438282a6da4; ?>
<?php unset($__componentOriginala179f6485965f9712e9f4438282a6da4); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginal883415bda26e38a22de70aa073118938 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal883415bda26e38a22de70aa073118938 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.social.facebook_url','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.social.facebook_url'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal883415bda26e38a22de70aa073118938)): ?>
<?php $attributes = $__attributesOriginal883415bda26e38a22de70aa073118938; ?>
<?php unset($__attributesOriginal883415bda26e38a22de70aa073118938); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal883415bda26e38a22de70aa073118938)): ?>
<?php $component = $__componentOriginal883415bda26e38a22de70aa073118938; ?>
<?php unset($__componentOriginal883415bda26e38a22de70aa073118938); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginalc7f1447138c3d9189e7941fbec9a6db2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc7f1447138c3d9189e7941fbec9a6db2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.social.twitter_url','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.social.twitter_url'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc7f1447138c3d9189e7941fbec9a6db2)): ?>
<?php $attributes = $__attributesOriginalc7f1447138c3d9189e7941fbec9a6db2; ?>
<?php unset($__attributesOriginalc7f1447138c3d9189e7941fbec9a6db2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc7f1447138c3d9189e7941fbec9a6db2)): ?>
<?php $component = $__componentOriginalc7f1447138c3d9189e7941fbec9a6db2; ?>
<?php unset($__componentOriginalc7f1447138c3d9189e7941fbec9a6db2); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginal9e394dcad86405fa8456f31f5ca8f4cf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9e394dcad86405fa8456f31f5ca8f4cf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.social.youtube_url','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.social.youtube_url'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9e394dcad86405fa8456f31f5ca8f4cf)): ?>
<?php $attributes = $__attributesOriginal9e394dcad86405fa8456f31f5ca8f4cf; ?>
<?php unset($__attributesOriginal9e394dcad86405fa8456f31f5ca8f4cf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9e394dcad86405fa8456f31f5ca8f4cf)): ?>
<?php $component = $__componentOriginal9e394dcad86405fa8456f31f5ca8f4cf; ?>
<?php unset($__componentOriginal9e394dcad86405fa8456f31f5ca8f4cf); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginal05ebc73cbf10977681feb8cdde62256e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal05ebc73cbf10977681feb8cdde62256e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.social.whatsapp_url','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.social.whatsapp_url'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal05ebc73cbf10977681feb8cdde62256e)): ?>
<?php $attributes = $__attributesOriginal05ebc73cbf10977681feb8cdde62256e; ?>
<?php unset($__attributesOriginal05ebc73cbf10977681feb8cdde62256e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal05ebc73cbf10977681feb8cdde62256e)): ?>
<?php $component = $__componentOriginal05ebc73cbf10977681feb8cdde62256e; ?>
<?php unset($__componentOriginal05ebc73cbf10977681feb8cdde62256e); ?>
<?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div data-aos="fade-left" data-aos-delay="200" class="rounded-[32px] border border-[#d5def3] bg-white px-6 py-6 shadow-lg shadow-[#11224e]/5 hover-glow">
                <h3 class="text-lg font-semibold text-[#11224e]"><?php echo e(__('Kirimkan brief singkat Anda')); ?></h3>
                <p class="mt-1 text-sm text-[#11224e]/80"><?php echo e(__('Ceritakan tujuan utama, tanggal, serta ekspektasi outcome. Kami akan hubungi Anda untuk sesi diskusi lanjut.')); ?></p>
                <form action="<?php echo e(route('contact.store')); ?>" method="POST" class="mt-6 space-y-4" novalidate>
                    <?php echo csrf_field(); ?>
                    <input type="text" name="website" id="contact-website" class="sr-only" aria-hidden="true" tabindex="-1" autocomplete="off">

                    <div>
                        <label for="name" class="text-xs font-semibold uppercase tracking-wide text-[#11224e]/70"><?php echo e(__('Nama')); ?></label>
                        <input id="name" name="name" type="text" value="<?php echo e(old('name')); ?>" maxlength="100" autocomplete="name" class="mt-2 w-full rounded-full border border-[#d5def3] bg-white px-4 py-3 text-sm text-[#11224e] placeholder:text-[#11224e]/40 focus:border-[#5c83c4] focus:outline-none <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 focus:border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required aria-required="true" aria-invalid="<?php echo e($errors->has('name') ? 'true' : 'false'); ?>">
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="email" class="text-xs font-semibold uppercase tracking-wide text-[#11224e]/70"><?php echo e(__('Email')); ?></label>
                        <input id="email" name="email" type="email" value="<?php echo e(old('email')); ?>" maxlength="150" autocomplete="email" class="mt-2 w-full rounded-full border border-[#d5def3] bg-white px-4 py-3 text-sm text-[#11224e] placeholder:text-[#11224e]/40 focus:border-[#5c83c4] focus:outline-none <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 focus:border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required aria-required="true" aria-invalid="<?php echo e($errors->has('email') ? 'true' : 'false'); ?>">
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="subject" class="text-xs font-semibold uppercase tracking-wide text-[#11224e]/70"><?php echo e(__('Subjek (opsional)')); ?></label>
                        <input id="subject" name="subject" type="text" value="<?php echo e(old('subject')); ?>" maxlength="150" class="mt-2 w-full rounded-full border border-[#d5def3] bg-white px-4 py-3 text-sm text-[#11224e] placeholder:text-[#11224e]/40 focus:border-[#5c83c4] focus:outline-none <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 focus:border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" aria-invalid="<?php echo e($errors->has('subject') ? 'true' : 'false'); ?>">
                        <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="message" class="text-xs font-semibold uppercase tracking-wide text-[#11224e]/70"><?php echo e(__('Pesan')); ?></label>
                        <textarea id="message" name="message" rows="5" minlength="10" class="mt-2 w-full rounded-2xl border border-[#d5def3] bg-white px-4 py-3 text-sm text-[#11224e] placeholder:text-[#11224e]/40 focus:border-[#5c83c4] focus:outline-none <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 focus:border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required aria-required="true" aria-invalid="<?php echo e($errors->has('message') ? 'true' : 'false'); ?>"><?php echo e(old('message')); ?></textarea>
                        <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="grid gap-3 pt-4 sm:grid-cols-2">
                        <?php
                            $waNumber = preg_replace('/[^0-9]/', '', setting('whatsapp_number') ?? '');
                            $waPrefill = setting('whatsapp_prefill') ?? 'Halo Digioh, saya ingin berdiskusi.';
                        ?>
                        <button type="button" id="send-wa" data-wa-number="<?php echo e($waNumber); ?>" data-wa-prefill="<?php echo e($waPrefill); ?>" class="inline-flex w-full items-center justify-center rounded-full bg-[#25d366] px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-[#25d366]/30 transition hover:bg-[#1fb358] focus:outline-none focus:ring-2 focus:ring-[#25d366]/60 focus:ring-offset-2 focus:ring-offset-white">
                            <?php echo e(__('Kirim via WhatsApp')); ?>

                        </button>
                        <a href="mailto:<?php echo e(setting('contact_email') ?? $defaultContactEmail); ?>" class="inline-flex w-full items-center justify-center rounded-full border border-[#d5def3] bg-white px-6 py-3 text-sm font-semibold text-[#11224e] transition hover:border-[#5c83c4] hover:text-[#5c83c4] focus:outline-none focus:ring-2 focus:ring-[#d5def3] focus:ring-offset-2 focus:ring-offset-white">
                            <?php echo e(__('Kirim via Email')); ?>

                        </a>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const btn = document.getElementById('send-wa');
                            if (!btn) {
                                return;
                            }
                            btn.addEventListener('click', function () {
                                const rawNum = btn.dataset.waNumber || '';
                                if (!rawNum) {
                                    window.location.href = 'mailto:<?php echo e(setting('contact_email') ?? $defaultContactEmail); ?>';
                                    return;
                                }
                                const prefill = btn.dataset.waPrefill || '';
                                const getValue = (id) => document.getElementById(id)?.value?.trim() || '';
                                const name = getValue('name');
                                const email = getValue('email');
                                const subject = getValue('subject');
                                const message = getValue('message');
                                const lines = [
                                    prefill,
                                    '',
                                    'Nama: ' + name,
                                    'Email: ' + email,
                                    'Subjek: ' + subject,
                                    '',
                                    message
                                ];
                                const base = 'https://wa.me/' + rawNum + '?text=';
                                window.open(base + encodeURIComponent(lines.join('\n')), '_blank');
                            });
                        });
                    </script>
                </form>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Marcel\Music\3.digioh\resources\views/frontend/pages/contact.blade.php ENDPATH**/ ?>