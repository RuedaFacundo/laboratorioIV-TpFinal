<body>
    <?php 
        require_once "header.php";
    ?>
    <main class="d-flex align-items-center justify-content-center height-100">
        <div class="content">
            <header class="text-center">
                <h2>Bienvenido!</h2>
            </header>
            <form action="<?php echo FRONT_ROOT ?>User/Login" method="POST" class="login-form bg-dark-alpha p-5 text-white">
                <div class="form-group">
                        <label for="email">Usuario</label>
                        <input type="text" name="email" class="form-control form-control-lg" placeholder="Ingresar usuario">
                </div>
                <div class="form-group">
                        <label for="password">Contrase&ntilde;a</label>
                        <input type="password" name="password" class="form-control form-control-lg" placeholder="Ingresar constrase&ntilde;a">
                </div>
                <button class="btn btn-dark btn-block btn-lg" type="submit">Iniciar Sesi&oacute;n</button>
                <a href="<?php echo FRONT_ROOT ?>User/ShowAddCompany" style="text-decoration: none; color:  white; text-align: center; padding-left: 45px;">Si es una empresa, haga click aqui</a>
            </form>
            <div style="margin-top: 20px">
                    <form action="<?php echo FRONT_ROOT ?>User/ShowRegisterView" method="POST" class="login-form bg-dark-alpha p-5 text-white">
                        <button class="btn btn-dark btn-block btn-lg" type="submit">Registrarse</button>
                    </form>
            </div>
        </div>
    </main>
    <?php 
        require_once "footer.php";
    ?>
</body>
</html>