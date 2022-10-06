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
  <div>
    @if (session()->has('message'))
        <div class="alert alert-success col-md-4" style="float:right">
          <button type="button" class="close" data-dismiss="alert">x</button>
            {{ session('message') }}
        </div>
    @endif
  </div>

  <form class="form" action="##" method="post" id="registrationForm" wire:submit.prevent="save">
    <div class="row">
      <div class="col-sm-5">
        <div class="text-center mt-4">
          @if ($avatar)
          <img src="{{ $avatar->temporaryUrl() }}" class="avatar img-circle img-thumbnail"
          alt="avatar" width="200px" height="200px">
          @else
          <img src="{{ Storage::url($oldAvatar) }}" class="avatar img-circle img-thumbnail"
            alt="avatar" width="200px" height="200px">
          @endif


          <h6>Thay đổi ảnh đại diện</h6>
          <input type="file" wire:model="avatar" class="text-center center-block file-upload">
        </div>
        <br>
      </div>
      <div class="col-sm-7">
        <div class="form-group">          
          <div class="col-xs-6">
              <label for="first_name">Tên tài khoản</h4></label>
              <input type="text" class="form-control" wire:model="name" id="name" placeholder="Tên tài khoản" title="enter your first name if any.">
          </div>
        </div>
        <div class="form-group">          
          <div class="col-xs-6">
              <label for="first_name"><h4>Email</h4></label>
              <input type="email" class="form-control" wire:model="email" id="email" placeholder="Email" title="enter your first name if any.">
          </div>
        </div>
        <div class="form-group">          
          <div class="col-xs-6">
              <label for="first_name"><h4>Số điện thoại</h4></label>
              <input type="text" class="form-control" wire:model="phone" id="phone" placeholder="Số điện thoại" title="enter your first name if any.">
          </div>
        </div>
        <div class="form-group">          
          <div class="col-xs-6">
            <legend for="gender" class="col-form-label">Giới tính</legend>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" wire:model="gender" id="inlineRadio1" value="0">
              <label class="form-check-label" for="inlineRadio1">Nam</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" wire:model="gender" id="inlineRadio2" value="1">
              <label class="form-check-label" for="inlineRadio2">Nữ</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" wire:model="gender" id="inlineRadio3" value="2">
              <label class="form-check-label" for="inlineRadio3">Chưa xác định</label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
               <br>
               <button class="btn btn-lg btn-primary" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Lưu</button>
                <a class="btn btn-lg btn-light" type="button" href="{{ route('home') }}"><i class="glyphicon glyphicon-repeat"></i> Thoát</a>
           </div>
        </div>
      </div>  
    </div>
  </form>
</div>