<?php

namespace App\DataFixtures;

use App\Entity\Campervan;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CampervanFixtures extends Fixture
{
    private $campervanList = [
        'Winnebago Revel Camper Van',
        'Nomad Vanz Sprinter Conversion',
        'Ford Terrier M Sport',
        'Knauss Boxstar 600',
        'Dalbury E Electric',
        'VW Crafter VanWorx ',
        'School Bus – Paved to Pines ',
        'Benchmark Ford Transit Camper',
        'Sportsmobile Classic  ',
        'VW Caddy',
        'Hymer Aktiv 2.0',
        'EarthCruiser GZL 300',
        'Ram Promaster City',
        'VW Bus',
    ];

    public function load(ObjectManager $manager)
    {
        foreach ($this->campervanList as $key => $campervanName) {
            $campervan = new Campervan();
            $campervan->setName($campervanName);
            $manager->persist($campervan);
            $this->addReference(Campervan::class.'_'.$key, $campervan);
        }

        $manager->flush();
    }
}
