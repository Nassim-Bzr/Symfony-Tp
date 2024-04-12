<?php

namespace App\DataFixtures;

use App\Entity\Annonces;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Images d'appartements (vous pouvez ajouter plus ou utiliser des liens dynamiques)
        $images = [
            'https://st3.depositphotos.com/1009647/16906/i/450/depositphotos_169065136-stock-photo-modern-apartment-interior.jpg',
            'https://pichet.twic.pics/var/site/storage/images/_aliases/product_item/8/6/4/1/651468-3-fre-FR/69ae60754a97-Teasing_vignette_690x380.jpg',
            'https://plan-a.ca/wp-content/uploads/2022/12/4800_paul_pouliot_30207_web-scaled.jpg',
            'https://www.travaux.com/images/cms/original/ebcd4d3c-6a00-47d2-8165-6d9e192082af.jpeg',
            'https://www.shutterstock.com/image-photo/living-room-couches-chairs-coffee-600nw-2290619915.jpg'
        ];

        for ($i = 0; $i < 20; $i++) {
            $annonce = new Annonces();
            $annonce->setTitle($faker->sentence(6))
                ->setDescription($faker->text(300))
                ->setImage($faker->randomElement($images));  // Sélection aléatoire d'une image

            $manager->persist($annonce);
        }

        $manager->flush();
    }
    # Generations de fausse images


}
