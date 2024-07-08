<?php 
$content = '<div class="row">
              <!-- left column -->
              <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Thêm người dùng</h3>
                  </div>
                  <!-- /.box-header -->
                  <!-- form start -->
                  <form role="form" id="createForm">
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
                        <input type="file" class="form-control-file" id="profile_image" name="profileUpload" accept="image/*">
                      </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                      <button type="button" class="btn btn-primary" onClick="AddUser()">Thêm</button>
                    </div>
                  </form>
                </div>
                <!-- /.box -->
              </div>
            </div>';
include('../master.php');
?>
<script>
  function AddUser(){
    var formData = new FormData();
    formData.append('first_name', $("#first_name").val());
    formData.append('last_name', $("#last_name").val());
    formData.append('email', $("#email").val());
    formData.append('password', $("#password").val());
    formData.append('profileUpload', $("#profile_image")[0].files[0]);

    $.ajax({
      type: "POST",
      url: '../api/user/create.php',
      data: formData,
      contentType: false,
      processData: false,
      dataType: 'json',
      error: function (result) {
        console.log(result.responseText);
      },
      success: function (result) {
        if (result['status'] == true) {
          alert("Thêm người dùng thành công!");
          window.location.href = '../Admin';
        } else {
          alert(result['message']);
        }
      }
    });
  }
</script>
