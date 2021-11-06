<?php
    if(isset($_SESSION['loggedUser'])) {
        $loggedUser = $_SESSION['loggedUser'];
    require_once('nav-student.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Bienvenido <?php echo $_SESSION['loggedUser']->getFirstName() ?> !! </h2>
            <table class="table">
                <thead>
                    <tr class="table-secondary">
                        <th scope="col">Carrera</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">DNI</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-light">
                        <th><?php echo $career[0]['description'] ?></th>
                        <td><?php echo $studentApi->getFirstName() ?></td>
                        <td><?php echo $studentApi->getLastName() ?></td>
                        <td><?php echo $studentApi->getDni() ?></td>
                    </tr>
                </tbody>
                <thead>
                    <tr class="table-secondary">
                        <th scope="col">Telefono</th>
                        <th scope="col">Genero</th>
                        <th scope="col">Fecha de nacimiento</th>
                        <th scope="col">Celular</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-light">
                        <th><?php echo $studentApi->getFileNumber() ?></th>
                        <td><?php echo $studentApi->getGender() ?></td>
                        <td><?php echo $studentApi->getBirthDate() ?></td>
                        <td><?php echo $studentApi->getPhoneNumber() ?></td>
                    </tr>
                </tbody>
                <thead>
                    <tr class="table-secondary">
                        <th colspan="4" style="text-align:center;">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-light">
                        <td colspan="4" style="text-align:center;"><?php echo $studentApi->getEmail() ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</main>
<?php
    } else {
        require_once(VIEWS_PATH."home.php");
    }
?>