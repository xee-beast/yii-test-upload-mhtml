<?php

namespace app\services;

use yii\i18n\Formatter;
use app\models\Group;
use Yii;

class GroupService
{
	/**
	 * @param $file
	 * @return void
	 */
	public function parseMhtmlFile($file){
	 $tempFile = $file->tempName;

	 // Start output buffering
	 ob_start();
	 $content = file_get_contents($tempFile);
	 if (preg_match_all('/<table[^>]*>(.*?)<\/table>/is', $content, $tableMatches)) {
		 foreach ($tableMatches[1] as $tableContent) {
			 echo "\n <br><br>";

			 // Extract the rows and columns from each table
			 if (preg_match_all('/<tr[^>]*>(.*?)<\/tr>/is', $tableContent, $rowMatches)) {
				 foreach (array_slice($rowMatches[1], 1) as $rowContent) { // Skip the first row as its header data
					 if (preg_match_all('/<td[^>]*>(.*?)<\/td>/is', $rowContent, $colMatches)) {
						 $winLoss = 0;
						 if (isset($colMatches[1][8])) {
							 $res = preg_replace("/[^0-9\.\-]/", "", $colMatches[1][8]);
							 $winLoss = (int)$res;
						 }
						 $group = new Group();
						 $group->group_no = $colMatches[1][0] ?? null;
						 $group->casino_name = $colMatches[1][1] ?? null;
						 $group->screen_name = utf8_encode($colMatches[1][2]) ?? null;
						 $group->player_id = $colMatches[1][3] ?? null;
						 $group->enrolled_at = $colMatches[1][4] ?? null;
						 $group->no_of_sessions = $colMatches[1][5] ?? null;
						 $group->currency = $colMatches[1][6] ?? null;
						 $group->turnover = $colMatches[1][7] ?? null;
						 $group->win_loss = $winLoss;
						 $group->date_played = $colMatches[1][9] ?? null;
						 $group->comment = $colMatches[1][10] ?? null;
						 $group->save();
					 }
				 }
			 }
		 }
	 }
	 ob_end_flush();
 }
}
