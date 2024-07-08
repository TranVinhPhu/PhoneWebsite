<?php
  $content = '<div class="row">
                <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Danh sách sản phẩm</h3>
                  </div>
                  <div class="box-body">
                    <table id="products" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>Thương hiệu</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Hình ảnh</th>
                        <th>Mô tả</th>
                        <th>Ngày đăng ký</th>
                        <th>Hành động</th>
                      </tr>
                      </thead>
                      <tbody>
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>Thương hiệu</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Hình ảnh</th>
                        <th>Mô tả</th>
                        <th>Ngày đăng ký</th>
                        <th>Hành động</th>
                      </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div id="pagination" class="text-center"></div>';
  include('../master.php');
?>

<script>
$(document).ready(function(){
    var pageSize = 7;
    var currentPage = 1;

    function displayProducts(page) {
        $.ajax({
            type: "GET",
            url: "../api/product/read.php",
            dataType: 'json',
            data: { page: page, pageSize: pageSize },
            success: function(data) {
                var response = "";
                for (var product in data.products) {
                    response += "<tr>" +
                        "<td>" + data.products[product].item_brand + "</td>" +
                        "<td>" + data.products[product].item_name + "</td>" +
                        "<td>" + data.products[product].item_price + "</td>" +
                        "<td><img src='" + data.products[product].item_image + "' alt='Product Image' height='50' width='50' /></td>" +
                        "<td>" + data.products[product].item_description + "</td>" +
                        "<td>" + data.products[product].item_register + "</td>" +
                        "<td><a href='updatep.php?item_id=" + data.products[product].item_id + "'>Sửa</a> | <a href='#' onClick=Remove('" + data.products[product].item_id + "')>Xóa</a></td>" +
                        "</tr>";
                }
                $("#products tbody").html(response);
                currentPage = page;
                displayPagination(data.totalPages); // Thêm totalPages vào đây
            },
            error: function(xhr, status, error) {
                var errorMessage = xhr.status + ': ' + xhr.statusText;
                alert('AJAX request failed: ' + errorMessage);
            }
        });
    }

    function displayPagination(totalPages) {
        var pagination = $("#pagination");
        pagination.empty();
        var prevButton = $("<button class='btn btn-default'>&lt;</button>").click(function() {
            if (currentPage > 1) {
                currentPage--;
                displayProducts(currentPage);
            }
        });
        pagination.append(prevButton);
        for (var i = 1; i <= totalPages; i++) {
            var pageButton = $("<button class='btn btn-default'>" + i + "</button>").click(function() {
                var pageNum = parseInt($(this).text());
                currentPage = pageNum;
                displayProducts(pageNum);
            });
            if (i === currentPage) {
                pageButton.addClass('active');
            }
            pagination.append(pageButton);
        }
        var nextButton = $("<button class='btn btn-default'>&gt;</button>").click(function() {
            if (currentPage < totalPages) {
                currentPage++;
                displayProducts(currentPage);
            }
        });
        pagination.append(nextButton);
    }

    displayProducts(currentPage);
});

function Remove(item_id){
    var result = confirm("Bạn có muốn xóa sản phẩm này?");
    if (result == true) { 
        $.ajax({
            type: "POST",
            url: '../api/product/delete.php',
            dataType: 'json',
            data: {
                item_id: item_id
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Xóa sản phẩm thành công");
                    window.location.href = 'allp.php';
                } else {
                    alert(result['message']);
                }
            }
        });
    }
}
</script>
