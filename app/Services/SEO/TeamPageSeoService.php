<?php


namespace App\Services\SEO;


use App\Models\Team;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;

class TeamPageSeoService
{
    public function execute()
    {
        SEOMeta::setTitle('Fundaciones')
            ->setDescription('Lista de fundaciones')
            ->setCanonical(route('teams-page'))
            ->setPrev(route('welcome'));

        $images = Team::select('logo')
            ->where('name', '!=', 'recaudar')
            ->where('status', 'approved')
            ->limit(15)
            ->pluck('logo')
            ->toArray() ??
            Team::select('banner')
                ->where('name', '!=', 'recaudar')
                ->where('status', 'approved')
                ->limit(15)
                ->pluck('banner')
                ->toArray() ?? [
                'https:' . config('app.url') . '/images/landing/hero/bg.jpeg',
            ];

        OpenGraph::addImage(config('app.url') . '/images/landing/hero/bg.jpeg')
            ->addImages($images)
            ->setTitle('Fundaciones - ' . config('app.name'))
            ->setDescription('Lista de fundaciones')
            ->setUrl(route('teams-page'))
            ->setSiteName('Fundaciones ' . config('app.name'));

        TwitterCard::setImage(config('app.url') . '/images/landing/hero/bg.jpeg')
            ->setTitle('Fundaciones - ' . config('app.name'))
            ->setDescription('Somos el corazón de la caridad, porque conectamos organizaciones y donadores de una manera fácil y segura para cambiar el mundo.')
            ->setUrl(route('teams-page'));
    }
}
