
<?php require_once _ROOTPATH_.'\templates\header.php'; ?>

<?php if(\App\Entity\User::isAdmin()): ?>
    <h2>Liste des utilisateurs</h2>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user->getIdUser(); ?></td>
                    <td><?= $user->getFirstName(); ?></td>
                    <td><?= $user->getLastName(); ?></td>
                    <td><?= $user->getEmail(); ?></td>
                    <td>
                        <a href="?controller=user&action=delete&id=<?= $user->getIdUser(); ?>" class="btn btn-danger">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php require_once _ROOTPATH_.'\templates\footer.php'; ?>