@extends('layouts.main')

@section('content')
<br/>

<div class="container-fluid">
    <div class="py-8">
        <div class="text-right">
            <button type="button" class="btn btn-success" style="">
                <i class="fas fa-plus"></i> Alta presupuesto
            </button>
        </div>
    </div>
    <div class="row">
        <div class="">
            <table id="datos" class="table table-bordered table-sm table-striped table-hover">
                <thead class="thead-green">
                   <tr>
                      <th>USUARIO<input type="text" class="search form-control-sm form-control" busqueda="buscador_usuario"></th>
                      <th>AÑO DE PRESUPUESTO<input type="text" class="search form-control-sm form-control" busqueda="buscador_a_presupuesto"></th>
                      <th>CONCEPTO GLOBAL <input type="text" class="search form-control-sm form-control" busqueda="buscador_c_global"></th>
                      <th>CONCEPTO ESPECIFICO <input type="text" class="search form-control-sm form-control" busqueda="buscador_c_especifico"></th>
                      <th>IMPORTE <input type="text" class="search form-control-sm form-control" busqueda="importe"></th>
                      <th>ESTATUS <input type="text" class="search form-control-sm form-control" busqueda="status"></th>
                      <th>ACCIONES</th>
                   </tr>
                </thead>
                <tbody>
                   <tr>
                       <td class="buscador_usuario">JUAN</td>
                       <td class="buscador_a_presupuesto">RIQUELME</td>
                       <td class="buscador_c_global">T</td>
                       <td class="buscador_c_especifico">T</td>
                       <td class="importe">T</td>
                       <td class="status">D</td>
                       <td>
                          <button type="button" class="btn btn-warning">Modificar</button>
                          <button type="button" class="btn btn-danger">Eliminar</button>
                       </td>
                   </tr>
                   <tr>
                       <td class="buscador_usuario">ROBERTO</td>
                       <td class="buscador_a_presupuesto">ANDRADE</td>
                       <td class="buscador_c_global">D</td>
                       <td class="buscador_c_especifico">D</td>
                       <td class="importe">D</td>
                       <td class="status">T</td>
                       <td>
                           <button type="button" class="btn btn-warning">Modificar</button>
                           <button type="button" class="btn btn-danger">Eliminar</button>
                       </td>
                   </tr>
                   <tr>
                       <td class="buscador_usuario">TOMAS</td>
                       <td class="buscador_a_presupuesto">RIQUELME</td>
                       <td class="buscador_c_global">D</td>
                       <td class="buscador_c_especifico">D</td>
                       <td class="importe">D</td>
                       <td class="status">T</td>
                       <td>
                           <button type="button" class="btn btn-warning">Modificar</button>
                           <button type="button" class="btn btn-danger">Eliminar</button>
                       </td>
                   </tr>
                </tbody>
                <tfoot class=paginador>
                    <td colspan="1">
                        Mostrando 1 to 3 de 3 registros
                    </td>
                    <td colspan="6">
                        <div class="left">
                            <ul class="pagination">
                              <li><a href="#">«</a></li>
                              <li><a class="active" href="#">1</a></li>
                              <li><a href="#">»</a></li>
                            </ul>
                          </div>
                    </td>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
