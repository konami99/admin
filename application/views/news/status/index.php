<?php $this->load->helper('form'); ?>
<?php $this->load->helper('html'); ?>
<div id="center-column">
                <div class="top-bar">
                    <?php echo anchor('status/newStatus', 'ADD NEW', array('class'=>'button')) ?>
                    <h1>Statuses Index</h1>
                    
                </div>
               <span><?php echo $this->session->flashdata('update_message') ?></span>
                <table>
                <tr>
                	<th>StatusID</th>
                	<th>Status</th>
                	<th>Option</th>
                </tr>
                <?php 
                foreach($queryResult->result() as $row)
                {
                	$id = $row->StatusID;
                ?>
                	
                	<tr>
                		<td><?php echo $id ?></td>
                		<td><?php echo $row->Status ?></td>
                		<td><?php echo anchor('status/edit/'.$id, 'edit');?>
                				|
                			<?php 
									echo anchor('status/delete/'.$id, 'delete');
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