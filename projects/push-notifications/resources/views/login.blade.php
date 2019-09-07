<div class="container">
    <div class="card my-5 mx-5">
        <div class="card-header">
            <h3>Login</h3>
        </div>
        <div class="card-body">
            <form action="/login" method="POST">
                @csrf
                <div class="form-group">
                    <input name="email" type="email" class="form-control form-control-lg" placeholder="Enter email">
                </div>

                <div class="form-group">
                    <input name="password" type="password" class="form-control form-control-lg" placeholder="Password">
                </div>

                <div class="mw-100 text-center">
                    <button type="submit" class="btn btn-primary px-4"><strong>Login</strong></button>
                </div>
            </form>
        </div>
    </div>
</div>
