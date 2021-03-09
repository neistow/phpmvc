<?php
?>

<div class="row justify-content-center mt-5">
    <h1 class="text-center display-4">Film Actor form</h1>
    <div class="col-md-6 mt-5">
        <form method="post">
            <input type="hidden" name="film_id" value="<?php echo $filmActor->film_id ?>">
            <input type="hidden" name="actor_id" value="<?php echo $filmActor->actor_id ?>">

            <div class="form-group">
                <label for="role">Role</label>
                <select class="form-control" name="role_id" id="role">
                    <?php
                    foreach ($roles as $key => $r) {
                        $isSelected = $filmActor->role_name == $r->name ? "selected" : "";
                        echo "<option value='$r->id' $isSelected>$r->name</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="d-flex flex-column">
                <button type="submit" class="btn btn-primary mt-2">
                    Edit
                </button>
            </div>
        </form>
        <form action="/film-actors/delete" method="post">
            <input type="hidden" name="film_id" value="<?php echo $filmActor->film_id ?>">
            <input type="hidden" name="actor_id" value="<?php echo $filmActor->actor_id ?>">

            <div class="d-flex flex-column">
                <button type="submit" class="btn btn-danger mt-2">Delete</button>
            </div>
        </form>
    </div>
</div>
