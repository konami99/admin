<?php $this->load->helper('form'); ?>
<?php $this->load->helper('html'); ?>
<div id="center-column">
                <div class="top-bar">
                    <?php echo anchor('author/newAuthor', 'ADD NEW', array('class'=>'button')) ?>
                    <h1>Authors Index</h1>
                    
                </div>
               <span><?php echo $this->session->flashdata('update_message') ?></span>
                <table>
                <tr>
                	<th>AuthorID</th>
                	<th>FirstName</th>
                	<th>LastName</th>
             		<th>Email</th>
                	<th>Option</th>
                </tr>
                <?php 
                foreach($queryResult->result() as $row)
                {
                	$id = $row->AuthorID;
                ?>
                	
                	<tr>
                		<td><?php echo $id ?></td>
                		<td><?php echo $row->FirstName ?></td>
                		<td><?php echo $row->LastName ?></td>
                		<td><?php echo $row->Email ?></td>
                		<td><?php echo anchor('author/edit/'.$id, 'edit');?>
                				|
                			<?php 
									echo anchor('author/delete/'.$id, 'delete');
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