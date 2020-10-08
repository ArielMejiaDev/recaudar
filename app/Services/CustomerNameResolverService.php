<?php


namespace App\Services;


use Illuminate\Support\Str;

class CustomerNameResolverService
{
    /**
     * @var false|string[]
     */
    private $splitname;

    public function __construct(String $fullname)
    {
        $this->splitname = explode(' ', Str::slug($fullname, ' '), 2);
    }

    public function firstname()
    {
        return $this->splitname[0];
    }

    public function lastname()
    {
        return !empty($this->splitname[1]) ? $this->splitname[1] : '';
    }
}
