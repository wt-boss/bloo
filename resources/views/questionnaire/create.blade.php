@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Creer un questionnaire</div>
                <div class="card-body">
                    {!! Form::open(['route' => 'questionnaire.store']) !!}
                    {!! Form::token();!!}
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="title">Titre</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Entrer le titre" required>
                            </div>
                            <div class="form-group col-6">
                                <label for="purpose">Objectif</label>
                                <input type="text" class="form-control" id="purpose"  name="purpose"  placeholder="Enter l'objectif">
                            </div>
                            <div class="form-group col-6">
                                <label for="date_start">Date de debut</label>
                                <input type="date" class="form-control" id="date_start" name="date_start">
                            </div>
                            <div class="form-group col-6">
                                <label for="date_end">Date de fin</label>
                                <input type="date" class="form-control" id="date_end" name="date_end">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
