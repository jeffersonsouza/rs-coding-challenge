<?php

namespace App\DataFixtures;

use App\Entity\Booking;
use App\Entity\BookingEquipment;
use App\Entity\Campervan;
use App\Entity\Equipment;
use App\Entity\Station;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OrderFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($b = 0; $b <= 99; ++$b) {
            $booking = new Booking();
            $booking->setStartStation($this->getReference(Station::class.'_'.mt_rand(0, 1)));
            $booking->setFinishStation($this->getReference(Station::class.'_'.mt_rand(2, 3)));
            $booking->setStartDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
            $booking->setFinishDate(new \DateTime(sprintf('-%d days', rand(15, 100))));
            $booking->setCampervan($this->getReference(Campervan::class.'_'.mt_rand(0, 13)));

            $equipmentsPerOrder = mt_rand(1, 5);
            for ($be = 0; $be <= $equipmentsPerOrder; ++$be) {
                $bookingEquipment = new BookingEquipment();
                $bookingEquipment->setBooking($booking);
                $bookingEquipment->setEquipment($this->getReference(Equipment::class.'_'.mt_rand(0, 12)));
                $bookingEquipment->setQuantity(mt_rand(1, 5));
            }

            $manager->persist($booking);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            StationFixtures::class,
            EquipmentFixtures::class,
        ];
    }
}
