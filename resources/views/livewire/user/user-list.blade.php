<div>
  <div>
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Quản lý người dùng</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Quản lý người dùng</li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      <div class="function-part">
        <div class="input-group col-md-4 search">
          <input type="text" class="form-control" wire:model="searchTerm" placeholder="Nhập tên người dùng ..." aria-label="Recipient's username" aria-describedby="basic-addon2" />
          <button class="btn btn-warning reset ml-2" type="button" wire:click="resetSearch()">Làm mới <i class="bi bi-arrow-counterclockwise"></i></button>
        </div>
        
        <div class="create-new mr-2">
          <button class="btn btn-primary create-new" type="button" data-toggle="modal" data-target="#exampleModal" wire:click = "openCreateModal">Tạo mới <i class="bi bi-plus-lg"></i></button>
        </div>
      </div>
      
      @if (session()->has('message'))
      <div class="alert alert-success col-md-4" style="float:right">
        <button type="button" class="close" data-dismiss="alert">x</button>
          {{ session('message') }}
      </div>
      @endif

      <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">STT</th>
              <th scope="col">Tên tài khoản</th>
              <th scope="col">Email</th>
              <th scope="col">Số điện thoại</th>
              <th scope="col">Avatar</th>
              <th scope="col">Giới tính</th>
              <th scope="col">Hành động</th>
            </tr>
          </thead>
          <tbody>
            @if($data)
            @forelse($data as $key => $dt)
            <tr>
              <th scope="row">{{ $key + $data->firstItem() }}</th>
              <td>{{ $dt->name }}</td>
              <td>{{ $dt->email }}</td>
              <td>{{ $dt->phone }}</td>
              <td><img src="{{ asset('storage/'.substr($dt->avatar,7)) }}" alt="ảnh đại diện" width="50px" height="50px"></td>
              <td>
                @if($dt->gender == '0')
                  Nam
                @elseif($dt->gender == '1')
                  Nữ
                @else
                  Chưa xác định
                @endif
              </td>
              <td>  
                <a href="#" class="ml-2 mr-4" wire:click="edit({{$dt->id}})"  data-toggle="modal" data-target="#exampleModal" type="button"><i class="bi bi-pencil"></i></a>              
                <a href="#"><i class="bi bi-trash"></i></a>
              </td>
            </tr>
            @empty
              <div>Không có bản ghi nào</div>
            @endforelse
            @endif
          </tbody>
        </table>
  </div>
<!-- modal tạo mới/update -->
  <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ $updateMode == false ? 'Tạo mới người dùng' : 'Cập nhật người dùng' }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeModal()">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="name" class="col-form-label">Tên tài khoản</label>
              <input type="text" class="form-control" wire:model="name">
              @error('name') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
              <label for="email" class="col-form-label">Email</label>
              <input type="email" class="form-control" wire:model="email">
              @error('email') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
              <label for="avatar" class="col-form-label">Avatar</label>
              <input type="file" class="form-control" wire:model="avatar" id="upload{{$iteration}}">
              @if ($avatar)
                  <img src="{{ $avatar->temporaryUrl() }}" width="200px" height="200px">
              @else
                  <img src="" width="200px" height="200px">
              @endif
              @error('avatar') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
              <label for="phone" class="col-form-label">Số điện thoại</label>
              <input type="text" class="form-control" wire:model="phone">
              @error('phone') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
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
              @error('gender') <span class="error">{{ $message }}</span> @enderror
            </div>
            @if($updateMode == false)
            <div class="form-group">
              <label for="password" class="col-form-label">Mật khẩu</label>
              <input type="password" class="form-control" wire:model="password">
              @error('password') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
              <label for="confirm_password" class="col-form-label">Xác nhận mật khẩu</label>
              <input type="password" class="form-control" wire:model="confirm_password">
              @error('confirm_password') <span class="error">{{ $message }}</span> @enderror
            </div>
            @endif
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="closeModal">Đóng</button>
          <button type="submit" class="btn btn-primary btn-save" data-dismiss="modal">Lưu</button>
        </div>
      </div>
    </div>
  </div>
<!-- -->

  @if(count($data) > 0)
  <div class="paginate-link mr-2">
    {{ $data->links() }}
  </div>
  @endif
</div>
