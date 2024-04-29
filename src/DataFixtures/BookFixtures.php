<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Book;
use Stripe\Util\Set;
use App\Entity\Autor;
use App\Entity\State;
use DateTimeImmutable;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class BookFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $categories = $manager->getRepository(Category::class)->findAll();
        $autors = $manager->getRepository(Autor::class)->findAll();
        $states = $manager->getRepository(State::class)->findAll();
    
        // Vérifier si des catégories existent
        if (empty($categories)) {
            // Gérer le cas où aucune catégorie n'est disponible
            return;
        }
    
        for ($i = 0; $i < 50; $i++) {
            $book = new Book();
            $book->setName($faker->sentence(3));
            $book->setCategory($faker->randomElement($categories));
            $book->setAutor($faker->randomElement($autors));
            $book->setState($faker->randomElement($states));
            $book->setDescription($faker->paragraphs($nb = 3, $asText = true));
    
            // Générer le slug à partir du nom du livre
            $slug = $this->slugify($book->getName());
            $book->setSlug($slug);
    
            $book->setImageName('book_' . $faker->unique()->numberBetween(1, 100) . '.jpg');
            $book->setPublicationAt(DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-6 months')));
            $book->setUptdatedAt(DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-6 months')));
            $book->setAvailable($faker->boolean(75));
            dump($book);
            $manager->persist($book);
        }
        $manager->flush();
    }
    
    // Fonction pour créer un slug à partir d'une chaîne de caractères
    private function slugify(string $string): string
    {
        // Nettoyer la chaîne en remplaçant les caractères spéciaux et en convertissant en minuscules
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string), '-'));
    
        // Supprimer les tirets doubles ou plus
        $slug = preg_replace('/-+/', '-', $slug);
    
        return $slug;
    }
    
}