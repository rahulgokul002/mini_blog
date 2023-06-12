<?php $this->load->view("admin_panel/header"); ?>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <h1 class="h2">Edit Blog</h1>
        <form enctype="multipart/form-data" action="<?= base_url().'admin/blog/editblog_post' ?>" method="post">
        <input type="hidden" name="blogid" id="blogid" value="<?= $blogid ?>">
        <select name="publish_unpublish" class="custom-select">
            <option selected>Select Option</option>
            <option value="1" <?= ($result[0]['status']=='1' ? "selected":"") ?>>Publish</option>
            <option value="0" <?= ($result[0]['status']=='0' ? "selected":"") ?>>Un Publish</option>
        </select>
        <div class="form-group" style="margin-top: 10px;">
                <input type="text" value="<?= $result[0]['blog_title'] ?>" class="form-control" name="blog_title" placeholder="Title" >
            </div>
            <div class="form-group">
                <textarea name="desc" class="form-control" placeholder="Blog desc"><?= $result[0]['blog_desc'] ?></textarea>   
            </div>
            <div class="form-group">
                <img width="100" src="<?= base_url().$result[0]['blog_img'] ?>" alt="">
                <input type="file" class="form-control" name="file" placeholder="Title" >
            </div>
            <button type="submit" class="btn btn-primary">Edit Blog</button>
        </form>    
    </main>
<?php $this->load->view('admin_panel/footer.php'); ?>
<script type="text/javascript">
<?php
if(isset($_SESSION['updated'])){
    if($_SESSION['updated']=='yes'){
        echo "alert('Data updated successfully')";
    }else{
        echo "alert('Not updated')";
    }
}
?>
</script>

</script>
<script src="//cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('desc');
</script>