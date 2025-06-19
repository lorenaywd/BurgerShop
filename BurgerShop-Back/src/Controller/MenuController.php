<?php

namespace App\Controller;

use App\Repository\BurgerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Burger;

final class MenuController extends AbstractController
{
    #[Route('/menu/{type}', name: 'app_menu', requirements: ['type' => 'boeuf|fish|chicken|veggie'], defaults: ['type' => null])]
public function index(BurgerRepository $burgers, ?string $type): Response
{
    if ($type) {
        $burgersList = $burgers->findBy(['type' => $type]);
    } else {
        $burgersList = $burgers->findAll();
    }

    return $this->render('menu/index.html.twig', [
        'controller_name' => 'MenuController',
        'burgers' => $burgersList,
        'type' => $type
    ]);
}

    #[Route('/add-burger', name: 'add_burger')]
    public function addBurger(EntityManagerInterface $em): Response
    {
        $burger = new Burger();
        $burger->setName('Veggie Burger');
        $burger->setPrice(4.99);

        $burger->setDescription('A delicious veggie burger with fresh vegetables and a special sauce.');
        $burger->setImage('https://www.gardengourmet.be/sites/default/files/recipes/472a6839884de87337ab731dff8b9a48_200828_MEDIAMONKS_GG_Vegetarian.jpg');
        $burger->setType('Vegetarian');

        $em->persist($burger);
        $em->flush();

        return new Response('Burger ajouté avec ID ' . $burger->getId());
    }

    #[Route('/import-burgers', name: 'import_burgers')]
    public function importBurgers(EntityManagerInterface $em)
{
    $burgersData = [
        ['Classic Beef Burger', 'boeuf', 5.99],
        ['Cheese Beef Burger', 'boeuf', 6.49],
        ['Spicy Chicken Burger', 'chicken', 6.99],
        ['Crispy Fish Burger', 'fish', 7.29],
        ['Veggie Delight', 'veggie', 5.49],
        ['BBQ Beef Burger', 'boeuf', 7.19],
        ['Chicken Avocado', 'chicken', 7.59],
        ['Fish & Chips Burger', 'fish', 7.99],
        ['Mushroom Veggie', 'veggie', 6.29],
    ];

    foreach ($burgersData as [$name, $type, $price]) {
        $burger = new Burger();
        $burger->setImage('https://www.gardengourmet.be/sites/default/files/recipes/472a6839884de87337ab731dff8b9a48_200828_MEDIAMONKS_GG_Vegetarian.jpg');
        $burger->setName($name);
        $burger->setType($type);
        $burger->setDescription('Can I get some burgers ?');
        $burger->setPrice($price);
        $em->persist($burger);
    }

    $em->flush();
    return new Response('Burgers importés');
}
}
