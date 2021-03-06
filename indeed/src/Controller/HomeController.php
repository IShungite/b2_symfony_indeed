<?php

namespace App\Controller;

use App\Entity\Offer;
use App\Form\OfferType;
use App\Repository\OfferRepository;
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
     * @Route("/offer/{id}", name="show_offer")
     * @param Offer $offer
     */
    public function showOffer(Offer $offer)
    {
        return $this->render('home/offer.html.twig', [
            'offer' => $offer
        ]);
    }

    /**
     * @Route("/createOffer", name="create_offer")
     */
    public function createOffer(Request $request)
    {
        $offer = new Offer();

        $form = $this->createForm(OfferType::class, $offer)
            ->add('submit', SubmitType::class);

        $offer->setCreationDate(new \DateTime());
        $offer->setUpdateDate(new \DateTime());
        $user = $this->getUser();
        $offer->setOwner($user->getId());


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($offer);
            $em->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('home/createOffer.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/offer/{id}/update", name="modify_offer")
     * @param Offer $offer
     */
    public function updateOffer(Offer $offer, Request $request)
    {
        if ($this->getUser()->getId() != $offer->getOwner())
            return $this->redirectToRoute('home'); 

        $form = $this->createForm(OfferType::class, $offer)
            ->add('submit', SubmitType::class);

        $offer->setUpdateDate(new \DateTime());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('home/updateOffer.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/offer/{id}/delete", name="delete_offer")
     * @param Offer $offer
     */
    public function deleteOffer(Offer $offer)
    {
        if ($this->getUser()->getId() != $offer->getOwner())
            return $this->redirectToRoute('home'); 
            
        $em = $this->getDoctrine()->getManager();
        $em->remove($offer);
        $em->flush();
        return $this->redirectToRoute('home');
    }
}
