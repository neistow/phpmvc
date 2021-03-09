<?php
$editMode = isset($actor);

$id = $editMode ? $actor->id : 0;
$first_name = $editMode ? $actor->first_name : "";
$last_name = $editMode ? $actor->last_name : "";
?>

<div class="row justify-content-center mt-5">
    <h1 class="text-center display-4">Actor form</h1>
    <div class="col-md-6 mt-5">
        <form method="post">

            <input type="hidden" name="id" value="<?php echo $id ?>">

            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" class="form-control" id="first_name"
                       value="<?php echo $first_name ?>">
            </div>

            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" class="form-control" id="last_name"
                       value="<?php echo $last_name ?>">
            </div>

            <div class="d-flex flex-column">
                <?php if ($editMode): ?>
                    <button type="submit" class="btn btn-primary mt-2">
                        Edit
                    </button>
                <?php else: ?>
                    <button type="submit" class="btn btn-success mt-2">
                        Create
                    </button>
                <?php endif; ?>
            </div>
        </form>
        <?php if ($editMode): ?>
            <form action="/actors/delete" method="post">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <div class="d-flex flex-column">
                    <button type="submit" class="btn btn-danger mt-2">Delete</button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>
