<div class="row">
  <div class="col-xs-12 bg-light">
    <h2>Summary</h2>
    <hr>
    <table id="summary-table" class="table table-bordered table-stripped table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>Serial Number</th>
          <th>Brand</th>
          <th>Filter</th>
          <th>Problem</th>
          <th style="text-align: center;">Status</th>
          <th>Technician Name</th>
          <th style="text-align: center;">You Rated</th>
          <th>Date Updated</th>
        </tr>
      </thead>

      <tbody>
        <?php 
          $conn= new mysqli("localhost", "root","","phonetech_db");
          $sql= "SELECT a.*, b.rating, c.FirstName, c.LastName FROM problem_tb a LEFT OUTER JOIN rating_tb b ON a.id = b.problem_id INNER JOIN customer_account c ON a.user_id = c.Customer_ID WHERE a.status IN ('In Progress', 'Pending', 'Finished');";
          $res=$conn->query($sql);
          $x = 0;
          while($row=$res->fetch_assoc()){
            $x += 1;
        ?>
          <tr class="clickable-row" onclick='lookProblem(<?php echo $row["id"]; ?>)'>
            <td> PN-<?= $row['id'] ?></td>
            <td> <?= $row['serialNumber'] ?></td>
            <td> <?= $row['brand'] ?></td>
            <td> <?= $row['filter'] ?></td>
            <td> <?= $row['problem'] ?></td>
            <td style="text-align: center;">  
              <?php
                if ($row['status'] == 'Pending') {
                  echo '<span style="position:absolute; visibility: hidden">1</span><span data-toggle="tooltip" title="Waiting for technician\'s approval" class="glyphicon glyphicon-time" aria-hidden="true" style="color: orange;"></span>';
                } elseif ($row['status'] == 'In Progress') {
                  echo '<span style="position:absolute; visibility: hidden">4</span><span data-toggle="tooltip" title="In Progress" class="glyphicon glyphicon-cog kogi" aria-hidden="true" style="color: dodgerblue;"></span>';
                } else {                  
                  echo '<span style="position:absolute; visibility: hidden">5</span><span data-toggle="tooltip" title="Repair Complete" class="glyphicon glyphicon-ok-circle" aria-hidden="true" style="color: green;"></span>';
                }
                  
              ?>  
            </td>
            <td> <?= $row['FirstName'] . ' ' . $row['LastName'] ?></td>
            <td style="text-align: center;"> 
              <?php 
                for ($y = 1; $y <= 5; $y++) {
                  if ($y <= $row['rating']) {
                    echo "<span class='fa fa-star checked'></span>";
                  } else {
                    echo "<span class='fa fa-star'></span>";
                  }
                }
              ?>
            </td>
            <td> <?= $row['currentdate'] ?></td>
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
</div>
