<?php


namespace App\Services\SEO;


use App\Models\Team;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;

class TeamProfilePageSeoService
{
    public function execute(Team $team)
    {
        $images = $team->plans()->pluck('banner')->toArray();

        SEOMeta::setTitle($team->name)
            ->setKeywords([$team->name, $team->public])
            ->setDescription('Perfil de la fundación ' . $team->name . ' en ' . config('app.url'))
            ->setCanonical(route('profile-page', $team))
            ->setPrev(config('app.url') . '/fundaciones');

        OpenGraph::addImage($team->banner)
            ->addImages(array_merge([$team->logo, $team->banner], $images))
            ->setTitle($team->name)
            ->setDescription('Perfil de la fundación ' . $team->name . ' en ' . config('app.url'))
            ->setUrl(route('profile-page', $team))
            ->setSiteName(route('profile-page', $team));

        TwitterCard::setImage($team->logo)
            ->setTitle($team->name)
            ->setDescription('Perfil de la fundacioón ' . $team->name . ' en ' . config('app.url'))
            ->setUrl(route('profile-page', $team));
    }
}
