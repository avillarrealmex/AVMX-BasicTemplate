{{-- Modal utilizado cuando se carga información --}}
<div class="bd-example-modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" id="modal-uploading">
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

<div class="modal fade" data-modal-color="" id="modalColor" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales orci ante, sed ornare eros vestibulum ut. Ut accumsan vitae eros sit amet tristique. Nullam scelerisque nunc enim, non dignissim nibh faucibus ullamcorper. Fusce pulvinar libero vel ligula iaculis ullamcorper. Integer dapibus, mi ac tempor varius, purus nibh mattis erat, vitae porta nunc nisi non tellus. Vivamus mollis ante non massa egestas fringilla. Vestibulum egestas consectetur nunc at ultricies. Morbi quis consectetur nunc.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link">Save changes</button>
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
