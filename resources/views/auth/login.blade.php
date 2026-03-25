        @extends('layouts.app')

        @section('title', 'Login')

        @section('content')
        <div class="row">
            <div class="col d-flex flex-row justify-content-center align-items-center vh-100">
                <form method="post" action="/login">
                    <div class="p-3 border border-dark border-1 rounded">
                        <h1 class="mb-3">J-Goal</h1>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input name="email" type="email" id="email" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input name="password" type="password" id="password" class="form-control" placeholder="Enter Password">
                        </div>
                        <div class="form-check mb-4">
                            <input name="remember" class="form-check-input" type="checkbox" id="rememberMe">
                            <label for="rememberMe" class="form-check-label">Remember Me</label>

                        </div>
                        <div class="mb-3 d-flex flex-column">
                            <button class="btn btn-primary mb-3" type="Submit">Login</button>
                            <a href="#">Forgot Password</a>
                        </div>
                    </div>

                </form>

            </div>
        </div>
        @endsection