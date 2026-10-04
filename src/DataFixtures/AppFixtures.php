<?php

namespace App\DataFixtures;
use App\Entity\Etudiant;
use App\Entity\Note;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $prenoms = [
        'Amadou', 'Fatou', 'Moussa', 'Aïssatou', 'Ibrahima',
        'Mariama', 'Ousmane', 'Aminata', 'Cheikh', 'Khady',
        'Abdoulaye', 'Sokhna', 'Mamadou', 'Astou', 'Aliou',
        'Adama', 'Mame', 'Pape', 'Ndeye', 'Babacar'
    ];

    $noms = [
        'Diop', 'Fall', 'Ndiaye', 'Sow', 'Ba',
        'Diallo', 'Sy', 'Seck', 'Gueye', 'Faye',
        'Cissé', 'Kane', 'Thiam', 'Diouf', 'Sarr',
        'Mbaye', 'Dieng', 'Niang', 'Camara', 'Touré'
    ];

    $classes = ['L1', 'L2', 'L3'];

    $matieres = ['Maths', 'Physique', 'Anglais'];

    for ($i = 1; $i <= 500; $i++) {
        // Création de l'étudiant
        $etudiant = new Etudiant();

        $prenom = $prenoms[array_rand($prenoms)];
        $nom = $noms[array_rand($noms)];

        $etudiant->setNomComplet($prenom . ' ' . $nom);
        $etudiant->setClasse($classes[array_rand($classes)]);

        $manager->persist($etudiant);

        // Création des 3 notes
        foreach ($matieres as $matiere) {
            $note = new Note();

            $note->setValeur(rand(0, 200) / 10);
            $note->setMatiere($matiere);
            $note->setEtudiant($etudiant);

            $manager->persist($note);
        }

        // Flush tous les 100 étudiants
        if ($i % 100 === 0) {
            $manager->flush();
            $manager->clear();
        }
    }

    // Enregistrer les éventuels derniers objets
    $manager->flush();
    }
}
