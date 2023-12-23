<?php require_once _ROOTPATH_.'\templates\header.php'; ?>

<h2>Modifier la Course</h2>

<form action="?controller=course&action=update" method="post">

    <div class="form-group">
        <input type="hidden" name="id_course" value="<?= $course->getIdCourse(); ?>">
    </div>
    <div class="form-group">
        <label for="name">Nom de la Course:</label>
        <input type="text" id="name" name="name" value="<?= $course->getName(); ?>" required>
    </div>
    <div class="form-group">
        <label for="date_course">Date de la course:</label>
        <input type="date" id="date_course" name="date_course" value="<?= $course->getDateCourse(); ?>" required>
    </div>
    <div class="form-group">
        <label for="description">description:</label>
        <textarea id="description" name="description" value="<?= $course->getDescription(); ?>" required><?= $course->getDescription(); ?></textarea>
    </div>
    <div class="form-group">
        <label for="image">Image:</label>
        <input type="text" id="image" name="image" value="<?= $course->getImage(); ?>" required>
    </div>

    <button type="submit">Enregistrer</button>
</form>

<?php require_once _ROOTPATH_.'\templates\footer.php'; ?>