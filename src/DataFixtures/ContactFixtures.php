<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Contact;

/*Here we create false datas to load in our table for it to be provided */

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
                    
            $manager->persist($contact); // I prepare $contact will exist in the table
            
        }
        
        $manager->flush(); // I validate and send $contact in the table - Symfony will make the sql query
    }
}
