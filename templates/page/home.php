<?php require_once _ROOTPATH_.'\templates\header.php'; ?>

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
                <th scope="row"><?=$course->getIdCourse();?></th>
                <td><a href="index.php?controller=course&action=show&id=<?= $course->getIdCourse(); ?>"><?= $course->getName(); ?></a></td>
                <td><?=$course->getDateCourse();?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

            <?php else : ?>
                <li>Aucune course disponible</li>
            <?php endif; ?>
        <a href="courses" type="button" class="btn btn-outline-primary me-2">Ajout d'une course</a>

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
                <th scope="row"><?=$coureur->getIdCoureur();?></th>
                <td><?=$coureur->getFirstName();?></td>
                <td><?=$coureur->getLastName();?></td>
                <td><?=$coureur->getNationalite();?></td>
                <td><?=$coureur->getDateNaissance();?></td>
                <td><?=$coureur->getIdEquipe();?></td>
                <td><?=$coureur->getCompteurCourse();?></td>
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
            <?php if (isset($scoreCoureurList) && !empty($scoreCoureurList)) : ?>
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
                    <?php foreach ($scoreCoureurList as $score) : ?>
                        <tr>
                            <th scope="row"><?= $score["nom_coureur"]; ?></th>
                            <td><?= $score["prenom"]; ?></td>
                            <td><?= $score["nom_course"]; ?></td>
                            <td><?= $score["date_course"]; ?></td>
                            <td><?= $score["position_coureur"]; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
        </table>
            <?php else : ?>
                <li>Aucun score n'a été trouvé</li>
            <?php endif; ?>

<?php require_once _ROOTPATH_.'\templates\footer.php'; ?>

