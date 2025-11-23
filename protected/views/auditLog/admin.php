<?php
/* @var $this AuditLogController */
/* @var $model AuditLog */

$this->breadcrumbs = array('Audit Logs' => array('index'), 'Manage');
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">System Audit Logs</h1>
</div>

<div class="card shadow mb-4">
	<div class="card-header py-3 border-left-warning">
		<h6 class="m-0 font-weight-bold text-warning"><i class="fas fa-shield-alt mr-1"></i> Activity Log</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<?php $this->widget('zii.widgets.grid.CGridView', array(
				'id' => 'audit-log-grid',
				'dataProvider' => $model->search(),
				'filter' => $model,
				'itemsCssClass' => 'table table-bordered table-hover table-sm small',
				'pagerCssClass' => 'dataTables_paginate paging_simple_numbers',

				'columns' => array(
					// 1. Timestamp
					array(
						'name' => 'timestamp',
						'value' => 'date("M j, Y H:i:s", strtotime($data->timestamp))',
						'htmlOptions' => array('width' => '15%', 'class' => 'text-muted'),
						'filter' => false,
					),

					// 2. User (The Actor - Showing USERNAME as requested)
					array(
						'header' => 'Actor (User)',
						'name' => 'user_account_id',
						'type' => 'raw',
						'value' => function ($data) {
							if ($data->user_account_id == 0) {
								return '<span class="badge badge-secondary">System / Guest</span>';
							}
							// Show Username in Bold
							if (isset($data->account)) {
								$role = isset($data->account->accountType) ? $data->account->accountType->type : '';
								return '<strong class="text-gray-800">' . CHtml::encode($data->account->username) . '</strong> <span class="text-muted">(' . $role . ')</span>';
							}
							return '<span class="text-danger">Deleted User (ID: ' . $data->user_account_id . ')</span>';
						},
						'htmlOptions' => array('width' => '20%'),
					),

					// 3. Action
					array(
						'name' => 'action',
						'type' => 'raw',
						'value' => function ($data) {
							$color = 'secondary';
							if (stripos($data->action, 'CREATE') !== false || stripos($data->action, 'ADD') !== false) $color = 'success';
							if (stripos($data->action, 'UPDATE') !== false) $color = 'warning';
							if (stripos($data->action, 'DELETE') !== false || stripos($data->action, 'CANCEL') !== false) $color = 'danger';
							if (stripos($data->action, 'LOGIN') !== false) $color = 'primary';

							return '<span class="badge badge-' . $color . '">' . $data->action . '</span>';
						},
						'htmlOptions' => array('width' => '12%', 'style' => 'text-align:center;'),
					),

					// 4. Target (The Object - Showing READABLE NAMES)
					array(
						'header' => 'Target',
						'type' => 'raw',
						'value' => function ($data) {
							$entity = $data->target_entity;
							$id = $data->target_id;
							$label = "ID: " . $id; // Default fallback

							// Logic to find readable names based on table
							if ($entity == 'tbl_account') {
								$rec = Account::model()->findByPk($id);
								if ($rec) $label = "User: <strong>" . $rec->username . "</strong>";
							} elseif ($entity == 'tbl_appointment') {
								$rec = Appointment::model()->with('patientAccount.user')->findByPk($id);
								if ($rec && isset($rec->patientAccount->user)) {
									$label = "Appt: <strong>" . $rec->patientAccount->user->firstname . "</strong>";
								}
							} elseif ($entity == 'tbl_prescription') {
								$label = "Prescription #" . $id;
							} elseif ($entity == 'tbl_consultation_record') {
								$label = "SOAP Note #" . $id;
							}

							return $label . ' <div class="small text-muted" style="font-size:0.75rem">' . $entity . '</div>';
						},
						'htmlOptions' => array('width' => '20%'),
					),

					// 5. Details
					array(
						'name' => 'details',
						'value' => '$data->details',
						'htmlOptions' => array('class' => 'text-gray-600'),
					),
				),
			)); ?>
		</div>
	</div>
</div>