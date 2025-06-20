<?php

namespace App\Controller;

use App\Repository\BurgerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Burger;
use App\Entity\Ingredient;
use Symfony\Component\HttpFoundation\JsonResponse;

final class MenuController extends AbstractController
{
    #[Route('api/menu/{type}', name: 'api_menu', requirements: ['type' => 'boeuf|fish|chicken|veggie'], defaults: ['type' => null])]
    public function apiMenu(?string $type, BurgerRepository $repo): JsonResponse
    {
        $burgers = $type ? $repo->findBy(['type' => $type]) : $repo->findAll();
        return $this->json(array_map(fn($b) => $b->toArray(), $burgers));
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
    $ingredientsList = [
        'jambon' => (new Ingredient())->setName('Jambon'),
        'salade' => (new Ingredient())->setName('Salade'),
        'tomate' => (new Ingredient())->setName('Tomate'),
        'oignon' => (new Ingredient())->setName('Oignon'),
        'cheddar' => (new Ingredient())->setName('Cheddar'),
        'sauce BBQ' => (new Ingredient())->setName('Sauce BBQ'),
        'sauce mayo' => (new Ingredient())->setName('Sauce Mayo'),
        'sauce tomate' => (new Ingredient())->setName('Sauce Tomate'),
        'pain brioché' => (new Ingredient())->setName('Pain Brioché'),
        'pain au sésame' => (new Ingredient())->setName('Pain au Sésame'),
    ];

    foreach ($ingredientsList as $ingredient) {
        $em->persist($ingredient);
    }

    $burgersData = [
        ['Double beef cheese Burger', 'boeuf', 5.99, "burger1.png", ['pain brioché', 'jambon', 'cheddar', 'salade'], 'Double steak de boeuf avec fromage fondu et jambon croustillant.'],
        ['Bacon Beef cheese Burger', 'boeuf', 6.49, "burger3.png", ['pain au sésame', 'jambon', 'sauce BBQ'], 'Burger classique avec bacon fumé et sauce BBQ maison.'],
        ['Spicy Chicken Burger', 'chicken', 6.99, "burger4.png", ['pain brioché', 'sauce mayo', 'salade', 'tomate'], 'Poulet épicé mariné avec salade fraîche et sauce mayo relevée.'],
        ['Crispy Fish Burger', 'fish', 7.29, "burger12.png", ['pain au sésame', 'sauce tomate', 'salade', 'oignon'], 'Filet de poisson croustillant accompagné d’une sauce tomate douce.'],
        ['Veggie Delight', 'veggie', 5.49, "burger15.png", ['pain brioché', 'salade', 'tomate', 'oignon'], 'Burger végétarien avec légumes frais et pain brioché moelleux.'],
        ['BBQ Beef Burger', 'boeuf', 7.19, "burger10.png", ['pain au sésame', 'sauce BBQ', 'cheddar'], 'Steak juteux avec cheddar fondu et sauce BBQ fumée.'],
        ['Chicken Avocado', 'chicken', 7.59, "burger15.png", ['pain brioché', 'salade', 'sauce mayo'], 'Poulet grillé avec avocat crémeux et sauce mayo légère.'],
        ['Fish & Chips Burger', 'fish', 7.99, "burger14.png", ['pain au sésame', 'sauce tomate'], 'Poisson frit accompagné de sa sauce tomate maison.'],
        ['Mushroom Veggie', 'veggie', 6.29, "burger2.png", ['pain brioché', 'salade', 'tomate', 'cheddar'], 'Délice végétarien avec champignons sautés et cheddar fondant.'],
    ];

    foreach ($burgersData as [$name, $type, $price, $image, $ingredientsKeys, $description]) {
        $burger = new Burger();
        $burger->setName($name);
        $burger->setType($type);
        $burger->setPrice($price);
        $burger->setImage($image);
        $burger->setDescription($description);

        foreach ($ingredientsKeys as $key) {
            if (isset($ingredientsList[$key])) {
                $burger->addIngredient($ingredientsList[$key]);
            }
        }

        $em->persist($burger);
    }

    $em->flush();

    return new Response('Burgers importés');
}

}
