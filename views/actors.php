<?php
?>

<h1 class="text-center mt-5">Actors</h1>

<table id="actors-table" class="table table-bordered table-hover">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <?php if ($user != null): ?>
            <th scope="col">Manage</th>
        <?php endif; ?>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($actors as $key => $actor): ?>
        <tr>
            <th scope="row"><?php echo $actor->id ?></th>
            <td><?php echo $actor->first_name ?></td>
            <td><?php echo $actor->last_name ?></td>
            <?php if ($user != null): ?>
                <td><a href="/actors/edit?id=<?php echo $actor->id ?>">Edit</a></td>
            <?php endif; ?>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
