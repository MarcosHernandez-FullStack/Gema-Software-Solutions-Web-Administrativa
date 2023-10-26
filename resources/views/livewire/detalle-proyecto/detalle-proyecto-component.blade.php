<div>  
    <button type="button" class="btn btn-sm rounded-pill bg-info d-flex align-items-center" data-toggle="modal" data-target="#modal_detalle_proyecto-{{$proyecto->id}}"><i class="fas fa-project-diagram mr-1"></i>  Detalles</button>
    <div wire:ignore.self class="modal fade" id="modal_detalle_proyecto-{{$proyecto->id}}" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form {{-- wire:submit.prevent="{{ $form == 'create' ? 'save' : 'update' }}" --}}>
                    <div class="modal-header bg-info text-light">
                        <h5 class="modal-title">
                            Detalles de {{$proyecto->nombre}}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body row">
                        <div class="form-group col-md-5">
                            <label class="form-label text-capitalize">Nombre</label>
                            <input type="text" class="form-control" wire:model='detalle_proyecto.nombre'>
                            @error('detalle_proyecto.nombre')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label ">Foto</label>
                            <input type="file" class="form-control form-control-sm rounded-pill" id="ruta_foto" wire:model='ruta_foto' >
                            @error('ruta_foto')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <button type="button" class="btn btn-success" wire:click="save()">+ Agregar</button>
                        </div>

                        <div class="form-group col-md-12">
                            <div id="carouselExampleControls-{{$proyecto->id}}" class="carousel slide">
                                <div class="carousel-inner">
                                  @foreach ($detalles_proyecto as $index => $detalle_proyecto)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                      <img class="d-block w-100" src="{{ Storage::url($detalle_proyecto->ruta_foto) }}" alt="Slide {{ $index + 1 }}">
                                      {{-- <button type="button" wire:click='edit({{$detalle_proyecto->id}})' class="btn btn-success">Editar</button> --}}
                                      <button type="button" wire:click='delete({{$detalle_proyecto->id}})' class="btn btn-danger"> <i class="fas fa-trash"></i> </button>
                                      <span role="button" class="badge rounded-pill bg-{{ $detalle_proyecto->estado == 1 ? 'success' : 'warning' }}">{{ $detalle_proyecto->estado == 1 ? 'ACTIVO' : 'INACTIVO' }}</span>
                                    </div>                                    
                                  @endforeach
                                </div>
                                <a class="carousel-control-prev" style="bottom: 15% !important;" href="#carouselExampleControls-{{$proyecto->id}}" role="button" data-slide="prev">
                                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                  <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" style="bottom: 15% !important;" href="#carouselExampleControls-{{$proyecto->id}}" role="button" data-slide="next">
                                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                  <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm rounded-pill btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
                        {{-- <button type="submit" class="btn btn-primary">{{ $form == 'create' ? 'Registrar' : 'Actualizar' }}</button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

