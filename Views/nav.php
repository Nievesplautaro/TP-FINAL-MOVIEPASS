<!-- In this VIEW we show the navigation bar on the users menu -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/ShowMenuView">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" >Movies</a> <!-- Showmovies get all the movies into a list and show them on Views/dashboard -->
        <ul>
          <li><a href="<?php echo FRONT_ROOT?>Dashboard/showMovies">Show Movies</a></li>
          <li><a href="<?php echo FRONT_ROOT?>Ticket/showMyTickets">My tickets</a></li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/logout">Logout</a>
      </li>
    </ul>
  </div>
</nav>
