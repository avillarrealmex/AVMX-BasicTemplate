{{-- Modal utilizado cuando se carga información --}}
<div class="modal fade bd-example-modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" id="modal-uploading">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content" style="width: 200px">
            <img src="{{ asset('images/gifs/greenUpload.gif') }}" width="150px" height="150px">
        </div>
    </div>
</div>

<div class="error500">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header alert alert-danger">
                <h4 class="modal-title">Atencion !</h4>
            </div>
            <div class="modal-body alert alert-danger">
                <p class='msgErrorAjax'></p>
            </div>
        </div>
    </div>
</div>

