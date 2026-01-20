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
                'type' => 'text',
                'data' => 'text',
                'name' => 'app_description_en',
                'label' => 'App Description (English)',
                'rules' => 'nullable',
                'class' => '',
                'value' => 'DigiOH is a digital studio that helps brands grow through creative solutions and modern technology.',
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
				'type' => 'text',
				'data' => 'string',
				'name' => 'about_title_en',
				'label' => 'Judul (English)',
				'rules' => 'nullable|min:2|max:150',
				'class' => '',
				'value' => 'About DigiOH',
			],
			[
				'type' => 'text',
				'data' => 'string',
				'name' => 'about_tagline',
				'label' => 'Tagline',
				'rules' => 'nullable|max:180',
				'class' => '',
				'value' => 'Beyond Expectations, Beyond Events',
			],
			[
				'type' => 'text',
				'data' => 'string',
				'name' => 'about_tagline_en',
				'label' => 'Tagline (English)',
				'rules' => 'nullable|max:180',
				'class' => '',
				'value' => 'Beyond Expectations, Beyond Events',
			],
			[
				'type' => 'textarea',
				'data' => 'string',
				'name' => 'about_vision',
				'label' => 'Visi (ID)',
				'rules' => 'nullable',
				'class' => '',
				'value' => 'Menjadi perusahaan event organizer berskala regional yang menggabungkan teknologi dan sentuhan personal di setiap layanan.',
			],
			[
				'type' => 'textarea',
				'data' => 'string',
				'name' => 'about_vision_en',
				'label' => 'Vision (EN)',
				'rules' => 'nullable',
				'class' => '',
				'value' => 'Becoming a regional scale event organizing company that combines the use of technology with a touch of heart in every service.',
			],
			[
				'type' => 'textarea',
				'data' => 'string',
				'name' => 'about_mission_intro',
				'label' => 'Misi Ringkas (ID)',
				'rules' => 'nullable',
				'class' => '',
				'value' => 'Kami memegang nilai L.E.T.S.G.O sebagai dasar cara kami bekerja bersama klien dan tim internal.',
			],
			[
				'type' => 'textarea',
				'data' => 'string',
				'name' => 'about_mission_intro_en',
				'label' => 'Mission Intro (EN)',
				'rules' => 'nullable',
				'class' => '',
				'value' => 'We use the L.E.T.S.G.O values as the foundation of how we collaborate with our clients and internal team.',
			],
			[
				'type' => 'textarea',
				'data' => 'string',
				'name' => 'about_mission_keywords',
				'label' => 'Mission Keywords (ID)',
				'rules' => 'nullable',
				'class' => 'font-mono text-sm',
				'help' => 'Pisahkan per baris dengan format HURUF|Judul|Deskripsi. Contoh: L|reLiability|Selalu bisa diandalkan.',
				'value' => "L|reLiability|Selalu bisa diandalkan\nE|Effective|Fokus pada hasil dan efisiensi\nT|Teamwork|Kolaborasi erat dengan semua pihak\nS|Service|Pelayanan menyeluruh & proaktif\nG|inteGrity|Menjaga kepercayaan melalui transparansi\nO|Outstanding|Memberikan output yang berkesan",
			],
			[
				'type' => 'textarea',
				'data' => 'string',
				'name' => 'about_mission_keywords_en',
				'label' => 'Mission Keywords (EN)',
				'rules' => 'nullable',
				'class' => 'font-mono text-sm',
				'help' => 'One item per line using format LETTER|Title|Description.',
				'value' => "L|reLiability|Always dependable partner\nE|Effective|Focused on measurable results\nT|Teamwork|Collaborating with every stakeholder\nS|Service|End-to-end, proactive support\nG|inteGrity|Trust through transparency\nO|Outstanding|Delivering memorable outcomes",
			],
			[
				'type' => 'textarea',
				'data' => 'string',
				'name' => 'about_timeline',
				'label' => 'Timeline (one item per line)',
				'rules' => 'nullable',
				'class' => 'font-mono text-sm',
				'help' => 'Format: YEAR|Judul|Deskripsi. Contoh: 2015|Starting off as CV DIGIOH|Business line: Digital Signage Rent',
				'value' => "2015|Starting off as CV DIGIOH|Business line: Digital Signage Rent\n2016|New formation as PT Digital Open House|Beginning full-service event division\n2017|New Product Development: digiSELFIE|Launching our first interactive activation product\n2018-2019|New Product Development|digiGAMES, digiSELFIE Mirror, Interactive White Board\n2020-2021|Virtual leap|digiSELFIE AR & Virtual Event Organizer (Virtual Stage)\n2022|Business development|Hybrid & offline event organizer services\n2024 - Recent|Advance experiences|Expo, competition, & high-level meeting execution",
			],
			[
				'type' => 'textarea',
				'data' => 'string',
				'name' => 'about_body',
				'label' => 'Konten',
				'rules' => 'required',
				'class' => 'richtext',
				'value' => '<p>DigiOH adalah studio digital yang membantu brand tumbuh melalui solusi kreatif dan teknologi.</p><ul><li>Strategi & Konsultasi</li><li>Desain & Pengembangan</li><li>Pemasaran & Pertumbuhan</li></ul>',
				'display' => 'raw',
			],
			[
				'type' => 'textarea',
				'data' => 'string',
				'name' => 'about_body_en',
				'label' => 'Konten (English)',
				'rules' => 'nullable',
				'class' => 'richtext',
				'value' => '<p>DigiOH is a digital studio that helps brands grow through creative solutions and technology.</p><ul><li>Strategy & Consulting</li><li>Design & Development</li><li>Marketing & Growth</li></ul>',
				'display' => 'raw',
			],
			[
				'type' => 'image',
				'data' => 'string',
				'name' => 'about_image',
				'label' => 'Gambar Hero (URL/Path)',
				'rules' => 'nullable|image|max:2048',
				'class' => '',
				'value' => 'img/default_banner.jpg',
				'help' => 'Unggah gambar hero untuk halaman About (disarankan 1200x800 px).',
			],
			[
				'type' => 'founders',
				'data' => 'json',
				'name' => 'about_founders',
				'label' => 'Daftar Founder',
				'rules' => 'nullable|array',
				'value' => [
					[
						'name' => 'John Doe',
						'title' => 'Chief Executive Officer',
						'photo' => 'img/avatar-1.png',
						'linkedin' => '#',
					],
					[
						'name' => 'Jane Smith',
						'title' => 'Chief Operating Officer',
						'photo' => 'img/avatar-2.png',
						'linkedin' => '#',
					],
					[
						'name' => 'Alex Lee',
						'title' => 'Chief Technology Officer',
						'photo' => 'img/avatar-3.png',
						'linkedin' => '#',
					],
					[
						'name' => 'Maria Gomez',
						'title' => 'Head of Growth',
						'photo' => 'img/avatar-4.png',
						'linkedin' => '#',
					],
				],
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
                'name' => 'contact_address_en',
                'label' => 'Contact Address (English)',
                'rules' => 'nullable',
                'class' => '',
                'value' => '',
            ],
            [
                'type' => 'textarea',
                'data' => 'string',
                'name' => 'contact_map_embed',
                'label' => 'Map Embed untuk Contact Page (iframe HTML)',
                'rules' => 'nullable',
                'class' => '',
                'value' => '',
                'help' => 'Paste kode iframe Google Maps untuk halaman Contact (ukuran lebih besar).',
                'display' => 'raw',
            ],
            [
                'type' => 'textarea',
                'data' => 'string',
                'name' => 'footer_map_embed',
                'label' => 'Map Embed untuk Footer (iframe HTML)',
                'rules' => 'nullable',
                'class' => '',
                'value' => '',
                'help' => 'Paste kode iframe Google Maps untuk Footer (ukuran lebih kecil).',
                'display' => 'raw',
            ],
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
