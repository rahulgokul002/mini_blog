<?php $this->load->view("admin_panel/header"); ?>
<div class="modal fadeInRight edit-modal-variation-data-consultation animated " id="edit-modal-variation-data-consultation" role="dialog" aria-labelledby="edit-modal-variation-data-consultation" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content" id="ajax_variation_modal_consultation"></div>
  </div>
</div>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <h1 class="h2">View Blog</h1>
        <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                <th>Sl.NO.</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Edit</th>
                <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if($results){
                    $c=1;
                    foreach($results as $key=>$value){
                        $treat='<span data-toggle="tooltip" data-placement="bottom" title="Add invoice"><button type="button" class="btn btn-primary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".edit-modal-variation-data-consultation"  data-field_id="'. $value['blog_img'] . '" data-field_type=""><span class="fa fa-plus">123</span></button>';      

                        echo  " <tr>
                        <td>".$c++."</td>
                        <td>".$value['blog_title']."</td>
                        <td>".$value['blog_desc']."</td>
                        <td><img src='".base_url().$value['blog_img']."' class='img-fluid' width='100'> </td>
                        <td><a class=\"btn btn-info\" href='". base_url().'admin/blog/editblog/'.$value['blogid']."'>Edit</a>
                        </a></td>
                        <td><a class=\"btn delete btn-danger\" href='#' data-id='".$value['blogid']."'>Delete</a>
                        </a></td>
                        <td>".$treat."</td>
                        </tr>";

echo $treat;
                    }
                }else{
                    echo "<tr><td colspan='6'>No Data</td></tr>";
                }
                ?>
             </tbody>
            </table></div>
    
    </main>
<?php $this->load->view('admin_panel/footer.php'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript">
    $(".delete").click(function(){
        var delete_id=$(this).attr('data-id');
        var bool=confirm('Are you sure you want delete this blog');
        if(bool){
            $.ajax({
                url:'<?= base_url().'admin/blog/deleteblog'?>',
                type:'post',
                data:{delete_id:delete_id},
                success:function(response){
                    if(response=="Deleted"){
                        location.reload();
                    }else{
                        alert("Something went to wrong");
                    }
                }
            });
        }else{
            alert('Blog is safe');
        }
    });
    $('.edit-modal-variation-data-consultation').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var modal = $(this);
  // var patient_id=$('#patient_id').val();
  var hidden_tab='invoice';
  $("#ajax_variation_modal_consultation").html('');
  $.ajax({
    url : base_url+"/blog/addblog",
    type: "GET",
    data: 'jd=1&is_ajax=1&mode=modal&data=warning&hidden_tab='+hidden_tab,
    success: function (response) {
    if(response) {
    $("#ajax_variation_modal_consultation").html(response);
    }
    },
    error:function(){
     $("#ajax_variation_modal_consultation").html('response');
    }
    });
  });
</script>