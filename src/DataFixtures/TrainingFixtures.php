<?php

namespace App\DataFixtures;

use App\Entity\SubProgram;
use App\Entity\Training;
use App\Entity\User;
use Carbon\CarbonInterface;
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
        /** @var User $testUser */
        $testUser = $this->getReference(UserFixtures::TEST_USER);
        /** @var SubProgram $terminatorSubProgram */
        $terminatorSubProgram = $this->getReference(SubProgramFixtures::TERMINATOR_SUB_PROGRAM);
        /** @var SubProgram $firstSubProgram */
        $firstSubProgram = $this->getReference(SubProgramFixtures::FIRST_SUB_PROGRAM);

        /** @var CarbonInterface $date */
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
            SubProgramFixtures::class,
        ];
    }
}
