<?php

namespace App\Controller;

use App\Entity\Product1;
use App\Form\Product1Type;
use App\Repository\Product1Repository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/product1')]
final class Product1Controller extends AbstractController
{
    #[Route(name: 'app_product1_index', methods: ['GET'])]
    public function index(Product1Repository $product1Repository): Response
    {
        return $this->render('product1/index.html.twig', [
            'product1s' => $product1Repository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_product1_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $product1 = new Product1();
        $form = $this->createForm(Product1Type::class, $product1);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($product1);
            $entityManager->flush();

            return $this->redirectToRoute('app_product1_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('product1/new.html.twig', [
            'product1' => $product1,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_product1_show', methods: ['GET'])]
    public function show(Product1 $product1): Response
    {
        return $this->render('product1/show.html.twig', [
            'product1' => $product1,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_product1_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Product1 $product1, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Product1Type::class, $product1);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_product1_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('product1/edit.html.twig', [
            'product1' => $product1,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_product1_delete', methods: ['POST'])]
    public function delete(Request $request, Product1 $product1, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product1->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($product1);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_product1_index', [], Response::HTTP_SEE_OTHER);
    }
}
