<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture
{
    public const LAFAY_PROGRAM_REFERENCE = 'lafay-program';
    public const BRUNO_PROGRAM_REFERENCE = 'bruno-program';

    public function load(ObjectManager $manager): void
    {
        foreach ($this->getData() as $programData) {
            $program = new Program();
            $program->setName($programData['name']);
            $manager->persist($program);
            $manager->flush();

            if (!empty($programData['reference'])) {
                $this->addReference($programData['reference'], $program);
            }
        }
    }

    private function getData(): array
    {
        return [
            ['name' => 'Méthode LaFay', 'reference' => self::LAFAY_PROGRAM_REFERENCE],
            ['name' => 'Chez Bruno', 'reference' => self::BRUNO_PROGRAM_REFERENCE],
        ];
    }
}
