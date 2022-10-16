<?php

namespace App\DataFixtures;

use App\Entity\Training;
use Carbon\CarbonPeriod;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TrainingFixtures extends Fixture implements DependentFixtureInterface
{
    public const MONDAY_TRAINING_REFERENCE = 'monday-training';
    public const TUESDAY_TRAINING_REFERENCE = 'tuesday-training';

    public function load(ObjectManager $manager): void
    {
        $period = CarbonPeriod::create('2022-04-25', '2022-04-26');
        $testUser = $this->getReference(UserFixtures::TEST_USER);
        $terminatorSubProgram = $this->getReference(SubProgramFixtures::TERMINATOR_SUB_PROGRAM);
        $firstSubProgram = $this->getReference(SubProgramFixtures::FIRST_SUB_PROGRAM);

        foreach ($period as $date) {
            $training = new Training();
            $training->setDate($date);
            $training->setUser($testUser);
            $training->setSubProgram($date->isMonday() ? $terminatorSubProgram : $firstSubProgram);

            $manager->persist($training);

            $this->addReference(
                $date->isMonday() ? self::MONDAY_TRAINING_REFERENCE : self::TUESDAY_TRAINING_REFERENCE,
                $training
            );
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            SubProgramFixtures::class
        ];
    }
}