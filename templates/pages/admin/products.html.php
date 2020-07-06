<h2>Products</h2>
<a class="button" href="/admin/products/edit">Add New Product</a>
<?php if (count($products) > 0): ?>
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">ID</th>
                <th style="width: 125px;">Image</th>
                <th style="width: 20%;">Product Name</th>
                <th style="width: 10%;">Price</th>
                <th style="width: 15%;">Category</th>
                <th style="width: 15%;">Platform</th>
                <th style="width: 15%;">Genre</th>
                <th style="width: 5%;"></th>
                <th style="width: 5%;"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?=$product->product_id;?></td>
                    <td><a target="__blank" href="<?=($product->image_id != null) ? '/image?id=' . $product->image_id : '/images/image-placeholder.jpg';?>"><img style="height: 200px; width: 200px; background-color: white;" src="<?=($product->image_id != null) ? '/image?id=' . $product->image_id : '/images/image-placeholder.jpg';?>" alt="<?=($product->image_id != null) ? htmlspecialchars(strip_tags($product->name), ENT_QUOTES, 'UTF-8') : 'Placeholder Image';?>"></a></td>
                    <td><?=htmlspecialchars(strip_tags($product->name), ENT_QUOTES, 'UTF-8');?></td>
                    <td>£<?=htmlspecialchars(strip_tags($product->price), ENT_QUOTES, 'UTF-8');?></td>
                    <td><?=htmlspecialchars(strip_tags($product->getCategoryName()), ENT_QUOTES, 'UTF-8');?></td>
                    <td><?=htmlspecialchars(strip_tags($product->getPlatformName()), ENT_QUOTES, 'UTF-8');?></td>
                    <td><?=htmlspecialchars(strip_tags($product->getGenreName()), ENT_QUOTES, 'UTF-8');?></td>
                    <td><a class="button" href="/admin/products/edit?id=<?=$product->product_id;?>">Edit Product</a></td>
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