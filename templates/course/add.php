<?php require_once _ROOTPATH_.'\templates\header.php'; ?>

<h2>Création de la Course</h2>

<form action="?controller=course&action=add" method="post">

    <div class="form-group">
        <input type="hidden" name="id_course" >
    </div>
    <div class="form-group">
        <label for="name">Nom de la Course:</label>
        <input type="text" id="name" name="name"  required>
    </div>
    <div class="form-group">
        <label for="date_course">Date de la course:</label>
        <input type="date" id="date_course" name="date_course" required>
    </div>
    <div class="form-group">
        <label for="description">description:</label>
        <textarea id="description" name="description" required></textarea>
    </div>
    <div class="form-group">
        <label for="image">Image:</label>
        <input type="text" id="image" name="image" required>
    </div>

    <button type="submit">Ajouter</button>
</form>

<?php require_once _ROOTPATH_.'\templates\footer.php'; ?>