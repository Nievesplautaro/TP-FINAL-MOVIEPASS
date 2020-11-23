<!-- In this VIEW we show the navigation bar on the admins menu -->
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
      <li class="nav-item active">
        <a class="nav-link">Shows</a>
        <ul>
          <li><a href="<?php echo FRONT_ROOT ?>Cinema/shows/add">Add Show</a></li>
          <li><a href="<?php echo FRONT_ROOT ?>Cinema/shows/see">See Shows</a></li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link">Admin</a>
        <ul>
          <li><a href="<?php echo FRONT_ROOT ?>User/ShowRegisterAdmin">Add Admin</a></li>
          
          <?php if(isset($movies_exists) && $movies_exists == '0')
          { 
          ?>
            <li><a href="<?php echo FRONT_ROOT ?>User/AddMovies">Add Movies</a></li>
          <?php
          }else
          { 
          ?>  
            <li><a href="<?php echo FRONT_ROOT ?>User/UpdateMovies">Update Movies</a></li>
          <?php
          }
          ?>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/logout">Logout</a>
      </li>
    </ul>
  </div>
</nav>
