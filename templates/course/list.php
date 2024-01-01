<?php

use App\Entity\User;

 require_once _ROOTPATH_.'\templates\header.php'; ?>

<h2>Liste des Courses</h2>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom de la Course</th>
            <th>Date de la course</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($courses as $course): ?>
            <tr>
                <td><?= htmlspecialchars($course->getIdCourse()); ?></td>
                <td><?= htmlspecialchars($course->getName()); ?></td>
                <td><?= htmlspecialchars($course->getDateCourse()); ?></td>
                <td><?= htmlspecialchars($course->getImage()); ?></td>
                <td>
                    <a href="?controller=course&action=show&id=<?= $course->getIdCourse(); ?>" class="btn btn-primary">Voir</a>
                    <?php if (User::isAdmin()): ?>
                        <a href="?controller=course&action=edit&id=<?= $course->getIdCourse(); ?>" class="btn btn-secondary">Modifier</a>
                        <a href="?controller=course&action=delete&id=<?= $course->getIdCourse(); ?>" class="btn btn-danger">Supprimer</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a href="?controller=course&action=add&id=<?= htmlspecialchars($course->getIdCourse()); ?>" class="btn btn-primary">Ajouter une course</a>

<?php require_once _ROOTPATH_.'\templates\footer.php'; ?>

