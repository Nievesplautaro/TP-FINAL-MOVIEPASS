<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="collapse navbar-collapse admin" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link">Cine</a>
        <ul>
          <li><a href="<?php echo FRONT_ROOT ?>Cinema/registerCinema">Add Cine</a></li>
          <li><a href="<?php echo FRONT_ROOT ?>Cinema/showCinemas">Show Cine</a></li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link">Admin</a>
        <ul>
          <li><a href="<?php echo FRONT_ROOT ?>User/ShowRegisterAdmin">Add Admin</a></li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/logout">Logout</a>
      </li>
    </ul>
  </div>
</nav>
