<?php

namespace App\Controller;

use App\Form\ProductFormType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class ProductController extends AbstractController
{

    /**
     * Liste des produits
     *  @Route("/product", name="product_list")
     *
     */
    public function list(ProductRepository $repository)
    {
        return $this->render('product/list.html.twig', [
            'product_list' => $repository->findAll()
        ]);
    }


    /**
     * Ajout d'un produit
     * @Route("/product/new", name="product_add")
     */
    public function add(Request $request, EntityManagerInterface $em)
    {
        // création du formulaire
        $productForm =$this->createForm(ProductFormType::class);
        // on passe à la requête au formulaire
        $productForm->handleRequest($request);

        //on vérifie que le formulaire est envoyé et valide
        if($productForm->isSubmitted() && $productForm ->isValid()){
            // On récupère les données du formulaire
        $product = $productForm->getData();
            $em->persist($product); // un peu comme le git commit.
            $em->flush(); // le flush permet d'exécuter et que ca soit ajouter à notre BDD

            // Redirection sur la liste des produits
            return $this->redirectToRoute('product_list');
        }
        return $this->render('product/add.html.twig',[
        'product_form' =>$productForm->createView()
            ]);

    }
    /**
     * Modification d'un produit
     * @Route("/product/{id}/edit", name="product_edit")
     */
    public function edit($id)
    {
        return $this->render('product/edit.html.twig');
    }
}
