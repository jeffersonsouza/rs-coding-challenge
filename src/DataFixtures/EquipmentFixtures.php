<?php

namespace App\DataFixtures;

use App\Entity\Equipment;
use App\Entity\Station;
use App\Entity\StationEquipment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EquipmentFixtures extends Fixture implements DependentFixtureInterface
{
    private $equipmentsList = [
        'portable toilets',
        'bed sheets',
        'sleeping bags',
        'camping tables',
        'camping chairs',
        'Darkening system',
        'Drive Van Tent',
        'Packingbags',
        'Mosquito net',
        'Cutlery',
        'Camera',
        'Bicycle carrier for 2 bikes',
        'Child car seat',
    ];

    public function load(ObjectManager $manager)
    {
        foreach ($this->equipmentsList as $key => $equipmentName) {
            $equipment = new Equipment();
            $equipment->setName($equipmentName);
            $manager->persist($equipment);
            $this->addReference(Equipment::class.'_'.$key, $equipment);

            for ($s = 0; $s <= 3; ++$s) {
                $stationEquipment = new StationEquipment();
                $stationEquipment->setEquipment($equipment);
                $stationEquipment->setStation($this->getReference(Station::class.'_'.$s));
                $stationEquipment->setQuantity(mt_rand(40, 50));

                $manager->persist($stationEquipment);
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            StationFixtures::class,
        ];
    }
}
