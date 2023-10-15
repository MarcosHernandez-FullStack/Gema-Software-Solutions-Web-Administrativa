<div>
    <div class="row mb-2">
        <div class="col-6">
            <h1>Sub Servicios de {{$servicio->descripcion}}</h1>
        </div>
        <div class="col-6">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_usuario" wire:click="showModal('form', 'create')"> 
                Nuevo Sub Servicio
            </button>
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
            <table class="table">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Descripción</th>
                    <th>Cliente</th>
                    <th>Fecha Implementación</th>
                    <th>Estado</th>
                    <th style="width: 40px">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($sub_servicios as $sub_servicio)
                        <tr>
                            <td>1.</td>                            
                            <td>{{$sub_servicio->descripcion}}</td>
                            <td><span role="button" class="badge bg-{{ $sub_servicio->estado == 'ACTIVO' ? 'success' : 'warning' }} p-2" >{{$sub_servicio->estado}}</span></td>
                            <td>{{$sub_servicio->empresa_cliente}}</td>
                            <td>{{$sub_servicio->fecha_implementacion}}</td>
                            <td><span role="button" class="badge bg-primary" wire:click='rediregirSubservicioDetalles({{ $sub_servicio->id }})'>DETALLES</span></td>
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
   
    @include("livewire.sub-servicio.$vista")

</div>
