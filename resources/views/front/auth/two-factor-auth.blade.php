<x-front-layout title="Two Factor Authentication"> 
 <!-- Start Account Login Area -->
 <div class="account-login section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                <form class="card login-form" action="{{ route('two-factor.enable') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="title">
                            <h3>Two Factor Authentication</h3>
                            <p>Please enable or disable two factor authentication.</p>
                        </div>
                     @auth
                         
                    @if(!$user->two_factor_secret)
                        <div class="button">
                            <button class="btn" type="submit">Enable</button>
                        </div>
                       @else 
                      @method('delete')
                      {!! $user->twoFactorQrCodeSvg(); !!}

                      <h3 class="mt-2"> Recovery Codes</h3>
                      <ul class="list-group">
                        @foreach ($user->recoveryCodes() as $code )

                        <li class="list-group-item">{{ $code }}</li>
                        @endforeach

                         
                      </ul>
                      
                           
                      <div class="button">
                        <button class="btn" type="submit">Disable</button>
                    </div>

                       @endif
                       @endauth

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Account Login Area -->

</x-front-layout>