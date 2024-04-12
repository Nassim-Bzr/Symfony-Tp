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
        // Création de l'instance de Faker
        $faker = Factory::create();

        // Création de 20 annonces
        for ($i = 0; $i < 20; $i++) {
            $annonce = new Annonces();

            // Utilisation de Faker pour générer le titre et la description
            $annonce->setTitle($faker->sentence(6)) // Génère une phrase de 6 mots pour le titre
            ->setDescription($faker->text(300)); // Génère un texte de 300 caractères pour la description

            // Persistance de l'objet Annonce
            $manager->persist($annonce);
        }

        // Sauvegarde de tous les objets persistés dans la base de données
        $manager->flush();
    }
}
