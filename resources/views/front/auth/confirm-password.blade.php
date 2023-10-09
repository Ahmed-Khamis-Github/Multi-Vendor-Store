<x-front-layout title="Confirm Password">
    <!-- Start Account Login Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <!-- Password -->


                        <div class="form-group input-group">
                            <label class="fw-bold">Confirm Password</label>
                            <input class="form-control" type="password" name="password" id="reg-pass" required
                                autocomplete="current-password" required>
                        </div>

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />

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
