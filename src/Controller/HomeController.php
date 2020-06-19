<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        #templates/     'home.html.twig'
        return $this->render('home.html.twig', [
            'pseudo' => "John Doe",
            'liste' => [
                'foo',
                'bar',
                'baz',
            ]
    ]);
    }

    /**
     * On place les paramètres dynamiques entre accolades
     * URI valide /test/42
     *  @Route("/test", name="test")
     */
    public function test(EntityManagerInterface $em)

    {
       // Création d'une entité
        $product = new Product();

        $product
            ->setname('jeans')
            ->setDescription('un super jean !')
            ->setprice(79.99)
            ->setQuantity(50)
            ;


        //fonction de debug dump and die
        dump($product);
        //Enregistrement (insertion)
        //1. préparer à l'enregistrement d'une entité
        $em->persist($product);
        //2. Exéciyet les requêtes SQL
        $em->flush();
        dd($product);
    }
    /**@Route("listeProduit/", name="listeProduit") */

}
