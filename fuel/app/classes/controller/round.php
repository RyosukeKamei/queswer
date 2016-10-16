<?php
class Controller_Round extends Controller_Template
{
    /**
     * action_list
     * 試験一覧表示
     * 
     */
	public function action_list($examnation_id = null)
	{
		/*
		 * Ver1.0 examinationでJOINして、試験ごとのリストを取得
		 * 例：応用情報
		 * 平成21年度春応用情報技術者試験
		 * 平成21年度秋応用情報技術者試験
		 * …
		 * 
		 * Ver2.0 後で
		 * 試験を開始 or 試験の続き・試験を終了（履歴を削除）の制御
		 * 
		 * データ取得（SELECT）の場合のテスト方針
		 * 下記のようにFuelPHPの作法に従った場合はテストしない（FuelPHPのメソッドで担保されているから）
		 * 自前でSQLを書かないといけない場合は、テストを書く
		 * 
		 */
	    $data = array('rounds');
	    if($examnation_id) {
            $data['rounds'] = 
                Model_Round::query()->related('examination')
                // JOINしたテーブルをWHEREするときはテーブル指定
//                 ->where('examination.id', 3)
                // FROMのテーブルをWHEREするときは指定しない（指定するとエラー）
                ->where('examination_id', 3)
                // ORDER BY
                ->order_by('id', 'desc')
                // get_oneで１レコード取得
                ->get();
            
            // select 文を準備します
//             SELECT * FROM rounds
//             INNER JOIN examinations ON rounds.examination_id = examinations.id
//             LEFT JOIN answers ON rounds.id = answers.round_id
//               AND answers.finish_flag = 0
//             WHERE rounds.examination_id = 3
//             ORDER BY rounds.id DESC
            $query = DB::select()->from('rounds');
            // Join examinations table
            $query->join('examinations', 'INNER');
            $query->on('rounds.examination_id', '=', 'examinations.id');
            // Join answers table
            $query->join('answers', 'LEFT');
            $query->on('rounds.id', '=', 'answers.round_id');
            $query->and_on('answers.finish_flag', '=', db::expr(0));
            $query->where('rounds.examination_id', 3);
            $query->order_by('rounds.id', 'desc');
            $result = $query->execute();
            var_dump($result);
            var_dump(count($result));
	    }
        $this->template->title = "応用情報技術者試験午前";
		$this->template->content = View::forge('round/list', $data);
	}
    
    /*
	 * 以下はscaffoldされた自動生成ファイル
	 * 使わない
	 * action_index
	 * action_view
	 * 登録・更新・削除は後日使うかも
	 * action_create
	 * action_exit
	 * action_delete
	 */
// 	public function action_index()
// 	{
// 		$data['rounds'] = Model_Round::find('all');
// 		$this->template->title = "Rounds";
// 		$this->template->content = View::forge('round/index', $data);

// 	}

// 	public function action_view($id = null)
// 	{
// 		is_null($id) and Response::redirect('round');

// 		if ( ! $data['round'] = Model_Round::find($id))
// 		{
// 			Session::set_flash('error', 'Could not find round #'.$id);
// 			Response::redirect('round');
// 		}

// 		$this->template->title = "Round";
// 		$this->template->content = View::forge('round/view', $data);

// 	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Round::validate('create');

			if ($val->run())
			{
				$round = Model_Round::forge(array(
					'round_name' => Input::post('round_name'),
					'examination_id' => Input::post('examination_id'),
					'deleted_at' => Input::post('deleted_at'),
				));

				if ($round and $round->save())
				{
					Session::set_flash('success', 'Added round #'.$round->id.'.');

					Response::redirect('round');
				}

				else
				{
					Session::set_flash('error', 'Could not save round.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Rounds";
		$this->template->content = View::forge('round/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('round');

		if ( ! $round = Model_Round::find($id))
		{
			Session::set_flash('error', 'Could not find round #'.$id);
			Response::redirect('round');
		}

		$val = Model_Round::validate('edit');

		if ($val->run())
		{
			$round->round_name = Input::post('round_name');
			$round->examination_id = Input::post('examination_id');
			$round->deleted_at = Input::post('deleted_at');

			if ($round->save())
			{
				Session::set_flash('success', 'Updated round #' . $id);

				Response::redirect('round');
			}

			else
			{
				Session::set_flash('error', 'Could not update round #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$round->round_name = $val->validated('round_name');
				$round->examination_id = $val->validated('examination_id');
				$round->deleted_at = $val->validated('deleted_at');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('round', $round, false);
		}

		$this->template->title = "Rounds";
		$this->template->content = View::forge('round/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('round');

		if ($round = Model_Round::find($id))
		{
			$round->delete();

			Session::set_flash('success', 'Deleted round #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete round #'.$id);
		}

		Response::redirect('round');

	}

}
