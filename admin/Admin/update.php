<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include '../api/user/update.php';
    }
?>
<?php
$content = '<div class="row">
              <!-- left column -->
              <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Cập nhật người dùng</h3>
                  </div>
                  <form id="reg-form" action="update.php" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                      <div class="form-group">
                        <label for="exampleInputFirstName">Tên</label>
                        <input type="text" class="form-control" id="first_name" placeholder="Nhập Tên">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputLastName">Họ</label>
                        <input type="text" class="form-control" id="last_name" placeholder="Nhập Họ">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="Nhập email">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputProfileImage">Hình đại diện</label>
                        <input type="file" class="form-control-file" id="profile_image" name="profile_Upload">
                      </div>
                    </div>
                    <div class="box-footer">
                      <button type="button" class="btn btn-primary" onClick="UpdateUser()">Cập nhật</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>';
include('../master.php');
?>
<script>
  $(document).ready(function(){
    $.ajax({
      type: "GET",
      url: "../api/user/read_single.php?user_id=<?php echo $_GET['user_id']; ?>",
      dataType: 'json',
      success: function(data) {
        $("#first_name").val(data['first_name']);
        $("#last_name").val(data['last_name']);
        $("#email").val(data['email']);
        $("#password").val(data['password']);
      },
      error: function (result) {
        console.log(result);
      }
    });
  });

  function UpdateUser(){
    var formData = new FormData();
    formData.append('user_id', <?php echo $_GET['user_id']; ?>);
    formData.append('first_name', $("#first_name").val());
    formData.append('last_name', $("#last_name").val());
    formData.append('email', $("#email").val());
    formData.append('password', $("#password").val());
    formData.append('profile_Upload', $("#profile_image")[0].files[0]);

    $.ajax({
      type: "POST",
      url: '../api/user/update.php',
      data: formData,
      contentType: false,
      processData: false,
      dataType: 'json',
      error: function (result) {
        console.log(result.responseText);
      },
      success: function (result) {
        if (result['status'] == true) {
          alert("User Updated Successfully!");
          window.location.href = '../Admin';
        } else {
          alert(result['message']);
        }
      }
    });
  }
</script>
