<?php 
$content = '<div class="row">
              <!-- left column -->
              <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Thêm sản phẩm</h3>
                  </div>
                  <!-- /.box-header -->
                  <!-- form start -->
                  <form role="form" id="createForm">
                    <div class="box-body">
                      <div class="form-group">
                        <label for="exampleInputBrand">Thương hiệu</label>
                        <select class="form-control" id="brand">
                          <option value="Samsung">Samsung</option>
                          <option value="Apple">Apple</option>
                          <option value="Redmi">Redmi</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="item_name" placeholder="Nhập tên sản phẩm">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPrice">Giá</label>
                        <input type="text" class="form-control" id="item_price" placeholder="Nhập giá">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputImage">Hình ảnh</label>
                        <input type="file" class="form-control-file" id="item_image" name="imageUpload" accept="image/*">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputDescription">Mô tả</label>
                        <textarea class="form-control" id="item_description" placeholder="Nhập mô tả"></textarea>
                      </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                      <button type="button" class="btn btn-primary" onClick="AddProduct()">Thêm</button>
                    </div>
                  </form>
                </div>
                <!-- /.box -->
              </div>
            </div>';
include('../master.php');
?>
<script>
  function AddProduct(){
    var formData = new FormData();
    formData.append('item_brand', $("#brand").val());
    formData.append('item_name', $("#item_name").val());
    formData.append('item_price', $("#item_price").val());
    formData.append('imageUpload', $("#item_image")[0].files[0]);
    formData.append('item_description', $("#item_description").val());

    $.ajax({
      type: "POST",
      url: '../api/product/create.php',
      data: formData,
      contentType: false,
      processData: false,
      dataType: 'json',
      error: function (result) {
        console.log(result.responseText);
      },
      success: function (result) {
        if (result['status'] == true) {
          alert("Thêm sản phẩm thành công!");
          window.location.href = 'allp.php';
        } else {
          alert(result['message']);
        }
      }
    });
  }
</script>
