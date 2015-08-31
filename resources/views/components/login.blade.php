<form class="navbar-form navbar-right" action="{{ URL::route('account-sign-in-post') }}" method="post">
    <div class="form-group">
        <input type="text" placeholder="Email" class="form-control" name="username">
    </div>
    <div class="form-group">
        <input type="password" placeholder="Password" class="form-control" name="password">
    </div>
    <button type="submit" class="btn btn-success">Sign in</button>
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
</form>