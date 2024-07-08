<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include '../api/product/updatep.php';
    }
?>
<?php
$content = '<div class="row">
              <!-- left column -->
              <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Cập nhật sản phẩm</h3>
                  </div>
                  <form id="reg-form" action="updatep.php" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                      <div class="form-group">
                        <label for="exampleInputBrand">Thương hiệu</label>
                        <select class="form-control" id="item_brand">
                          <option value="Samsung">Samsung</option>
                          <option value="Apple">Apple</option>
                          <option value="Redmi">Redmi</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="item_name" placeholder="Nhập Tên sản phẩm">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPrice">Giá sản phẩm</label>
                        <input type="text" class="form-control" id="item_price" placeholder="Nhập Giá sản phẩm">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputDescription">Mô tả sản phẩm</label>
                        <textarea class="form-control" id="item_description" placeholder="Nhập Mô tả sản phẩm"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputImage">Hình ảnh sản phẩm</label>
                        <input type="file" class="form-control-file" id="item_image" name="imageUpload" accept="image/*">
                      </div>
                    </div>
                    <div class="box-footer">
                      <button type="button" class="btn btn-primary" onClick="UpdateProduct()">Cập nhật</button>
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
      url: "../api/product/read_single.php?item_id=<?php echo $_GET['item_id']; ?>",
      dataType: 'json',
      success: function(data) {
        $("#item_brand").val(data['item_brand']);
        $("#item_name").val(data['item_name']);
        $("#item_price").val(data['item_price']);
        $("#item_description").val(data['item_description']);
      },
      error: function (result) {
        console.log(result);
      }
    });
  });

  function UpdateProduct(){
    var formData = new FormData();
    formData.append('item_id', <?php echo $_GET['item_id']; ?>);
    formData.append('item_brand', $("#item_brand").val());
    formData.append('item_name', $("#item_name").val());
    formData.append('item_price', $("#item_price").val());
    formData.append('item_description', $("#item_description").val());
    formData.append('imageUpload', $("#item_image")[0].files[0]);

    $.ajax({
      type: "POST",
      url: '../api/product/update.php',
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
