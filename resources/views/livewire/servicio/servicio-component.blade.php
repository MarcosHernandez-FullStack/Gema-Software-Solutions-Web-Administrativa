<div>
    <div class="row mb-2">
        <div class="col-6">
            <h1>Servicios</h1>
        </div>
        <div class="col-12">
            @if (session()->has('message'))
                <div class=" mx-5 alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24">
                        <use xlink:href="#check-circle-fill" />
                    </svg>
                    <div>
                        {{ session('message') }}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <div class="col-12">
            <div class="card">
                {{-- <div class="card-header">
                  <h1 class="card-title">Listado de Servicios</h1>
                </div> --}}
                <!-- /.card-header -->
                <div class="card-body">
                  <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_usuario" wire:click="showModal('form', 'create')"> 
                            Nuevo servicio
                            </button>
                        </div>
                        <div class="col-sm-12 col-md-8"><label>Search:</label><input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example1"></div>
                        <br>
                    </div>
        
            <div class="row">
                <div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
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
                                <td>{{$key+1}}</td>
                                <td>{{$servicio->descripcion}}</td>
                                <td>{{$servicio->detalle_descripcion_resumida}}</td>
                                <td><span role="button" class="badge bg-{{ $servicio->estado == 'ACTIVO' ? 'success' : 'warning' }} p-2" >{{$servicio->estado}}</span></td>
                                <td><span role="button" class="badge bg-primary" wire:click='rediregirSubservicio({{ $servicio->id }})'>SUB SERVICIOS</span></td>
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
            <div class="row">
                <div class="col-sm-12 col-md-5">
                        Mostrando
                        {{ ($servicios->currentPage() - 1) * $servicios->perPage() + 1 }} a
                        {{ ($servicios->currentPage() - 1) * $servicios->perPage() + count($servicios->items()) }}
                        de
                        {{ $servicios->total() }} entradas
                </div>
                <div class="col-sm-12 col-md-7">
                    {{-- {{ $servicios->links() }} --}}
                </div>
            </div>
                </div>
                </div>
                <!-- /.card-body -->
              </div>
        </div>
    </div>
   
    @include("livewire.servicio.$vista")

</div>
