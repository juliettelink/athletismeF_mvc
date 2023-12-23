<?php require_once _ROOTPATH_.'\templates\header.php'; ?>

<h2>Liste des Courses</h2>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom de la Course</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($courses as $course): ?>
            <tr>
                <td><?= $course->getIdCourse(); ?></td>
                <td><?= $course->getName(); ?></td>
                <td><?= $course->getDateCourse(); ?></td>
                <td>
                    <a href="?controller=course&action=show&id=<?= $course->getIdCourse(); ?>">Voir</a>
                    <a href="?controller=course&action=edit&id=<?= $course->getIdCourse(); ?>">Modifier</a>
                    <a href="?controller=course&action=delete&id=<?= $course->getIdCourse(); ?>">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a href="?controller=course&action=add&id=<?= $course->getIdCourse(); ?>">Ajouter une course</a>

<?php require_once _ROOTPATH_.'\templates\footer.php'; ?>