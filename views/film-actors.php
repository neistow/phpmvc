<?php
?>

<h1 class="text-center mt-5">Film actors</h1>


<table id="film-table" class="table table-bordered table-hover">
    <thead>
    <tr>
        <th scope="col">Film Id</th>
        <th scope="col">ActorId</th>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Role</th>
        <?php if ($user != null): ?>
            <th scope="col">Manage</th>
        <?php endif; ?>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($filmActors as $key => $filmActor): ?>
        <tr>
            <th><?php echo $filmActor->film_id ?></th>
            <th><?php echo $filmActor->actor_id ?></th>
            <td><?php echo $filmActor->first_name ?></td>
            <td><?php echo $filmActor->last_name ?></td>
            <td><?php echo $filmActor->role_name ?></td>
            <?php if ($user != null): ?>
                <td>
                    <a href="/film-actors/edit?film_id=<?php echo $filmActor->film_id ?>&actor_id=<?php echo $filmActor->actor_id ?>">Edit</a>
                </td>
            <?php endif; ?>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>