<?php
    require_once('nav-student.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Informacion del estudiante</h2>
            <table class="table">
                <thead>
                    <tr class="table-primary">
                        <th scope="col">Carrera</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">DNI</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-light">
                        <th><?php echo $_SESSION['loggedUser']->getCareerId() ?></th>
                        <td><?php echo $_SESSION['loggedUser']->getFirstName() ?></td>
                        <td><?php echo $_SESSION['loggedUser']->getLastName() ?></td>
                        <td><?php echo $_SESSION['loggedUser']->getDni() ?></td>
                    </tr>
                </tbody>
                <thead>
                    <tr class="table-primary">
                        <th scope="col">Telefono</th>
                        <th scope="col">Genero</th>
                        <th scope="col">Fecha de nacimiento</th>
                        <th scope="col">Celular</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-light">
                        <th><?php echo $_SESSION['loggedUser']->getFileNumber() ?></th>
                        <td><?php echo $_SESSION['loggedUser']->getGender() ?></td>
                        <td><?php echo $_SESSION['loggedUser']->getBirthDate() ?></td>
                        <td><?php echo $_SESSION['loggedUser']->getPhoneNumber() ?></td>
                    </tr>
                </tbody>
                <thead>
                    <tr class="table-primary">
                        <th colspan="4" style="text-align:center;">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-light">
                        <td colspan="4" style="text-align:center;"><?php echo $_SESSION['loggedUser']->getEmail() ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</main>