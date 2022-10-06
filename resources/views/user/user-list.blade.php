@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('admin/css/oneforall.css') }}">
@endsection
@section('main')
    @livewire('user.user-list')    
@endsection

@section('js')
<script>
    $('.btn-save').click(function(){
        window.livewire.emit('saveData');
    });

    window.livewire.on('close-edit-modal',function(){
        $('#exampleModal').modal('hide');
    });

    window.livewire.on('close-delete-modal',function(){
        $('#deleteModal').modal('hide');
    });
</script>
@endsection