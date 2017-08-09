
<?php $this->set('title_for_layout', 'Manage News'); ?>

<?php $this->start('jquery-scripts'); ?>
	$('#blog-table').dataTable({	
		"sPaginationType": "bootstrap"
	});
<?php $this->end(); ?>

<?php if (!empty($blogs)): ?>
<table class="table table-striped table-bordered table-hover dataTable" id="ablog-table">
	<thead>
		<tr>
			<th>Post Name</th>
			
			<th>Options</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($blogs as $blog) { ?>
		<tr>
			<td><?php echo $blog['Blog']['name']; ?></td>
			
			<td>
				<a role="button" class="btn btn-primary" href="/admin/blog/edit/<?php echo $blog['Blog']['id']; ?>"><i class="fa fa-edit"></i> Edit</a>&nbsp;
				<a role="button" class="btn btn-danger delete-object" onclick='return confirm("Are you sure you want to delete \"<?php echo $blog['Blog']['name']; ?>?\" This action CANNOT be undone.")'
                                   href="/admin/blog/delete/<?php echo $blog['Blog']['id']; ?>"><i class="fa fa-trash-o"></i> Delete</a>
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>

<?php echo $this->element('modals/delete', array('title' => 'Delete Blog', 'text' => 'delete the <strong>{name}</strong> blog', 'action' => '/admin/blog/delete/{id}')); ?>

<?php else: ?>
<p>There is no blog in this section.</p>
<?php endif; ?>

<a role="button" href="/admin/blog/add" class="btn btn-primary small"><i class="fa fa-plus"></i> Create New Page</a>
