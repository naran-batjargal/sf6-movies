<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Form\AdFormType;
use App\Repository\AdRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class AdController extends AbstractController
{
    private $em;
    private $adRepository;
    private $paginator;

    public function __construct(EntityManagerInterface $em, AdRepository $adRepository, PaginatorInterface $paginator)
    {
        $this->em = $em;
        $this->adRepository = $adRepository;
        $this->paginator = $paginator;
    }

    #[Route('/ads', name: 'ads')]
    public function index(Request $request): Response
    {
        $ads = $this->adRepository->findAll();

        $dql   = "SELECT a FROM App\Entity\Ad a ORDER BY a.id DESC";
        $query = $this->em->createQuery($dql);

        $pagination = $this->paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            20 /*limit per page*/
        );

        //dd($pagination);
        return $this->render('ads/index.html.twig', [
            'ads' => $ads,
            'pagination' => $pagination
        ]);
    }

    #[Route('/ads/create', name: 'create_ad')]
    public function create(Request $request): Response
    {
        $ad = new Ad();
        $form = $this->createForm(AdFormType::class, $ad);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newAd = $form->getData();
            //$imagePath = $form->get('imagePath')->getData();

            // if ($imagePath) {
            //     $newFileName = uniqid() . '.' . $imagePath->guessExtension();

            //     try {
            //         $imagePath->move(
            //             $this->getParameter('kernel.project_dir') . '/public/uploads',
            //             $newFileName
            //         );
            //     } catch (FileException $e) {
            //         return new Response($e->getMessage());
            //     }
            //     $newAd->setUserId($this->getUser()->getId());
            //     $newAd->setImagePath('/uploads/' . $newFileName);
            // }

            //$newAd->setUserId($this->getUser()->getId());
            $this->em->persist($newAd);
            $this->em->flush();

            return $this->redirectToRoute('ads');
        }

        return $this->render('ads/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/ads/delete/{id}', methods: ['GET', 'DELETE'], name: 'delete_ad')]
    public function delete($id): Response
    {
        $this->checkLoggedInUser($id);
        $ad = $this->adRepository->find($id);
        $this->em->remove($ad);
        $this->em->flush();

        return $this->redirectToRoute('ads');
    }


    #[Route('/ads/{id}', methods: ['GET'], name: 'show_ad')]
    public function show($id): Response
    {
        $ad = $this->adRepository->find($id);

        return $this->render('ads/show.html.twig', [
            'ad' => $ad
        ]);
    }

    private function checkLoggedInUser($adId)
    {
        if ($this->getUser() == null || $this->getUser()->getId() !== $adId) {
            return $this->redirectToRoute('ads');
        }
    }
}
