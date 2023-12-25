
<?php require_once _ROOTPATH_.'\templates\header.php'; ?>

<h2>Confirmer la suppression</h2>

<?php if ($user instanceof \App\Entity\User): ?>

    <p>Voulez-vous vraiment supprimer cet utilisateur "<?= $user->getFirstName(); ?>"?</p>

    <form action="?controller=user&action=confirmDelete" method="post">
        <input type="hidden" name="id" value="<?= $user->getIdUser(); ?>">
        <button type="submit">Confirmer la suppression</button>
    </form>

<?php else: ?>
    <p>Utilisateur non trouvé.</p>
<?php endif; ?>

<?php require_once _ROOTPATH_.'\templates\footer.php'; ?>