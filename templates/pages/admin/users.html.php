<h2>Users</h2>
<a class="button" href="/admin/users/edit">Add New User</a>
<?php if (count($users) > 0): ?>
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">ID</th>
                <th style="width: 20%;">Username</th>
                <th style="width: 20%;">First Name</th>
                <th style="width: 20%;">Surname</th>
                <th style="width: 20%;">Email</th>
                <th style="width: 12%;">User Type</th>
                <th style="width: 5%;">Active</th>
                <th style="width: 5%;"></th>
                <th style="width: 5%;"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?=$user->user_id;?></td>
                    <td><?=htmlspecialchars(strip_tags($user->username), ENT_QUOTES, 'UTF-8');?></td>
                    <td><?=htmlspecialchars(strip_tags($user->firstname), ENT_QUOTES, 'UTF-8');?></td>
                    <td><?=htmlspecialchars(strip_tags($user->surname), ENT_QUOTES, 'UTF-8');?></td>
                    <td><?=htmlspecialchars(strip_tags($user->email), ENT_QUOTES, 'UTF-8');?></td>
                    <td><?php if ($user->user_type == 2) { echo 'Owner'; } elseif ($user->user_type == 1) { echo 'Administrator'; } else { echo 'Customer'; } ?></td>
                    <td><?=($user->activated == 1) ? 'True' : 'False';?></td>
                    <td>
                        <?php if (isset($_SESSION['isOwner']) && $user->user_type != 2 || isset($_SESSION['isAdmin']) && ($user->user_type != 2 && $user->user_type != 1) || $user->user_id == $_SESSION['id']): ?>
                            <a class="button" href="/admin/users/edit?id=<?=$user->user_id?>">Edit User</a></td>
                        <?php endif ;?>
                    <td>
                        <?php if (isset($_SESSION['isOwner']) && $user->user_type != 2 || isset($_SESSION['isAdmin']) && ($user->user_type != 2 && $user->user_type != 1)): ?>
                            <form action="/admin/users/delete" method="post">
                                <input type="hidden" name="user[user_id]" value="<?=$user->user_id?>">
                                <input type="submit" name="submit" value="Delete User">
                            </form>
                        <?php endif ;?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p class="msg">There are currently no users.</p>  
<?php endif; ?>