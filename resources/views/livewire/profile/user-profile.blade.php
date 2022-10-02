<div class="container bootstrap snippet">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Thông tin cá nhân</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Thông tin cá nhân</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <form class="form" action="##" method="post" id="registrationForm">
    <div class="row">
      <div class="col-sm-5">
        <div class="text-center mt-4">
          <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail"
            alt="avatar">
          <h6>Thay đổi ảnh đại diện</h6>
          <input type="file" class="text-center center-block file-upload">
        </div>
        <br>
      </div>
      <div class="col-sm-7">
        <div class="form-group">          
          <div class="col-xs-6">
              <label for="first_name">Tên tài khoản</h4></label>
              <input type="text" class="form-control" name="name" id="name" placeholder="Tên tài khoản" title="enter your first name if any.">
          </div>
        </div>
        <div class="form-group">          
          <div class="col-xs-6">
              <label for="first_name"><h4>Email</h4></label>
              <input type="email" class="form-control" name="email" id="email" placeholder="Email" title="enter your first name if any.">
          </div>
        </div>
        <div class="form-group">          
          <div class="col-xs-6">
              <label for="first_name"><h4>Số điện thoại</h4></label>
              <input type="text" class="form-control" name="phone" id="phone" placeholder="Số điện thoại" title="enter your first name if any.">
          </div>
        </div>
        <div class="form-group">          
          <div class="col-xs-6">
              <legend for="first_name"><h4>Giới tính</h4></legend>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                <label class="form-check-label" for="inlineRadio1">Nam</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                <label class="form-check-label" for="inlineRadio2">Nữ</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
                <label class="form-check-label" for="inlineRadio3">Chưa xác định</label>
              </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
               <br>
               <button class="btn btn-lg btn-primary" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Lưu</button>
                <button class="btn btn-lg btn-light" type="reset"><i class="glyphicon glyphicon-repeat"></i> Thoát</button>
           </div>
        </div>
      </div>  
    </div>
  </form>
</div>