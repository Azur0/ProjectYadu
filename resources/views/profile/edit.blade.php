@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Profile') }}</div>

                    <div class="card-body">
                        <form method="POST" action="/profile/updateProfile">
                            @csrf
                            <input type="hidden" id="accountId" name="accountId" value="{{$account->id}}">
                            <div class="form-group row">
                                <label for="firstName"
                                       class="col-md-4 col-form-label text-md-right">{{ __('First name') }}*</label>

                                <div class="col-md-6">
                                    <input id="firstName" type="text"
                                           class="form-control{{ $errors->has('firstName') ? ' is-invalid' : '' }}"
                                           placeholder="Name" name="firstName" value="{{$account->firstName}}" required
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
                                       class="col-md-4 col-form-label text-md-right">{{ __('Middle Name') }}</label>

                                <div class="col-md-6">
                                    <input id="middleName" type="text"
                                           class="form-control{{ $errors->has('middleName') ? ' is-invalid' : '' }}"
                                           placeholder="middleName" name="middleName" value="{{$account->middleName}}"
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
                                       class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                                <div class="col-md-6">
                                    <input id="lastName" type="text"
                                           class="form-control{{ $errors->has('lastName') ? ' is-invalid' : '' }}"
                                           placeholder="lastName" name="lastName" value="{{$account->lastName}}"
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
                                       class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
                                <div class="col-md-6">
                                    <select name="gender" selected="{{$account->gender}}">
                                        @if($account->gender == null)
                                            <option value="-" selected>-</option>
                                        @endif
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
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="dateOfBirth"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                                <div class="col-md-6">
                                    <input type="date" name="dateOfBirth" value="{{$account->dateOfBirth}}">

                                    @if ($errors->has('dateOfBirth'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('dateOfBirth') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}*</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="email" value="{{$account->email}}" required
                                           placeholder="example@example.com">

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button id="submit" type="submit" class="btn btn-primary">
                                        {{ __('Update Profile') }}
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">{{ __('Change password') }}</div>
                    <div class="card-body">
                        <form method="POST" action="/profile/changePassword">
                            @csrf
                            <input type="hidden" id="accountId" name="accountId" value="{{$account->id}}">

                            <div class="form-group row">
                                <label for="currentPassword"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}
                                    *</label>

                                <div class="col-md-6">
                                    <input id="currentPassword" minlength="8" type="password"
                                           class="form-control{{ $errors->has('currentPassword') ? ' is-invalid' : '' }}"
                                           name="currentPassword" required>

                                    @if ($errors->has('currentPassword'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('currentPassword') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="newPassword"
                                       class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}
                                    *</label>

                                <div class="col-md-6">
                                    <input id="newPassword" minlength="8" type="password"
                                           class="form-control{{ $errors->has('newPassword') ? ' is-invalid' : '' }}"
                                           name="newPassword" required>

                                    @if ($errors->has('newPassword'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('newPassword') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="newPassword_confirmation"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Confirm New Password') }}
                                    *</label>

                                <div class="col-md-6">
                                    <input id="newPassword_confirmation" minlength="8" type="password"
                                           class="form-control"
                                           name="newPassword_confirmation" required>

                                    @if ($errors->has('confirmNewPassword'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('confirmNewPassword') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button id="submit" type="submit" class="btn btn-primary">
                                        {{ __('Change password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">{{ __('Delete account') }}</div>
                    <div class="card-body">
                        <form method="POST" id="deleteAccount" action="/profile/deleteAccount">
                            @csrf
                            <input type="hidden" id="accountId" name="accountId" value="{{$account->id}}">
                            <div class="form-group row">
                                <label for="currentPassword"
                                       class="col-md-8 col-form-label text-md-left">Click here to delete your account.
                                    <br><strong>This can not be undone!</strong>
                                </label>

                                <div class="col-md-4 mt-2">
                                    <button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#confirmDeleteAccount">
                                        {{ __('Delete account') }}
                                    </button>
                                </div>

                                <div class="modal fade" id="confirmDeleteAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Confirm</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete your account?
                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" form="deleteAccount" class="btn btn-danger" value="Yes, Delete it">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">No, Keep it!</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
