@if(isset($user))
    <h2>Update Profile</h2>

    @include('parts.alert')
    <form method="post">
        <input type="hidden" name="_method" value="PUT">
        <label>Display Name:</label>
        <input type="text" name="display_name" value="{{ $user->display_name }}"/>
        <input type="text" name="_token" value="{{ \IlluminePlugin1\Helper::token() }}"/>
        <button type="submit" value="submit" class="button">Update Profile</button>
    </form>
@endif

