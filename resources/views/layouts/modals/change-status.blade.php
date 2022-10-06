
  <!-- Modal change status with toggle switch -->
  <div wire:ignore.self class="modal fade" id="changeStatusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Xóa bản ghi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Bạn có muốn thay đổi trạng thái bản ghi này không ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
          <button type="button" class="btn btn-primary" wire:click.prevent="" data-dismiss="modal">Có</button>
        </div>
      </div>
    </div>
  </div>