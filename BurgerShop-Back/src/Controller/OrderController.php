<?php

namespace App\Controller;
use App\Repository\BurgerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Order;

final class OrderController extends AbstractController
{
    #[Route('/api/orders', name: 'api_orders_create', methods: ['POST'])]
public function create(Request $request, EntityManagerInterface $em): JsonResponse
{
    $data = json_decode($request->getContent(), true);

    if (!$data || !isset($data['items'], $data['total'])) {
        return $this->json(['error' => 'Invalid data'], 400);
    }

    $order = new Order();
    $order->setItems($data['items']);
    $order->setTotal($data['total']);
    $order->setCreatedAt(new \DateTime($data['createdAt'] ?? 'now'));

    if (isset($data['customer'])) {
        $order->setCustomerName($data['customer']['name'] ?? '');
        $order->setCustomerAddress($data['customer']['address'] ?? '');
        $order->setCustomerEmail($data['customer']['email'] ?? '');
    }

    $em->persist($order);
    $em->flush();

    return $this->json([
        'message' => 'Commande enregistrée',
        'id' => $order->getId(), // ✅ L’ID est renvoyé au frontend
    ]);
}

}
