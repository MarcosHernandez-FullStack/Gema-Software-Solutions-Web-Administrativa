<div>
    <div class="row mb-2">
        <div class="col-12">
            <div class="card shadow-lg m-0 px-2" style="border-radius: 25px">
                <!-- /.card-header -->
                <div class="card-body p-3">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        @include('layouts.header-listado', 
                        [
                           
                            'label' => 'Servicio',
                            'create_function' => "showModal('form', 'create')",
                            'mensajeListado' => $mensajeListado,
                            'find' => 'Buscar por nombre del servicio'
                        ]
                        )
                        <div class="row my-1">

                           @forelse ($servicios as $key => $servicio)
                                <div class="col-md-4 px-5 py-3">
                                    <!-- Widget: user widget style 1 -->
                                    <div class="card card-widget widget-user shadow-lg" style="border-radius: 25px; height: 100%;position: relative;">
                                        <!-- Add the bg color to the header using any of the bg-* classes -->
                                        <div class="widget-user-header text-white"
                                            style="background: url('{{ Storage::url($servicio->ruta_foto_principal) }}') center center;border-radius: 25px 25px 0 0;">
                                            <div class="text-right">
                                                <span role="button"
                                                    class="badge rounded-pill text-sm bg-{{ $servicio->estado == '1' ? 'success' : 'warning' }}"
                                                    wire:click='cambiarEstado({{ $servicio->id }})'>{{ $servicio->estado == '1' ? 'ACTIVO' : 'INACTIVO' }}</span>
                                            </div>
                                        </div>
                                        <div class="widget-user-image">
                                            <img class="img-circle" style="height: 90px;object-fit: cover;"
                                                src="{{ Storage::url($servicio->ruta_foto_secundaria) }}"
                                                alt="{{ $servicio->descripcion_resumida }}">
                                        </div>
                                        <div class="p-5">
                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    <h5><strong> {{ $servicio->nombre }}</strong></h5>
                                                </div>
                                                <div class="col-12 my-2">
                                                    <h5 class="widget-user-desc text-left text-md">
                                                        {{ $servicio->descripcion_resumida }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="px-5 py-3" style="position: absolute;bottom: 0%;left:0%;right: 0%;">
                                            <div class="col-12 my-2">
                                                <div class="d-flex justify-content-between">
                                                    <button type="button" class="btn btn-sm rounded-pill bg-info"
                                                        wire:click='rediregirProyectos({{ $servicio->id }})'><i
                                                            class="fas fa-project-diagram"></i> PROYECTOS</button>
                                                    <button type="button"
                                                        class="btn btn-sm btn-warning btn-sm rounded-pill"
                                                        data-toggle="modal" data-target="#modal_usuario"
                                                        wire:click="edit({{ $servicio->id }})"><i
                                                            class="fas fa-pen"></i>
                                                        EDITAR
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- /.widget-user -->
                                </div>
                            @empty
                                <div class="col-12" style="color: blue"><strong>No hay servicios disponibles</strong></div>
                                
                            @endforelse
                        </div>
                        @include('layouts.footer-listado', ['elementosListado' => $servicios])
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    @include("livewire.servicio.$vista")
</div>
