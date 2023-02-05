    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.5/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script src="{{ asset('vendor/datepicker3/datepicker3.min.js') }}"></script>

    <script>
        $('body').on('hidden.bs.modal', function() {
            if ($('.modal.show').length > 0) {
                $('body').addClass('modal-open');
            }
        });
    </script>
    
    <script>
        const deleteConfirmation = (url, text = null) => {
            let setting = [`@csrf`, `@method('DELETE')`];
            let form = document.createElement('form');
            setting.forEach(item => {
                form.insertAdjacentHTML('beforeend', item.trim());
            })
            form.setAttribute('action', url);
            form.setAttribute('method', 'POST');
            form.setAttribute('class', 'd-none');
            document.body.appendChild(form);
            Swal.fire({
                icon: 'warning',
                title: !!text ? `Hapus data ${text}?` : 'Hapus data ini?',
                text: "Data yang sudah dihapus tidak dapat dikembalikan!",
                showCancelButton: true,
                buttonsStyling: false,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya, Hapus!',
                customClass: {
                    confirmButton: 'swal2-confirm btn btn-danger rounded-3 me-1',
                    cancelButton: 'swal2-cancel btn btn-light rounded-3',
                }
            }).then((result) => {
                if (result.value) {
                    form.submit();
                }
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            $('[data-toggle="datepicker3"]').datepicker({
                autoclose: true,
                pickerPosition: "bottom-left",
                format: 'yyyy-mm-dd',
                todayHighlight: true,
            });
        });
    </script>

    <script>
        const approveConfirmation = (url, text = null) => {
            let setting = [`@csrf`, `@method('PUT')`];
            let form = document.createElement('form');
            setting.forEach(item => {
                form.insertAdjacentHTML('beforeend', item.trim());
            })
            form.setAttribute('action', url);
            form.setAttribute('method', 'POST');
            form.setAttribute('class', 'd-none');
            document.body.appendChild(form);
            Swal.fire({
                icon: 'info',
                title: !!text ? `Approve data ${text}?` : 'Approve data ini?',
                text: "Apakah anda yakin ingin Mengapprove Data ini?",
                showCancelButton: true,
                buttonsStyling: false,
                cancelButtonText: 'Tidak!',
                confirmButtonText: 'Ya, Approve!',
                customClass: {
                    confirmButton: 'swal2-confirm btn btn-danger rounded-3 me-1',
                    cancelButton: 'swal2-cancel btn btn-light rounded-3',
                }
            }).then((result) => {
                if (result.value) {
                    form.submit();
                }
            });
        }
    </script>

    <script>
        const rejectConfirmation = (url, text = null) => {
            let setting = [`@csrf`, `@method('PUT')`];
            let form = document.createElement('form');
            setting.forEach(item => {
                form.insertAdjacentHTML('beforeend', item.trim());
            })
            form.setAttribute('action', url);
            form.setAttribute('method', 'POST');
            form.setAttribute('class', 'd-none');
            document.body.appendChild(form);
            Swal.fire({
                icon: 'warning',
                title: !!text ? `Reject data ${text}?` : 'Reject data ini?',
                text: "Apakah anda yakin ingin Reject Data ini?",
                showCancelButton: true,
                buttonsStyling: false,
                cancelButtonText: 'Tidak!',
                confirmButtonText: 'Ya, Reject!',
                customClass: {
                    confirmButton: 'swal2-confirm btn btn-danger rounded-3 me-1',
                    cancelButton: 'swal2-cancel btn btn-light rounded-3',
                }
            }).then((result) => {
                if (result.value) {
                    form.submit();
                }
            });
        }
    </script>

    <script>
        $(function() {
            $('[data-toggle="daterangepicker"]').daterangepicker({
                opens: 'left',
                locale: {
                    format: 'YYYY-MM-DD'
                }
            });
        });
        $(document).on('click', '.applyBtn', function() {
            $('#form-filter').submit();
        });
    </script>

    <script>
        $('.select2').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });
    </script>

    <script>
        const selesaiConfirmation = (url, text = null) => {
            let setting = [`@csrf`, `@method('PUT')`];
            let form = document.createElement('form');
            setting.forEach(item => {
                form.insertAdjacentHTML('beforeend', item.trim());
            })
            form.setAttribute('action', url);
            form.setAttribute('method', 'POST');
            form.setAttribute('class', 'd-none');
            document.body.appendChild(form);
            Swal.fire({
                icon: 'info',
                title: !!text ? `Tandai ${text}? telah selesai` : 'Tandai Telah Selesai?',
                text: "Apakah anda yakin ingin Menandai Selesai Data ini?",
                showCancelButton: true,
                buttonsStyling: false,
                cancelButtonText: 'Tidak!',
                confirmButtonText: 'Ya, Tandai!',
                customClass: {
                    confirmButton: 'swal2-confirm btn btn-danger rounded-3 me-1',
                    cancelButton: 'swal2-cancel btn btn-light rounded-3',
                }
            }).then((result) => {
                if (result.value) {
                    form.submit();
                }
            });
        }
    </script>
