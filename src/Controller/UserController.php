<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Partenaire;
use App\Repository\PartenaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Compenent\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;


/**
 * @Route("/api")
 */

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }


    /**
     * @Route("/api/partenaires", name="ajouPartenaire",methods={"POST"}) 
     */
    public function ajoutPartenaire(Partenaire $partenaire,Request $request,SerializerInterface $serializer, EntityManagerInterface $entityManager)
    {
        $partenaire=$serializer->deserialize($request->getContent(),Partenaire::class,'json');
        $entityManager->persist($partenaire);
        $entityManager->flush();
        $data=[
            'status'=>201,
            'message'=>'partenaire ajouté'
        ];

        return new JsonResponse($data,201);
    }
}
