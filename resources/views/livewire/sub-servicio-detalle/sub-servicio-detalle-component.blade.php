<div>
    <div class="row mb-2">
        <div class="col-6">
            <h1>Detalles del Sub Servicio {{$sub_servicio->descripcion}}</h1>
        </div>
        <div class="col-6">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_usuario" wire:click="showModal('form', 'create')"> 
                Nuevo Sub Servicio Detalle
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
           {{--  <table class="table">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th style="width: 40px">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($sub_servicio_detalles as $sub_servicio_detalle)
                        <tr>
                            <td>1.</td>
                            <td>{{$sub_servicio->descripcion}}</td>
                            <td><span @if($sub_servicio->estado=='ACTIVO') class="badge bg-success" @else class="badge bg-danger" @endif >{{$servicio->estado}}</span></td>
                            <td><span class="badge bg-primary" wire:click='rediregirSubservicioDetalles({{ $sub_servicio->id }})'>DETALLES</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                <h4>No hay registros</h4>
                            </td>
                        </tr>
                    @endforelse
                  
                </tbody>
              </table> --}}
            {{getcwd()}}
           {{--  <img src="../storage/app/subserviciodetalles/TolD0xIBH02lBjHCnOjJyYrvXQi5Al9Ola0Lut4C.jpg" class="img-thumbnail w-100" alt="no_hay_imagen"> --}}
            @forelse ($sub_servicio_detalles as $sub_servicio_detalle)
              <div class="col-md-6">
                    <div class="card card-default color-palette-box">
                        <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-tag"></i>
                            {{$sub_servicio_detalle->descripcion}}
                        </h3>
                        </div>
                        <div class="card-body">
                            <img src="{{Storage::url($sub_servicio_detalle->ruta_foto)}}" class="img-thumbnail w-100" alt="no_hay_imagen">
                            {{Storage::url($sub_servicio_detalle->ruta_foto)}}
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
   
    @include("livewire.sub-servicio-detalle.$vista")

</div>
