<?php

namespace App\DataFixtures;

use App\Entity\SubProgram;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SubProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const FIRST_SUB_PROGRAM = 'first-sub-program';
    public const TERMINATOR_SUB_PROGRAM = 'terminator-sub-program';

    public function load(ObjectManager $manager): void
    {
        foreach ($this->getData() as $subProgramData) {
            $subProgram = new SubProgram();
            $subProgram->setName($subProgramData['name']);
            $subProgram->setProgram($subProgramData['program']);
            $manager->persist($subProgram);

            if (!empty($subProgramData['reference'])) {
                $this->addReference($subProgramData['reference'], $subProgram);
            }
        }

        $manager->flush();
    }

    /**
     * @return array<array<string, mixed>>
     */
    private function getData(): array
    {
        return [
            [
                'name' => 'Premier Programme',
                'program' => $this->getReference(ProgramFixtures::LAFAY_PROGRAM_REFERENCE),
                'reference' => self::FIRST_SUB_PROGRAM,
            ],
            [
                'name' => 'Deuxième Programme',
                'program' => $this->getReference(ProgramFixtures::LAFAY_PROGRAM_REFERENCE),
            ],
            [
                'name' => 'Terminator session',
                'program' => $this->getReference(ProgramFixtures::BRUNO_PROGRAM_REFERENCE),
                'reference' => self::TERMINATOR_SUB_PROGRAM,
            ],
        ];
    }

    public function getDependencies(): array
    {
        return [
            ProgramFixtures::class,
        ];
    }
}
