{{-- Modal utilizado cuando se carga información --}}
<div class="charge">
    <div class="charge-content">
        <img src="{{ asset('images/gifs/greenUpload.gif') }}" width="150px" height="150px">
    </div>
</div>
{{-- Modal utilizado para mostrar los errores 500 --}}
<div class="error500" data-modal-color="red">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Atencion !</h4>
            </div>
            <div class="modal-body">
                <p class='msgErrorAjax'></p>
            </div>
        </div>
    </div>
</div>
{{-- Otros modales --}}
<div class="modal fade modalColor" data-modal-color="" id="modalColor" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
