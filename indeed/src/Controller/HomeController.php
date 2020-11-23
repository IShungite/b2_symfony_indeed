<?php

namespace App\Controller;

use App\Entity\Offer;
use App\Repository\OfferRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/makeOffer", name="makeOffer")
     */
    public function makeOffer(Request $request, EntityManagerInterface $em)
    {
        $offre = new Offer();
        $form = $this->createFormBuilder($offre)
            ->add('title')
            ->add('description')
            ->add('adresse')
            ->add('postal_code')
            ->add('city')
            ->add('contract_end')
            ->add('contract')
            ->add('contract_type')
            ->add('submit', SubmitType::class)
            ->getForm();

        $offre->setCreationDate(new \DateTime());
        $offre->setUpdateDate(new \DateTime());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($offre);
            $em->flush();
        }


        return $this->render('home/makeOffer.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
