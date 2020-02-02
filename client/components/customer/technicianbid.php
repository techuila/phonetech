<div class="container">
  <div class="header-cont">
    <h2>Technician Bid</h2>
    <button data-toggle="modal" data-target="#PostMalone" type="button" class="btn btn-sm btn-primary" aria-label="Left Align">
      <span class="glyphicon glyphicon-envelope " aria-hidden="true"></span>
      Post Problem
    </button>
  </div>
  <hr>
  <div class="form-group">
    <label for="phone-select">My Phone</label>
    <select class="form-control" id="phone-select">
      <option value="" disabled>Select Phone</option>
      <?php
        $conn1 = new mysqli("localhost", "root", "", "phonetech_db");
        $sql1 = "SELECT a.*, b.FirstName, b.LastName, b.ContactNumber, c.rating FROM problem_tb a LEFT OUTER JOIN customer_account b ON a.tech_id = b.Customer_ID LEFT OUTER JOIN rating_tb c ON a.id = c.problem_id WHERE a.user_id = " . $_SESSION['Customer_ID'];
        $res1 = $conn1->query($sql1);
        $status = '';
        $haveFeedback = false;
        while ($row2 = $res1->fetch_assoc()) {
          if (isset($_GET['problem_id'])) {
            if (htmlspecialchars($_GET["problem_id"]) == $row2['id']) {
              if($row2['status'] == 'In Progress' || $row2['status'] == 'Finished')
                $status = $row2['status'];

              if ($row2['rating'] != '' && $row2['rating'] != null)
                $haveFeedback = true;
            }
          }
      ?>
        <option value="<?=$row2['id']?>" data-name="<?=$row2['FirstName'] . ' ' . $row2['LastName']?>" data-contactNumber="<?= $row2['ContactNumber'] ?>" data-filter="<?=$row2['filter']?>" data-problem="<?=$row2['problem']?>"> <?=$row2['brand']?> | <?=$row2['serialNumber']?> </option>
      <?php } ?>
    </select>
  </div>

  <?php if (isset($_GET['problem_id']) && $status == '') { ?>
    <span><b>Problem: </b></span> <span id="problem-label"></span><br /><br />
    <table id="technicianbid-table" class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Payment Breakdown</th>
          <th scope="col" style="text-align: center;">Days To Repair</th>
          <th scope="col"style="text-align: right;">Expected Date to Finish</th>
          <th scope="col" style="text-align: center;">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
          // SORT BID BY TOP SUGGESTION ((SUM(x.price) * a.repairdays) / 2)
          setlocale(LC_MONETARY, 'en_US');
          $conn = new mysqli("localhost", "root", "", "phonetech_db");
          $sql = "SELECT a.*,b.tech_id as techs_id,b.status as prob_status, ((SUM(x.price) * a.repairdays) / 2) as ave FROM bid_tb a INNER JOIN problem_tb b ON a.problem_id = b.id INNER JOIN payment_breakdown x ON x.bid_id = a.id WHERE a.problem_id = " . htmlspecialchars($_GET["problem_id"]) . " GROUP BY a.id ORDER BY ave ASC;";
          $res = $conn->query($sql); 
          $x = 0;
          while ($row = $res->fetch_assoc()) {
            $bid_id = $row['id'];
            $sql1 = "SELECT * FROM payment_breakdown WHERE bid_id = $bid_id";
            $res1 = $conn->query($sql1); 
            $x += 1;
        ?>
            <tr>
              <td> 
                <span><span style="position: absolute; visibility: hidden">₱</span><?= $x ?> </span>
                <?= ($row['tech_id'] == $row['techs_id'] && $row['prob_status'] == 'Pending') ? '<span data-toggle="tooltip" data-title="You selected this bid" class="glyphicon glyphicon-ok-circle" aria-hidden="true" style="color: green;"></span>' : '' ?>
              </td>
              <td>
                <table class="table">
                  <thead>
                    <th>Description</th>
                    <th>Price</th>
                  </thead>
                  <tbody>
                    <?php
                      $total = 0;
                      while ($row1 = $res1->fetch_assoc()) {
                        $total += $row1['price'];
                    ?>
                      <tr>
                        <td><?= $row1['descr'] ?></td>
                        <td><?= '₱ '. money_format("%!n", $row1['price']) ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                    <td style="font-weight: 600; text-align: right;">Total Payment:</td>
                    <td style="font-weight: 600;"><?= '₱ ' . money_format("%!n", $total); ?></td>
                  </tfoot>
                </table>
                <span style="visibility: hidden;"><?= $total; ?></span>
              </td>
              <td style="text-align: center;"> <?=$row['repairdays']?></td>
              <td style="text-align: right;"> 
                <?php
                  $today = new DateTime();
                  date_add($today, date_interval_create_from_date_string($row['repairdays']. ' days'));
                  echo date_format($today,"Y-m-d");
                ?>
              </td>
              <td>
                <center>
                  <button title="Select this bid" data-toggle="modal" data-target="#confirmModal" type="button" class="btn btn-sm btn-primary" aria-label="Left Align" onclick='selectBid(<?php echo json_encode($row); ?>)'>
                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                  </button>
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
  <?php } elseif ($status != '') {?>
    <span><b>Filter: </b></span> <span id="filter-label"></span><br /><br />
    <span><b>Problem: </b></span> <span id="problem-label"></span><br /><br />
    <span><b>Technician Name: </b></span> <span id="technician-name"></span><br /><br />
    <span><b>Contact Number: </b></span> +<span id="technician-contact"></span><br /><br />

    <div class="jumbotron vertical-center">
      <?= 
        $status == 'In Progress' ? 
        '<span data-toggle="tooltip" title="In Progress" class="glyphicon glyphicon-cog kogi" aria-hidden="true" style="color: dodgerblue; font-size: 4em;"></span>
        <h2>Repair in Progress!</h2>
        <p>Technician is currently repairing your phone.</p>' :

        '<span data-toggle="tooltip" title="Finished" class="glyphicon glyphicon-ok-circle" aria-hidden="true" style="color: green; font-size: 4em;"></span>
        <h2>Repair Done!</h2>
        <p>Contact your technician to get your phone.</p>'
      ?>
    </div>
    <?php if ($status == 'Finished' && !$haveFeedback) { ?>
      <form id="form-rating" name="form-rating" class="vertical-center" onsubmit="submitFeedback();return false">
        <div class="form-group">
          <label>Send Your Feedback!</label>
          <div id="rate-me" class="rate">
            <span id="rate-1" data-rate="1" class="fa fa-star checked"></span>
            <span id="rate-2" data-rate="2" class="fa fa-star checked"></span>
            <span id="rate-3" data-rate="3" class="fa fa-star checked"></span>
            <span id="rate-4" data-rate="4" class="fa fa-star"></span>
            <span id="rate-5" data-rate="5" class="fa fa-star"></span>
          </div>
          <input style="display: none; height: 0;" value="3" type="text" class="form-control" name="rating" id="rating">
          <input style="display: none; height: 0;" value="<?php echo htmlspecialchars($_GET["problem_id"]); ?>" type="text" class="form-control" name="problem_id" id="problem_id">
        </div>

        <div class="form-group" style="text-align: center;">
          <label for="exampleFormControlFile1">Upload Photo (Optional)</label>
          <input type="file" name="photo" class="form-control-file" id="exampleFormControlFile1">
        </div>

        <div class="form-group">
          <label style="text-align: center; width: 100%;">Comment</label>
          <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
  <?php } elseif ($status == 'Finished' && $haveFeedback) { echo '<div class="vertical-center"><label>Your feedback has been sent!</label></div>'; } 
    }?>
</div>

<div class="container" style="padding: 0;">
  <!-- Modal -->
  <div class="modal fade" id="PostMalone" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title">Post New Problem</h4></center>
        </div>
        <form id="modal-form" name="modal-form" onsubmit="postProblem();return false">
          <input style="display: none; height: 0;" value="<?php echo $_SESSION['Customer_ID']; ?>" type="text" class="form-control" name="user_id" id="user_id">
          <div class="modal-body">
            <div id="registration-form">
              <div class="row">

                <div class="col-xs-6">
                  <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon2">Brand</span>
                    <input type="text" class="form-control" placeholder="Enter Your Mobile Phone Brand" name="brand" id="brand" required>
                  </div>
                </div>

                <div class="col-xs-6">
                  <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon2">Serial Number</span>
                    <input type="text" class="form-control" placeholder="Enter Your Mobile Phone's Serian Number" name="serialNumber" id="serialNumber" required>
                  </div>
                </div>

                <div class="col-xs-12">
                  <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon2">Filter</span>
                    <select class="form-control" id="filter" name="filter">
                      <option value="None" selected>Other Specific Problem</option>
                      <option value="LCD">LCD</option>
                      <option value="Motherboard">Motherboard</option>
                    </select>
                  </div>
                </div>

                <div class="col-xs-12">
                  <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon2">Problem</span>
                    <input type="text" class="form-control" placeholder="Enter Problem" name="problem" id="problem" required>
                  </div>
                </div>

              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
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

      <form id="modal-form3" name="modal-form3" onsubmit="submitBid();return false">
        <div id="hals" class="modal-body">
          <p>Are you sure you want to choose this bid?</p>
        <input style="visibility: hidden; height: 0; position: absolute;" type="text" class="form-control" name="id" id="problem_id" aria-describedby="sizing-addon2">
        <input style="visibility: hidden; height: 0; position: absolute;" type="text" class="form-control" name="tech_id" id="tech_id" aria-describedby="sizing-addon2">
        <input style="visibility: hidden; height: 0; position: absolute;" type="text" class="form-control" name="status" id="status" aria-describedby="sizing-addon2">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Proceed</button>
        </div>
      </form>
    </div>
  </div>
</div>
