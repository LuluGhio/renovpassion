<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Contact;

/*Ici on créé de fausses données à balancer dans notre table pour qu'elle soit fournie */

class ContactFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i=1;$i<10;$i++){
            $contact = new Contact();
            $contact->setPrenom("Prénom $i")
                    ->setNom("Nom $i")
                    ->setEmail("email$i@mail.me")
                    ->setMessage("Contenu du message $i");
                    
            $manager->persist($contact); // je prépare le fait que le $contact existera dans la table
            
        }
        
        $manager->flush(); // je valide et balance le $contact dans la table - Symfony fera la requête sql nécessaire
    }
}
