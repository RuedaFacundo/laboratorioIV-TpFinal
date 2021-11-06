<?php
    if(isset($_SESSION['loggedUser'])) {
        $loggedUser = $_SESSION['loggedUser'];
    require_once('nav-student.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
                <h2 class="mb-4">Listado de empresas</h2>
                <table class="table bg-light-alpha">
                    <thead>
                    <tr>
                        <th>Razon social</th>
                        <th>Cuit</th>
                        <th>Direccion</th>
                        <th>Fecha Fundacion</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                        foreach($companyList as $value){                                
                    ?>
                    <tr>
                        <td><?php echo $value->getName() ?></td>
                        <td><?php echo $value->getCuit() ?></td>
                        <td><?php echo $value->getAdress() ?></td>
                        <td><?php echo $value->getFounded() ?></td>
                    </tr>
                    <?php                              
                        }
                    ?>
                </tbody>
                </table>
                <form action="<?php echo FRONT_ROOT ?>Company/ShowCompanyView" method="post">
                    <table style="max-width: 35%;" >
                        <thead>
                        <tr>
                            <th style="width: 100px;">Nombre</th>
                            <th style="width: 170px; text-align: center">Accion</th>
                        </tr>
                        </thead>
                        <tbody align=center>
                        <tr>
                            <td>
                            <input type="text" name="nameCompany" style="height: 40px;" min="0" placeholder="Nombre de la empresa..">  
                            </td>
                            <td>
                            <input type="submit" class="btn" value="Buscar" style="background-color:#DC8E47;color:white;"/>
                            </td>
                        </tr>
                        </tbody>
                        </tr>
                    </table>
                <form>
        </div>
    </section>
</main>
<?php
    } else {
        require_once(VIEWS_PATH."home.php");
    }
?>