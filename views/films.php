<?php
$ratingClasses = [
    1 => "text-danger",
    2 => "text-danger",
    3 => "text-danger",
    4 => "text-warning",
    5 => "text-warning",
    6 => "text-warning",
    7 => "text-primary",
    8 => "text-primary",
    9 => "text-primary",
    10 => "text-success"
]
?>

<h1 class="text-center mt-5">Films</h1>

<div class="mb-1">
    <label for="search">Search film by name:</label>
    <input id="search" type="text" class="w-100">
</div>

<table id="film-table" class="table table-bordered table-hover">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Date released</th>
        <th scope="col">Rating</th>
        <th scope="col">Actors</th>
        <?php if ($user != null): ?>
            <th scope="col">Manage</th>
        <?php endif; ?>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($films as $key => $film): ?>
        <tr>
            <th scope="row"><?php echo $film->id ?></th>
            <td><?php echo $film->name ?></td>
            <td><?php echo $film->date_released ?></td>
            <td class="<?php echo $ratingClasses[$film->rating] ?>"><?php echo $film->rating ?></td>
            <td><a href='<?php echo "/film-actors?film_id=$film->id" ?>'>Actors</a></td>
            <?php if ($user != null): ?>
                <td><a href="/films/edit?id=<?php echo $film->id ?>">Edit</a></td>
            <?php endif; ?>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>

<script>
    $("#search").on('input', function () {
        const search = $(this).val().toLowerCase();
        const rows = $("#film-table>tbody>tr");
        if (search === "") {
            rows.each(function () {
                $(this).show();
            });
        } else {
            rows.each(function () {
                const name = $(this).children()[1];
                if (name.innerText.toLowerCase().includes(search)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }
    });
</script>