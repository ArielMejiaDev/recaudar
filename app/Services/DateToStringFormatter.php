<?php


namespace App\Services;


use Illuminate\Support\Carbon;

class DateToStringFormatter
{
    public function make(Carbon $date, $language = 'es')
    {
        Carbon::setlocale($language);

        $outputsByLanguage = [
            'en' => 'l jS \\of F Y',
            'es' => 'j \\de F \\de Y',
        ];

        return $date->translatedFormat($outputsByLanguage[$language]);

        //        l domingo
        //        j 27
        //        jS 27th
        //        F septiembre
        //        Y 2020
    }
}
