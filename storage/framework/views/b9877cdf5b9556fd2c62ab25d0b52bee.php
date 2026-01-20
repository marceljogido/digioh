<div>
    <?php if (isset($component)) { $__componentOriginal885417cb62579f505f388b228557db34 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal885417cb62579f505f388b228557db34 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.header-block','data' => ['title' => $title]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.header-block'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($title)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal885417cb62579f505f388b228557db34)): ?>
<?php $attributes = $__attributesOriginal885417cb62579f505f388b228557db34; ?>
<?php unset($__attributesOriginal885417cb62579f505f388b228557db34); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal885417cb62579f505f388b228557db34)): ?>
<?php $component = $__componentOriginal885417cb62579f505f388b228557db34; ?>
<?php unset($__componentOriginal885417cb62579f505f388b228557db34); ?>
<?php endif; ?>

    <section class="mx-auto max-w-screen-xl bg-white p-6 text-gray-600 sm:p-20">
        <div class="grid grid-cols-1">
            <!--[if BLOCK]><![endif]--><?php if(app()->getLocale() === 'id'): ?>
                
                <p>Selamat datang di <?php echo e(app_name()); ?>!</p>
                <p>
                    <?php echo e(app_name()); ?> adalah layanan yang disediakan oleh <?php echo e($company_name); ?>.
                    Layanan ini bertujuan untuk membantu brand dan bisnis melalui solusi digital, event, dan experiential marketing.
                </p>
                <p>
                    Syarat dan ketentuan ini mengatur aturan dan regulasi penggunaan Website <?php echo e($company_name); ?>, yang berlokasi di
                    <a href="<?php echo e(config("app.url")); ?>" class="text-blue-600 hover:underline"><?php echo e(config("app.url")); ?></a>.
                </p>
                <p>
                    Dengan mengakses website ini, kami menganggap Anda menerima syarat dan ketentuan ini. Jangan lanjutkan menggunakan
                    <?php echo e(app_name()); ?> jika Anda tidak setuju dengan seluruh syarat dan ketentuan yang tercantum di halaman ini.
                </p>
                <p>
                    Terminologi berikut berlaku untuk Syarat dan Ketentuan, Pernyataan Privasi, Pemberitahuan Penafian dan semua Perjanjian:
                    "Klien", "Anda" mengacu pada Anda, orang yang mengakses website ini dan mematuhi syarat dan ketentuan Perusahaan.
                    "Perusahaan", "Kami", "Kita", mengacu pada Perusahaan kami. "Pihak", "Para Pihak", mengacu pada Klien dan kami bersama-sama.
                    Semua istilah mengacu pada tawaran, penerimaan, dan pertimbangan pembayaran yang diperlukan untuk menjalankan proses
                    bantuan kami kepada Klien sesuai dengan hukum yang berlaku di Republik Indonesia.
                </p>

                <h3 class="mb-2 mt-4 text-2xl">Cookie</h3>
                <p>
                    Kami menggunakan cookie di website ini. Dengan mengakses <?php echo e(app_name()); ?>, Anda setuju untuk menggunakan cookie
                    sesuai dengan Kebijakan Privasi <?php echo e($company_name); ?>.
                </p>
                <p>
                    Sebagian besar website interaktif menggunakan cookie untuk mengambil detail pengguna pada setiap kunjungan.
                    Cookie digunakan oleh website kami untuk mengaktifkan fungsionalitas area tertentu agar memudahkan pengunjung.
                    Beberapa mitra afiliasi/periklanan kami mungkin juga menggunakan cookie.
                </p>

                <h3 class="mb-2 mt-4 text-2xl">Lisensi</h3>
                <p>
                    Kecuali dinyatakan lain, <?php echo e($company_name); ?> dan/atau pemberi lisensinya memiliki hak kekayaan intelektual untuk
                    semua materi di <?php echo e(app_name()); ?>. Semua hak kekayaan intelektual dilindungi. Anda dapat mengakses ini dari
                    <?php echo e(app_name()); ?> untuk penggunaan pribadi Anda sendiri dengan batasan yang ditetapkan dalam syarat dan ketentuan ini.
                </p>

                <h3 class="mb-2 mt-4 text-2xl">Anda tidak boleh:</h3>
                <ul class="list-inside list-disc">
                    <li>Mempublikasikan ulang materi dari <?php echo e(app_name()); ?></li>
                    <li>Menjual, menyewakan atau mensublisensikan materi dari <?php echo e(app_name()); ?></li>
                    <li>Mereproduksi, menduplikasi atau menyalin materi dari <?php echo e(app_name()); ?></li>
                    <li>Mendistribusikan ulang konten dari <?php echo e(app_name()); ?></li>
                </ul>

                <h3 class="mb-2 mt-4 text-2xl">Komentar</h3>
                <p>
                    Bagian dari website ini menawarkan kesempatan bagi pengguna untuk memposting dan bertukar pendapat serta informasi.
                    <?php echo e($company_name); ?> tidak menyaring, mengedit, mempublikasikan atau meninjau Komentar sebelum kehadirannya di website.
                    Komentar tidak mencerminkan pandangan dan pendapat <?php echo e($company_name); ?>, agen dan/atau afiliasinya.
                </p>
                <p>
                    <?php echo e($company_name); ?> berhak untuk memantau semua Komentar dan menghapus Komentar yang dianggap tidak pantas,
                    menyinggung atau melanggar Syarat dan Ketentuan ini.
                </p>

                <h3 class="mb-2 mt-4 text-2xl">Hyperlink ke Konten Kami</h3>
                <p>Organisasi berikut dapat menautkan ke Website kami tanpa persetujuan tertulis sebelumnya:</p>
                <ul class="list-inside list-disc">
                    <li>Lembaga pemerintah</li>
                    <li>Mesin pencari</li>
                    <li>Organisasi berita</li>
                    <li>Distributor direktori online</li>
                    <li>Bisnis Terakreditasi di seluruh sistem</li>
                </ul>

                <h3 class="mb-2 mt-4 text-2xl">iFrame</h3>
                <p>
                    Tanpa persetujuan dan izin tertulis sebelumnya, Anda tidak boleh membuat bingkai di sekitar Halaman Web kami
                    yang mengubah tampilan visual atau penampilan Website kami dengan cara apa pun.
                </p>

                <h3 class="mb-2 mt-4 text-2xl">Tanggung Jawab Konten</h3>
                <p>
                    Kami tidak bertanggung jawab atas konten apa pun yang muncul di Website Anda. Anda setuju untuk melindungi dan
                    membela kami terhadap semua klaim yang timbul dari Website Anda.
                </p>

                <h3 class="mb-2 mt-4 text-2xl">Hak yang Dilindungi</h3>
                <p>
                    Kami berhak untuk meminta Anda menghapus semua tautan atau tautan tertentu ke Website kami.
                    Anda menyetujui untuk segera menghapus semua tautan ke Website kami atas permintaan.
                    Kami juga berhak untuk mengubah syarat dan ketentuan ini dan kebijakan tautannya kapan saja.
                </p>

                <h3 class="mb-2 mt-4 text-2xl">Penafian</h3>
                <p>
                    Sejauh diizinkan oleh hukum yang berlaku, kami mengecualikan semua pernyataan, jaminan dan kondisi
                    yang berkaitan dengan website kami dan penggunaan website ini. Penafian ini tidak akan:
                </p>
                <ul class="list-inside list-disc">
                    <li>Membatasi atau mengecualikan tanggung jawab kami atau Anda atas kematian atau cedera pribadi</li>
                    <li>Membatasi atau mengecualikan tanggung jawab kami atau Anda atas penipuan</li>
                    <li>Membatasi tanggung jawab kami atau Anda dengan cara yang tidak diizinkan oleh hukum yang berlaku</li>
                    <li>Mengecualikan tanggung jawab kami atau Anda yang tidak dapat dikecualikan oleh hukum yang berlaku</li>
                </ul>
                <p>
                    Selama website dan informasi serta layanan di website disediakan secara gratis,
                    kami tidak akan bertanggung jawab atas kerugian atau kerusakan apa pun.
                </p>

            <?php else: ?>
                
                <p>Welcome to <?php echo e(app_name()); ?>!</p>
                <p>
                    <?php echo e(app_name()); ?> is a service provided by <?php echo e($company_name); ?>.
                    This service aims to help brands and businesses through digital solutions, events, and experiential marketing.
                </p>
                <p>
                    These terms and conditions outline the rules and regulations for the use of <?php echo e($company_name); ?>'s
                    Website, located at
                    <a href="<?php echo e(config("app.url")); ?>" class="text-blue-600 hover:underline"><?php echo e(config("app.url")); ?></a>.
                </p>
                <p>
                    By accessing this website we assume you accept these terms and conditions. Do not continue to use
                    <?php echo e(app_name()); ?> if you do not agree to take all of the terms and conditions stated on this page.
                </p>
                <p>
                    The following terminology applies to these Terms and Conditions, Privacy Statement and Disclaimer Notice
                    and all Agreements: "Client", "You" and "Your" refers to you, the person log on this website and
                    compliant to the Company's terms and conditions. "The Company", "Ourselves", "We", "Our" and "Us",
                    refers to our Company. "Party", "Parties", or "Us", refers to both the Client and ourselves. All terms
                    refer to the offer, acceptance and consideration of payment necessary to undertake the process of our
                    assistance to the Client in the most appropriate manner for the express purpose of meeting the Client's
                    needs in respect of provision of the Company's stated services, in accordance with and subject to,
                    prevailing law of Indonesia.
                </p>

                <h3 class="mb-2 mt-4 text-2xl">Cookies</h3>
                <p>
                    We employ the use of cookies. By accessing <?php echo e(app_name()); ?>, you agreed to use cookies in agreement
                    with the <?php echo e($company_name); ?>'s Privacy Policy.
                </p>
                <p>
                    Most interactive websites use cookies to let us retrieve the user's details for each visit. Cookies are
                    used by our website to enable the functionality of certain areas to make it easier for people visiting
                    our website. Some of our affiliate/advertising partners may also use cookies.
                </p>

                <h3 class="mb-2 mt-4 text-2xl">License</h3>
                <p>
                    Unless otherwise stated, <?php echo e($company_name); ?> and/or its licensors own the intellectual property rights
                    for all material on <?php echo e(app_name()); ?>. All intellectual property rights are reserved. You may access
                    this from <?php echo e(app_name()); ?> for your own personal use subjected to restrictions set in these terms and
                    conditions.
                </p>

                <h3 class="mb-2 mt-4 text-2xl">You must not:</h3>
                <ul class="list-inside list-disc">
                    <li>Republish material from <?php echo e(app_name()); ?></li>
                    <li>Sell, rent or sub-license material from <?php echo e(app_name()); ?></li>
                    <li>Reproduce, duplicate or copy material from <?php echo e(app_name()); ?></li>
                    <li>Redistribute content from <?php echo e(app_name()); ?></li>
                </ul>

                <h3 class="mb-2 mt-4 text-2xl">Comments</h3>
                <p>
                    Parts of this website offer an opportunity for users to post and exchange opinions and information in
                    certain areas of the website. <?php echo e($company_name); ?> does not filter, edit, publish or review Comments
                    prior to their presence on the website. Comments do not reflect the views and opinions of
                    <?php echo e($company_name); ?>, its agents and/or affiliates.
                </p>
                <p>
                    <?php echo e($company_name); ?> reserves the right to monitor all Comments and to remove any Comments which can be
                    considered inappropriate, offensive or causes breach of these Terms and Conditions.
                </p>

                <h3 class="mb-2 mt-4 text-2xl">Hyperlinking to our Content</h3>
                <p>The following organizations may link to our Website without prior written approval:</p>
                <ul class="list-inside list-disc">
                    <li>Government agencies</li>
                    <li>Search engines</li>
                    <li>News organizations</li>
                    <li>Online directory distributors</li>
                    <li>System wide Accredited Businesses</li>
                </ul>

                <h3 class="mb-2 mt-4 text-2xl">iFrames</h3>
                <p>
                    Without prior approval and written permission, you may not create frames around our Webpages that alter
                    in any way the visual presentation or appearance of our Website.
                </p>

                <h3 class="mb-2 mt-4 text-2xl">Content Liability</h3>
                <p>
                    We shall not be hold responsible for any content that appears on your Website. You agree to protect and
                    defend us against all claims that is rising on your Website.
                </p>

                <h3 class="mb-2 mt-4 text-2xl">Reservation of Rights</h3>
                <p>
                    We reserve the right to request that you remove all links or any particular link to our Website. You
                    approve to immediately remove all links to our Website upon request. We also reserve the right to amend
                    these terms and conditions and its linking policy at any time.
                </p>

                <h3 class="mb-2 mt-4 text-2xl">Disclaimer</h3>
                <p>
                    To the maximum extent permitted by applicable law, we exclude all representations, warranties and
                    conditions relating to our website and the use of this website. Nothing in this disclaimer will:
                </p>
                <ul class="list-inside list-disc">
                    <li>Limit or exclude our or your liability for death or personal injury</li>
                    <li>Limit or exclude our or your liability for fraud or fraudulent misrepresentation</li>
                    <li>Limit any of our or your liabilities in any way that is not permitted under applicable law</li>
                    <li>Exclude any of our or your liabilities that may not be excluded under applicable law</li>
                </ul>
                <p>
                    As long as the website and the information and services on the website are provided free of charge, we
                    will not be liable for any loss or damage of any nature.
                </p>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </div>
    </section>
</div>
<?php /**PATH C:\Users\Marcel\Music\3.digioh\resources\views/livewire/terms.blade.php ENDPATH**/ ?>