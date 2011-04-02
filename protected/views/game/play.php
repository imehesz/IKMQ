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
			<td><?php echo $movie->quotes[ $rand_qoute ]->quote; ?></td>
			<td><?php echo $model->movies_shuffled[$rand_movie_cnt++]->title; ?>
			<?php echo $model->movies_shuffled[$rand_movie_cnt++]->title; ?></td>
		</tr>
	<?php endfor; ?>
	</table>
</div>
