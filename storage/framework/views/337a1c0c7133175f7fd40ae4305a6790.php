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
                
                <p>
                    Di <?php echo e(app_name()); ?>, yang dapat diakses di
                    <a href="<?php echo e(config("app.url")); ?>" class="text-blue-600 hover:underline"><?php echo e(config("app.url")); ?></a>,
                    salah satu prioritas utama kami adalah privasi pengunjung. Dokumen Kebijakan Privasi ini berisi jenis
                    informasi yang dikumpulkan dan dicatat oleh <?php echo e(app_name()); ?> dan bagaimana kami menggunakannya.
                </p>
                <p>
                    Jika Anda memiliki pertanyaan tambahan atau memerlukan informasi lebih lanjut tentang Kebijakan Privasi kami,
                    jangan ragu untuk menghubungi kami melalui email di <?php echo e($app_email); ?>

                </p>
                <p>
                    Kebijakan privasi ini hanya berlaku untuk aktivitas online kami dan berlaku untuk pengunjung website kami
                    terkait informasi yang mereka bagikan dan/atau kumpulkan di <?php echo e(app_name()); ?>. Kebijakan ini tidak berlaku
                    untuk informasi apa pun yang dikumpulkan secara offline atau melalui saluran selain website ini.
                </p>

                <h3 class="mb-2 mt-4 text-2xl">Persetujuan</h3>
                <p>Dengan menggunakan website kami, Anda dengan ini menyetujui Kebijakan Privasi kami dan menyetujui ketentuannya.</p>

                <h3 class="mb-2 mt-4 text-2xl">Informasi yang Kami Kumpulkan</h3>
                <p>
                    Informasi pribadi yang diminta untuk Anda berikan, dan alasan mengapa Anda diminta untuk memberikannya,
                    akan dijelaskan kepada Anda pada saat kami meminta Anda memberikan informasi pribadi Anda.
                </p>
                <p>
                    Jika Anda menghubungi kami secara langsung, kami mungkin menerima informasi tambahan tentang Anda seperti nama,
                    alamat email, nomor telepon, isi pesan dan/atau lampiran yang mungkin Anda kirimkan kepada kami, dan informasi
                    lain yang mungkin Anda pilih untuk diberikan.
                </p>
                <p>
                    Saat Anda mendaftar untuk Akun, kami mungkin meminta informasi kontak Anda, termasuk item seperti nama,
                    nama perusahaan, alamat, alamat email, dan nomor telepon.
                </p>

                <h3 class="mb-2 mt-4 text-2xl">Bagaimana Kami Menggunakan Informasi Anda</h3>
                <p>Kami menggunakan informasi yang kami kumpulkan dengan berbagai cara, termasuk untuk:</p>
                <ul class="list-inside list-disc">
                    <li>Menyediakan, mengoperasikan, dan memelihara website kami</li>
                    <li>Meningkatkan, mempersonalisasi, dan memperluas website kami</li>
                    <li>Memahami dan menganalisis bagaimana Anda menggunakan website kami</li>
                    <li>Mengembangkan produk, layanan, fitur, dan fungsionalitas baru</li>
                    <li>Berkomunikasi dengan Anda untuk layanan pelanggan, pembaruan, dan tujuan pemasaran</li>
                    <li>Mengirimkan email kepada Anda</li>
                    <li>Menemukan dan mencegah penipuan</li>
                </ul>

                <h3 class="mb-2 mt-4 text-2xl">File Log</h3>
                <p>
                    <?php echo e(app_name()); ?> mengikuti prosedur standar menggunakan file log. File-file ini mencatat pengunjung saat
                    mereka mengunjungi website. Semua perusahaan hosting melakukan ini sebagai bagian dari analitik layanan hosting.
                    Informasi yang dikumpulkan meliputi alamat protokol internet (IP), jenis browser, Penyedia Layanan Internet (ISP),
                    cap waktu, halaman rujukan/keluar, dan mungkin jumlah klik. Ini tidak terkait dengan informasi apa pun yang
                    dapat diidentifikasi secara pribadi.
                </p>

                <h3 class="mb-2 mt-4 text-2xl">Cookie dan Web Beacon</h3>
                <p>
                    Seperti website lainnya, <?php echo e(app_name()); ?> menggunakan 'cookie'. Cookie ini digunakan untuk menyimpan informasi
                    termasuk preferensi pengunjung, dan halaman di website yang diakses atau dikunjungi pengunjung. Informasi
                    tersebut digunakan untuk mengoptimalkan pengalaman pengguna dengan menyesuaikan konten halaman web kami
                    berdasarkan jenis browser pengunjung dan/atau informasi lainnya.
                </p>

                <h3 class="mb-2 mt-4 text-2xl">Kebijakan Privasi Mitra Periklanan</h3>
                <p>
                    Server iklan pihak ketiga atau jaringan iklan menggunakan teknologi seperti cookie, JavaScript, atau
                    Web Beacon yang digunakan dalam iklan dan tautan masing-masing yang muncul di <?php echo e(app_name()); ?>, yang
                    dikirim langsung ke browser pengguna. Mereka secara otomatis menerima alamat IP Anda saat ini terjadi.
                </p>
                <p>
                    Perhatikan bahwa <?php echo e(app_name()); ?> tidak memiliki akses ke atau kontrol atas cookie yang digunakan oleh
                    pengiklan pihak ketiga.
                </p>

                <h3 class="mb-2 mt-4 text-2xl">Kebijakan Privasi Pihak Ketiga</h3>
                <p>
                    Kebijakan Privasi <?php echo e(app_name()); ?> tidak berlaku untuk pengiklan atau website lain. Dengan demikian, kami
                    menyarankan Anda untuk berkonsultasi dengan Kebijakan Privasi masing-masing server iklan pihak ketiga ini
                    untuk informasi yang lebih rinci.
                </p>
                <p>
                    Anda dapat memilih untuk menonaktifkan cookie melalui opsi browser individual Anda. Untuk mengetahui informasi
                    yang lebih rinci tentang manajemen cookie dengan browser web tertentu, dapat ditemukan di website browser
                    masing-masing.
                </p>

                <h3 class="mb-2 mt-4 text-2xl">Hak Perlindungan Data GDPR</h3>
                <p>
                    Kami ingin memastikan Anda sepenuhnya mengetahui semua hak perlindungan data Anda. Setiap pengguna berhak atas:
                </p>
                <ul class="list-inside list-disc">
                    <li>Hak untuk mengakses – Anda berhak meminta salinan data pribadi Anda.</li>
                    <li>Hak untuk perbaikan – Anda berhak meminta kami memperbaiki informasi yang Anda yakini tidak akurat.</li>
                    <li>Hak untuk menghapus – Anda berhak meminta kami menghapus data pribadi Anda, dalam kondisi tertentu.</li>
                    <li>Hak untuk membatasi pemrosesan – Anda berhak meminta kami membatasi pemrosesan data pribadi Anda.</li>
                    <li>Hak untuk menolak pemrosesan – Anda berhak menolak pemrosesan data pribadi Anda oleh kami.</li>
                    <li>Hak untuk portabilitas data – Anda berhak meminta kami mentransfer data yang telah kami kumpulkan ke organisasi lain.</li>
                </ul>
                <p>
                    Jika Anda mengajukan permintaan, kami memiliki satu bulan untuk merespons Anda. Jika Anda ingin menggunakan
                    hak-hak ini, silakan hubungi kami.
                </p>

                <h3 class="mb-2 mt-4 text-2xl">Informasi Anak-anak</h3>
                <p>
                    Bagian lain dari prioritas kami adalah menambahkan perlindungan untuk anak-anak saat menggunakan internet.
                    Kami mendorong orang tua dan wali untuk mengamati, berpartisipasi, dan/atau memantau dan membimbing aktivitas
                    online mereka.
                </p>
                <p>
                    <?php echo e(app_name()); ?> tidak dengan sengaja mengumpulkan Informasi Identifikasi Pribadi dari anak-anak di bawah usia 13 tahun.
                    Jika Anda merasa bahwa anak Anda memberikan informasi semacam ini di website kami, kami sangat menganjurkan Anda
                    untuk segera menghubungi kami dan kami akan melakukan upaya terbaik untuk segera menghapus informasi tersebut
                    dari catatan kami.
                </p>

            <?php else: ?>
                
                <p>
                    At <?php echo e(app_name()); ?>, accessible at
                    <a href="<?php echo e(config("app.url")); ?>" class="text-blue-600 hover:underline"><?php echo e(config("app.url")); ?></a>,
                    one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types
                    of information that is collected and recorded by <?php echo e(app_name()); ?> and how we use it.
                </p>
                <p>
                    If you have additional questions or require more information about our Privacy Policy, do not hesitate
                    to contact us through email at <?php echo e($app_email); ?>

                </p>
                <p>
                    This privacy policy applies only to our online activities and is valid for visitors to our website with
                    regards to the information that they shared and/or collect in <?php echo e(app_name()); ?>. This policy is not
                    applicable to any information collected offline or via channels other than this website.
                </p>

                <h3 class="mb-2 mt-4 text-2xl">Consent</h3>
                <p>By using our website, you hereby consent to our Privacy Policy and agree to its terms.</p>

                <h3 class="mb-2 mt-4 text-2xl">Information we collect</h3>
                <p>
                    The personal information that you are asked to provide, and the reasons why you are asked to provide it,
                    will be made clear to you at the point we ask you to provide your personal information.
                </p>
                <p>
                    If you contact us directly, we may receive additional information about you such as your name, email
                    address, phone number, the contents of the message and/or attachments you may send us, and any other
                    information you may choose to provide.
                </p>
                <p>
                    When you register for an Account, we may ask for your contact information, including items such as name,
                    company name, address, email address, and telephone number.
                </p>

                <h3 class="mb-2 mt-4 text-2xl">How we use your information</h3>
                <p>We use the information we collect in various ways, including to:</p>
                <ul class="list-inside list-disc">
                    <li>Provide, operate, and maintain our website</li>
                    <li>Improve, personalize, and expand our website</li>
                    <li>Understand and analyze how you use our website</li>
                    <li>Develop new products, services, features, and functionality</li>
                    <li>Communicate with you for customer service, updates, and marketing purposes</li>
                    <li>Send you emails</li>
                    <li>Find and prevent fraud</li>
                </ul>

                <h3 class="mb-2 mt-4 text-2xl">Log Files</h3>
                <p>
                    <?php echo e(app_name()); ?> follows a standard procedure of using log files. These files log visitors when they
                    visit websites. All hosting companies do this as part of hosting services' analytics. The information
                    collected includes internet protocol (IP) addresses, browser type, Internet Service Provider (ISP),
                    date and time stamp, referring/exit pages, and possibly the number of clicks. These are not linked to
                    any information that is personally identifiable.
                </p>

                <h3 class="mb-2 mt-4 text-2xl">Cookies and Web Beacons</h3>
                <p>
                    Like any other website, <?php echo e(app_name()); ?> uses 'cookies'. These cookies are used to store information
                    including visitors' preferences, and the pages on the website that the visitor accessed or visited. The
                    information is used to optimize the users' experience by customizing our web page content based on
                    visitors' browser type and/or other information.
                </p>

                <h3 class="mb-2 mt-4 text-2xl">Advertising Partners Privacy Policies</h3>
                <p>
                    Third-party ad servers or ad networks uses technologies like cookies, JavaScript, or Web Beacons that
                    are used in their respective advertisements and links that appear on <?php echo e(app_name()); ?>, which are sent
                    directly to users' browser. They automatically receive your IP address when this occurs.
                </p>
                <p>
                    Note that <?php echo e(app_name()); ?> has no access to or control over these cookies that are used by third-party
                    advertisers.
                </p>

                <h3 class="mb-2 mt-4 text-2xl">Third Party Privacy Policies</h3>
                <p>
                    <?php echo e(app_name()); ?>'s Privacy Policy does not apply to other advertisers or websites. Thus, we are
                    advising you to consult the respective Privacy Policies of these third-party ad servers for more
                    detailed information.
                </p>
                <p>
                    You can choose to disable cookies through your individual browser options. To know more detailed
                    information about cookie management with specific web browsers, it can be found at the browsers'
                    respective websites.
                </p>

                <h3 class="mb-2 mt-4 text-2xl">GDPR Data Protection Rights</h3>
                <p>
                    We would like to make sure you are fully aware of all of your data protection rights. Every user is
                    entitled to the following:
                </p>
                <ul class="list-inside list-disc">
                    <li>The right to access – You have the right to request copies of your personal data.</li>
                    <li>The right to rectification – You have the right to request that we correct any information you believe is inaccurate.</li>
                    <li>The right to erasure – You have the right to request that we erase your personal data, under certain conditions.</li>
                    <li>The right to restrict processing – You have the right to request that we restrict the processing of your personal data.</li>
                    <li>The right to object to processing – You have the right to object to our processing of your personal data.</li>
                    <li>The right to data portability – You have the right to request that we transfer the data to another organization.</li>
                </ul>
                <p>
                    If you make a request, we have one month to respond to you. If you would like to exercise any of these
                    rights, please contact us.
                </p>

                <h3 class="mb-2 mt-4 text-2xl">Children's Information</h3>
                <p>
                    Another part of our priority is adding protection for children while using the internet. We encourage
                    parents and guardians to observe, participate in, and/or monitor and guide their online activity.
                </p>
                <p>
                    <?php echo e(app_name()); ?> does not knowingly collect any Personal Identifiable Information from children under
                    the age of 13. If you think that your child provided this kind of information on our website, we
                    strongly encourage you to contact us immediately and we will do our best efforts to promptly remove such
                    information from our records.
                </p>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </div>
    </section>
</div>
<?php /**PATH C:\Users\Marcel\Music\3.digioh\resources\views/livewire/privacy.blade.php ENDPATH**/ ?>