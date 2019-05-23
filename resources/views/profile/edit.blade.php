@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8">
                <div class="backlink">
					<a href="/home"><i class="fas fa-arrow-left"></i> Dashboard</a>
				</div>
                <div class="card">
                    <div class="card-header">{{__('profile.edit_edit_profile_title')}}</div>

                    <div class="card-body">
                        <form method="POST" action="/profile/updateProfile">
                            @csrf
                            <input type="hidden" id="accountId" name="accountId" value="{{$account->id}}">
                            <div class="form-group row">
                                <label for="firstName"
                                       class="col-md-4 col-form-label text-md-right">{{__('profile.edit_firstname')}}
                                    &nbsp;*</label>

                                <div class="col-md-6">
                                    <input id="firstName" type="text"
                                           class="form-control{{ $errors->has('firstName') ? ' is-invalid' : '' }}"
                                           placeholder="{{__('profile.edit_firstname')}}" name="firstName"
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
                                       class="col-md-4 col-form-label text-md-right">{{__('profile.edit_middlename')}}</label>

                                <div class="col-md-6">
                                    <input id="middleName" type="text"
                                           class="form-control{{ $errors->has('middleName') ? ' is-invalid' : '' }}"
                                           placeholder="{{__('profile.edit_middlename')}}" name="middleName"
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
                                       class="col-md-4 col-form-label text-md-right">{{ __('profile.edit_lastname')}}</label>

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
                                       class="col-md-4 col-form-label text-md-right">{{__('profile.edit_gender')}}</label>
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
                                       class="col-md-4 col-form-label text-md-right">{{ __('profile.edit_birthday')}}</label>

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
                                       class="col-md-4 col-form-label text-md-right">{{ __('profile.edit_email')}}&nbsp;*</label>

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
                                        {{__('profile.edit_update_profile')}}
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <!-- Notification settings -->
                <div class="card">
                    <div class="card-header">
                        {{__('profile.edit_change_account_settings_title')}}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/profile/updateAccountSettings/{{$account->id}}">
                            @csrf
                            @method("PATCH")
                            <div class="form-group row justify-content-md-center">
                                <h5>{{__('profile.edit_change_account_settings_follow_notification_title')}}</h5>
                            </div>
                            <div class="form-group row justify-content-md-center">
                                <label for="FollowNotificationCreateEvent"
                                       class="col col-form-label text-md-right">{{__('profile.edit_change_account_settings_follow_notification_creation')}}
                                </label>

                                <div class="col">
                                    <div class="custom-control custom-switch">
                                        @if($account->settings->FollowNotificationCreateEvent == 0)
                                            <input type="checkbox" name="FollowNotificationCreateEvent" class="custom-control-input" id="customSwitches">
                                        @else
                                            <input type="checkbox" name="FollowNotificationCreateEvent" class="custom-control-input" id="customSwitches" checked>
                                        @endif
                                        <label class="custom-control-label" for="customSwitches"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row justify-content-md-center">
                                <label for="FollowNotificationJoinEvent"
                                       class="col-md-6 col-form-label text-md-right">{{__('profile.edit_change_account_settings_follow_notification_join')}}
                                </label>
                                <div class="col">
                                    <div class="custom-control custom-switch">
                                        @if($account->settings->FollowNotificationJoinAndLeaveEvent == 0)
                                            <input type="checkbox" name="FollowNotificationJoinEvent" class="custom-control-input" id="customSwitches1">
                                        @else
                                            <input type="checkbox" name="FollowNotificationJoinEvent" class="custom-control-input" id="customSwitches1" checked>
                                        @endif
                                        <label class="custom-control-label" for="customSwitches1"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row justify-content-md-center">
                                <h5>{{__('profile.edit_change_account_settings_event_notification_title')}}</h5>
                            </div>
                            <div class="form-group row justify-content-md-center">
                                <label for="NotificationEventEdited"
                                       class="col col-form-label text-md-right">{{__('profile.edit_change_account_settings_event_edited')}}
                                </label>
                                <div class="col">
                                    <div class="custom-control custom-switch">
                                        @if($account->settings->NotificationEventEdited == 0)
                                            <input type="checkbox" name="NotificationEventEdited" class="custom-control-input" id="customSwitches3">
                                        @else
                                            <input type="checkbox" name="NotificationEventEdited" class="custom-control-input" id="customSwitches3" checked>
                                        @endif
                                        <label class="custom-control-label" for="customSwitches3"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row justify-content-md-center">
                                <label for="NotificationEventDeleted"
                                       class="col col-form-label text-md-right">{{__('profile.edit_change_account_settings_event_deleted')}}
                                </label>
                                <div class="col">
                                    <div class="custom-control custom-switch">
                                        @if($account->settings->NotificationEventDeleted == 0)
                                            <input type="checkbox" name="NotificationEventDeleted" class="custom-control-input" id="customSwitches4">
                                        @else
                                            <input type="checkbox" name="NotificationEventDeleted" class="custom-control-input" id="customSwitches4" checked>
                                        @endif
                                        <label class="custom-control-label" for="customSwitches4"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row justify-content-md-center">
                                <h5>{{__('profile.edit_change_account_settings_notification_title')}}</h5>
                            </div>
                            <div class="form-group row justify-content-md-center">
                                <label for="FollowNotificationJoinEvent"
                                       class="col col-form-label text-md-right">{{__('profile.edit_change_account_settings_notification_join')}}
                                </label>
                                <div class="col">
                                    <div class="custom-control custom-switch">
                                        @if($account->settings->NotificationJoinAndLeaveEvent == 0)
                                            <input type="checkbox" name="FollowNotificationJoinEvent" class="custom-control-input" id="customSwitches5">
                                        @else
                                            <input type="checkbox" name="FollowNotificationJoinEvent" class="custom-control-input" id="customSwitches5" checked>
                                        @endif
                                        <label class="custom-control-label" for="customSwitches5"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button id="submit" type="submit" class="btn btn-primary">
                                        {{__('profile.edit_change_account_settings')}}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">{{__('profile.edit_change_password_title')}}</div>
                    <div class="card-body">
                        <form method="POST" action="/profile/changePassword">
                            @csrf
                            <div class="form-group row">
                                <label for="currentPassword"
                                       class="col-md-4 col-form-label text-md-right">{{__('profile.edit_current_password')}}
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
                                       class="col-md-4 col-form-label text-md-right">{{__('profile.edit_new_password')}}
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
                                       class="col-md-4 col-form-label text-md-right">{{__('profile.edit_confirm_new_password')}}
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
                                        {{__('profile.edit_change_password')}}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">{{__('profile.edit_delete_account_title')}}</div>
                    <div class="card-body">
                        <form method="POST" id="deleteAccount" action="/profile/deleteAccount">
                            @csrf
                            <div class="form-group row">
                                <label for="currentPassword"
                                       class="col-md-8 col-form-label text-md-left">
                                    {{__('profile.edit_delete_account_content')}}</br>
                                    <strong>{{__('profile.edit_delete_account_cannot_be_undone')}}</strong>
                                </label>

                                <div class="col-md-4 mt-2">
                                    <button type="button" class="btn btn-danger float-right" data-toggle="modal"
                                            data-target="#confirmDeleteAccount">
                                        {{__('profile.edit_delete_account')}}
                                    </button>
                                </div>

                                <div class="modal fade" id="confirmDeleteAccount" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">{{__('profile.edit_delete_account_confirm_title')}}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                {{__('profile.edit_delete_account_confirm_content')}}
                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" form="deleteAccount" class="btn btn-danger"
                                                       value="{{__('profile.edit_delete_account_positive')}}">
                                                <button type="button" class="btn btn-primary"
                                                        data-dismiss="modal">{{__('profile.edit_delete_account_negative')}}
                                                </button>
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
