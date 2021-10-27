{include file='header.tpl'}

<body id="page-top">

	<!-- Wrapper -->
	<div id="wrapper">

		<!-- Sidebar -->
		{include file='sidebar.tpl'}

		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main content -->
			<div id="content">

				<!-- Topbar -->
				{include file='navbar.tpl'}

				<!-- Begin Page Content -->
				<div class="container-fluid">

					<!-- Page Heading -->
					<div class="d-sm-flex align-items-center justify-content-between mb-4">


						<div class="row mb-2">
							<div class="col-sm-6">
								<h1 class="m-0 text-dark">{$TITLE}</h1>
							</div>
						</div>
					</div>

					<section class="content">
						{if isset($SUCCESS)}
							<div class="alert alert-success alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h5><i class="icon fa fa-check"></i> {$SUCCESS_TITLE}</h5>
								{$SUCCESS}
							</div>
						{/if}

						{if isset($ERRORS) && count($ERRORS)}
							<div class="alert alert-danger alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h5><i class="icon fas fa-exclamation-triangle"></i> {$ERRORS_TITLE}</h5>
								<ul>
									{foreach from=$ERRORS item=error}
										<li>{$error}</li>
									{/foreach}
								</ul>
							</div>
						{/if}
						<div class="float-md">
							<a href="{$ADD_URL}" class="btn btn-primary">{$ADD_NEW_JOBS} <i class="fa fa-plus-circle"></i></a>
						</div>
						<hr>
						{if count($JOBS_LIST)}
							<div class="table-responsive">
								<table class="table table-striped">
									<tbody>
										{foreach from=$JOBS_LIST key=key item=jobs}
											<tr>
												<td>
													<strong>{$jobs}</strong>
												</td>
												<td>
													<div class="float-md-right">
														<a class="btn btn-warning btn-sm" href="{$EDIT_URL}{$key}"><i class="fas fa-edit fa-fw"></i></a>
														<button class="btn btn-danger btn-sm" type="button" onclick="showDeleteModal('{$key}')"><i
																class="fas fa-trash fa-fw"></i></button>
													</div>
												</td>
											</tr>
										{/foreach}
									</tbody>
								</table>
							</div>
						{else}
							{$NO_JOBS}
						{/if}
					</section>
				</div>




				<!-- Modal Form -->
				<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">{$ARE_YOU_SURE}</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								{$CONFIRM_DELETE}
							</div>
							<div class="modal-footer">
								<form method="post">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">{$NO}</button>
									<input type="hidden" name="delete_value" id="delete_value">
									<input type="hidden" name="token" value="{$TOKEN}">
									<input type="submit" class="btn btn-primary" value="{$YES}">
								</form>
							</div>
						</div>
					</div>
				</div>

			</div>

			{include file='footer.tpl'}

		</div>
	</div>
	<!-- ./wrapper -->

	{include file='scripts.tpl'}

	<script type="text/javascript">
		function showDeleteModal(value) {
			document.getElementById('delete_value').value = value;
			$('#deleteModal').modal().show();
		}
	</script>

</body>

</html>