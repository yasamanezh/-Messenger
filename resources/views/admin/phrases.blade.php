@extends('layouts.language')
@section('title',__('Languages'))
@section('body')
<style>
    .mt-4, .my-4{
        margin-top:0 !important
    }
</style>
@livewire('translations-ui::phrase-list', ['translation' => $translation])
@endsection
