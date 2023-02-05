@push('modal-section')
    <div class="modal fade modalOpen" style="width: ; display: none;" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div {{ $attributes->merge(['class' => 'modal-dialog']) }}>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-html" id="modal-html">
                        <div class="modal-body">
                            <div class="text-center">
                                <div class="loader">
                                    <div class="ball-pulse">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.modalOpen').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var title = button.data('title')
                var url = button.data('url')
                var modal = $(this)
                modal.find('.modal-title').text(title)
                $.ajax({
                    url: url,
                    success: function(data) {
                        modal.find('.modal-html').html(data)
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText)
                    }
                })
            })
        })
    </script>
@endpush
