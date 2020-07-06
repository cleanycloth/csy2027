<h2>Products</h2>
<a class="button" href="/admin/products/edit">Add New Product</a>
<?php if (count($products) > 0): ?>
    <table>
        <thead>
            <tr>
                <th style="width: 5%">ID</th>
                <th style="width: 125px;">Image</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Platform</th>
                <th>Genre</th>
                <th style="width: 5%"></th>
                <th style="width: 5%"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?=$product->product_id;?></td>
                    <td><img src="/image?id=<?=$product->image_id;?>" alt="<?=htmlspecialchars(strip_tags($product->name), ENT_QUOTES, 'UTF-8');?>"></td>
                    <td><?=htmlspecialchars(strip_tags($product->name), ENT_QUOTES, 'UTF-8');?></td>
                    <td>£<?=htmlspecialchars(strip_tags($product->price), ENT_QUOTES, 'UTF-8');?></td>
                    <td><?=htmlspecialchars(strip_tags($product->getCategoryName()), ENT_QUOTES, 'UTF-8');?></td>
                    <td><?=htmlspecialchars(strip_tags($product->getPlatformName()), ENT_QUOTES, 'UTF-8');?></td>
                    <td><?=htmlspecialchars(strip_tags($product->getGenreName()), ENT_QUOTES, 'UTF-8');?></td>
                    <td><a class="button" href="/admin/products/edit?id=1">Edit Product</a></td>
                    <td>
                        <form action="/admin/products/delete" method="post">
                            <input type="hidden" name="product[product_id]" value="<?=$product->product_id;?>">
                            <input type="submit" name="submit" value="Delete Product">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p class="msg">There are currently no products.</p>  
<?php endif; ?>