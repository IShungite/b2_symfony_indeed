<?php

namespace App\Controller;

use App\Entity\Offer;
use App\Form\ContractType;
use App\Form\ContractTypeType;
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
        $offre = new Offer();
        $form = $this->createFormBuilder($offre)
            ->add('title')
            ->add('description')
            ->add('adresse')
            ->add('postal_code')
            ->add('city')
            ->add('contract_end')
            ->add('contract', ContractType::class)
            ->add('contract_type', ContractTypeType::class)
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
