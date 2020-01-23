<nav class="navbar navbar-inverse">
  <div class="container-fluid">

  <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Phone Tech</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="float: left;">
      <ul class="nav navbar-nav">
        <li id="home-link" class="active"><a href="index.php">Home <span class="sr-only">(current)</span></a></li>
        <?php if (isset($_SESSION['type']) && !empty($_SESSION['type'])) {?>
          <?php if ($_SESSION['type'] === 'Technician') {?>
            <li><a href="#problemlist">Problem List</a></li>
          <?php } elseif ($_SESSION['type'] === 'Customer') { ?>
            <li id="technicianbid-link"><a href="#technicianbid">Technician Bid</a></li>
          <?php } else { ?>
            <!-- <li class="active"><a href="index.php">Home <span class="sr-only">(current)</span></a></li> -->
          <?php } ?>
        <?php } else { ?>
          <li><a href="#">About Us</a></li>
          <li><a href="#">Technicians</a></li>
        <?php } ?>
      </ul>
    </div>

    <ul class="nav navbar-nav navbar-right">
      <?php 
        if (isset($_SESSION['type']) && !empty($_SESSION['type'])) { 
      ?>
        <li><a href="#">Hi, <?php echo ($_SESSION['FirstName'] . ' ' . $_SESSION['LastName']); ?>!</a></li>

      <?php
          if ($_SESSION['type'] != 'Administrator') {
      ?>
        <!-- <li class="nav-item dropdown">
          <a class="nav-link" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Notifications</a>
          <div class="dropdown-menu" aria-labelledby="dropdown01" >
            <?php
              if ($_SESSION['type'] === 'Technician') {
                $query = "SELECT * from `problem_tb` order by `currentdate` DESC";
                if(count(fetchAll($query))>0) {
                  foreach(fetchAll($query) as $i) {
            ?>
                    <a style ="color: black" class="dropdown-item" href="client/components/view.php?id=<?php echo $i['id'] ?>">
                      <small><i><?php echo date('F j, Y, g:i a',strtotime($i['currentdate'])) ?></i></small><br/>
                      <?php echo ucfirst($i['name'])." posted a problem."; ?>
                    </a>

                    <div class="dropdown-divider"></div>
            <?php
                  }
                } else {
                  echo "No Records yet.";
                }
              } else { // Customer
                $query = "SELECT * from `bid_tb` order by `currentdate` DESC";
                if(count(fetchAll($query))>0) {
                  foreach(fetchAll($query) as $i) {
            ?>
                    <a style ="color: black" class="dropdown-item" href="technicianbid.php?id=<?php echo $i['id'] ?>">
                      <small><i><?php echo date('F j, Y, g:i a',strtotime($i['currentdate'])) ?></i></small><br/>
                      <?php echo " posted a problem."; ?>
                    </a>

                    <div class="dropdown-divider"></div>
            <?php
                  }
                } else {
                    echo "No Records yet.";
                }
              }
            ?>
          </div>
        </li> -->
      <?php } ?>
        <li><form method="post" action="/phonetech/server/customerserver.php"><button type="submit" name="Logout" id="logout">Logout</button></form></li>
      <?php } else { ?>
        <li><a href="#about" data-toggle="modal" data-target="#myModal">Login</a></li>
        <li><a href="/phonetech/registration.php">Register</a></li>
      <?php } ?>
    </ul>
  </div>
</nav>

<div class="container" style="padding: 0;">
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title">LOGIN NOW!</h4></center>
        </div>
        <div class="modal-body">

          <form method="post" action="/phonetech/index.php">
            <div class="input-container">
              <i class="fa fa-user icon"></i>
              <input class="input-field" type="text" placeholder="Username" name="Username">
            </div>

            <div class="input-container">
              <i class="fa fa-key icon"></i>
              <input class="input-field" type="password" placeholder="Password" name="Password">
            </div>

            <button type="submit" class="btn login-btn" name="Login">Log In</button>
            <ul class="login-more p-t-190">
              <li>
                <span class="txt1">
                  Don’t have an account?
                </span>

                <a href="/phonetech/registration.php" class="txt2">
                  Sign up
                </a>
              </li>
            </ul>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(function () {
      $("[data-toggle='tooltip']").tooltip();
  });
</script>