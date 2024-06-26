<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Salle;
use App\Entity\Reservation;
use App\Repository\ReservationRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserHistoryController extends AbstractController
{
    #[Route('/users/history', name: 'app_users_history')]
    public function index(ManagerRegistry $doctrine, Security $security): Response
    {
        $user = $this->getUser();
        
        if(!$security->isGranted('IS_NOT_BANNED')){
            return $this->redirectToRoute('app_home');
        }

        if($this->getUser()->getId() !== $user->getId() && !$this->isGranted('ROLE_ADMIN')){
            return $this->redirectToRoute('app_home');
        }
        
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $userList = $doctrine->getRepository(User::class)->findAll();
        $roomList = $doctrine->getRepository(Salle::class)->findAll();
        $reservationList = $doctrine->getRepository(Reservation::class)->findAll();
        

        

        return $this->render('user_history/index.html.twig', [
            'controller_name' => 'UserHistoryController',
            'userList' => $userList,
            'roomList' => $roomList,
            'reservationList' => $reservationList,
        ]);
    }
    #[Route ('/reservations', name: 'app_user_reservations', methods: ['GET'])]
    public function reservations(ReservationRepository $reservationRepo)
    {
        if(!$this->isGranted('ROLE_ADMIN')){
            return $this->redirectToRoute('app_home');
        }

        $reservations = $reservationRepo->findAllReservationsSortedByStartDateAndUser();

        return $this->render('user_history/reservations.html.twig', [
            'reservations' => $reservations
        ]);
    }
}
