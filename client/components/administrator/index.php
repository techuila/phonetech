<?php include 'server/functions.php'?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="client/assets/css/app.css">
</head>
<body>
  <!-- Navigation bar -->
  <?php include 'client/components/common/navbar.php' ?>

  <div class="container-c">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">First Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">Email</th>
          <th scope="col">Username</th>
          <th scope="col">Password <span class="pass glyphicon glyphicon-info-sign" data-toggle="tooltip" title="Hover to reveal password"></span></th>
          <th scope="col">User Type</th>
          <th scope="col">Contact Number</th>
          <th scope="col">Address</th>
          <th scope="col">Status</th>
          <th scope="col">Certificate</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $index = 0;
          $results = fetchAll("SELECT * FROM customer_account WHERE type NOT IN  ('Administrator', 'Customer');");
          // echo $results[0]['FirstName'];
          // echo '<pre>'; print_r($results); echo '</pre>';
          foreach ($results as $key => $result) {
            $index += 1;
            $filename = $result['certificate'];
        ?>
          <tr>
            <th scope="row"><?php echo  $index; ?></th>
            <td><?php echo $result['FirstName']; ?></td>
            <td><?php echo $result['LastName']; ?></td>
            <td><?php echo $result['Email']; ?></td>
            <td><?php echo $result['Username']; ?></td>
            <td class="user-pass"><?php echo $result['Password']; ?></td>
            <td><?php echo $result['type']; ?></td>
            <td><?php echo '+' . $result['ContactNumber']; ?></td>
            <td><?php echo $result['Address']; ?></td>
            <td><?php echo $result['status']; ?></td>
            <td><a href="#" data-toggle="modal" data-target="#image-viewer" onclick="displayImage('<?= $filename; ?>')"><?php echo $filename; ?></a></td>
            <td>
              <center>
                <!-- <?php if (in_array($result['status'], array("Pending", "Inactive"))) { ?>
                  <button data-toggle="tooltip" title="Activate Account" type="button" class="btn btn-sm btn-primary" aria-label="Left Align" onclick="changeStatus(<?php echo $result['Customer_ID']; ?>, 'Active')">
                    <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
                  </button>
                <?php } else { ?>
                  <button data-toggle="tooltip" title="Disable Account" type="button" class="btn btn-sm btn-danger" aria-label="Left Align" onclick="changeStatus(<?php echo $result['Customer_ID']; ?>, 'Inactive')">
                    <span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>
                  </button>
                <?php } ?> -->

                <?php if ($result['status'] == 'Pending') { ?>
                  <input type="button" class="btn btn-danger" name="status" value="Decline" onclick="changeStatus(<?php echo $result['Customer_ID']; ?>, 'Inactive')">
                  <input type="button" class="btn btn-success" name="status" value="Accept" onclick="changeStatus(<?php echo $result['Customer_ID']; ?>, 'Active')">

                <!-- onclick='editAccount(<?php echo json_encode($result); ?>)' -->
                <!-- <button type="button" title="Edit Account" type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal" onclick='selectUser(<?php echo json_encode($result); ?>)'>
                  <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                </button> -->
                <?php } ?>
                </center>
            </td>
          </tr>
        <?php }
          if ($index === 0) {
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

  <div class="modal fade" id="image-viewer" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <img id="img-view" src="" width="100%" class="rounded mx-auto d-block" alt="Responsive image">
        </div>
      </div>
    </div>


  <div class="container" style="padding: 0;">
    <!-- Modal -->
    <div class="modal fade" id="editModal" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <center><h4 class="modal-title">Edit User</h4></center>
          </div>
          <form id="modal-form" name="modal-form" onsubmit="editAccount();return false">
            <input style="visibility: hidden; height: 0;" type="text" class="form-control" name="Customer_ID" id="Customer_ID" aria-describedby="sizing-addon2">
            <input style="visibility: hidden; height: 0;" type="text" class="form-control" name="Username1" id="Username1" aria-describedby="sizing-addon2">

            <div class="modal-body">
              <div id="registration-form">
                <div class="row">
                  <div class="col-xs-6">
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">First Name</span>
                      <input type="text" class="form-control" placeholder="Enter First Name" name="FirstName" id="FirstName" aria-describedby="sizing-addon2" required>
                    </div>
                  </div>

                  <div class="col-xs-6">
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">Last Name</span>
                      <input type="text" class="form-control" placeholder="Enter Last Name" name="LastName" id="LastName" aria-describedby="sizing-addon2" required>
                    </div>
                  </div>

                  <div class="col-xs-12">
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">Username</span>
                      <input type="text" class="form-control" placeholder="Enter Username" name="Username" id="Username" aria-describedby="sizing-addon2" required>
                    </div>
                  </div>
                  
                  <div class="col-xs-12">
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">Contact Number (+63)</span>
                      <input maxlength="10" type="text" class="form-control" placeholder="Enter Contact Number" name="ContactNumber" id="ContactNumber" aria-describedby="sizing-addon2" required>
                    </div>
                  </div>

                  <div class="col-xs-12">
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">Email Address</span>
                      <input type="email" class="form-control" placeholder="Enter Email Address" name="Email" id="Email" aria-describedby="sizing-addon2" required>
                    </div>
                  </div>

                  <div class="col-xs-12">
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">Address</span>
                      <input type="text" class="form-control" placeholder="Enter Address" name="Address" id="Address" aria-describedby="sizing-addon2" required>
                    </div>
                  </div>

                  <div class="user-type">
                    <input id="Customer" type="radio" name="type" value="Customer" checked> Customer
                    <input id="Technician" type="radio" name="type" value="Technician">  Technician
                  </div>

                  <div class="col-xs-12">
                    <input id="change-pass" name="ChangePass" value="true" type="checkbox" onclick="hidePass()"> Change Password
                  </div>
                  <div id="password-container">
                    <div class="col-xs-6">
                      <div class="input-group">
                        <span class="input-group-addon" id="sizing-addon2">Password</span>
                        <input type="password" class="form-control" placeholder="Enter Password" name="Password1" id="Password1" aria-describedby="sizing-addon2">
                      </div>
                    </div>
  
                    <div class="col-xs-6">
                      <div class="input-group">
                        <span class="input-group-addon" id="sizing-addon2">Confirm Password</span>
                        <input type="password" class="form-control" placeholder="Repeat Password" name="Password2" id="Password2" aria-describedby="sizing-addon2">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    function displayImage(filename) {
      console.log(filename)
      $('#img-view').attr('src','/phonetech/server/uploads/'+filename);
    }

    function hidePass() {
      if (!$("#change-pass").is(':checked')) {
        $("input").attr("required", false);
        $("#password-container").css('display', 'none');
      } else {
        $("input").attr("required", true);
        $("#password-container").css('display', 'initial');
      }
    }

    function changeStatus(id, status) {
      $.post('/phonetech/server/customerserver.php', { id, status, ChangeStatus: null }, (result) => {
        result = JSON.parse(result)
        if(result.success) {
          if (status == 'Inactive') {
            alert('Successfully Declined Request!')
          } else {
            alert('Successfully Accepted Request!')
          }
          window.location = 'index.php'
        } else {
          alert('Error upon changing status. Check console.log for error details.');
          console.log(result.msg)
        }
      });
    }

    function editAccount() {
      const formData = new FormData(document.forms.namedItem('modal-form'))
      let payload = {};
      formData.forEach((value,key) => payload[key] = value )

      $.post('/phonetech/server/customerserver.php', { ...payload, Register: null, EditAccount: null }, (result) => {
        result = JSON.parse(result)
        if(result.success) {
          alert('Account successfully updated!');
          window.location = 'index.php'
        } else {
          alert(result.msg[0]);
          console.log(result.msg)
        }
      });
    }


    function selectUser(row) {
      $('#Customer_ID').val(row.Customer_ID);
      $('#FirstName').val(row.FirstName);
      $('#LastName').val(row.LastName);
      $('#Username').val(row.Username);
      $('#Username1').val(row.Username);
      $('#ContactNumber').val(row.ContactNumber);
      $('#Email').val(row.Email);
      $('#Address').val(row.Address);

      if (row.type == 'Customer') {
        $('#Customer').click()
      } else {
        $('#Technician').click()
      }
    }
  </script>
</body>
</html>