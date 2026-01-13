<?php
    $locale = app()->getLocale();
    $defaultTitle = $locale === 'en' ? 'About DigiOH' : 'Tentang DigiOH';

    $aboutTitle = $locale === 'en'
        ? (setting('about_title_en') ?: setting('about_title'))
        : setting('about_title');
    $aboutTitle = $aboutTitle ?: $defaultTitle;

    $aboutBody = $locale === 'en'
        ? (setting('about_body_en') ?: setting('about_body'))
        : setting('about_body');
    $aboutBody = $aboutBody ?: (
        $locale === 'en'
            ? '<p>DigiOH is a digital studio helping brands grow through creative solutions and technology.</p>'
            : '<p>DigiOH adalah studio digital yang membantu brand tumbuh melalui solusi kreatif dan teknologi.</p>'
    );

    $aboutTagline = $locale === 'en'
        ? (setting('about_tagline_en') ?: setting('about_tagline'))
        : setting('about_tagline');
    $aboutTagline = $aboutTagline ?: (
        $locale === 'en'
            ? 'Beyond Expectations, Beyond Experiences'
            : 'Melampaui Ekspektasi, Menciptakan Pengalaman'
    );

    $visionText = $locale === 'en'
        ? (setting('about_vision_en') ?: setting('about_vision'))
        : setting('about_vision');

    $missionIntro = $locale === 'en'
        ? (setting('about_mission_intro_en') ?: setting('about_mission_intro'))
        : setting('about_mission_intro');

    $missionKeywordsRaw = $locale === 'en'
        ? (setting('about_mission_keywords_en') ?: setting('about_mission_keywords'))
        : setting('about_mission_keywords');

    $missionKeywords = collect(preg_split("/\r\n|\r|\n/", (string) $missionKeywordsRaw))
        ->filter(fn ($line) => trim($line) !== '')
        ->map(function ($line) {
            $parts = array_map('trim', explode('|', $line, 3));
            $parts = array_pad($parts, 3, '');

            return [
                'letter' => strtoupper($parts[0]),
                'title' => $parts[1],
                'description' => $parts[2],
            ];
        })
        ->whenEmpty(function ($collection) use ($locale) {
            return collect([
                ['letter' => 'L', 'title' => $locale === 'en' ? 'Reliability' : 'Keandalan', 'description' => $locale === 'en' ? 'Always dependable across every touchpoint.' : 'Selalu bisa diandalkan di setiap detail.'],
                ['letter' => 'E', 'title' => $locale === 'en' ? 'Effective' : 'Efektif', 'description' => $locale === 'en' ? 'Designing experiences that drive results.' : 'Merancang pengalaman yang tepat sasaran.'],
                ['letter' => 'T', 'title' => $locale === 'en' ? 'Teamwork' : 'Kolaborasi', 'description' => $locale === 'en' ? 'Working closely with clients & partners.' : 'Bergerak bersama klien dan partner.'],
                ['letter' => 'S', 'title' => $locale === 'en' ? 'Service' : 'Layanan', 'description' => $locale === 'en' ? 'End-to-end, proactive support.' : 'Layanan menyeluruh dan proaktif.'],
                ['letter' => 'G', 'title' => $locale === 'en' ? 'Integrity' : 'Integritas', 'description' => $locale === 'en' ? 'Transparency builds trust.' : 'Transparansi menjaga kepercayaan.'],
                ['letter' => 'O', 'title' => $locale === 'en' ? 'Outstanding' : 'Terkesan', 'description' => $locale === 'en' ? 'Always creating memorable output.' : 'Selalu menghadirkan hasil yang mengesankan.'],
            ]);
        });
    $missionLetters = $missionKeywords->pluck('letter')->filter()->map(fn ($letter) => strtoupper($letter))->implode(' . ');



    $foundersSetting = setting('about_founders', []);
    $founders = collect(is_array($foundersSetting) ? $foundersSetting : [])
        ->filter(function ($founder) {
            return ! empty($founder['name']) || ! empty($founder['title']) || ! empty($founder['photo']);
        })
        ->values();
?>

<?php $__env->startSection('title', $aboutTitle); ?>

<?php $__env->startPush('after-styles'); ?>
    <style>
        .about-theme footer {
            background-image: linear-gradient(125deg, #fff2e7 0%, #f7f2ff 55%, #e6f3ff 100%) !important;
            color: #111827;
            font-family: 'Open Sans', 'Inter', sans-serif;
        }
        .about-theme footer .text-white\/80,
        .about-theme footer .text-white\/70,
        .about-theme footer .text-white\/60,
        .about-theme footer .text-white\/85 {
            color: rgba(17, 24, 39, 0.75) !important;
        }
        .about-theme footer .border-white\/10,
        .about-theme footer .border-white\/15,
        .about-theme footer .border-white\/20 {
            border-color: rgba(17, 24, 39, 0.15) !important;
        }
        .about-theme footer .bg-white\/5 {
            background-color: rgba(255, 255, 255, 0.9) !important;
            color: #e56700 !important;
        }
        .about-theme footer span.rounded-full {
            border-color: rgba(17, 24, 39, 0.12) !important;
            background-image: linear-gradient(120deg, rgba(255, 166, 48, 0.25), rgba(92, 131, 196, 0.15)) !important;
            color: #c75600 !important;
        }
        .about-theme footer a {
            color: #0f172a;
            font-weight: 500;
            letter-spacing: 0.02em;
            transition: color 0.2s ease, transform 0.2s ease;
        }
        .about-theme footer a:hover {
            color: #e56700;
            transform: translateY(-1px);
        }
        .about-theme footer .absolute {
            opacity: 0.12 !important;
            mix-blend-mode: multiply;
        }
        .about-theme footer .grid .space-y-4 > p.text-xs {
            letter-spacing: 0.3em;
            color: #5c83c4 !important;
        }
        .about-theme footer .space-y-4 h2,
        .about-theme footer h2 {
            font-weight: 800;
            letter-spacing: 0.02em;
        }
        .about-theme footer img.about-footer-logo {
            filter: drop-shadow(0 8px 25px rgba(17, 24, 39, 0.15));
            height: 2.75rem;
            width: auto;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('after-scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.body.classList.add('about-theme');

            const footerLogo = document.querySelector('footer img');
            if (footerLogo) {
                footerLogo.dataset.originalSrc = footerLogo.src;
                footerLogo.src = "<?php echo e(asset('img/DIGIOH_Main Logo_Flat Color Blue.svg')); ?>";
                footerLogo.classList.add('about-footer-logo');
            }
        });
        window.addEventListener('beforeunload', function () {
            const footerLogo = document.querySelector('footer img.about-footer-logo');
            if (footerLogo && footerLogo.dataset.originalSrc) {
                footerLogo.src = footerLogo.dataset.originalSrc;
            }
            document.body.classList.remove('about-theme');
        });
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="pt-4 lg:pt-6"></div>
    <?php echo $__env->make('frontend.pages.partials.about-snippet', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


    <section class="relative overflow-hidden bg-gradient-to-r from-[#11224e] via-[#5c83c4] to-[#ffa630] py-16 text-white">
        <div class="mx-auto max-w-screen-xl px-4 sm:px-12">
            <div class="rounded-[32px] border border-white/25 bg-white/10 p-10 shadow-lg backdrop-blur">
                <p class="text-3xl font-black uppercase"><?php echo e($locale === 'en' ? 'Vision' : 'Visi'); ?></p>
                <div class="mt-6 h-1 w-16 bg-white/70"></div>
                <?php if($visionText): ?>
                    <p class="mt-6 text-lg leading-relaxed text-white/85"><?php echo e($visionText); ?></p>
                <?php endif; ?>
            </div>
            <div class="mt-10 rounded-[32px] border border-white/20 bg-white/10 p-10 text-white shadow-2xl backdrop-blur">
                <p class="text-3xl font-black uppercase tracking-wide"><?php echo e($locale === 'en' ? 'Mission' : 'Misi'); ?></p>
                <div class="mt-4 h-1 w-20 bg-white/70"></div>
                <?php if($missionLetters): ?>
                    <p class="mt-6 text-4xl font-black tracking-[0.4em] text-white"><?php echo e($missionLetters); ?></p>
                <?php endif; ?>
                <?php if($missionIntro): ?>
                    <p class="mt-4 text-sm text-white/85"><?php echo e($missionIntro); ?></p>
                <?php endif; ?>
                <div class="mt-8 grid gap-6 text-center text-sm font-semibold uppercase text-white sm:grid-cols-3 lg:grid-cols-6">
                    <?php $__currentLoopData = $missionKeywords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex flex-col items-center gap-1">
                            <p class="text-xl font-black tracking-wide text-white"><?php echo e(strtoupper($mission['letter'])); ?></p>
                            <p class="text-white/90"><?php echo e($mission['title']); ?></p>
                            <p class="text-xs font-normal text-white/80"><?php echo e($mission['description']); ?></p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </section>

    <?php if ($founders->isNotEmpty()): ?>
        <section class="relative overflow-hidden bg-gradient-to-br from-[#fff2e7] via-[#f8f5ff] to-[#e6f3ff] py-16 dark:bg-slate-900">
            <div class="pointer-events-none absolute -left-32 top-8 h-72 w-72 rounded-full bg-gradient-to-br from-[#ffa630]/40 via-[#ffe0b2]/50 to-transparent blur-3xl"></div>
            <div class="pointer-events-none absolute -right-10 bottom-4 h-80 w-80 rounded-full bg-gradient-to-tl from-[#5c83c4]/40 via-[#a1c0ff]/40 to-transparent blur-3xl"></div>
            <div class="relative mx-auto max-w-screen-xl px-4 py-4 sm:px-12">
                <div class="mb-10 flex flex-col gap-3 text-center lg:text-left">
                    <span class="inline-flex items-center justify-center gap-2 self-center rounded-full bg-white/80 px-4 py-1 text-xs font-semibold uppercase tracking-[0.25em] text-[#5c83c4] shadow-sm lg:self-start">
                        <?php echo e(__('Founding Team')); ?>

                    </span>
                    <h2 class="text-3xl font-black text-slate-900 dark:text-white"><?php echo e(__('Orang di balik Digioh')); ?></h2>
                    <p class="text-sm text-slate-600 dark:text-slate-300"><?php echo e(__('Tim inti yang memastikan setiap pengalaman berjalan mulus dan penuh makna.')); ?></p>
                </div>

                <?php
                    $founderGradients = [
                        ['from' => '#ffa630', 'via' => '#ffd4a3', 'to' => '#ffecc7'],
                        ['from' => '#5c83c4', 'via' => '#9fb7ff', 'to' => '#e1e9ff'],
                        ['from' => '#f08acb', 'via' => '#f6c0e3', 'to' => '#ffe3f6'],
                        ['from' => '#4dd0e1', 'via' => '#a5f2f9', 'to' => '#e0fcff'],
                    ];
                ?>
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    <?php $__currentLoopData = $founders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $photoPath = $f['photo'] ?? null;
                            $photoUrl = $photoPath
                                ? (\Illuminate\Support\Str::startsWith($photoPath, ['http://', 'https://', '//']) ? $photoPath : asset($photoPath))
                                : null;
                            $gradient = $founderGradients[$index % count($founderGradients)];
                        ?>
                        <div class="group rounded-[30px] border border-white/50 bg-white/85 p-6 shadow-xl shadow-[#d9dbe6]/60 transition hover:-translate-y-1.5 hover:shadow-2xl dark:border-slate-800/60 dark:bg-slate-900/80">
                            <div class="relative inline-block">
                                <div class="pointer-events-none absolute -inset-4 rounded-[32px] opacity-80 blur-3xl" style="background-image: linear-gradient(120deg, <?php echo e($gradient['from']); ?>, <?php echo e($gradient['via']); ?>, <?php echo e($gradient['to']); ?>);"></div>
                                <div class="relative overflow-hidden rounded-[24px] border border-white/60 shadow-lg dark:border-slate-700">
                                    <?php if($photoUrl): ?>
                                        <img src="<?php echo e($photoUrl); ?>" alt="<?php echo e($f['name']); ?>" class="h-28 w-28 object-cover" />
                                    <?php else: ?>
                                        <div class="flex h-28 w-28 items-center justify-center bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-300">
                                            <svg class="h-10 w-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 20.25a8.25 8.25 0 1115 0v.75H4.5v-.75z" /></svg>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <h3 class="mt-5 text-lg font-semibold text-slate-900 dark:text-white"><?php echo e($f['name']); ?></h3>
                            <p class="text-sm text-slate-600 dark:text-slate-300"><?php echo e($f['title']); ?></p>
                            <div class="mt-4 flex items-center gap-3">
                                <?php if(! empty($f['linkedin'])): ?>
                                    <a href="<?php echo e($f['linkedin']); ?>" target="_blank" rel="noopener" class="inline-flex items-center rounded-full border border-slate-200 px-3 py-1 text-xs font-medium text-slate-700 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800">
                                        <svg class="mr-2 h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M4.98 3.5C4.98 4.88 3.87 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1 4.98 2.12 4.98 3.5zM.22 8.5H4.78V24H.22V8.5zM8.54 8.5H13v2.11h.07c.62-1.17 2.14-2.4 4.41-2.4 4.72 0 5.59 3.11 5.59 7.15V24h-4.56v-6.63c0-1.58-.03-3.62-2.2-3.62-2.2 0-2.53 1.72-2.53 3.5V24H8.54V8.5z" /></svg>
                                        LinkedIn
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section class="relative overflow-hidden bg-gradient-to-r from-[#11224e] via-[#5c83c4] to-[#ffa630] text-white">
        <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-12">
            <div class="grid gap-10 lg:grid-cols-[1.2fr_0.8fr] lg:items-center">
                <div>
                    <span class="text-xs font-semibold uppercase tracking-[0.3em] text-white/70"><?php echo e(__('Mari berkolaborasi')); ?></span>
                    <h2 class="mt-4 text-3xl font-bold sm:text-4xl text-white"><?php echo e(__('Tertarik membangun pengalaman yang berkesan?')); ?></h2>
                    <p class="mt-4 max-w-2xl text-sm text-white/80"><?php echo e(__('Hubungi kami untuk mendiskusikan rencana Anda. Tim kami siap membantu menyiapkan solusi dan timeline yang realistis.')); ?></p>
                    <div class="mt-6 flex flex-wrap items-center gap-4">
                        <a href="<?php echo e(route('contact')); ?>" class="inline-flex items-center justify-center rounded-full bg-white px-6 py-3 text-sm font-semibold text-[#11224e] shadow-lg shadow-black/20 hover:bg-slate-100"><?php echo e(__('Hubungi kami')); ?></a>
                        <a href="<?php echo e(route('frontend.services.index')); ?>" class="inline-flex items-center gap-2 text-sm font-semibold text-white hover:text-white/80"><?php echo e(__('Lihat layanan')); ?>

                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                        </a>
                    </div>
                </div>
                <div class="hidden h-full w-full rounded-3xl border border-white/20 bg-white/10 p-6 shadow-2xl shadow-[#11224e]/40 backdrop-blur lg:flex">
                    <div class="flex flex-1 flex-col justify-between gap-6 text-sm text-white/85">
                        <div>
                            <h3 class="text-lg font-semibold text-white"><?php echo e(__('Nilai inti kami')); ?></h3>
                            <ul class="mt-3 space-y-2">
                                <li class="flex items-start gap-2"><span class="mt-1 h-1.5 w-1.5 rounded-full bg-white"></span><span><?php echo e(__('Kolaborasi dan transparansi dalam setiap sprint.')); ?></span></li>
                                <li class="flex items-start gap-2"><span class="mt-1 h-1.5 w-1.5 rounded-full bg-white"></span><span><?php echo e(__('Pengalaman pengguna di atas segalanya.')); ?></span></li>
                                <li class="flex items-start gap-2"><span class="mt-1 h-1.5 w-1.5 rounded-full bg-white"></span><span><?php echo e(__('Engineering disiplin & scalable untuk jangka panjang.')); ?></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Marcel\Music\3.digioh\resources\views/frontend/pages/about.blade.php ENDPATH**/ ?>