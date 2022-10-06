<div>
    <div>
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">Quản lý sản phẩm</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Quản lý sản phẩm</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
  
        <div class="function-part">
          <div class="input-group col-md-4 search">
            <input type="text" class="form-control" wire:model="searchTerm" placeholder="Nhập tên sản phẩm ..." aria-label="Recipient's username" aria-describedby="basic-addon2" />
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
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Mã sản phẩm</th>
                <th scope="col">Sản phẩm cha</th>
                <th scope="col">Danh mục sản phẩm</th>
                <th scope="col">Giá bán</th>
                <th scope="col">Giá bán (sale)</th>
                <th scope="col">Hình ảnh</th>
                <th scope="col">Mô tả</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Hành động</th>
              </tr>
            </thead>
            <tbody>
              @if($data)
              @forelse($data as $key => $dt)
              <tr>
                <th scope="row">{{ $key + $data->firstItem() }}</th>
                <td>{{ $dt->name }}</td>
                <td>{{ $dt->code }}</td>
                <td>{{ $dt->parent_id }}</td>
                <td>{{ $dt->category->name ?? '' }}</td>
                <td>{{ $dt->price }}</td>
                <td>{{ $dt->discount_price }}</td>
                <td><img src="{{ asset('storage/'.substr($dt->image,7)) }}" alt="ảnh sản phẩm" width="50px" height="50px"></td>
                <td>{{ $dt->description }}</td>
                <td>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" @if ($dt->status == 1) checked @endif disabled>
                    </div>
                </td>
                <td>  
                  <a href="#" class="ml-2 mr-4" wire:click="edit({{$dt->id}})"  data-toggle="modal" data-target="#exampleModal" type="button"><i class="bi bi-pencil"></i></a>              
                  <a href="#" wire:click="deleteId({{$dt->id}})" data-toggle="modal" data-target="#deleteModal" type="button"><i class="bi bi-trash"></i></a>
                </td>
              </tr>
              @empty
                <td colspan='12' class='text-center'>  Không có bản ghi nào </td>
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
            <h5 class="modal-title" id="exampleModalLabel">{{ $updateMode == false ? 'Tạo mới sản phẩm' : 'Cập nhật sản phẩm' }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeModal()">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="name" class="col-form-label">Tên sản phẩm</label>
                <input type="text" class="form-control" wire:model="name">
                @error('name') <span class="error">{{ $message }}</span> @enderror
              </div>
              <div class="form-group">
                <label for="code" class="col-form-label">Mã sản phẩm</label>
                <input type="text" class="form-control" wire:model="code" @if ($updateMode == true) disabled @endif>
                @error('code') <span class="error">{{ $message }}</span> @enderror
              </div>
              <div class="form-group">
                <label for="image" class="col-form-label">Hình ảnh</label>
                <input type="file" class="form-control" wire:model="image" id="upload{{$iteration}}">
                @if ($image != null && !is_string($image))
                    <img src="{{ $image->temporaryUrl() }}" width="200px" height="200px">
                @else
                    <img src="{{ Storage::url($oldImage) }}" width="200px" height="200px">
                @endif
                @error('image') <span class="error">{{ $message }}</span> @enderror
              </div>
              <div class="form-group">
                <label for="parent_id" class="col-form-label">Sản phẩm cha</label>
                <select name="" id="" wire:model="parent_id" class="form-control">
                  <option value="-1">--- Chọn sản phẩm cha ---</option>
                  @foreach ($data as $item)   
                    <option value="{{$item->id}}">{{$item->name}}</option>
                  @endforeach
                </select>
                @error('parent_id') <span class="error">{{ $message }}</span> @enderror
              </div>
              <div class="form-group">
                <label for="category_id" class="col-form-label">Danh mục sản phẩm</label>
                <select id="" wire:model="category_id" class="form-control">
                  <option value="-1">--- Chọn danh mục sản phẩm ---</option>
                  @foreach ($listCategories as $listCategory)   
                    <option value="{{$listCategory->id}}">{{$listCategory->name}}</option>
                  @endforeach
                </select>
                @error('category_id') <span class="error">{{ $message }}</span> @enderror
              </div>
              <div class="form-group">
                <label for="price" class="col-form-label">Giá bán</label>
                <input type="text" class="form-control" wire:model="price">
                @error('price') <span class="error">{{ $message }}</span> @enderror
              </div>
              <div class="form-group">
                <label for="discount_price" class="col-form-label">Giá bán (sale)</label>
                <input type="text" class="form-control" wire:model="discount_price">
                @error('discount_price') <span class="error">{{ $message }}</span> @enderror
              </div>
              <div class="form-group">
                <label for="description" class="col-form-label">Mô tả</label>
                <textarea class="form-control" id="description" wire:model.lazy="description"></textarea>
                @error('description') <span class="error">{{ $message }}</span> @enderror
              </div>
              <div class="form-group">
                <label for="status" class="col-form-label">Trạng thái</label>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" role="switch" wire:model="status">
                </div>
                @error('status') <span class="error">{{ $message }}</span> @enderror
              </div>
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
  @include('layouts.modals.delete')
  
    @if(count($data) > 0)
    <div class="paginate-link mr-2">
      {{ $data->links() }}
    </div>
    @endif
  </div>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $('#description').summernote({
            callbacks: {
                onChange: function(contents, $editable) {
                    @this.set('description', contents);
                }
            }
    });

    $('.btn-save').click(function(){
        window.livewire.emit('saveData');
    });


    window.livewire.on('close-edit-modal',function(){
            $('#exampleModal').modal('hide');
    });

    window.livewire.on('close-delete-modal',function(){
        $('#deleteModal').modal('hide');
    });
  });
</script>