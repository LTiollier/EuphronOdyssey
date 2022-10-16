<?php

namespace App\DataFixtures;

use App\Entity\Exercise;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ExerciseFixtures extends Fixture
{
    public const A3_EXERCISE = 'a3-exercise';
    public const A1_EXERCISE = 'a1-exercise';
    public const D_EXERCISE = 'd-exercise';
    public const C1_EXERCISE = 'c1-exercise';
    public const E_EXERCISE = 'e-exercise';
    public const F_EXERCISE = 'f-exercise';
    public const G_EXERCISE = 'g-exercise';
    public const K2_EXERCISE = 'k2-exercise';

    public const FIRST_SUB_PROGRAM_EXERCISES = [
        self::A3_EXERCISE,
        self::A1_EXERCISE,
        self::D_EXERCISE,
        self::C1_EXERCISE,
        self::E_EXERCISE,
        self::F_EXERCISE,
        self::G_EXERCISE,
        self::K2_EXERCISE
    ];

    public const DEVELOPPE_COUCHE_EXERCISE = 'developpe-couche-exercise';
    public const TRACTION_EXERCISE = 'traction-exercise';
    public const PAPILLON_EXERCISE = 'papillon-exercise';

    public const MONDAY_EXERCISES = [
        self::DEVELOPPE_COUCHE_EXERCISE,
        self::TRACTION_EXERCISE,
        self::PAPILLON_EXERCISE
    ];

    public function load(ObjectManager $manager): void
    {
        foreach ($this->getData() as $exerciseData) {
            $exercise = new Exercise();
            $exercise->setName($exerciseData['name']);
            $exercise->setSeries($exerciseData['series']);
            $manager->persist($exercise);

            if (!empty($exerciseData['reference'])) {
                $this->addReference($exerciseData['reference'], $exercise);
            }
        }

        $manager->flush();
    }

    private function getData(): array
    {
        return [
            ['name' => 'A3', 'series' => 3, 'reference' => self::A3_EXERCISE],
            ['name' => 'A1', 'series' => 3, 'reference' => self::A1_EXERCISE],
            ['name' => 'D', 'series' => 3, 'reference' => self::D_EXERCISE],
            ['name' => 'C1', 'series' => 3, 'reference' => self::C1_EXERCISE],
            ['name' => 'E', 'series' => 2, 'reference' => self::E_EXERCISE],
            ['name' => 'F', 'series' => 2, 'reference' => self::F_EXERCISE],
            ['name' => 'G', 'series' => 2, 'reference' => self::G_EXERCISE],
            ['name' => 'K2', 'series' => 2, 'reference' => self::K2_EXERCISE],

            ['name' => 'Développé couché', 'series' => 3, 'reference' => self::DEVELOPPE_COUCHE_EXERCISE],
            ['name' => 'Traction', 'series' => 3, 'reference' => self::TRACTION_EXERCISE],
            ['name' => 'Papillon', 'series' => 3, 'reference' => self::PAPILLON_EXERCISE],
        ];
    }
}