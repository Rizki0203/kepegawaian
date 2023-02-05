<form action="{{ route('admin.dinas.reject.update', $dinas->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="mb-3">
            <label for="" class="form-label">Alasan Reject</label>
            <input type="text" class="form-control" name="alasan_reject" id="" placeholder="Masukkan Alasan Reject">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-outline-link" data-bs-dismiss="modal">Back</button>
        <button type="submit" class="btn btn-outline-primary">Submit</button>
    </div>
</form>