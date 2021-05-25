<?php

namespace App\Controller;

use App\Entity\Station;
use App\Repository\BookingRepository;
use App\Repository\StationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StationController extends AbstractController
{
    #[Route('/stations', name: 'station_list')]
    public function index(StationRepository $stationRepository): Response
    {
        $stations = $stationRepository->findAll();

        return $this->render('station/index.html.twig', [
            'stations' => $stations,
        ]);
    }

    #[Route('/stations/{uuid}/dashboard', name: 'station_dashboard')]
    #[Route('/api/stations/{uuid}/dashboard', name: 'station_dashboard_json')]
    public function dashboard(Station $station, Request $request, BookingRepository $bookingRepository): Response
    {
        $dashboardData = $bookingRepository->findBookingDashboardPerStation($station->getId());

        if ('station_dashboard_json' == $request->get('_route')) {
            return new JsonResponse(['data' => $dashboardData], Response::HTTP_OK);
        }

        return $this->render('station/dashboard.html.twig', [
            'station' => $station,
            'dashboardData' => $dashboardData,
        ]);
    }
}
