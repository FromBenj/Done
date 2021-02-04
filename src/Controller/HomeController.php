<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HomeController extends AbstractController
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        return $this->render('home/index.html.twig');
    }

    /**
     * @Route("/citation", name="citation")
     */
    public function index(): Response
    {
        $response = $this->client->request(
            'GET',
            'https://type.fit/api/quotes'
        );
        $citations = $response->toArray();
        $citation = $citations[rand(0, count($citations))];

        return $this->render('home/citation.html.twig', [
            'citation' => $citation
        ]);
    }
}
