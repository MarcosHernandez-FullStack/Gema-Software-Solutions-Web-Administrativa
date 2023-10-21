<div>
    <div class="row mb-2">
        <div class="col-12">
            <div class="card shadow-lg m-0 px-2" style="border-radius: 25px">
                <!-- /.card-header -->
                <div class="card-body p-3">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        @if (session()->has('message'))
                            <div class="row col-12 alert alert-success alert-dismissible fade show" role="alert">
                                <div>
                                    {{ session('message') }}
                                </div>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="row my-1 d-flex justify-content-between align-items-center">
                            <div class="row col-sm-12 col-md-6">
                                <div class="border-info border-bottom text-info h1 font-weight-bolder" style="border-bottom-width:5px !important">Servicios</div>
                            </div>
                            <div class="row col-sm-12 col-md-2 justify-content-end">
                                <button type="button" class="btn btn-info btn-sm rounded-pill" data-toggle="modal"
                                    data-target="#modal_usuario" wire:click="showModal('form', 'create')">
                                    <i class="fas fa-plus"></i>
                                    Nuevo servicio
                                </button>
                            </div>
                        </div>
                        <div class="row my-1">
                            <div class="form-group col-sm-12 col-md-4 d-flex align-items-center"><label
                                    class="m-0">Search</label><input type="search"
                                    class="form-control form-control-sm ml-1 rounded-pill" placeholder="" aria-controls="example1">
                            </div>
                        </div>
                        <div class="row my-1">
                            <div class="col-sm-12">
                                <table id="example1" class="table table-sm m-0 rounded-pill" aria-describedby="example1_info">
                                    <thead>
                                        <tr>
                                            <th rowspan="1" colspan="1">#</th>
                                            <th rowspan="1" colspan="1">Descripción</th>
                                            <th rowspan="1" colspan="1">Detalle resumido</th>
                                            <th rowspan="1" colspan="1">Estado</th>
                                            <th rowspan="1" colspan="1">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($servicios as $key => $servicio)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $servicio->descripcion }}</td>
                                                <td>{{ $servicio->detalle_descripcion_resumida }}</td>
                                                <td><span role="button"
                                                        class="badge rounded-pill bg-{{ $servicio->estado == 'ACTIVO' ? 'success' : 'warning' }}">{{ $servicio->estado }}</span>
                                                </td>
                                                <td><span role="button" class="badge rounded-pill bg-info"
                                                        wire:click='rediregirSubservicio({{ $servicio->id }})'>SUB
                                                        SERVICIOS</span></td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">
                                                    <h4>No hay registros</h4>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @include('layouts.footer-listado', ['servicios' => $servicios])
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    @include("livewire.diseño.$vista")
</div>
