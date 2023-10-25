<div class="row my-3">
    <div class="col-sm-12 col-md-5">
        Mostrando
        {{ ($elementosListado->currentPage() - 1) * $elementosListado->perPage() + 1 }} a
        {{ ($elementosListado->currentPage() - 1) * $elementosListado->perPage() + count($elementosListado->items()) }}
        de
        {{ $elementosListado->total() }} entradas
    </div>
    <div class="col-sm-12 col-md-7 ">
        <div class="float-right">
            {{ $elementosListado->links() }}
        </div>
       
    </div>
</div>