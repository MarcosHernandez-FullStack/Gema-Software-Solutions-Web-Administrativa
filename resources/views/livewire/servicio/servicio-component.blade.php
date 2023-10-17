<div>
    <div class="row mb-2">
        <div class="col-12">
            <div class="card rounded-lg shadow-lg p-2">
                <!-- /.card-header -->
                <div class="card-body">
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
                        <div class="row my-3 d-flex justify-content-between align-items-center">
                            <div class="row col-sm-12 col-md-6">
                                <div class="border-5 border-info border-bottom text-info h1">Servicios</div>
                            </div>
                            <div class="row col-sm-12 col-md-2 justify-content-end">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modal_usuario" wire:click="showModal('form', 'create')">
                                    Nuevo servicio
                                </button>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-sm-12 col-md-4 d-flex align-items-center"><label
                                class="m-0">Search</label><input type="search"
                                class="form-control form-control-sm ml-1" placeholder="" aria-controls="example1">
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-sm-12">
                                <table id="example1" class="table m-0 rounded-pill"
                                    aria-describedby="example1_info">
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
                                                        class="badge bg-{{ $servicio->estado == 'ACTIVO' ? 'success' : 'warning' }} p-2">{{ $servicio->estado }}</span>
                                                </td>
                                                <td><span role="button" class="badge bg-primary"
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

    @include("livewire.servicio.$vista")

</div>
