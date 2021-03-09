<?php
?>

<div class="row justify-content-center mt-5">
    <h1 class="text-center display-4">Film Actor form</h1>
    <div class="col-md-6 mt-5">
        <form method="post">
            <div class="form-group">
                <label for="actor">Actor</label>
                <select class="form-control" name="actor_id" id="actor">
                    <?php
                    foreach ($actors as $key => $a) {
                        echo "<option value='$a->id' >$a->first_name $a->last_name</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="film">Film</label>
                <select class="form-control" name="film_id" id="film">
                    <?php
                    foreach ($films as $key => $f) {
                        echo "<option value='$f->id' >$f->name</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select class="form-control" name="role_id" id="role">
                    <?php
                    foreach ($roles as $key => $r) {
                        echo "<option value='$r->id'>$r->name</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="d-flex flex-column">
                <button type="submit" class="btn btn-success mt-2">
                    Create
                </button>
            </div>
        </form>
    </div>
</div>
