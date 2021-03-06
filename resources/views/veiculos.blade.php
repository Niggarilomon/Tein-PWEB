@extends('layouts.app')

@section('content')
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.10.0/ui-bootstrap-tpls.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<div ng-app="select" ng-controller="controller">
        <div class="container">
            <br/>
            <h3 align="center">Cadastro de Veiculos</a></h3>
            <br/>
            <div class="row">
                <div class="col-sm-6 pull-left">
                    <label>Busca:</label>
                    <input type="text" ng-model="search" ng-change="filter()" placeholder="Busca" class="form-control" />
                </div>
                <div class="col-sm-1 pull-left">
                    <label> </label>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Cadastrar
                      </button>
                      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Cadastro</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <div ng-include src="'views/insereVehicles.html'"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
				</div>
                <div class="col-sm-2 pull-right">
                    <label>Qtd por p&aacute;gina:</label>
                    <select ng-model="data_limit" class="form-control">
                        <option>10</option>
                        <option>20</option>
                        <option>50</option>
                        <option>100</option>
                    </select>

                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-md-12" ng-show="filter_data > 0">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <th>id</th>
                            <th>Marca&nbsp;<a ng-click="sort_with('mark');"><i class="glyphicon glyphicon-sort"></i></a></th>
                            <th>Modelo&nbsp;<a ng-click="sort_with('model');"><i class="glyphicon glyphicon-sort"></i></a></th>
                            <th>Placa&nbsp;<a ng-click="sort_with('licensePlate');"><i class="glyphicon glyphicon-sort"></i></a></th>
                            <th>Dono do Carro&nbsp;<a ng-click="sort_with('carOwnName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                            <th colspan=2>&nbsp;</th>
                           </thead>
                        <tbody>
                            <tr ng-repeat="data in searched = (file | filter:search | orderBy : base :reverse) | beginning_data:(current_grid-1)*data_limit | limitTo:data_limit" id="<% data.id %>">
                                <td><% data.id %></td>
                                <td><input type="text" class="form-control" style="border:0;" value="<% data.mark %>"/></td>
                                <td><input type="text" class="form-control" style="border:0;" value="<% data.model %>"/></td>
                                <td><input type="text" class="form-control" style="border:0;" value="<% data.licensePlate %>"/></td>
                                <td><input type="text" list="list" class="form-control" style="border:0;" value="<% data.carOwnName %>"></td>
                                <td>
                                  <button class="btn btn-success btn-xs" ng-click="update_data(data.id)">
                                       <span class="glyphicon glyphicon-edit"></span> Editar
                                  </button>
                                </td>
                                <td>
                                   <button class="btn btn-danger btn-xs" ng-click="delete_data(data.id)">
                                     <span class="glyphicon glyphicon-trash"></span> Del
                                   </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12" ng-show="filter_data == 0">
                    <div class="col-md-12">
                        <h4>Nenhum registro encontrado..</h4>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6 pull-left">
                        <h5>Mostrando <% searched.length %> de <% entire_user%> registros</h5>
                    </div>
                    <div class="col-md-6" ng-show="filter_data > 0">
                        <div pagination="" page="current_grid" on-select-page="page_position(page)" boundary-links="true" total-items="filter_data" items-per-page="data_limit" class="pagination-small pull-right" previous-text="&laquo;" next-text="&raquo;" first-text="Primeiro" last-text="&Uacute;ltimo"></div>
                    </div>
                </div>
            </div>
        </div>
        <datalist id="list">
            <select>
                <option ng-repeat="x in clients" value="<% x.name %>"><% x.name %></option>
            </select>
        </datalist>
    </div>
    <script type="text/javascript" src="app/controllers/veiculos/selectCtrl.js"></script>
    <script type="text/javascript" src="app/controllers/veiculos/insertCtrl.js"></script>
@endsection
