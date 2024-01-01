<?php require_once _ROOTPATH_.'\templates\header.php'; ?>

<h2>Création de la Course</h2>

<form action="?controller=course&action=add" method="post" enctype="multipart/form-data">

<div class="form-group">
        <input type="hidden" name="id_course">
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Nom de la Course :</label>
        <div class="col-sm-10">
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
    </div>
    <div class="form-group">
        <label for="date_course" class="col-sm-2 control-label">Date de la course:</label>
        <div class="col-sm-10">
            <input type="date" id="date_course" name="date_course" class="form-control" required>
        </div>
    </div>
    <div class="form-group">
        <label for="description" class="col-sm-2 control-label">Description:</label>
        <div class="col-sm-10">
            <textarea id="description" name="description" class="form-control" required></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="image" class="col-sm-2 control-label">Image:</label>
        <div class="col-sm-10">
            <?php if (isset($newCourse) && $newCourse->getImage()): ?>
                <img src="<?= htmlspecialchars($newCourse->getImage()); ?>" alt="Image par défaut" style="max-width: 200px;">
            <?php endif; ?>
            <br>
            <input type="file" id="image" name="image" accept="image/*">
            <small class="form-text text-muted">Choisissez une image </small>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>

<?php require_once _ROOTPATH_.'\templates\footer.php'; ?>