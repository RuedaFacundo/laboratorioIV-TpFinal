<?php
    if(isset($_SESSION['loggedUser'])) {
        $loggedUser = $_SESSION['loggedUser'];
    require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Listado de alumnos registrados</h2>
            <table class="table bg-light-alpha">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Carrera</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    foreach($arrayStudents as $value){ 
                        $studentApi = $this->userDAO->GetApiByEmail($value->getEmail());
                        $career = $this->careerDAO->getById($studentApi->getCareerId());     
                ?>
                <tr>
                    <td><?php echo $studentApi->getFirstName() ?></td>
                    <td><?php echo $studentApi->getLastName() ?></td>
                    <td><?php echo $studentApi->getEmail() ?></td>
                    <td><?php echo $career[0]['description'] ?></td>
                </tr>
                <?php                              
                    }
                ?>
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