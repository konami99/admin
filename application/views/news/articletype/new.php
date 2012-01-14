<?php $this->load->helper('form'); ?>
<?php $this->load->helper('html'); ?>
<div id="center-column">
                <div class="top-bar">
                    <a href="#" class="button">ADD NEW </a>
                    <h1>New Article Type</h1>
                    
                </div>
               <p>
                <?php echo form_open('articletype/create'); ?>
                <?php
                echo 'Type:', form_input(array('name'=>'type','value'=>'')), br();
                
                echo  form_submit('updateButton', 'Save');
                ?>
                <?php echo form_close(); ?>
                </p>
            </div>

<script type="text/javascript">
    $(function(){
    	
    });

</script>