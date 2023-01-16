@push('modal-image')
    
<div id="myModal" class="modal-image">
    <span class="close">&times;</span>
    <img class="modal-content-image" id="img01">
    <div id="caption"></div>
</div>
@endpush


@push('after-scripts')
    <script>
        var modal = document.getElementById("myModal");

        var img = document.getElementById("myImg");
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        img.onclick = function() {
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        }

        var span = document.getElementsByClassName("close")[0];

        span.onclick = function() {
            modal.style.display = "none";
        }
    </script>
@endpush
