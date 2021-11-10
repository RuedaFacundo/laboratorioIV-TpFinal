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
                    <th>CV</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    foreach($appointmentList as $value){                                
                ?>
                <tr>
                    <td><?php echo $value['name'] ?></td>
                    <td><?php echo $value['description'] ?></td>
                    <td><?php echo $value['email'] ?></td> 
                    <td><?php echo $value['message'] ?></td> 
                    <td> <a href=" <?php echo FRONT_ROOT ?>Appointment/ShowFile?name=<?php echo $value['cv']?>">Ver</a></td>
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