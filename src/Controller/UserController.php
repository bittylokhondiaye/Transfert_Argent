<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Partenaire;
use App\Entity\UserPartenaire;
use App\Repository\PartenaireRepository;
use App\Repository\UserPartenaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Response;

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
     * @Route("api/partenaires", name="ajouPartenaire",methods={"POST"}) 
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


    /**
     * @Route("/userPartenaires", name="addUserPartenaire", methods={"POST"})
     */
    public function addUserPartenaire(Request $request, SerializerInterface $serializer,EntityManagerInterface $entityManager)
    {
        $userPartenaire = $serializer->deserialize($request->getContent(), UserPartenaire::class, 'json');
        $entityManager->persist($userPartenaire);
        $entityManager->flush();
        $data = [
            'status' => 201,
            'message' => 'Le UserPartenaire a bien été ajouté'
        ];
        return new JsonResponse($data, 201);
    }

}
