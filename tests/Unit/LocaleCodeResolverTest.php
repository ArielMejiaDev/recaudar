<?php

namespace Tests\Unit;

use App\Services\LocaleCodeResolver;
use PHPUnit\Framework\TestCase;

class LocaleCodeResolverTest extends TestCase
{
    /** @test */
    public function test_locale_from_specific_country()
    {
        $locale = (new LocaleCodeResolver)->getLocaleFrom('Guatemala');
        $this->assertEquals('es-GT', $locale->countryCode());
        $this->assertEquals('GTQ', $locale->currencyCode());
        $anotherLocale = (new LocaleCodeResolver)->getLocaleFrom('United States');
        $this->assertEquals('en-US', $anotherLocale->countryCode());
        $this->assertEquals('USD', $anotherLocale->currencyCode());
    }
}
