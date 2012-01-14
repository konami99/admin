<?php $this->load->helper('form'); ?>
<?php $this->load->helper('html'); ?>
<div id="center-column">
                <div class="top-bar">
                    <a href="#" class="button">ADD NEW </a>
                    <h1>Edit Status</h1>
                    
                </div>
               
                <?php echo form_open('status/update/' .  $this->uri->segment(3)); ?>
                <?php
                echo 'StatusID:', $queryResult->row()->StatusID, br();
                echo 'Status:', form_input(array('name'=>'status','value'=>$queryResult->row()->Status)), br();
             	?>


                <?php
                echo  form_submit('updateButton', 'Save');
                ?>
                <?php echo form_close(); ?>
            </div>

<script type="text/javascript">
    $(function(){
        
    });

</script>