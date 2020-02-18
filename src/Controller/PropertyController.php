<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
//use Doctrine\Persistence\ObjectManager;
use App\Entity\Property;
use App\Repository\PropertyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\QueryBuilder;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use Symfony\Component\Form\FormView;



class PropertyController extends AbstractController
{

  private $repository;
  private $em;

//utilise le EntityManagerInterface
  public function __construct(PropertyRepository $repository, EntityManagerInterface $em)
  {
    $this->repository = $repository;
    $this->em = $em;
  }

  /**
  *@Route("/biens", name="property.index")
  *@return Response
  */
  public function index(PaginatorInterface $paginator, Request $request): Response
  {

    $search = new PropertySearch();
    $form = $this->createForm(PropertySearchType::class, $search);
    $form->handleRequest($request);

    $properties = $paginator->paginate(
        $this->repository->findAllVisibleQuery($search),
        $request->query->getInt('page', 1),
        12
    );
    return $this->render('property/index.html.twig', [
      'current_menu' => 'properties',
      'properties' => $properties,
      'form' => $form->createView()

    ]);
  }

  /**
  *@Route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
  */
  public function show(Property $property, string $slug): Response
  {
    if($property->getSlug() !== $slug) {
        return $this->redirectToRoute('property.show', [
            'id' => $property->getId(),
            'slug' => $property->getSlug()
        ], 301);
    }
    return $this->render('property/show.html.twig', [
      'property' => $property,
      'current_menu' => 'properties'
    ]);

  }




}
