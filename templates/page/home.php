<?php

use App\Entity\User;

 require_once _ROOTPATH_.'\templates\header.php'; ?>

    <?php if (User::isAdmin()): ?>
        <a href="index.php?controller=user&action=list" type="button" class="btn btn-outline-primary me-2">Suppression d'un compte</a>
    <?php endif; ?>

        <h1 class="text-center">Liste d'athlétisme</h1> 
        <h2>Liste des Courses :</h2>
        
        <table class="table">
        <?php if (isset($courseList) && !empty($courseList)) : ?>
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">nom de la course</th>
                <th scope="col">date de la course</th>

                </tr>
            </thead>
            <tbody>
            <?php foreach ($courseList as $course) : ?>
                <tr>
                <th scope="row"><?=htmlspecialchars($course->getIdCourse());?></th>
                <td><a href="index.php?controller=course&action=show&id=<?= $course->getIdCourse(); ?>"><?= htmlspecialchars($course->getName()); ?></a></td>
                <td><?=htmlspecialchars($course->getDateCourse());?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

            <?php else : ?>
                <li>Aucune course disponible</li>
            <?php endif; ?>
            <?php if (User::isAuthenticated()): ?>
                <a href="index.php?controller=course&action=list" type="button" class="btn btn-outline-primary me-2">Ajout/Suppression/Modification</a>
            <?php endif; ?>

            <h2>Liste des Coureurs :</h2>
        
        <table class="table table-striped">
        <?php if (isset($coureurList) && !empty($coureurList)) : ?>
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">nom</th>
                <th scope="col">prénom</th>
                <th scope="col">nationalité</th>
                <th scope="col">date de naissance</th>
                <th scope="col">numéro d'équipe</th>
                <th scope="col">compteur-course</th>

                </tr>
            </thead>
            <tbody>
            <?php foreach ($coureurList as $coureur) : ?>
                <tr>
                <th scope="row"><?=htmlspecialchars($coureur->getIdCoureur());?></th>
                <td><?=htmlspecialchars($coureur->getFirstName());?></td>
                <td><?=htmlspecialchars($coureur->getLastName());?></td>
                <td><?=htmlspecialchars($coureur->getNationalite());?></td>
                <td><?=htmlspecialchars($coureur->getDateNaissance());?></td>
                <td><?=htmlspecialchars($coureur->getIdEquipe());?></td>
                <td><?=htmlspecialchars($coureur->getCompteurCourse());?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

            <?php else : ?>
                <li>Aucun coureur trouvé</li>
            <?php endif; ?>
    
<!--  affiche les données  DE LA VUE de score_coureur -->
    <h2>Liste des Scores des Coureurs :</h2>
        <table class="table table-striped">
            <?php if (isset($scoreList) && !empty($scoreList)) : ?>
                <thead>
                    <tr>
                        <th scope="col">Nom du coureur</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">nom de la course</th>
                        <th scope="col">date de la course</th>
                        <th scope="col">position du coureur</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($scoreList as $score) : ?>
                        <tr>
                            <th scope="row"><?= htmlspecialchars($score->getFirstName()); ?></th>
                            <td><?= htmlspecialchars($score->getLastName()); ?></td>
                            <td><?= htmlspecialchars($score->getName()); ?></td>
                            <td><?= htmlspecialchars($score->getDateCourse()); ?></td>
                            <td><?= htmlspecialchars($score->getPositionCoureur()); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
        </table>
            <?php else : ?>
                <li>Aucun score n'a été trouvé</li>
            <?php endif; ?>

<?php require_once _ROOTPATH_.'\templates\footer.php'; ?>

