@extends('layouts/admin/app')

@section('content')

<h1>Edit Links</h1>
<div class="card-body">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Link</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody id="linksToDisplay">
            @foreach ($socialmedia as $social)
            <tr>
                <td>1</td>
                <td>{{$social->name}}</td>
                <td>{{$social->link}}</td>
                <td><button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#change{{$social->name}}Link"
                        data-whatever="@mdo">{{__('events.show_edit')}}</button>

                    <div class="modal fade" id="change{{$social->name}}Link" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit {{$social->name}} link</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <form method="POST" action="/admin" id="submitEdit{{$social->name}}">
                                            @csrf
                                            <label for="{{$social->name}}" class="col-form-label">Link:</label>
                                            <input type="hidden" name="name" value="{{$social->name}}">
                                            <input type="text" class="form-control" name="link"
                                                value="{{$social->link}}">
                                        </form>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" form="submitEdit{{$social->name}}" value="Submit"
                                        class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection