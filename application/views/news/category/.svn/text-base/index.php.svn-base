<?php $this->load->helper('form'); ?>
<?php $this->load->helper('html'); ?>
<div id="center-column">
                <div class="top-bar">
                    <?php echo anchor('category/newCategory', 'ADD NEW', array('class'=>'button')) ?>
                    <h1>Categories Index</h1>
                    
                </div>
               <span><?php echo $this->session->flashdata('update_message') ?></span>
                <table>
                <tr>
                	<th>CategoryID</th>
                	<th>Category</th>
                	<th>Option</th>
                </tr>
                <?php 
                foreach($queryResult->result() as $row)
                {
                	$id = $row->CategoryID;
                ?>
                	
                	<tr>
                		<td><?php echo $id ?></td>
                		<td><?php echo $row->Category ?></td>
                		
                		<td><?php echo anchor('category/edit/'.$id, 'edit');?>
                				|
                			<?php 
									echo anchor('category/delete/'.$id, 'delete');
                			?>
                		
                		</td>
                	</tr>
                <?php 
                }
               	?>
                
                </table>
            </div>

<script type="text/javascript">
    $(function(){
        
    });

</script>