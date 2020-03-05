<?php
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

use Symfony\Component\HttpFoundation\RequestStack;

class AppExtension extends AbstractExtension
{

    protected $request;

    public function __construct(RequestStack $req){
        $this->request = $req;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('active_link', [$this, 'active_link']),
        ];
    }

    public function active_link($expected_route)
    {
        $output = "";

        $routeName = $this->request->getCurrentRequest()->get('_route');

        if($routeName === $expected_route){
            $output = "active";
        }

        return $output;
    }

}