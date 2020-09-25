<?php


namespace App\Services;


class LocaleCodeResolver
{
    public $countryCode;
    public $currencyCode;

    public function getLocaleFrom(string $country)
    {
        $bcp47 = [
            'Canada' => 'en-CA',
            'United States' => 'en-US',
            'Mexico' => 'es-MX',
            'Guatemala' => 'es-GT',
            'Belize' => 'en-BZ',
            'El Salvador' => 'es-SV',
            'Honduras' => 'es-HN',
            'Nicaragua' => 'es-NI',
            'Panama' => 'es-PA',
            'Costa Rica' => 'es-CR',
            'Colombia' => 'es-CO',
            'Venezuela' => 'es-VE',
            'Brasil' => 'pr-BR',
            'Ecuador' => 'es-EC',
            'Peru' => 'es-PE',
            'Bolivia' => 'es-BO',
            'Chile' => 'es-CL',
            'Paraguay' => 'es-PY',
            'Argentina' => 'es-AR',
            'Uruguay' => 'es-UY',
            'Puerto Rico' => 'es-PR',
            'Cuba' => 'es-CU',
            'Filipinas' => 'es-PH',
            'Republica Dominicana' => 'es-DO',
            'España' => 'es-ES',
            'Guinea Ecuatorial' => 'es-GQ',
        ];

        $ISO4217 = [
            'Canada' => 'CAD',
            'United States' => 'USD',
            'Mexico' => 'MXN',
            'Guatemala' => 'GTQ',
            'Belize' => 'BZD',
            'El Salvador' => 'USD',
            'Honduras' => 'HNL',
            'Nicaragua' => 'NIO',
            'Panama' => 'USD',
            'Costa Rica' => 'CRC',
            'Colombia' => 'COP',
            'Venezuela' => 'VEF',
            'Brasil' => 'BRL',
            'Ecuador' => 'USD',
            'Peru' => 'PEN',
            'Bolivia' => 'BOB',
            'Chile' => 'CLP',
            'Paraguay' => 'PYG',
            'Argentina' => 'ARS',
            'Uruguay' => 'UYU',
            'Puerto Rico' => 'USD',
            'Cuba' => 'CUP',
            'Filipinas' => 'PHP',
            'Republica Dominicana' => 'DOP',
            'España' => 'EUR',
            'Guinea Ecuatorial' => 'XAF',
        ];

        $this->countryCode = $bcp47[$country] ?? 'en-US';
        $this->currencyCode = $ISO4217[$country] ?? 'USD';
        return $this;
    }

    public function countryCode()
    {
        return $this->countryCode;
    }

    public function currencyCode()
    {
        return $this->currencyCode;
    }
}
