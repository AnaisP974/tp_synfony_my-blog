<?php

namespace App\DataFixtures;


use Faker\Factory;
use App\Entity\Post;
use App\Entity\User;
use App\Entity\Offer;
use App\Entity\Subscription;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher) {}

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $today = new DateTimeImmutable();
        
        $offer = new Offer();
        
        $offer
            ->setName('Premium')
            ->setPrice(1.00)
            ->setFeatures($faker->paragraphs(5, true))
            ->setCreatedAt($today)
        ;
        $manager->persist($offer);



        // Create admin user
        $admin = new User();
        $admin
            ->setEmail('admin@admin.fr')
            ->setFullname('admin')
            ->setPassword('admin')
            ->setImage('https://images.pexels.com/photos/14634926/pexels-photo-14634926.jpeg?auto=compress&cs=tinysrgb&w=600')
            ->setBiography($faker->paragraphs(2, true))
            ->setCreatedAt($today)
            ;
        
        for ($i = 0; $i < 10; $i++) {
            $post = new Post();
            $post
                ->setTitle($faker->sentence())
                ->setContent($faker->paragraphs(5, true))
                ->setImage('https://lipsum.app/id/'. ($i +10) .'/300x300')
                ->setPublic(($i % 7 === 0)? true : false)
                ->setPremium(($i % 2 === 0) ? false : true)
                ->setSignature($admin)
                ->setCreatedAt($today)
            ;

            $manager->persist($post);
        }
            
        $manager->persist($admin);


        // Create regular users
        for ($j = 0; $j < 4; $j++) {
            $author = new User();
            $author
                ->setEmail($faker->email())
                ->setFullname($faker->userName())
                ->setPassword('userpassword')
                ->setImage('https://lipsum.app/id/' . ($i + 13) . '/300x300?profil')
                ->setBiography($faker->paragraphs(2, true))
                ->setCreatedAt($today)
            ;
            for ($k = 0; $k < 10; $k++) {
                $post = new Post();
                $post
                    ->setTitle($faker->sentence())
                    ->setContent($faker->paragraphs(5, true))
                    ->setImage('https://lipsum.app/id/' . ($i + 16) . '/300x300')
                    ->setPublic(($k % 7 === 0) ? true : false)
                    ->setPremium(($k % 2 === 0) ? false : true)
                    ->setSignature($author)
                    ->setCreatedAt($today);
                $manager->persist($post);
            }
            $manager->persist($author);
        }

        for ($l = 0; $l < 20; $l++) {
            $user = new User();
            $user
                ->setEmail($faker->email())
                ->setFullname($faker->userName())
                ->setPassword('userpassword')
                ->setImage('https://lipsum.app/id/' . ($i + 24) . '/300x300?profil')
                ->setBiography($faker->paragraphs(1, true))
                ->setCreatedAt($today)
            ;

            if($l % 2 === 0)
            {
                $subscription = new Subscription();
                
                $subscription
                    ->setStartDate($today)
                    ->setEndDate($today->modify('+30 days'))
                    ->setOfferId($offer)
                    ->setUserId($user)
                    ->setCreatedAt($today)
                ;
                $manager->persist($subscription);
            }

            
            $manager->persist($user);
        }

        $manager->flush();
    }
}
