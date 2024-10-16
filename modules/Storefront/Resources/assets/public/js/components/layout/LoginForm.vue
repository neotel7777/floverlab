<template>
    <form class="auth-form-body" method="POST" action="{{ route('login.post') }}">
        window.FleetCart.csrfToken
        <div>
            <div class="form-group">
                <label
                    for="email"
                    class="input-label"
                >
                    {{ $trans('user::auth.email') }} <span>*</span>
                </label>

                <div
                    x-data
                    class="input-group"
                >
                    <input
                        type="text"
                        name="email"
                        value=""
                        class="form-control"
                        id="email"
                        placeholder="{{ $trans('user::auth.enter_your_email') }}"
                        autofocus
                    >

                    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                         viewBox="0 0 20 20" fill="none">
                        <path
                            d="M14.167 17.0832H5.83366C3.33366 17.0832 1.66699 15.8332 1.66699 12.9165V7.08317C1.66699 4.1665 3.33366 2.9165 5.83366 2.9165H14.167C16.667 2.9165 18.3337 4.1665 18.3337 7.08317V12.9165C18.3337 15.8332 16.667 17.0832 14.167 17.0832Z"
                            stroke="#A0AEC0" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M14.1663 7.5L11.558 9.58333C10.6997 10.2667 9.29134 10.2667 8.433 9.58333L5.83301 7.5"
                            stroke="#A0AEC0" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>

                {!! $errors->first('email', '<span class="help-block text-red">:message</span>') !!}
            </div>

            <div class="form-group">
                <label
                    for="password"
                    class="input-label"
                >
                    {{ trans('user::auth.password') }} <span>*</span>
                </label>

                <div
                    x-data="{ showPassword: false }"
                    class="input-group"
                >
                    <div
                        class="password-toggle-icon"
                        :data-tooltip="showPassword ? '{{ trans('user::auth.hide_password') }}' : '{{ trans('user::auth.show_password') }}'"
                        @click="showPassword = !showPassword"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                             viewBox="0 0 20 20" fill="none">
                            <path
                                d="M12.9833 9.99993C12.9833 11.6499 11.6499 12.9833 9.99993 12.9833C8.34993 12.9833 7.0166 11.6499 7.0166 9.99993C7.0166 8.34993 8.34993 7.0166 9.99993 7.0166C11.6499 7.0166 12.9833 8.34993 12.9833 9.99993Z"
                                x-bind:stroke="showPassword ? '#0E1E3E' : '#A0AEC0'" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M9.99987 16.8918C12.9415 16.8918 15.6832 15.1584 17.5915 12.1584C18.3415 10.9834 18.3415 9.00843 17.5915 7.83343C15.6832 4.83343 12.9415 3.1001 9.99987 3.1001C7.0582 3.1001 4.31654 4.83343 2.4082 7.83343C1.6582 9.00843 1.6582 10.9834 2.4082 12.1584C4.31654 15.1584 7.0582 16.8918 9.99987 16.8918Z"
                                x-bind:stroke="showPassword ? '#0E1E3E' : '#A0AEC0'" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>

                        <div class="show-password" :class="showPassword ? 'animate-show' : ''"></div>
                    </div>

                    <input
                        :type="showPassword ? 'text' : 'password'"
                        name="password"
                        placeholder="{{ trans('user::auth.enter_your_password') }}"
                        class="form-control"
                    >

                    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                         viewBox="0 0 20 20" fill="none">
                        <path
                            d="M9.18301 16.25H6.24967C5.73301 16.25 5.27467 16.2333 4.86634 16.175C2.67467 15.9333 2.08301 14.9 2.08301 12.0833V7.91667C2.08301 5.1 2.67467 4.06667 4.86634 3.825C5.27467 3.76667 5.73301 3.75 6.24967 3.75H9.13301"
                            stroke="#A0AEC0" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M12.5166 3.75H13.7499C14.2666 3.75 14.7249 3.76667 15.1333 3.825C17.3249 4.06667 17.9166 5.1 17.9166 7.91667V12.0833C17.9166 14.9 17.3249 15.9333 15.1333 16.175C14.7249 16.2333 14.2666 16.25 13.7499 16.25H12.5166"
                            stroke="#A0AEC0" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M12.5 1.6665V18.3332" stroke="#A0AEC0" stroke-width="1.5" stroke-linecap="round"
                              stroke-linejoin="round" />
                        <path d="M9.2451 10.0002H9.25258" stroke="#A0AEC0" stroke-width="2"
                              stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M5.91209 10.0002H5.91957" stroke="#A0AEC0" stroke-width="2"
                              stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>

                {!! $errors->first('password', '<span class="help-block text-red">:message</span>') !!}
            </div>

            <div class="checkbox-group">
                <div class="checkbox">
                    <input type="hidden" name="remember_me" value="0">

                    <input
                        type="checkbox"
                        name="remember_me"
                        class="checkbox-element"
                        id="remember-me"
                        value="1"
                    >

                    <label class="checkbox-label" for="remember-me">
                                        <span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 12.5 1"></polyline>
                                            </svg>
                                        </span>

                        <span>{{ trans('user::attributes.auth.remember_me') }}</span>
                    </label>
                </div>

                <a href="{{ route('reset') }}" class="forgot-password">
                    {{ trans('user::auth.forgot_password') }}
                </a>
            </div>
        </div>

        <button
            type="submit"
            x-data="{ formSubmitting: false }"
            :class="formSubmitting ? 'btn-loading' : ''"
            class="btn btn-primary"
            :disabled="formSubmitting"
            @click="formSubmitting = true; $el.parentElement.submit()"
        >
            {{ trans('user::auth.sign_in') }}
        </button>
    </form>
</template>

<script >
import Errors from "../../Errors";
import Alphine from "../../auth";
export default {
    components: [Errors,Alphine]

}
</script>
