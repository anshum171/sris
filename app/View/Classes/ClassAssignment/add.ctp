<?php
echo $this->Html->script('plugins/tableCheckable/jquery.tableCheckable', array('inline' => false));
echo $this->Html->script('plugins/icheck/jquery.icheck.min', array('inline' => false));
echo $this->Html->css('../js/plugins/icheck/skins/minimal/blue', array('inline' => false));
$this->extend('/Layouts/tabs');

$this->assign('contentHeader', $contentHeader);
$this->assign('portletHeader', $portletHeader);
$this->assign('tabHeader', $header);

$this->prepend('portletBody');
	echo $this->element('../Classes/profile');
$this->end();

$this->start('tabActions');
	echo $this->FormUtility->link('back', array('action' => $model));
$this->end();

$this->start('tabBody');

$formOptions = $this->FormUtility->getFormOptions(array('action' => $model, 'add'));
echo $this->Form->create($model, $formOptions);
echo $this->element('layout/edit');
echo $this->Form->input('education_grade_id', array(
	'options' => $gradeOptions,
	'onchange' => "$('#reload').click()"
));

?>

<div class="form-group">
	<label class="col-md-2 control-label"><?php echo $this->Label->get('EducationSubject.title'); ?></label>
	<div class="col-md-10">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-checkable table-input table-highlight">
				<thead>
					<tr>
						<th class="checkbox-column"><input type="checkbox" class="icheck-input" /></th>
						<th><?php echo $this->Label->get('general.code'); ?></th>
						<th><?php echo $this->Label->get('EducationSubject.title'); ?></th>
						<th class="cell-marks"><?php echo $this->Label->get('AssessmentResultType.min'); ?></th>
						<th class="cell-marks"><?php echo $this->Label->get('AssessmentResultType.max'); ?></th>
						<th class="cell-marks"><?php echo $this->Label->get('AssessmentItem.weighting'); ?></th>
					</tr>
				</thead>
				
				<tbody>
					<?php
					foreach ($items as $i => $obj) :
						$inputOptions = array('div' => false, 'label' => false, 'before' => false, 'between' => false, 'type' => 'number');
					?>
					<tr>
						<?php
						echo $this->Form->hidden("AssessmentItem.$i.education_grade_subject_id", array('value' => $obj['EducationGradesSubject']['id']));
						?>
						<td class="checkbox-column">
							<?php echo $this->Form->checkbox("AssessmentItem.$i.visible", array('class' => 'icheck-input')); ?>
						</td>
						<td><?php echo $obj['EducationSubject']['code'] ?></td>
						<td><?php echo $obj['EducationSubject']['name'] ?></td>
						<td><?php echo $this->Form->input("AssessmentItem.$i.min", array_merge($inputOptions, array('value' => 50))) ?></td>
						<td><?php echo $this->Form->input("AssessmentItem.$i.max", array_merge($inputOptions, array('value' => 100))) ?></td>
						<td><?php echo $this->Form->input("AssessmentItem.$i.weighting", array_merge($inputOptions, array('value' => 0))) ?></td>
					</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php
echo '<div class="col-md-offset-2 form-buttons">';
echo $this->Form->button('reload', array('id' => 'reload', 'type' => 'submit', 'name' => 'submit', 'value' => 'reload', 'class' => 'hidden'));
echo $this->Form->button($this->Label->get('general.save'), array('type' => 'submit', 'name' => 'submit', 'value' => 'save', 'class' => 'btn btn-primary'));
echo $this->Form->button($this->Label->get('general.cancel'), array('type' => 'reset', 'class' => 'btn btn-primary btn-back'));
echo '</div>';
echo $this->Form->end();
$this->end();
?>