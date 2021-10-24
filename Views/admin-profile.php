<?php
    require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Bienvenido <?php echo $_SESSION['loggedUser']->getFirstName() ?> !! </h2>
            <table class="table">
                <thead>
                    <tr class="table-primary">
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">DNI</th>
                        <th scope="col">Telefono</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-light">
                        <th><?php echo $_SESSION['loggedUser']->getFirstName() ?></th>
                        <td><?php echo $_SESSION['loggedUser']->getLastName() ?></td>
                        <td><?php echo $_SESSION['loggedUser']->getDni() ?></td>
                        <td><?php echo $_SESSION['loggedUser']->getFileNumber() ?></td>
                    </tr>
                </tbody>
                <thead>
                    <tr class="table-primary">                       
                        <th scope="col">Genero</th>
                        <th scope="col">Fecha de nacimiento</th>
                        <th scope="col">Celular</th>
                        <th scope="col">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-light">
                        <th><?php echo $_SESSION['loggedUser']->getGender() ?></th>
                        <td><?php echo $_SESSION['loggedUser']->getBirthDate() ?></td>
                        <td><?php echo $_SESSION['loggedUser']->getPhoneNumber() ?></td>
                        <td><?php echo $_SESSION['loggedUser']->getEmail() ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</main>
