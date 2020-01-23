
<div class="col-xs-12 bg-light rounded">
  <h2>Problem List</h2>
  <hr>
  <table id="problem-table" class="table table-bordered table-stripped table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Serial Number</th>
        <th>Brand</th>
        <th>Problem</th>
        <th>Date</th>
        <th style="text-align: center;">Status</th>
        <th style="text-align: center;">Action</th>
      </tr>
    </thead>

    <tbody>
      <?php 
        $conn= new mysqli("localhost", "root","","phonetech_db");
        $user_id = $_SESSION['Customer_ID'];
        $sql= "SELECT b.*, a.FirstName, a.LastName, c.id as bid_id, c.repairdays, (CASE WHEN c.tech_id = $user_id THEN 'Done' ELSE 'Pending' END) as bidStatus FROM problem_tb b INNER JOIN customer_account a ON a.Customer_ID = b.user_id LEFT OUTER JOIN bid_tb c ON b.id = c.problem_id AND c.tech_id = $user_id WHERE ((b.status IN ('Pending', 'In Progress', 'Finished') AND b.tech_id = $user_id) OR (b.status = 'No Technician')) GROUP BY b.id;";
        $res=$conn->query($sql);
        $x = 0;
        while($row=$res->fetch_assoc()){
          $bid_id =  $row['bid_id'];
          $row['payments'] = fetchAll("SELECT * FROM payment_breakdown WHERE bid_id = $bid_id;");
          $x += 1;
      ?>
        <tr>
          <td> PN-<?= $row['id']; ?></td>
          <td> <?= $row['FirstName'] . ' ' . $row['LastName'] ?></td>
          <td> <?= $row['serialNumber'] ?></td>
          <td> <?= $row['brand'] ?></td>
          <td> <?= $row['problem'] ?></td>
          <td> <?= $row['currentdate'] ?></td>
          <td> 
            <center>
              <?php
                if ($row['status'] == 'No Technician') {
                  if ($row['bidStatus'] == 'Pending') {
                    echo '<span style="position:absolute; visibility: hidden">2</span><span data-toggle="tooltip" title="Bid not placed yet" class="glyphicon glyphicon-remove-circle" aria-hidden="true" style="color: red;"></span>';
                  } else {
                    echo '<span style="position:absolute; visibility: hidden">3</span><span data-toggle="tooltip" title="Bid Placed" class="glyphicon glyphicon-time" aria-hidden="true" style="color: orange;"></span>' ;
                  }
                } elseif ($row['status'] == 'Pending') {
                  echo '<span style="position:absolute; visibility: hidden">1</span><span data-toggle="tooltip" title="Acknowledge customer\'s request" class="glyphicon glyphicon-alert alerta" aria-hidden="true" style="color: orange;"></span>';
                } elseif ($row['status'] == 'In Progress') {
                  echo '<span style="position:absolute; visibility: hidden">4</span><span data-toggle="tooltip" title="In Progress" class="glyphicon glyphicon-cog kogi" aria-hidden="true" style="color: dodgerblue;"></span>';
                } else {                  
                  echo '<span style="position:absolute; visibility: hidden">5</span><span data-toggle="tooltip" title="Repair Complete" class="glyphicon glyphicon-ok-circle" aria-hidden="true" style="color: green;"></span>';
                }
                  
              ?>
            </center>
          </td>
          <td> 
            <center>
              <?php
                if ($row['status'] == 'No Technician') {
                  if ($row['bidStatus'] == 'Pending') { ?>
                    <button data-toggle="modal" data-target="#bidModal" data-toggle="tooltip" title="Place bid" type="button" class="btn btn-sm btn-primary" aria-label="Left Align" onclick='enterBid(<?php echo json_encode($row); ?>, "update")'>
                      <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                    </button>
              <?php } else {
              ?>
                  <button data-toggle="modal" data-target="#bidModal" data-toggle="tooltip" title="Edit bid" type="button" class="btn btn-sm btn-warning" aria-label="Left Align" onclick='enterBid(<?php echo json_encode($row); ?>, "update")'>
                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                  </button>
              <?php
                  }
                } elseif ($row['status'] == 'Pending') { ?> 
                  <button data-toggle="modal" data-target="#bidModal" data-toggle="tooltip" title="View Request" type="button" class="btn btn-sm btn-warning" aria-label="Left Align" onclick='enterBid(<?php echo json_encode($row); ?>, "view")'>
                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                  </button>
              <?php  } elseif ($row['status'] == 'In Progress') { ?>
                  <button data-toggle="modal" data-target="#confirmModal" data-toggle="tooltip" title="Set Repair Done!" type="button" class="btn btn-sm btn-success" aria-label="Left Align" onclick='repairDone(<?php echo json_encode($row); ?>)'>
                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                  </button>
              <?php } else { ?>
                  <button data-toggle="modal" data-target="#bidModal" data-toggle="tooltip" title="View Summary" type="button" class="btn btn-sm btn-default" aria-label="Left Align" onclick='enterBid(<?php echo json_encode($row); ?>, "view")'>
                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                  </button>
              <?php } ?>
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

<!-- Modal -->
<div class="modal fade" id="bidModal" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h2 id="modal-title1" class="modal-title update-bid" style="display: inline;">Place Bid</h2>
        <h2 id="modal-title2" class="modal-title view-bid" style="display: inline;">Summary</h2>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- ======= UPDATE BID ======= -->
      <div id="modal-form1" class="update-bid">
        <form name="modal-form" onsubmit="submitBid();return false">
          <input style="visibility: hidden; height: 0;" type="text" class="form-control" name="id" id="id" aria-describedby="sizing-addon2">
          <input style="visibility: hidden; height: 0;" type="text" class="form-control" name="problem_id" id="problem_id" aria-describedby="sizing-addon2">

          <div id="hals" class="modal-body">
            <div class="row">
              <div class="col-xs-12">
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">Days to Repair</span>
                  <input type="text" class="form-control" placeholder="Enter Days to Repaird" name="repairdays" id="repairdays" aria-describedby="sizing-addon2" required>
                </div>
              </div>
            </div><br />

            <label>Payment Breakdown</label>
            <div class="form-group multiple-form-group input-group">
              <div class="row" style="margin-bottom: 8px;">
                <!-- <label>Paymen Breakdown</label> -->
                <div class="col-xs-6">
                  <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon2">Description</span>
                    <input type="text" class="form-control" name="descr" placeholder="Enter Description" aria-describedby="sizing-addon2" required>
                  </div>
                </div>
      
                <div class="col-xs-6">
                  <div class="input-group">
                    <input type="text" class="form-control bid-price" name="price" placeholder="Enter Price" required>
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-success btn-add">+</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <center>
              <h2 id="total-bid-price">₱0.00</h2>
              <p style="margin-top: -10px; color: #adadad;">Total Bid Price</p>
            </center>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>

      <!-- ======= VIEW BID ======= -->
      <form id="modal-form2" name="modal-form2" class="view-bid" onsubmit="ack(event);return false">
        <input style="visibility: hidden; height: 0;" type="text" class="form-control" name="problem_id" id="problem_id_view">
        <input style="visibility: hidden; height: 0;" type="text" class="form-control" name="status" id="su">

        <div id="hals" class="modal-body">
          <div class="row">
            <div class="col-xs-6">
              <label>ID</label>
              <p id="summary-id">PR-1</p>
            </div>
            <div class="col-xs-6">
              <label>Status</label>
              <p id="summary-status">Pending</p>
            </div>
          </div>

          <div class="row">
            <div class="col-xs-12">
              <label>Name</label>
              <p id="summary-name">Ryan Suzuki</p>
            </div>
          </div>

          <div class="row">
            <div class="col-xs-6">
              <label>Serial Numver</label>
              <p id="summary-serialNumber">1S9ABCON4R</p>
            </div>
            <div class="col-xs-6">
              <label>Brand</label>
              <p id="summary-brand">Samsung</p>
            </div>
          </div>

          <div class="row">
            <div class="col-xs-6">
              <label>Problem</label>
              <p id="summary-problem">Motherboard</p>
            </div>
            <div class="col-xs-6">
              <label>Days to Repair</label>
              <p id="summary-repairdays">6</p>
            </div>
          </div>

          <label>Payment Breakdown</label>
          <table class="table">
            <thead>
              <th>Descr</th>
              <th style="text-align: right;">Price</th>
            </thead>
            <tbody id="payment-breakdown">
              <tr>
                <td>Materials</td>
                <td style="text-align: right;">₱200.00</td>
              </tr>
            </tbody>
            <tfoot>
              <td colspan="2" style="text-align: right; font-weight: 600; "><span style="margin-right: 10px;">Total Payment:</span> <span id="summary-total-price">₱0.00</span></td>
            </tfoot>
          </table>

        </div>
        <div id="view-footer" class="modal-footer">
          <input type="submit" class="btn btn-danger" name="status"  value="Decline" onclick="setStatus('No Technician')">
          <input type="submit" class="btn btn-success" name="status"  value="Accept" onclick="setStatus('In Progress')">
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="confirmModal" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" style="display: inline;">Confirmation</h2>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <form id="modal-form3" name="modal-form3" onsubmit="ackRepair();return false">
        <input style="visibility: hidden; height: 0;" type="text" class="form-control" name="id" id="problemo" aria-describedby="sizing-addon2">

        <div id="hals" class="modal-body">
          <p>Are you sure you want to set this status to finished?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Proceed</button>
        </div>
      </form>
    </div>
  </div>
</div>