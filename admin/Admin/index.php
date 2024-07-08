<?php
$content = '<div class="row">
                <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Danh sách người dùng</h3>
                  </div>
                  <div class="box-body">
                    <table id="users" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>Tên</th>
                        <th>Họ</th>
                        <th>Email</th>
                        <th>Hình đại diện</th>
                        <th>Ngày đăng ký</th>
                        <th>Hành động</th>
                      </tr>
                      </thead>
                      <tbody>
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>Tên</th>
                        <th>Họ</th>
                        <th>Email</th>
                        <th>Hình đại diện</th>
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

    function displayUsers(page) {
        $.ajax({
            type: "GET",
            url: "../api/user/read.php",
            dataType: 'json',
            data: { page: page, pageSize: pageSize },
            success: function(data) {
                var response = "";
                for (var user in data.users) {
                    response += "<tr>" +
                        "<td>" + data.users[user].first_name + "</td>" +
                        "<td>" + data.users[user].last_name + "</td>" +
                        "<td>" + data.users[user].email + "</td>" +
                        "<td><img src='" + data.users[user].profileImage + "' alt='Profile Image' height='50' width='50' /></td>" +
                        "<td>" + data.users[user].register_date + "</td>" +
                        "<td><a href='update.php?user_id=" + data.users[user].user_id + "'>Sửa</a> | <a href='#' onClick=Remove('" + data.users[user].user_id + "')>Xóa</a></td>" +
                        "</tr>";
                }
                $("#users tbody").html(response);
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
                displayUsers(currentPage);
            }
        });
        pagination.append(prevButton);
        for (var i = 1; i <= totalPages; i++) {
            var pageButton = $("<button class='btn btn-default'>" + i + "</button>").click(function() {
                var pageNum = parseInt($(this).text());
                currentPage = pageNum;
                displayUsers(pageNum);
            });
            if (i === currentPage) {
                pageButton.addClass('active');
            }
            pagination.append(pageButton);
        }
        var nextButton = $("<button class='btn btn-default'>&gt;</button>").click(function() {
            if (currentPage < totalPages) {
                currentPage++;
                displayUsers(currentPage);
            }
        });
        pagination.append(nextButton);
    }

    displayUsers(currentPage);
});

function Remove(user_id){
    var result = confirm("Bạn có muốn xóa người dùng này?");
    if (result == true) { 
        $.ajax({
            type: "POST",
            url: '../api/user/delete.php',
            dataType: 'json',
            data: {
                user_id: user_id
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Thành công xóa người dùng");
                    window.location.href = 'index.php';
                } else {
                    alert(result['message']);
                }
            }
        });
    }
}
</script>