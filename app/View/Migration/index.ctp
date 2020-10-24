<div class="row-fluid">
	<?php if(!empty($error_msg)): ?>
		<div class="alert alert-danger" role="alert">
			<?= $error_msg; ?>
		</div>
	<?php endif; ?>
	<?php if(!empty($success_msg)): ?>
		<div class="alert alert-success" role="alert">
			<?= $success_msg; ?>
		</div>
	<?php endif; ?>

	<hr />

	<div class="alert">
		<h3>Migration Excel Records</h3>
	</div>
<?php
//echo $this->Form->create('FileUpload');
echo '<form action="index" method="post" enctype="multipart/form-data">';
echo ' <input type="file" name="upload_input" id="upload_input">';
//echo $this->Form->input('file', array('label' => 'File Upload', 'type' => 'file'));
echo $this->Form->submit('Upload', array('class' => 'btn btn-primary'));
echo $this->Form->end();
?>



	
</div>