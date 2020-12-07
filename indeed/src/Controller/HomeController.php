<?php

namespace App\Controller;

use App\Entity\Offer;
use App\Form\OfferType;
use App\Repository\OfferRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
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

    /**
     * @Route("/makeOffer", name="make_offer")
     */
    public function makeOffer(Request $request, EntityManagerInterface $em)
    {
        $offer = new Offer();

        $form = $this->createForm(OfferType::class, $offer)
            ->add('submit', SubmitType::class);

        $offer->setCreationDate(new \DateTime());
        $offer->setUpdateDate(new \DateTime());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($offer);
            $em->flush();
            return $this->redirectToRoute('home');
        }


        return $this->render('home/makeOffer.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/modifyOffer/{id}", name="modify_offer")
     */
    public function modifyOffer(Offer $offer, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(OfferType::class, $offer)
            ->add('submit', SubmitType::class);

        $offer->setUpdateDate(new \DateTime());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('home/modifyOffer.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
