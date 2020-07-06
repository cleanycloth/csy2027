<h2>Slides</h2>
<a class="button" href="/admin/slides/edit">Add New Slide</a>
<?php if (count($slides) > 0): ?>
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">ID</th>
                <th style="width: 288px;">Image</th>
                <th style="width: 25%;">Name</th>
                <th style="width: 25%;">Message</th>
                <th style="width: 25%;">URL</th>
                <th style="width: 5%;"></th>
                <th style="width: 5%;"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($slides as $slide): ?>
                <tr>
                    <td><?=$slide->slide_id;?></td>
                    <td><a target="__blank" href="<?=($slide->image_id != null) ? '/image?id=' . $slide->image_id : '/images/image-slide-placeholder.jpg';?>"><img style="height: 75px; width: 288px; background-color: white;" src="<?=($slide->image_id != null) ? '/image?id=' . $slide->image_id : '/images/image-slide-placeholder.jpg';?>" alt="<?=($slide->image_id != null) ? htmlspecialchars(strip_tags($slide->name), ENT_QUOTES, 'UTF-8') : 'Placeholder Image';?>"></a></td>
                    <td><?=htmlspecialchars(strip_tags($slide->name), ENT_QUOTES, 'UTF-8');?></td>
                    <td><?=htmlspecialchars(strip_tags($slide->message), ENT_QUOTES, 'UTF-8');?></td>
                    <td><a target="__blank" href="<?=htmlspecialchars(strip_tags($slide->url), ENT_QUOTES, 'UTF-8');?>"><?=htmlspecialchars(strip_tags($slide->url), ENT_QUOTES, 'UTF-8');?></a></td>
                    <td>
                        <a class="button" href="/admin/slides/edit?id=<?=$slide->slide_id?>">Edit Slide</a></td>
                    <td>
                        <form action="/admin/slides/delete" method="post">
                            <input type="hidden" name="slide[slide_id]" value="<?=$slide->slide_id?>">
                            <input type="submit" name="submit" value="Delete Slide">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p class="msg">There are currently no slides.</p>  
<?php endif; ?>