window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('.sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});


$(".search").keyup(function(){
    rastreator($(this));
});
$(".search").keydown(function(){
    rastreator($(this));
});
function rastreator(elem){
    var rastrear="#datos tbody tr ."+elem.attr("busqueda");
    var contenido=elem.val();
    $(rastrear).each(function(){
        var texto=$(this).text();
        if(texto.startsWith(contenido)){
            $(this).parents("tr").show();
        }else{
            $(this).parents("tr").hide();
        }
    });
}
