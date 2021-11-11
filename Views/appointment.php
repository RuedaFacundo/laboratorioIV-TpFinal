<?php
    if(isset($_SESSION['loggedUser'])) {
    require_once('nav-student.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Postulaciones realizadas</h2>
            <table class="table bg-light-alpha">
                <thead>
                <tr>
                    <th>Empresa</th>
                    <th>Puesto</th>
                    <th>Email</th>
                    <th>Mensaje</th>
                    <th colspan="2" style="text-align:center;">CV</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    foreach($appointmentList as $value){                                
                ?>
                <tr>
                    <td><?php echo $value->getJobOffer()->getCompany()->getName() ?></td>
                    <td><?php echo $value->getJobOffer()->getJobPosition()->getDescription() ?></td>
                    <td><?php echo $value->getStudent()->getEmail() ?></td> 
                    <td><?php echo $value->getMessage() ?></td> 
                    <td> <a href=" <?php echo FRONT_ROOT ?>Appointment/ShowFile?name=<?php echo $value->getCv()?>">Ver</a></td>
                    <td> <a href=" <?php echo FRONT_ROOT ?>Appointment/ShowDownload?name=<?php echo $value->getCv()?>">Descargar</a></td>
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