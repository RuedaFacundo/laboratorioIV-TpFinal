<?php
    if(isset($_SESSION['loggedUser'])) {
        $loggedUser = $_SESSION['loggedUser'];
    require_once('nav-student.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Empresa</h2>
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
                <tr>
                    <td><?php echo $company[0]->getName() ?></td>
                    <td><?php echo $company[0]->getCuit() ?></td>
                    <td><?php echo $company[0]->getAdress() ?></td>
                    <td><?php echo $company[0]->getFounded() ?></td>
                </tr>
            </tbody>
            </table>
            <form action="<?php echo FRONT_ROOT ?>Company/ShowListViewStudent" method="post">
            <table style="max-width: 35%;" >
                <thead>
                <tr>
                    <th style="width: 170px; text-align: center"> Accion</th>
                </tr>
                </thead>
                <tbody align=center>
                <tr>
                    <td>
                    <input type="submit" class="btn" value="Volver" style="background-color:#DC8E47;color:white;"/>
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