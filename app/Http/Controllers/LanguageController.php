<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function switch($language)
    {
        $availableLocales = array_keys(config('app.available_locales', []));

        if (! in_array($language, $availableLocales, true)) {
            abort(404);
        }

        App::setLocale($language);

        session()->put('locale', $language);

        $localeCandidates = $this->localeCandidates($language);

        if ($localeCandidates !== []) {
            setlocale(LC_TIME, ...$localeCandidates);
        }

        try {
            Carbon::setLocale($language);
        } catch (\Throwable $e) {
            // Ignore when Carbon does not support this locale.
        }

        $localeLabel = config("app.available_locales.$language", strtoupper($language));

        flash()
            ->success(__('Language changed to').' '.$localeLabel)
            ->important();

        return redirect()->back();
    }

    /**
     * Generate locale strings understood by PHP's setlocale.
     */
    private function localeCandidates(string $locale): array
    {
        $standard = config("app.locale_aliases.$locale");

        return array_values(array_filter([
            $standard,
            $locale.'_'.strtoupper($locale),
            $locale,
        ]));
    }
}
