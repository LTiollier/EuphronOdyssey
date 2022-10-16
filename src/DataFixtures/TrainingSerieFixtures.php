<?php

namespace App\DataFixtures;

use App\Entity\Exercise;
use App\Entity\TrainingSerie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TrainingSerieFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $mondayTraining = $this->getReference(TrainingFixtures::MONDAY_TRAINING_REFERENCE);
        $tuesdayTraining = $this->getReference(TrainingFixtures::TUESDAY_TRAINING_REFERENCE);

        foreach (ExerciseFixtures::MONDAY_EXERCISES as $key) {
            /** @var Exercise $exercise */
            $exercise = $this->getReference($key);
            $max = rand(6, 30);

            for ($serie = 1; $serie <= $exercise->getSeries(); $serie++) {
                $training = new TrainingSerie();
                $training->setTraining($mondayTraining);
                $training->setExercise($exercise);
                $training->setSerie($serie);
                $training->setResult($max);
                $manager->persist($training);
                $max--;
            }
        }

        foreach (ExerciseFixtures::FIRST_SUB_PROGRAM_EXERCISES as $key) {
            /** @var Exercise $exercise */
            $exercise = $this->getReference($key);
            $max = rand(6, 30);

            for ($serie = 1; $serie <= $exercise->getSeries(); $serie++) {
                $training = new TrainingSerie();
                $training->setTraining($tuesdayTraining);
                $training->setExercise($exercise);
                $training->setSerie($serie);
                $training->setResult($max);
                $manager->persist($training);
                $max--;
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            TrainingFixtures::class
        ];
    }
}