<?php $this->load->view("admin_panel/header"); ?>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <h1 class="h2">Add Blog</h1>
        <form enctype="multipart/form-data" action="<?= base_url().'admin/blog/addblog_post' ?>" method="post">
        <div class="form-group">
                <input type="text" class="form-control" name="blog_title" placeholder="Title" >
            </div>
            <div class="form-group">
                <textarea name="desc" class="form-control" placeholder="Blog desc"></textarea>   
            </div>
            <div class="form-group">
                <input type="file" class="form-control" name="file" placeholder="Title" >
            </div>
            <button type="submit" class="btn btn-primary">Add Blog</button>
        </form>    
    </main>
<?php $this->load->view('admin_panel/footer.php'); ?>
<script type="text/javascript">
<?php
if(isset($_SESSION['inserted'])){
    if($_SESSION['inserted']=='yes'){
        echo "alert('Data inserted successfully')";
    }else{
        echo "alert('Not inserted')";
    }
}
?>

</script>
<script src="//cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('desc');
</script>