<?php

namespace App\DataFixtures;

use App\Repository\UserRepository;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends FakerFixture
{
    public const TEST_USER = 'test-user';

    public function __construct(
        private UserRepository $userRepository
    ) {
        parent::__construct();
    }

    public function load(ObjectManager $manager): void
    {
        $user = $this->userRepository->create([
            'email' => 'test@example.com',
            'username' => 'test user',
            'password' => 'password',
        ]);

        $this->addReference(self::TEST_USER, $user);

        for ($i = 0; $i < 4; ++$i) {
            $this->userRepository->create([
                'email' => $this->faker->unique()->email,
                'username' => $this->faker->unique()->userName,
                'password' => 'password',
            ]);
        }

        $manager->flush();
    }
}
