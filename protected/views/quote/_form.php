<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'quote-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php /*
	<div class="row">
		<?php echo $form->labelEx($model,'movie_id'); ?>
		<?php 
			$this->widget( 'zii.widgets.jui.CJuiAutoComplete', array(
				'name'	=> 'movie_id_input',
				'value'	=> '',
				'source'=> $this->createUrl( '/movie/ajaxmovielist' ),
				'options'	=> array(
					'showAnim'	=> 'fold',
					'select'	=> 'js:function(event,ui){
						jQuery("#Quote_movie_id").val( ui.item["id"] );
					}'
				)
			) );
		?>
		<?php echo $form->hiddenField($model,'movie_id'); ?>
		<?php echo $form->error($model,'movie_id'); ?>
	</div>
	*/ ?>

	<div class="row">
		<?php
			if( Yii::app()->request->getParam( 'lastmid', null ) )
			{
				$model->movie_id = Yii::app()->request->getParam('lastmid');
			}
		?>
		<?php echo $form->labelEx( $model, 'movie_id' ); ?>
		<?php echo $form->dropDownList( $model, 'movie_id', CHtml::listData( Movie::model()->findAll( array('order' => 'title' ) ),'id','title' ), array( 'style' => 'width:300px', 'class' => 'chzn-select', 'onchange' => 'updateLatestQuotes(jQuery( "#"+this.id).val() );' ) ) ?>
	</div>
	<?php $this->widget( 'ext.EChosen.EChosen' ); ?>

	<div class="row">
		<?php $model->level = $model->level ? $model->level : 1; ?> 
		<?php echo $form->labelEx($model,'level'); ?>
		<?php echo $form->dropDownList($model,'level', range(0,25) ); ?>
		<?php echo $form->error($model,'level'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'quote'); ?>
		<?php echo $form->textArea($model,'quote',array('rows'=>6, 'cols'=>45)); ?>
		<?php echo $form->error($model,'quote'); ?>
	</div>

	<?php /*
	<div class="row">
		<?php echo $form->labelEx($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
		<?php echo $form->error($model,'created'); ?>
	</div>
	*/?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php Yii::app()->clientscript->registerScript( 'focusquotes', '$("#Quote_quote").focus();', CClientScript::POS_READY ) ?>
