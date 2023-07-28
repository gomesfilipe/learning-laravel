<x-layout title="Editar Série '{!! $series->nome !!}'"> <!-- !! utilizado para eliminar problema quando tem "'" -->
  <x-series.form action="{{ route('series.update', $series->id) }}" nome="{!! $series->nome !!}" :update="true" />
</x-layout>
