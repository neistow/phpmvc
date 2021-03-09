<?php
?>

<div class="row justify-content-center mt-5">
    <h1 class="text-center display-4">Login</h1>
    <div class="col-md-6 mt-5">
        <form method="post">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" name="email" class="form-control" id="email"
                       aria-describedby="emailHelp"
                       placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                    else.</small>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password"
                       placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-2">Login</button>
        </form>
    </div>
</div>
