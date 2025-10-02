<?php

return [
    'app' => [
        'title' => 'General',
        'desc' => 'All the general settings for application.',
        'icon' => 'fas fa-cube',

        'elements' => [
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'app_name', // unique name for field
                'label' => 'App Name', // you know what label it is
                'rules' => 'required|min:2|max:50', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'DigiOH', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'text', // data type, string, int, boolean
                'name' => 'app_description', // unique name for field
                'label' => 'App Description', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'DigiOH adalah studio digital yang membantu brand tumbuh melalui solusi kreatif dan teknologi modern.', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'footer_text', // unique name for field
                'label' => 'Footer Text', // you know what label it is
                'rules' => 'required|min:2', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '<a href="https://digioh.id" class="text-muted">Built with ♥ by DigiOH</a>', // default value if you want
            ],
            [
                'type' => 'checkbox', // input fields type
                'data' => 'text', // data type, string, int, boolean
                'name' => 'show_copyright', // unique name for field
                'label' => 'Show Copyright', // you know what label it is
                'rules' => 'nullable', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '1', // default value if you want
            ],
        ],
    ],
    'email' => [
        'title' => 'Email',
        'desc' => 'Email settings for app',
        'icon' => 'fas fa-envelope',

        'elements' => [
            [
                'type' => 'email', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'email', // unique name for field
                'label' => 'Email', // you know what label it is
                'rules' => 'required|email', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'info@example.com', // default value if you want
            ],
        ],

    ],
    'social' => [
        'title' => 'Social Profiles',
        'desc' => 'Link of all the online/social profiles.',
        'icon' => 'fas fa-users',

        'elements' => [
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'website_url', // unique name for field
                'label' => 'Website URL', // you know what label it is
                'rules' => 'nullable|max:191', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'https://digioh.id', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'facebook_url', // unique name for field
                'label' => 'Facebook Page URL', // you know what label it is
                'rules' => 'nullable|max:191', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '#', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'twitter_url', // unique name for field
                'label' => 'Twitter Profile URL', // you know what label it is
                'rules' => 'nullable|max:191', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'https://twitter.com/digioh_id', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'instagram_url', // unique name for field
                'label' => 'Instagram Account URL', // you know what label it is
                'rules' => 'nullable|max:191', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'https://www.instagram.com/digioh.id', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'youtube_url', // unique name for field
                'label' => 'Youtube Channel URL', // you know what label it is
                'rules' => 'nullable|max:191', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'https://www.youtube.com/@digioh', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'linkedin_url', // unique name for field
                'label' => 'LinkedIn URL', // you know what label it is
                'rules' => 'nullable|max:191', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '#', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'whatsapp_url', // unique name for field
                'label' => 'WhatsApp URL', // you know what label it is
                'rules' => 'nullable|max:191', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '#', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'messenger_url', // unique name for field
                'label' => 'Messenger URL', // you know what label it is
                'rules' => 'nullable|max:191', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '#', // default value if you want
            ],
        ],

    ],
	'about' => [
		'title' => 'About Us',
		'desc' => 'Konten halaman About Us',
		'icon' => 'fas fa-info-circle',
		'elements' => [
			[
				'type' => 'text',
				'data' => 'string',
				'name' => 'about_title',
				'label' => 'Judul',
				'rules' => 'required|min:2|max:150',
				'class' => '',
				'value' => 'Tentang DigiOH',
			],
			[
				'type' => 'textarea',
				'data' => 'string',
				'name' => 'about_body',
				'label' => 'Konten',
				'rules' => 'required',
				'class' => '',
				'value' => '<p>DigiOH adalah studio digital yang membantu brand tumbuh melalui solusi kreatif dan teknologi.</p><ul><li>Strategi & Konsultasi</li><li>Desain & Pengembangan</li><li>Pemasaran & Pertumbuhan</li></ul>',
				'display' => 'raw',
			],
			// English variant (optional)
			[
				'type' => 'text',
				'data' => 'string',
				'name' => 'about_title_en',
				'label' => 'Title (English)',
				'rules' => 'nullable|max:150',
				'class' => '',
				'value' => 'About DigiOH',
			],
			[
				'type' => 'textarea',
				'data' => 'string',
				'name' => 'about_body_en',
				'label' => 'Content (English)',
				'rules' => 'nullable',
				'class' => '',
				'value' => '<p>DigiOH is a digital studio helping brands grow through creative solutions and technology.</p><ul><li>Strategy & Consulting</li><li>Design & Development</li><li>Marketing & Growth</li></ul>',
				'display' => 'raw',
			],
			[
				'type' => 'text',
				'data' => 'string',
				'name' => 'about_image',
				'label' => 'Gambar Hero (URL/Path)',
				'rules' => 'nullable|max:191',
				'class' => '',
				'value' => 'img/default_banner.jpg',
			],
			// Founders (maks 3)
			[
				'type' => 'text',
				'data' => 'string',
				'name' => 'about_founder_1_name',
				'label' => 'Founder 1 - Nama',
				'rules' => 'nullable|max:100',
				'class' => '',
				'value' => 'John Doe',
			],
			[
				'type' => 'text',
				'data' => 'string',
				'name' => 'about_founder_1_title',
				'label' => 'Founder 1 - Jabatan',
				'rules' => 'nullable|max:100',
				'class' => '',
				'value' => 'Chief Executive Officer',
			],
			[
				'type' => 'text',
				'data' => 'string',
				'name' => 'about_founder_1_photo',
				'label' => 'Founder 1 - Foto (URL/Path)',
				'rules' => 'nullable|max:191',
				'class' => '',
				'value' => 'img/avatar-1.png',
			],
			[
				'type' => 'text',
				'data' => 'string',
				'name' => 'about_founder_1_linkedin',
				'label' => 'Founder 1 - LinkedIn URL',
				'rules' => 'nullable|max:191',
				'class' => '',
				'value' => '#',
			],
			[
				'type' => 'text',
				'data' => 'string',
				'name' => 'about_founder_2_name',
				'label' => 'Founder 2 - Nama',
				'rules' => 'nullable|max:100',
				'class' => '',
				'value' => 'Jane Smith',
			],
			[
				'type' => 'text',
				'data' => 'string',
				'name' => 'about_founder_2_title',
				'label' => 'Founder 2 - Jabatan',
				'rules' => 'nullable|max:100',
				'class' => '',
				'value' => 'Chief Operating Officer',
			],
			[
				'type' => 'text',
				'data' => 'string',
				'name' => 'about_founder_2_photo',
				'label' => 'Founder 2 - Foto (URL/Path)',
				'rules' => 'nullable|max:191',
				'class' => '',
				'value' => 'img/avatar-2.png',
			],
			[
				'type' => 'text',
				'data' => 'string',
				'name' => 'about_founder_2_linkedin',
				'label' => 'Founder 2 - LinkedIn URL',
				'rules' => 'nullable|max:191',
				'class' => '',
				'value' => '#',
			],
			[
				'type' => 'text',
				'data' => 'string',
				'name' => 'about_founder_3_name',
				'label' => 'Founder 3 - Nama',
				'rules' => 'nullable|max:100',
				'class' => '',
				'value' => 'Alex Lee',
			],
			[
				'type' => 'text',
				'data' => 'string',
				'name' => 'about_founder_3_title',
				'label' => 'Founder 3 - Jabatan',
				'rules' => 'nullable|max:100',
				'class' => '',
				'value' => 'Chief Technology Officer',
			],
			[
				'type' => 'text',
				'data' => 'string',
				'name' => 'about_founder_3_photo',
				'label' => 'Founder 3 - Foto (URL/Path)',
				'rules' => 'nullable|max:191',
				'class' => '',
				'value' => 'img/avatar-3.png',
			],
			[
				'type' => 'text',
				'data' => 'string',
				'name' => 'about_founder_3_linkedin',
				'label' => 'Founder 3 - LinkedIn URL',
				'rules' => 'nullable|max:191',
				'class' => '',
				'value' => '#',
			],
		],
	],
    'meta' => [
        'title' => 'Meta ',
        'desc' => 'Application Meta Data',
        'icon' => 'fa-solid fa-earth-asia',

        'elements' => [
            [
                'type' => 'text', // input fields type
                'data' => 'text', // data type, string, int, boolean
                'name' => 'meta_site_name', // unique name for field
                'label' => 'Meta Site Name', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'DigiOH | Digital Studio Indonesia', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'text', // data type, string, int, boolean
                'name' => 'meta_description', // unique name for field
                'label' => 'Meta Description', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'DigiOH adalah studio digital yang membantu brand tumbuh melalui solusi kreatif dan teknologi. Kami menyediakan layanan desain, pengembangan, dan pemasaran digital.', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'text', // data type, string, int, boolean
                'name' => 'meta_keyword', // unique name for field
                'label' => 'Meta Keyword', // you know what label it is
                'rules' => 'nullable', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'Digital Studio, Web Development, Mobile App, UI/UX Design, Digital Marketing, DigiOH, Indonesia, Jakarta', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'text', // data type, string, int, boolean
                'name' => 'meta_image', // unique name for field
                'label' => 'Meta Image', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'img/default_banner.jpg', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'text', // data type, string, int, boolean
                'name' => 'meta_fb_app_id', // unique name for field
                'label' => 'Meta Facebook App Id', // you know what label it is
                'rules' => 'nullable', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '569561286532601', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'text', // data type, string, int, boolean
                'name' => 'meta_twitter_site', // unique name for field
                'label' => 'Meta Twitter Site Account', // you know what label it is
                'rules' => 'nullable', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '@digioh_id', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'text', // data type, string, int, boolean
                'name' => 'meta_twitter_creator', // unique name for field
                'label' => 'Meta Twitter Creator Account', // you know what label it is
                'rules' => 'nullable', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '@digioh_id', // default value if you want
            ],
        ],
    ],
    'analytics' => [
        'title' => 'Analytics',
        'desc' => 'Application Analytics',
        'icon' => 'fas fa-chart-line',

        'elements' => [
            [
                'type' => 'text', // input fields type
                'data' => 'text', // data type, string, int, boolean
                'name' => 'google_analytics', // unique name for field
                'label' => 'Google Analytics (gtag)', // you know what label it is
                'rules' => 'nullable', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'G-ABCDE12345', // default value if you want
                'help' => 'Paste the only the Measurement Id of Google Analytics stream.', // Help text for the input field.
            ],
        ],

    ],
    'custom_css' => [
        'title' => 'Custom Code',
        'desc' => 'Custom code area',
        'icon' => 'fa-solid fa-file-code',

        'elements' => [
            [
                'type' => 'textarea', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'custom_css_block', // unique name for field
                'label' => 'Custom Css Code', // you know what label it is
                'rules' => 'nullable', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
                'help' => 'Paste the code in this field.', // Help text for the input field.
                'display' => 'raw', // Help text for the input field.
            ],
        ],

    ],
    'contact' => [
        'title' => 'Contact',
        'desc' => 'Contact info and map embed.',
        'icon' => 'fas fa-address-card',

        'elements' => [
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'contact_email',
                'label' => 'Contact Email',
                'rules' => 'nullable|email',
                'class' => '',
                'value' => '',
            ],
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'whatsapp_number',
                'label' => 'WhatsApp Number (Intl format, e.g., 6281234567890)',
                'rules' => 'nullable',
                'class' => '',
                'value' => '',
                'help' => 'Masukkan nomor tanpa tanda + atau spasi. Contoh: 62812xxxxxxx'
            ],
            [
                'type' => 'textarea',
                'data' => 'string',
                'name' => 'whatsapp_prefill',
                'label' => 'WhatsApp Prefill Message',
                'rules' => 'nullable',
                'class' => '',
                'value' => 'Halo DigiOH, saya ingin berdiskusi tentang proyek/event.',
                'help' => 'Pesan default yang akan terisi di WhatsApp.'
            ],
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'contact_address',
                'label' => 'Contact Address',
                'rules' => 'nullable',
                'class' => '',
                'value' => '',
            ],
            [
                'type' => 'textarea',
                'data' => 'string',
                'name' => 'contact_map_embed',
                'label' => 'Map Embed (iframe HTML)',
                'rules' => 'nullable',
                'class' => '',
                'value' => '',
                'help' => 'Paste your map iframe embed code here (e.g., Google Maps).',
                'display' => 'raw',
            ],
        ],
    ],
    'homepage' => [
        'title' => 'Homepage',
        'desc' => 'Homepage display options.',
        'icon' => 'fas fa-home',

        'elements' => [
            [
                'type' => 'text',
                'data' => 'text',
                'name' => 'home_services_heading_en',
                'label' => 'Services Section Heading (EN)',
                'rules' => 'nullable',
                'class' => '',
                'value' => 'We help companies design, build, and grow end-to-end digital products.',
                'help' => 'English heading shown when locale is EN'
            ],
            [
                'type' => 'text',
                'data' => 'text',
                'name' => 'home_services_heading',
                'label' => 'Services Section Heading',
                'rules' => 'nullable',
                'class' => '',
                'value' => 'Kami membantu perusahaan merancang, membangun, dan mengembangkan produk digital end-to-end.',
                'help' => 'Judul besar pada bagian "Layanan utama" di homepage.'
            ],
            [
                'type' => 'checkbox',
                'data' => 'boolean',
                'name' => 'home_show_portfolio',
                'label' => 'Show Portfolio section',
                'rules' => 'nullable',
                'class' => '',
                'value' => '0',
                'help' => 'Enable to display the Portfolio section on the homepage.',
            ],
            // Optional EN variants for static services (used when DB Services empty)
            [ 'type' => 'text', 'data' => 'string', 'name' => 'home_service_1_title_en', 'label' => 'Service 1 Title (EN)', 'rules' => 'nullable', 'class' => '', 'value' => '' ],
            [ 'type' => 'textarea', 'data' => 'string', 'name' => 'home_service_1_description_en', 'label' => 'Service 1 Description (EN)', 'rules' => 'nullable', 'class' => '', 'value' => '' ],
            [ 'type' => 'text', 'data' => 'string', 'name' => 'home_service_2_title_en', 'label' => 'Service 2 Title (EN)', 'rules' => 'nullable', 'class' => '', 'value' => '' ],
            [ 'type' => 'textarea', 'data' => 'string', 'name' => 'home_service_2_description_en', 'label' => 'Service 2 Description (EN)', 'rules' => 'nullable', 'class' => '', 'value' => '' ],
            [ 'type' => 'text', 'data' => 'string', 'name' => 'home_service_3_title_en', 'label' => 'Service 3 Title (EN)', 'rules' => 'nullable', 'class' => '', 'value' => '' ],
            [ 'type' => 'textarea', 'data' => 'string', 'name' => 'home_service_3_description_en', 'label' => 'Service 3 Description (EN)', 'rules' => 'nullable', 'class' => '', 'value' => '' ],
            [ 'type' => 'text', 'data' => 'string', 'name' => 'home_service_4_title_en', 'label' => 'Service 4 Title (EN)', 'rules' => 'nullable', 'class' => '', 'value' => '' ],
            [ 'type' => 'textarea', 'data' => 'string', 'name' => 'home_service_4_description_en', 'label' => 'Service 4 Description (EN)', 'rules' => 'nullable', 'class' => '', 'value' => '' ],
        ],
    ],
    'instagram' => [
        'title' => 'Instagram Videos',
        'desc' => 'Instagram video embed settings for homepage.',
        'icon' => 'fab fa-instagram',

        'elements' => [
            [
                'type' => 'checkbox',
                'data' => 'boolean',
                'name' => 'instagram_section_enabled',
                'label' => 'Enable Instagram Video Section',
                'rules' => 'nullable',
                'class' => '',
                'value' => '1',
                'help' => 'Show Instagram video section on homepage above FAQ.',
            ],
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'instagram_section_title',
                'label' => 'Section Title',
                'rules' => 'nullable|max:100',
                'class' => '',
                'value' => 'Lihat Aktivitas Kami di Instagram',
                'help' => 'Title for the Instagram video section.',
            ],
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'instagram_section_title_en',
                'label' => 'Section Title (English)',
                'rules' => 'nullable|max:100',
                'class' => '',
                'value' => 'See Our Activities on Instagram',
                'help' => 'English title for the Instagram video section.',
            ],
            [
                'type' => 'textarea',
                'data' => 'string',
                'name' => 'instagram_section_subtitle',
                'label' => 'Section Subtitle',
                'rules' => 'nullable|max:300',
                'class' => '',
                'value' => 'Ikuti perjalanan kreatif kami dan lihat behind-the-scenes dari berbagai proyek yang sedang kami kerjakan.',
                'help' => 'Subtitle description for the Instagram video section.',
            ],
            [
                'type' => 'textarea',
                'data' => 'string',
                'name' => 'instagram_section_subtitle_en',
                'label' => 'Section Subtitle (English)',
                'rules' => 'nullable|max:300',
                'class' => '',
                'value' => 'Follow our creative journey and see behind-the-scenes from various projects we are working on.',
                'help' => 'English subtitle description for the Instagram video section.',
            ],
            [
                'type' => 'textarea',
                'data' => 'string',
                'name' => 'instagram_embed_1',
                'label' => 'Instagram Embed Code 1',
                'rules' => 'nullable',
                'class' => '',
                'value' => '',
                'help' => 'Paste Instagram embed iframe code here. Get it from Instagram post -> ... -> Embed.',
                'display' => 'raw',
            ],
            [
                'type' => 'textarea',
                'data' => 'string',
                'name' => 'instagram_embed_2',
                'label' => 'Instagram Embed Code 2',
                'rules' => 'nullable',
                'class' => '',
                'value' => '',
                'help' => 'Paste Instagram embed iframe code here. Get it from Instagram post -> ... -> Embed.',
                'display' => 'raw',
            ],
            [
                'type' => 'textarea',
                'data' => 'string',
                'name' => 'instagram_embed_3',
                'label' => 'Instagram Embed Code 3',
                'rules' => 'nullable',
                'class' => '',
                'value' => '',
                'help' => 'Paste Instagram embed iframe code here. Get it from Instagram post -> ... -> Embed.',
                'display' => 'raw',
            ],
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'instagram_profile_url',
                'label' => 'Instagram Profile URL',
                'rules' => 'nullable|url|max:191',
                'class' => '',
                'value' => 'https://www.instagram.com/digioh.id',
                'help' => 'Link to your Instagram profile page.',
            ],
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'instagram_cta_text',
                'label' => 'Call-to-Action Text',
                'rules' => 'nullable|max:50',
                'class' => '',
                'value' => 'Ikuti kami di Instagram',
                'help' => 'Text for the button linking to Instagram profile.',
            ],
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'instagram_cta_text_en',
                'label' => 'Call-to-Action Text (English)',
                'rules' => 'nullable|max:50',
                'class' => '',
                'value' => 'Follow us on Instagram',
                'help' => 'English text for the button linking to Instagram profile.',
            ],
        ],
    ],
];

