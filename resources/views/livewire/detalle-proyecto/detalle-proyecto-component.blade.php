<div>
    <button type="button" class="btn btn-sm rounded-pill bg-info d-flex align-items-center" data-toggle="modal"
        data-target="#modal_detalle_proyecto-{{ $proyecto->id }}"><i class="fas fa-project-diagram mr-1"></i>
        Detalles</button>
    <div wire:ignore.self class="modal fade" id="modal_detalle_proyecto-{{ $proyecto->id }}" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form {{-- wire:submit.prevent="{{ $form == 'create' ? 'save' : 'update' }}" --}}>
                    <div class="modal-header bg-info text-light">
                        <h5 class="modal-title">
                            Detalles de {{ $proyecto->nombre }}
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
                            <input type="file" class="form-control form-control-sm rounded-pill" id="ruta_foto"
                                wire:model='ruta_foto'>
                            @error('ruta_foto')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <button type="button" class="btn btn-success" wire:click="save()">+ Agregar</button>
                        </div>

                        <div class="form-group col-md-12">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th style="width: 200px">Foto</th>
                                        <th>Descripción</th>
                                        <th>Estado</th>
                                        <th>Opciónes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($detalles_proyecto as $index => $detalle_proyecto)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td><img class="d-block w-100"
                                                    src="{{ Storage::url($detalle_proyecto->ruta_foto) }}"
                                                    alt="Slide {{ $index + 1 }}"></td>
                                            <td>{{ $detalle_proyecto->nombre }}</td>
                                            <td><span role="button"
                                                    class="badge rounded-pill bg-{{ $detalle_proyecto->estado == '1' ? 'success' : 'warning' }}"
                                                    wire:click='cambiarEstado({{ $detalle_proyecto->id }})'>{{ $detalle_proyecto->estado == '1' ? 'ACTIVO' : 'INACTIVO' }}</span>
                                            </td>
                                            <td>
                                                {{-- <button type="button" wire:click='edit({{ $detalle_proyecto->id }})'
                                                    class="btn btn-warning"><i class="fas fa-edit"></i></button> --}}
                                                <button type="button" wire:click='delete({{ $detalle_proyecto->id }})'
                                                    class="btn btn-danger"> <i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                <p>No hay registros</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm rounded-pill btn-secondary" data-dismiss="modal"><i
                                class="fas fa-times"></i> Cerrar</button>
                        {{-- <button type="submit" class="btn btn-primary">{{ $form == 'create' ? 'Registrar' : 'Actualizar' }}</button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
