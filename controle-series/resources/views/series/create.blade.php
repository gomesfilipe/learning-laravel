<x-layout title="Adicionar Nova Série">
  <x-series.form action="{{ route('series.store') }}" :nome="old('nome')" :update="false" />
</x-layout>
