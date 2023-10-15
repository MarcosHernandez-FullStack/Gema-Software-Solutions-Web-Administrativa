{{-- <div wire:ignore.self class="modal fade" id="modal_usuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modal_usuarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            @yield('contenido_modal')
        </div>
    </div>
</div> --}}

<div wire:ignore.self class="modal fade" id="modal_usuario" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        @yield('contenido_modal')
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
