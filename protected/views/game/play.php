<?php
$this->breadcrumbs=array(
	'Game'=>array('/game'),
	'Play',
);?>
<h1>PLAY</h1>

<div>
	<table>
	<?php $rand_movie_cnt=0; for( $i=0; $i < $model->level ; $i++ ): ?>
		<?php		
				$movie = $model->movies[$i];
				
				do{
					$rand_qoute = rand( 0, $movie->quoteCnt );
				}while( ! isset( $movie->quotes[ $rand_qoute ] ) );
		?>
		<tr class="">
			<td style="font-size:20px;width:550px;"><?php echo $movie->quotes[ $rand_qoute ]->quote; ?></td>
			<td><?php 
					echo 
						CHtml::image( 
							Yii::app()->request->baseUrl . 
								'/image.php?width=50&height=75&image='. Yii::app()->request->baseUrl . '/' . Yii::app()->params['moviescreenshots'] . $model->movies_shuffled[$rand_movie_cnt]->pic, null, array( 'title' => $model->movies_shuffled[$rand_movie_cnt++]->title ) ) . ' '; 

					echo 
						CHtml::image( 
							Yii::app()->request->baseUrl . 
								'/image.php?width=50&height=75&image='. Yii::app()->request->baseUrl . '/' . Yii::app()->params['moviescreenshots'] . $model->movies_shuffled[$rand_movie_cnt]->pic, null, array( 'title' => $model->movies_shuffled[$rand_movie_cnt++]->title ) );
				?></td>
		</tr>
	<?php endfor; ?>
	</table>
</div>
