<?php

namespace App\DataFixtures;

use App\Entity\Station;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StationFixtures extends Fixture
{
    private $stationsList = [
        'Germany' => 'Munich',
        'France' => 'Paris',
        'Portugal' => 'Porto',
        'Spain' => 'Madrid',
    ];

    public function load(ObjectManager $manager)
    {
        $counter = 0;
        foreach ($this->stationsList as $country => $stationName) {
            $station = new Station();
            $station->setName($stationName);
            $station->setCity($stationName);
            $station->setCountry($country);
            $manager->persist($station);
            $this->addReference(Station::class.'_'.$counter, $station);
            ++$counter;
        }

        $manager->flush();
    }
}
