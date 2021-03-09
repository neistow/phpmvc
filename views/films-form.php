<?php
$editMode = isset($film);

$id = $editMode ? $film->id : 0;
$name = $editMode ? $film->name : "";
$date_released = $editMode ? $film->date_released : "";
$rating = $editMode ? $film->rating : 1;
?>

<div class="row justify-content-center mt-5">
    <h1 class="text-center display-4">Film form</h1>
    <div class="col-md-6 mt-5">
        <form method="post">

            <input type="hidden" name="id" value="<?php echo $id ?>">

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name"
                       value="<?php echo $name ?>">
            </div>
            <div class="form-group">
                <label for="dateReleased">Date released</label>
                <input type="date" name="date_released" class="form-control" id="dateReleased"
                       value="<?php echo $date_released ?>">
            </div>
            <div class="form-group">
                <label for="rating">Rating</label>
                <select class="form-control" name="rating" id="rating">
                    <?php
                    for ($i = 1; $i <= 10; $i++) {
                        $isSelected = $film->rating == $i ? "selected" : "";
                        echo "<option value='$i' $isSelected>$i</option>";
                    }
                    ?>
                </select>
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
            <form action="/films/delete" method="post">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <div class="d-flex flex-column">
                    <button type="submit" class="btn btn-danger mt-2">Delete</button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>
