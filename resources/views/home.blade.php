@if (!auth()->user()->two_factor_secret)
       you have not enabled 2fa
       <form action="{{ url('user/two-factor-authentication') }}" method="post">
            @csrf
            <button type="submit" class="">
                Enable
            </button>
        </form>
    @else
       you have 2fa enabled
       <form action="{{ url('user/two-factor-authentication') }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="">
            Disable
        </button>
    </form>
@endif



@if (session('status') == 'two-factor-authentication-enabled')
    you have now enabled 2fa, please scan the following OR code 
    into your phones authenticator application
    {!!  auth()->user()->twoFactorQCodeSvg() !!} 

    <p>please copy this code and save it in seruce place</p>
    @foreach (json_decode(decrypt(auth()->user()->two_factory_recovery_codes, true)) as $code)
        {{ trim($code) }} <br>
    @endforeach
@endif