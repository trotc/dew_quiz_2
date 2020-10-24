
<div class="row-fluid">
	<table class="table table-bordered" id="table_records">
		<thead>
			<tr>
				<th>ID</th>
				<th>NAME</th>	
			</tr>
		</thead>
		<tbody>
			<?php foreach($records as $record):?>
				
			<tr>
				<td>ID<?php echo $record['Record']['id']?></td>
				<td>Name<?php echo $record['Record']['name']?></td>
			</tr>	
			
			<?php  endforeach;?>
		</tbody>
	</table>
</div>


<?php $this->start('script_own');?>

<script type="text/javascript">
$(document).ready(function(){
	$("#table_records").dataTable({
	});
})
</script>
<?php $this->end();?>