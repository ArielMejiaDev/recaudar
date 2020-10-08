<?php


namespace App\Services\SEO;


use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;

class LandingPageSeoService
{
    public function execute()
    {
        SEOMeta::addKeyword('recaudar')
            ->setKeywords(['fundaciones', 'caridad', 'beneficiencia'])
            ->setCanonical(config('app.url'))
            ->setNext(route('teams-page'));

        TwitterCard::setImage('https:' . config('app.url') . '/images/landing/hero/bg.jpeg')
            ->setTitle(config('app.url'))
            ->setDescription('Somos el corazón de la caridad, porque conectamos organizaciones y donadores de una manera fácil y segura para cambiar el mundo.')
            ->setUrl(route('welcome'));
    }
}
