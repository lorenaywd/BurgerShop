<?php

namespace App\Controller;

use App\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class ClientController extends AbstractController
{
    #[Route('/api/auth/register', name: 'client_register', methods: ['POST'])]
    public function register(
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordHasher
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);

        $email = $data['email'] ?? null;
        $password = $data['password'] ?? null;

        if (!$email || !$password) {
            return $this->json(['error' => 'Champs manquants'], 400);
        }

        $client = new Client();
        $client->setEmail($email);
        $client->setPassword($passwordHasher->hashPassword($client, $password));
        $client->setCreatedAt(new \DateTimeImmutable());

        $em->persist($client);
        $em->flush();

        return $this->json(['message' => 'Client créé avec succès']);
    }

    #[Route('/api/auth/login', name: 'api_login', methods: ['POST'])]
    public function login(
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordHasher,
        JWTTokenManagerInterface $jwtManager
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);
        $email = $data['email'] ?? null;
        $password = $data['password'] ?? null;

        if (!$email || !$password) {
            return $this->json(['error' => 'Email et mot de passe requis.'], 400);
        }

        // Recherche du client par email
        $client = $em->getRepository(Client::class)->findOneBy(['email' => $email]);

        if (!$client) {
            return $this->json(['error' => 'Identifiants invalides.'], 401);
        }

        // Vérification du mot de passe
        if (!$passwordHasher->isPasswordValid($client, $password)) {
            return $this->json(['error' => 'Identifiants invalides.'], 401);
        }

        // Génération du token JWT
        $token = $jwtManager->create($client);

        return $this->json([
            'token' => $token,
            'user' => [
                'id' => $client->getId(),
                'email' => $client->getEmail(),
            ],
        ]);
    }
}
