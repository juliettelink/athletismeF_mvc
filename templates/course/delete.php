
<?php require_once _ROOTPATH_.'\templates\header.php'; ?>

<h2>Confirmer la suppression</h2>

<p>Voulez-vous vraiment supprimer la course "<?= $course->getName(); ?>"?</p>

<form action="?controller=course&action=confirmDelete" method="post">
    <input type="hidden" name="id" value="<?= $course->getIdCourse(); ?>">
    <button type="submit">Confirmer la suppression</button>
</form>

<?php require_once _ROOTPATH_.'\templates\footer.php'; ?>