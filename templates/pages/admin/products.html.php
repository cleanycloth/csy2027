<h2>Products</h2>
<a class="button" href="/admin/products/edit">Add New Product</a>
<?php if (count($products) > 0): ?>
    <table>
        <thead>
            <tr>
                <th style="width: 5%">ID</th>
                <th>Image</th>
                <th>Product Name</th>
                <th>Price</th>
                <th style="width: 5%"></th>
                <th style="width: 5%"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td><img src="https://via.placeholder.com/200x200" alt="Placeholder Image"></td>
                <td>Xbox Game</td>
                <td>£45.99</td>
                <td><a class="button" href="/admin/users/edit?id=1">Edit Product</a></td>
                <td>
                    <form action="/admin/products/delete" method="post">
                        <input type="hidden" name="user[id]" value="1">
                        <input type="submit" name="submit" value="Delete Product">
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
<?php else: ?>
    <p class="msg">There are currently no products.</p>  
<?php endif; ?>