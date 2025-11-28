<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $defaultLocale = config('app.locale', config('app.fallback_locale', 'en'));
        $availableLocales = array_keys(config('app.available_locales', []));

        $locale = session()->get('locale', $defaultLocale);

        if (! in_array($locale, $availableLocales, true)) {
            $locale = $defaultLocale;
            session()->put('locale', $locale);
        }

        App::setLocale($locale);

        $localeCandidates = $this->localeCandidates($locale);

        if ($localeCandidates !== []) {
            setlocale(LC_TIME, ...$localeCandidates);
        }

        try {
            Carbon::setLocale($locale);
        } catch (\Throwable $e) {
            // Ignore when Carbon does not support this locale.
        }

        return $next($request);
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
