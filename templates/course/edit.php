<?php require_once _ROOTPATH_.'\templates\header.php'; ?>

<h2>Modifier la Course</h2>

<form action="?controller=course&action=update" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <input type="hidden" name="id_course" value="<?= $course->getIdCourse(); ?>">
    </div>
    <div class="form-group">
        <label for="name">Nom de la Course:</label>
        <div class="col-sm-10">
            <input type="text" id="name" name="name" value="<?= $course->getName(); ?>" required>
        </div>
        </div>
    <div class="form-group">
        <label for="date_course">Date de la course:</label>
        <div class="col-sm-10">
            <input type="date" id="date_course" name="date_course" value="<?= $course->getDateCourse(); ?>" required>
        </div>
        </div>
    <div class="form-group">
        <label for="description">description:</label>
        <div class="col-sm-10">
            <textarea id="description" name="description" value="<?= $course->getDescription(); ?>" required><?= $course->getDescription(); ?></textarea>
        </div>
        </div>
    <div class="form-group">
        <label for="image">Image:</label>
        <div class="col-sm-10">
            <img src="<?= $course->getImage(); ?>" alt="Image actuelle" style="max-width: 200px;">
            <br>
            <input type="file" id="image" name="image" accept="image/*">
        </div>
    </div>
    <br>

    <button class="btn btn-primary" type="submit">Enregistrer</button>
</form>

<?php require_once _ROOTPATH_.'\templates\footer.php'; ?>