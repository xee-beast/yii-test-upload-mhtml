<?php
/** @var yii\web\View $this */

use yii\grid\GridView;
use yii\jui\DatePicker;
use yii\helpers\Html;

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>My Application</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="content-wrapper mt-3 mb-5">
	<div class="container">
		<div class="d-flex gap-2 mb-3">
			<?= Html::fileInput('file', null, ['id' => 'file-input', 'class' => 'btn btn-primary']) ?>
		</div>


		<div class="result-table mt-4">
			<div class="table-responsive">
		<?= GridView::widget([
				'dataProvider' => $dataProvider,
				'filterModel' => $searchModel,
				'columns' => [
						'group_no',
						'casino_name',
						'screen_name',
						'player_id',
						'enrolled_at',
						'no_of_sessions',
						'currency',
						'turnover',
						'win_loss',
						[
								'attribute' => 'date_played',
								'format' => ['datetime', 'php:Y-m-d'],
								'contentOptions' => ['style' => 'width:400px;'],
								'filter' => '<div class="input-group">' .
										DatePicker::widget([
												'model' => $searchModel,
												'attribute' => 'date_played_from',
												'options' => ['class' => 'form-control', 'placeholder' => 'From'],
												'dateFormat' => 'yyyy-MM-dd',
										]) .
										DatePicker::widget([
												'model' => $searchModel,
												'attribute' => 'date_played_to',
												'options' => ['class' => 'form-control', 'placeholder' => 'To'],
												'dateFormat' => 'yyyy-MM-dd',
										]) .
										'</div>',
						],
						'comment'
				],
		]); ?>
			</div>
		</div>


	</div>
</div>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
	$(function() {
		$('#file-input').on('change', function() {
			var fileInput = $(this)[0];
			var file = fileInput.files[0];
			var formData = new FormData();
			formData.append('file', file);

			$.ajax({
				url: '/group/submit',
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				success: function(response) {
					location.reload();
				},
				error: function() {
				}
			});
		});


	});

</script>
