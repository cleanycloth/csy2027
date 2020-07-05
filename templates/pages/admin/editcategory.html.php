<h2><?=$pageName;?></h2>
<?php require 'forms/editcategoryform.html.php'; ?>

<?php if (isset($_GET['id'])): ?>
    <h2>Child Categories</h2>
    <?php require 'forms/childcategorieslist.html.php'; ?>
<?php endif; ?>