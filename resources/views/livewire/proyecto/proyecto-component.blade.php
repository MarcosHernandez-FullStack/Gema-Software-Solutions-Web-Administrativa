{{-- <div>
    <div class="row mb-2">
        <div class="col-6">
            <h1>Proyectos de {{$servicio->nombre}}</h1>
        </div>
        <div class="col-6">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_usuario" wire:click="showModal('form', 'create')"> 
                Nuevo proyecto
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
                    <th>Fecha Implementación</th>
                    <th>Foto</th>
                    <th>Empresa</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th style="width: 40px">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($proyectos as $key => $proyecto)
                    
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td><img src="{{Storage::url($proyecto->ruta_foto)}}" class="img-thumbnail w-100" alt="no_hay_imagen"></td>    
                            <td>{{$proyecto->fecha_implementacion}}</td>                       
                            <td>{{$proyecto->empresa->razon_social}}</td>
                            <td>{{$proyecto->nombre}}</td>           
                            <td><span role="button" class="badge bg-{{ $proyecto->estado == '1' ? 'success' : 'warning' }} p-2" wire:click='cambiarEstado({{ $proyecto->id }})'>{{ $proyecto->estado == '1' ? 'ACTIVO' : 'INACTIVO' }}</span></td>
                
                            <td>
                                @livewire("detalle-proyecto.detalle-proyecto-component", ['proyecto' =>  $proyecto], key("detalle-proyecto-$proyecto->id"))
                            </td>
                            <td>
                            <button type="button"
                            class="btn btn-sm btn-warning btn-sm rounded-pill"
                            data-toggle="modal" data-target="#modal_usuario"
                            wire:click="edit({{ $proyecto->id }})"><i
                                class="fas fa-pen"></i>
                            EDITAR
                        </button>
                            </td>
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
        @include('layouts.footer-listado', ['elementosListado' => $proyectos])
       

    </div>
   
    @include("livewire.proyecto.$vista")

</div> --}}



<div>
    <div class="row mb-2">
        <div class="col-12">
            <div class="card shadow-lg m-0 px-2" style="border-radius: 25px">
                <!-- /.card-header -->
                <div class="card-body p-3">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        @include('layouts.header-listado', 
                        [
                           
                            'label' => 'Proyecto',
                            'create_function' => "showModal('form', 'create')",
                            'condition_message' => session()->has('message'),
                            'find' => 'Buscar por nombre del proyecto'
                        ]
                        )
                        <div class="row my-1">

                            @forelse ($proyectos as $key => $proyecto)
                                <div class="col-md-4 px-5 py-3">
                                    <!-- Widget: user widget style 1 -->
                                    <div class="card card-widget widget-user shadow-lg" style="border-radius: 25px;height: 100%;position: relative;">
                                        <!-- Add the bg color to the header using any of the bg-* classes -->
                                        <div class="widget-user-header text-white"
                                            style="background: url('{{ Storage::url($proyecto->ruta_foto) }}') center center;border-radius: 25px 25px 0 0;">
                                            <div class="text-right">
                                                <span role="button"
                                                    class="badge rounded-pill text-sm bg-{{ $proyecto->estado == '1' ? 'success' : 'warning' }}"
                                                    wire:click='cambiarEstado({{ $proyecto->id }})'>{{ $proyecto->estado == '1' ? 'ACTIVO' : 'INACTIVO' }}</span>
                                            </div>
                                        </div>
                                        <div class="p-5">
                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    <h5><strong> {{ $proyecto->nombre }}</strong></h5>
                                                  
                                                </div>
                                                <div class="col-12 my-2">
                                                    <h5 class="widget-user-desc text-left text-md">Fecha implementación: {{ $proyecto->fecha_implementacion }}</h5>
                                                </div>
                                                <div class="col-12 my-2">
                                                    <h5 class="widget-user-desc text-left text-md">Empresa cliente: {{ $proyecto->empresa->razon_social }}</h5>
                                                </div>
                                                <div class="row col-12">
                                                    <div class="col-6">
                                                       
                                                            @livewire("detalle-proyecto.detalle-proyecto-component", ['proyecto' =>  $proyecto], key("detalle-proyecto-$proyecto->id"))
                                                    </div>
                                                    <div class="col-6">               
                                                            <button type="button"
                                                            class="btn btn-sm btn-warning btn-sm rounded-pill float-right"
                                                            data-toggle="modal" data-target="#modal_usuario"
                                                            wire:click="edit({{ $proyecto->id }})"><i
                                                                class="fas fa-pen"></i>
                                                                EDITAR
                                                            </button>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.widget-user -->
                                </div>
                            @empty

                            @endforelse
                        </div>
                        @include('layouts.footer-listado', ['elementosListado' => $proyectos])
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    @include("livewire.proyecto.$vista")
</div>

