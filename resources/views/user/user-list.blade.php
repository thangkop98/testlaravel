@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('admin/css/user.css') }}">
@endsection
@section('main')
    @livewire('user.user-list')    
@endsection

@section('js')
<script>
    $('.btn-save').click(function(){
        window.livewire.emit('saveData');
    });

    window.livewire.on('close-modal',function(){
        $('#exampleModal').modal('hide');
    });
</script>
@endsection