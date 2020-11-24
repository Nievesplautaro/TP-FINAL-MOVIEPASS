<!-- In this VIEW we show the navigation bar on the users menu -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo FRONT_ROOT ?>">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" >Movies</a> <!-- Showmovies get all the movies into a list and show them on Views/dashboard -->
        <ul>
          <li><a href="<?php echo FRONT_ROOT?>Dashboard/showMovies">Show Movies</a></li>
          <?php 
            if(isset($_SESSION["loggedUser"])){
          ?>
           <li><a href="<?php echo FRONT_ROOT?>Ticket/showMyTickets">Tickets</a></li>
          <?php 
          }
          ?>
        </ul>
      </li>
      <li class="nav-item">
        <?php if(!isset($_SESSION["loggedUser"])){?> 
          <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/Logme">Login</a>
        <?php }else{ ?>
          <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/logout">Logout</a>
        <?php } ?>
      </li>
    </ul>
  </div>
</nav>
