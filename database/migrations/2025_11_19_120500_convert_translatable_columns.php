<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $this->convertServices();
        $this->convertFaqs();
        $this->convertStats();
    }

    public function down(): void
    {
        $this->restoreServices();
        $this->restoreFaqs();
        $this->restoreStats();
    }

    private function convertServices(): void
    {
        if (! Schema::hasTable('services')) {
            return;
        }

        Schema::table('services', function (Blueprint $table) {
            $table->json('name_tmp')->nullable()->after('name_en');
            $table->json('description_tmp')->nullable()->after('description_en');
        });

        DB::table('services')->orderBy('id')->lazy()->each(function ($service) {
            DB::table('services')
                ->where('id', $service->id)
                ->update([
                    'name_tmp' => $this->buildTranslations($service->name, $service->name_en),
                    'description_tmp' => $this->buildTranslations($service->description, $service->description_en, allowEmpty: true),
                ]);
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['name', 'name_en', 'description', 'description_en']);
        });

        Schema::table('services', function (Blueprint $table) {
            $table->json('name')->nullable()->after('slug');
            $table->json('description')->nullable()->after('name');
        });

        DB::statement('UPDATE services SET name = name_tmp, description = description_tmp');

        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['name_tmp', 'description_tmp']);
        });
    }

    private function convertFaqs(): void
    {
        if (! Schema::hasTable('faqs')) {
            return;
        }

        Schema::table('faqs', function (Blueprint $table) {
            $table->json('question_tmp')->nullable()->after('question_en');
            $table->json('answer_tmp')->nullable()->after('answer_en');
        });

        DB::table('faqs')->orderBy('id')->lazy()->each(function ($faq) {
            DB::table('faqs')
                ->where('id', $faq->id)
                ->update([
                    'question_tmp' => $this->buildTranslations($faq->question, $faq->question_en),
                    'answer_tmp' => $this->buildTranslations($faq->answer, $faq->answer_en, allowEmpty: true),
                ]);
        });

        Schema::table('faqs', function (Blueprint $table) {
            $table->dropColumn(['question', 'question_en', 'answer', 'answer_en']);
        });

        Schema::table('faqs', function (Blueprint $table) {
            $table->json('question')->nullable()->after('id');
            $table->json('answer')->nullable()->after('question');
        });

        DB::statement('UPDATE faqs SET question = question_tmp, answer = answer_tmp');

        Schema::table('faqs', function (Blueprint $table) {
            $table->dropColumn(['question_tmp', 'answer_tmp']);
        });
    }

    private function convertStats(): void
    {
        if (! Schema::hasTable('stats')) {
            return;
        }

        Schema::table('stats', function (Blueprint $table) {
            $table->json('label_tmp')->nullable()->after('label_en');
        });

        DB::table('stats')->orderBy('id')->lazy()->each(function ($stat) {
            DB::table('stats')
                ->where('id', $stat->id)
                ->update([
                    'label_tmp' => $this->buildTranslations($stat->label, $stat->label_en),
                ]);
        });

        Schema::table('stats', function (Blueprint $table) {
            $table->dropColumn(['label', 'label_en']);
        });

        Schema::table('stats', function (Blueprint $table) {
            $table->json('label')->nullable()->after('value');
        });

        DB::statement('UPDATE stats SET label = label_tmp');

        Schema::table('stats', function (Blueprint $table) {
            $table->dropColumn(['label_tmp']);
        });
    }

    private function restoreServices(): void
    {
        if (! Schema::hasTable('services')) {
            return;
        }

        Schema::table('services', function (Blueprint $table) {
            $table->string('name_old')->nullable()->after('id');
            $table->string('name_en_old')->nullable()->after('name_old');
            $table->text('description_old')->nullable()->after('slug');
            $table->text('description_en_old')->nullable()->after('description_old');
        });

        DB::table('services')->orderBy('id')->lazy()->each(function ($service) {
            [$source, $english] = $this->unpackTranslations($service->name);
            [$descriptionSource, $descriptionEnglish] = $this->unpackTranslations($service->description);

            DB::table('services')
                ->where('id', $service->id)
                ->update([
                    'name_old' => $source,
                    'name_en_old' => $english,
                    'description_old' => $descriptionSource,
                    'description_en_old' => $descriptionEnglish,
                ]);
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['name', 'description']);
        });

        Schema::table('services', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->string('name_en')->nullable()->after('name');
            $table->text('description')->nullable()->after('slug');
            $table->text('description_en')->nullable()->after('description');
        });

        DB::statement('UPDATE services SET name = name_old, name_en = name_en_old, description = description_old, description_en = description_en_old');

        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['name_old', 'name_en_old', 'description_old', 'description_en_old']);
        });
    }

    private function restoreFaqs(): void
    {
        if (! Schema::hasTable('faqs')) {
            return;
        }

        Schema::table('faqs', function (Blueprint $table) {
            $table->string('question_old')->nullable()->after('id');
            $table->string('question_en_old')->nullable()->after('question_old');
            $table->text('answer_old')->nullable()->after('question');
            $table->text('answer_en_old')->nullable()->after('answer_old');
        });

        DB::table('faqs')->orderBy('id')->lazy()->each(function ($faq) {
            [$questionSource, $questionEnglish] = $this->unpackTranslations($faq->question);
            [$answerSource, $answerEnglish] = $this->unpackTranslations($faq->answer);

            DB::table('faqs')
                ->where('id', $faq->id)
                ->update([
                    'question_old' => $questionSource,
                    'question_en_old' => $questionEnglish,
                    'answer_old' => $answerSource,
                    'answer_en_old' => $answerEnglish,
                ]);
        });

        Schema::table('faqs', function (Blueprint $table) {
            $table->dropColumn(['question', 'answer']);
        });

        Schema::table('faqs', function (Blueprint $table) {
            $table->string('question')->after('id');
            $table->string('question_en')->nullable()->after('question');
            $table->text('answer')->nullable()->after('question_en');
            $table->text('answer_en')->nullable()->after('answer');
        });

        DB::statement('UPDATE faqs SET question = question_old, question_en = question_en_old, answer = answer_old, answer_en = answer_en_old');

        Schema::table('faqs', function (Blueprint $table) {
            $table->dropColumn(['question_old', 'question_en_old', 'answer_old', 'answer_en_old']);
        });
    }

    private function restoreStats(): void
    {
        if (! Schema::hasTable('stats')) {
            return;
        }

        Schema::table('stats', function (Blueprint $table) {
            $table->string('label_old')->nullable()->after('value');
            $table->string('label_en_old')->nullable()->after('label_old');
        });

        DB::table('stats')->orderBy('id')->lazy()->each(function ($stat) {
            [$labelSource, $labelEnglish] = $this->unpackTranslations($stat->label);

            DB::table('stats')
                ->where('id', $stat->id)
                ->update([
                    'label_old' => $labelSource,
                    'label_en_old' => $labelEnglish,
                ]);
        });

        Schema::table('stats', function (Blueprint $table) {
            $table->dropColumn(['label']);
        });

        Schema::table('stats', function (Blueprint $table) {
            $table->string('label')->after('value');
            $table->string('label_en')->nullable()->after('label');
        });

        DB::statement('UPDATE stats SET label = label_old, label_en = label_en_old');

        Schema::table('stats', function (Blueprint $table) {
            $table->dropColumn(['label_old', 'label_en_old']);
        });
    }

    private function buildTranslations(?string $source, ?string $english, bool $allowEmpty = false): ?string
    {
        $translations = [];
        $sourceLocale = config('translatable.source_locale', 'id');

        if ($source !== null && ($allowEmpty || $source !== '')) {
            $translations[$sourceLocale] = $source;
        }

        if ($english !== null && ($allowEmpty || $english !== '')) {
            $translations['en'] = $english;
        }

        if (empty($translations)) {
            return null;
        }

        $locales = config('translatable.locales', ['id', 'en']);
        $fallbackValue = $translations[$sourceLocale] ?? reset($translations);

        foreach ($locales as $locale) {
            if (! isset($translations[$locale]) && $fallbackValue !== null) {
                $translations[$locale] = $fallbackValue;
            }
        }

        return json_encode($translations, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @return array{0: ?string, 1: ?string}
     */
    private function unpackTranslations(?string $payload): array
    {
        if ($payload === null) {
            return [null, null];
        }

        $decoded = json_decode($payload, true);

        if (! is_array($decoded)) {
            return [$payload, $payload];
        }

        $sourceLocale = config('translatable.source_locale', 'id');

        $source = $decoded[$sourceLocale] ?? reset($decoded) ?: null;
        $english = $decoded['en'] ?? $source;

        return [$source, $english];
    }
};
