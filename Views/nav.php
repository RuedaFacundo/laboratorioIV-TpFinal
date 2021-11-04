<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
     <span class="nav-item">
          <strong><a class="nav-link" data-bs-toggle="" href="<?php echo FRONT_ROOT ?>User/ShowAdminProfileView" role="button" aria-expanded="false" style="color: rgba(255,255,255,.5);">Perfil</a></strong>
     </span>
     
     <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="" role="button" aria-expanded="false">Empresa</a>
               <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?php echo FRONT_ROOT ?>Company/ShowAddView">Agregar</a></li>
                    <li><a class="dropdown-item" href="<?php echo FRONT_ROOT ?>Company/ShowListView">Listar</a></li>
                    <li><a class="dropdown-item" href="<?php echo FRONT_ROOT ?>Company/ShowModifyView">Modificar</a></li>
               </ul>
          </li>     
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="" role="button" aria-expanded="false">Oferta Laboral</a>
               <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?php echo FRONT_ROOT ?>JobOffer/ShowAddView">Cargar</a></li>
                    <li><a class="dropdown-item" href="<?php echo FRONT_ROOT ?>JobOffer/ShowListView">Listar</a></li>
                    <li><a class="dropdown-item" href="<?php echo FRONT_ROOT ?>JobOffer/ShowModifyView">Modificar</a></li>
               </ul>
          </li> 
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="" role="button" aria-expanded="false">Estudiante</a>
               <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?php echo FRONT_ROOT ?>User/ShowListStudent">Listar</a></li>
               </ul>
          </li>    
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="" role="button" aria-expanded="false">Usuario</a>
               <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?php echo FRONT_ROOT ?>User/ShowAddView">Agregar</a></li>
               </ul>
          </li> 
          <li class="nav-item">
               <a class="nav-link" data-bs-toggle="" href="<?php echo FRONT_ROOT ?>User/Logout" role="button" aria-expanded="false">Cerrar sesion</a>
          </li> 
     </ul>
</nav>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>