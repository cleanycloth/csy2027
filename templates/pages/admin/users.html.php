<h2>Users</h2>
<a class="button" href="/admin/users/edit">Add New User</a>
<table>
    <thead>
        <tr>
            <th style="width: 5%">ID</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Surname</th>
            <th>Email</th>
            <th>User Type</th>
            <th style="width: 8%">Active</th>
            <th style="width: 5%"></th>
            <th style="width: 5%"></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>exampleuser</td>
            <td>Example</td>
            <td>User</td>
            <td>example@user.com</td>
            <td>Admin</td>
            <td>true</td>
            <td><a class="button" href="/admin/users/edit?id=1">Edit User</a></td>
            <td>
                <form action="/admin/users/delete" method="post">
                    <input type="hidden" name="user[id]" value="1">
                    <input type="submit" name="submit" value="Delete User">
                </form>
            </td>
        </tr>
        <tr>
            <td>1</td>
            <td>exampleuser</td>
            <td>Example</td>
            <td>User</td>
            <td>example@user.com</td>
            <td>Admin</td>
            <td>true</td>
            <td><a class="button" href="/admin/users/edit?id=1">Edit User</a></td>
            <td>
                <form action="/admin/users/delete" method="post">
                    <input type="hidden" name="user[id]" value="1">
                    <input type="submit" name="submit" value="Delete User">
                </form>
            </td>
        </tr>
    </tbody>
</table>