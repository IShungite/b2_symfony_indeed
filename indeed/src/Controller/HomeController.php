<?php

namespace App\Controller;

use App\Entity\Offer;
use App\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(OfferRepository $repo)
    {
        $offers = $repo->findAll();

        return $this->render('home/index.html.twig', [
            'offers' => $offers
        ]);
    }

    /**
     * @Route("/offer/{id}", name="show_post")
     */
    public function show(Offer $offer)
    {
        return $this->render('home/offer.html.twig', [
            'offer' => $offer
        ]);
    }
}
