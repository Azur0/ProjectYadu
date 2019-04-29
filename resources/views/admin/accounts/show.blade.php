@extends('layouts/admin/app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row"><img class="img-fluid rounded-circle my-auto mr-3 avatar-lg"
                                  src="data:image/jpeg;base64, {{base64_encode($account->avatar)}}"/>
                <h1 class="my-auto">{{$account->firstName .' '. $account->middleName .' '. $account->lastName}}</h1>
                <div class="ml-auto my-auto mr-3">
                    @if($account->isDeleted == 0)
                        <button type="button" class="btn btn-danger my-auto" data-toggle="modal"
                                data-target="#confirmDeleteAccount">
                            {{__('accounts.edit_delete_account')}}
                        </button>
                    @else
                        <button type="button" class="btn btn-success my-auto" data-toggle="modal"
                                data-target="#confirmDeleteAccount">
                            {{__('accounts.edit_restore_account')}}
                        </button>
                    @endif


                    <div class="modal fade" id="confirmDeleteAccount" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{__('accounts.edit_delete_account_confirm_title')}}</h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @if($account->isDeleted == 0)
                                <div class="modal-body">
                                    {{__('accounts.edit_delete_account_confirm_content')}}
                                </div>
                                <div class="modal-footer">
                                    <a type="submit" href="{{url('/admin/accounts/'. $account->id .'/delete')}}"
                                       class="btn btn-danger">
                                        {{__('accounts.edit_delete_account_positive')}}</a>
                                    <button type="button" class="btn btn-primary"
                                            data-dismiss="modal">{{__('accounts.edit_delete_account_negative')}}
                                    </button>
                                </div>
                                @else
                                <div class="modal-body">
                                    {{__('accounts.edit_restore_account_confirm_content')}}
                                </div>
                                <div class="modal-footer">
                                    <a type="submit" href="{{url('/admin/accounts/'. $account->id .'/restore')}}"
                                       class="btn btn-success">
                                        {{__('accounts.edit_restore_account_positive')}}</a>
                                    <button type="button" class="btn btn-primary"
                                            data-dismiss="modal">{{__('accounts.edit_restore_account_negative')}}
                                    </button>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table mb-3">
                <tr>
                    <th>{{__('accounts.email_verified')}}</th>
                    <td>
                        @if($account->email_verified_at != null)
                            {{$account->email_verified_at}}
                        @else
                            <a href="{{url('/admin/accounts/'. $account->id .'/activate')}}"
                               class="btn btn-warning">{{__('accounts.email_verify_button')}}</a>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>{{__('accounts.password_reset')}}</th>
                    <td>
                        <a href="{{url('/admin/accounts/'. $account->id .'/passwordreset')}}"
                           class="btn-warning btn">{{__('accounts.password_reset_button')}}</a>
                    </td>
                </tr>
            </table>

            <hr>

            <h3 class="mb-3">{{__('accounts.edit_edit_account_title')}}</h3>

            <form method="POST" action="/admin/accounts/{{$account->id}}/update">
                @csrf
                <div class="form-group row">
                    <label for="firstName"
                           class="col-md-2 col-form-label text-md-right">{{__('accounts.edit_firstname')}}
                        &nbsp;*</label>

                    <div class="col-md-6">
                        <input id="firstName" type="text"
                               class="form-control{{ $errors->has('firstName') ? ' is-invalid' : '' }}"
                               placeholder="{{__('accounts.edit_firstname')}}" name="firstName"
                               value="{{$account->firstName}}"
                               required
                               autofocus maxlength="45">

                        @if ($errors->has('firstName'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('firstName') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="middleName"
                           class="col-md-2 col-form-label text-md-right">{{__('accounts.edit_middlename')}}</label>

                    <div class="col-md-6">
                        <input id="middleName" type="text"
                               class="form-control{{ $errors->has('middleName') ? ' is-invalid' : '' }}"
                               placeholder="{{__('accounts.edit_middlename')}}" name="middleName"
                               value="{{$account->middleName}}"
                               maxlength="45">

                        @if ($errors->has('middleName'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('middleName') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="lastName"
                           class="col-md-2 col-form-label text-md-right">{{ __('profile.edit_lastname')}}</label>

                    <div class="col-md-6">
                        <input id="lastName" type="text"
                               class="form-control{{ $errors->has('lastName') ? ' is-invalid' : '' }}"
                               placeholder="{{ __('profile.edit_lastname')}}" name="lastName"
                               value="{{$account->lastName}}"
                               maxlength="45">

                        @if ($errors->has('lastName'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lastName') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="gender"
                           class="col-md-2 col-form-label text-md-right">{{__('accounts.edit_gender')}}</label>
                    <div class="col-md-6">
                        <select name="gender" selected="{{$account->gender}}"
                                class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}">
                            <option value="-" selected>-</option>
                            @foreach($genders as $gender)
                                @if($gender->gender == $account->gender)
                                    <option value="{{ $gender->gender }}"
                                            selected>{{ $gender->gender }}</option>
                                @else
                                    <option value="{{ $gender->gender }}">{{ $gender->gender }}</option>
                                @endif
                            @endforeach
                        </select>
                        @if ($errors->has('gender'))

                            <span class="invalid-feedback force-show" role="alert">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="dateOfBirth"
                           class="col-md-2 col-form-label text-md-right">{{ __('accounts.edit_birthday')}}</label>

                    <div class="col-md-6">
                        <input type="date" name="dateOfBirth" value="{{$account->dateOfBirth}}"
                               class="form-control{{ $errors->has('dateOfBirth') ? ' is-invalid' : '' }}">

                        @if ($errors->has('dateOfBirth'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('dateOfBirth') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email"
                           class="col-md-2 col-form-label text-md-right">{{ __('accounts.edit_email')}} *</label>

                    <div class="col-md-6">
                        <input type="email" name="email" value="{{$account->email}}"
                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}">

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="accountRole"
                           class="col-md-2 col-form-label text-md-right">{{ __('accounts.edit_role')}} *</label>
                    <div class="col-md-6">
                        <select name="accountRole" selected="{{$account->accountRole}}"
                                class="form-control{{ $errors->has('accountRole') ? ' is-invalid' : '' }}">
                            @foreach($accountRoles as $accountRole)
                                @if($accountRole->role == $account->accountRole)
                                    <option value="{{ $accountRole->role }}"
                                            selected>{{ $accountRole->role }}</option>
                                @else
                                    <option value="{{ $accountRole->role }}">{{ $accountRole->role }}</option>
                                @endif
                            @endforeach
                        </select>
                        @if ($errors->has('accountRole'))

                            <span class="invalid-feedback force-show" role="alert">
                                        <strong>{{ $errors->first('accountRole') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-1">
                        <button id="submit" type="submit" class="btn btn-primary">
                            {{__('accounts.edit_update_profile')}}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection