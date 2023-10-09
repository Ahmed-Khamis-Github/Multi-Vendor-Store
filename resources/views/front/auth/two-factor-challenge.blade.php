<x-front-layout title="2FA CHALLENGE">
    <!-- Start Account Login Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">

                    @if ($errors->has('code'))
                        <div class="alert alert-danger">
                            {{ $errors->first('code') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('two-factor.login') }}">
                        @csrf



                        <div class="form-group input-group">
                            <label class="fw-bold">Enter the QR CODE</label>
                            <input class="form-control" type="text" name="code">
                        </div>

                        <h5 class="mb-2 d-flex justify-content-center">OR</h5>
 

                        <div class="form-group input-group">
                            <label class="fw-bold">Enter the Recovery Code</label>
                            <input class="form-control" type="text" name="recovery_code">
                        </div>


                        <div class="button">
                            <button class="btn" type="submit">Confirm</button>
                        </div>

                    </form>



                </div>
            </div>
        </div>
    </div>
    <!-- End Account Login Area -->

</x-front-layout>
