<div class="row">
  <div class="col-xs-9 bg-light">
    <h2>Summary</h2>
    <hr>
    <table id="summary-table" class="table table-bordered table-stripped table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Serial Number</th>
          <th>Brand</th>
          <th>Filter</th>
          <th>Problem</th>
          <th style="text-align: center;">Status</th>
        </tr>
      </thead>

      <tbody>
        <?php 
          $conn= new mysqli("localhost", "root","","phonetech_db");
          $user_id = $_SESSION['Customer_ID'];

          $sql= "SELECT b.*, a.FirstName, a.LastName, c.id as bid_id, c.repairdays, (CASE WHEN c.tech_id = $user_id THEN 'Done' ELSE 'Pending' END) as bidStatus FROM problem_tb b INNER JOIN customer_account a ON a.Customer_ID = b.user_id LEFT OUTER JOIN bid_tb c ON b.id = c.problem_id AND c.tech_id = $user_id WHERE ((b.status IN ('Pending', 'In Progress', 'Finished') AND b.tech_id = $user_id) OR (b.status = 'No Technician' AND c.tech_id = $user_id)) GROUP BY b.id;";
          $res=$conn->query($sql);
          $x = 0;
          while($row=$res->fetch_assoc()){
            $x += 1;
        ?>
          <tr>
            <td> PN-<?= $row['id'] ?></td>
            <td> <?= $row['FirstName'] . ' ' . $row['LastName'] ?></td>
            <td> <?= $row['serialNumber'] ?></td>
            <td> <?= $row['brand'] ?></td>
            <td> <?= $row['filter'] ?></td>
            <td> <?= $row['problem'] ?></td>
            <td> 
              <center>
                <?php
                  if ($row['status'] == 'No Technician') {
                    if ($row['bidStatus'] == 'Pending') {
                      echo '<span style="position:absolute; visibility: hidden">2</span><span data-toggle="tooltip" title="Bid not placed yet" class="glyphicon glyphicon-remove-circle" aria-hidden="true" style="color: red;"></span>';
                    } else {
                      echo '<span style="position:absolute; visibility: hidden">4</span><span data-toggle="tooltip" title="Waiting for customer to choose bid" class="glyphicon glyphicon-time" aria-hidden="true" style="color: orange;"></span>' ;
                    }
                  } elseif ($row['status'] == 'Pending') {
                    echo '<span style="position:absolute; visibility: hidden">1</span><span data-toggle="tooltip" title="Acknowledge customer\'s request (Go to Problem List)" class="glyphicon glyphicon-alert alerta" aria-hidden="true" style="color: orange;"></span>';
                  } elseif ($row['status'] == 'In Progress') {
                    echo '<span style="position:absolute; visibility: hidden">3</span><span data-toggle="tooltip" title="In Progress" class="glyphicon glyphicon-cog kogi" aria-hidden="true" style="color: dodgerblue;"></span>';
                  } else {                  
                    echo '<span style="position:absolute; visibility: hidden">5</span><span data-toggle="tooltip" title="Repair Complete" class="glyphicon glyphicon-ok-circle" aria-hidden="true" style="color: green;"></span>';
                  }
                    
                ?>
              </center>
            </td>
          </tr>
        <?php } 
          if ($x === 0) {
        ?>
          <tr>
            <td colspan="8" style="text-align: center; padding: 30px 0; ">
              <img src="client/assets/img/empty.svg" alt="Empty"><br />
              No Data 
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

  <div class="col-xs-3">
    <h2>Feedbacks</h2>
    <hr>
    
    <div id="customer-ratings" class="list-group">
      <?php 
        $conn1= new mysqli("localhost", "root","","phonetech_db");
        $user_id = $_SESSION['Customer_ID'];
        $sql1= "SELECT a.*, b.problem, c.FirstName, c.LastName FROM rating_tb a INNER JOIN problem_tb b ON a.problem_id = b.id INNER JOIN customer_account c ON b.user_id = c.Customer_ID WHERE b.tech_id = $user_id;";
        $res1=$conn1->query($sql1);
        $x1 = 0;
        while($row1=$res1->fetch_assoc()){
          $x1 += 1;
      ?>
        <a class="list-group-item">
          <div class="rating-header">
            <h4 class="list-group-item-heading"><?= $row1['FirstName'] . ' ' . $row1['LastName'] ?></h4>
            <div class="rate">
              <?php 
                for ($y = 1; $y <= 5; $y++) {
                  if ($y <= $row1['rating']) {
                    echo "<span class='fa fa-star checked'></span>";
                  } else {
                    echo "<span class='fa fa-star'></span>";
                  }
                }
              ?>
            </div>
          </div>
          <img src="/phonetech/server/uploads/<?= $row1['photo']; ?>" style="display: <?= $row1['photo'] != '' ? 'block': 'none'; ?>" alt="..." class="img-thumbnail">
          <small class="feedback-problem"><em>(PN-<?= $row1['id'] ?>) - <?= $row1['problem'] ?></em></small>
          <p class="list-group-item-text"><?= $row1['comment'] ?></p>
        </a>
        <?php } 
          if ($x1 === 0) {
        ?>
          <a class="list-group-item"  style="text-align: center; padding: 30px 0; ">
            <img src="client/assets/img/empty.svg" alt="Empty" /><br />
            No Data 
          </a>
        <?php } ?>
    </div>
  </div>
</div>

<!-- <?php include 'client/components/technician/RatingListSample.html' ?> -->