<?php
/**
 * Controller_Examination
 * 試験区分（ITパスポート・基本情報・応用情報など）
 * 今のところ増減する予定なし、あったとしても頻度は限りなく小さい
 * 当面はDB直接操作で運用
 * ↓
 * index以外はコメントアウト
 * indexはトップページに利用
 * 
 * @author sr2smail
 *
 */
class Controller_Examination extends Controller_Template
{

	public function action_index()
	{
		/*
		 * 試験カテゴリ
		 */
		$data['examinations'] = Model_Examination::find('all');
		
		/*
		 * 最新のイベントへのリンク
		 */
		$data['event'] = Model_Event::find('last');
		
		/*
		 * イベント開始
		 */
		$data['start_event'] = Model_Event::query()
				->related('round')
				->related('examination')
				->where('start_datetime', '<=', DB::EXPR('NOW()'))
				->where('finish_datetime', '>=', DB::EXPR('NOW()'))
				->get_one();
		
		$this->template->title = "IPA系国家資格 過去問チャレンジサイト";
		$this->template->content = View::forge('examination/index', $data);

	}

// 	public function action_view($id = null)
// 	{
// 		is_null($id) and Response::redirect('examination');

// 		if ( ! $data['examination'] = Model_Examination::find($id))
// 		{
// 			Session::set_flash('error', 'Could not find examination #'.$id);
// 			Response::redirect('examination');
// 		}

// 		$this->template->title = "Examination";
// 		$this->template->content = View::forge('examination/view', $data);

// 	}

// 	public function action_create()
// 	{
// 		if (Input::method() == 'POST')
// 		{
// 			$val = Model_Examination::validate('create');

// 			if ($val->run())
// 			{
// 				$examination = Model_Examination::forge(array(
// 					'examination_name' => Input::post('examination_name'),
// 					'deleted_at' => Input::post('deleted_at'),
// 				));

// 				if ($examination and $examination->save())
// 				{
// 					Session::set_flash('success', 'Added examination #'.$examination->id.'.');

// 					Response::redirect('examination');
// 				}

// 				else
// 				{
// 					Session::set_flash('error', 'Could not save examination.');
// 				}
// 			}
// 			else
// 			{
// 				Session::set_flash('error', $val->error());
// 			}
// 		}

// 		$this->template->title = "Examinations";
// 		$this->template->content = View::forge('examination/create');

// 	}

// 	public function action_edit($id = null)
// 	{
// 		is_null($id) and Response::redirect('examination');

// 		if ( ! $examination = Model_Examination::find($id))
// 		{
// 			Session::set_flash('error', 'Could not find examination #'.$id);
// 			Response::redirect('examination');
// 		}

// 		$val = Model_Examination::validate('edit');

// 		if ($val->run())
// 		{
// 			$examination->examination_name = Input::post('examination_name');
// 			$examination->deleted_at = Input::post('deleted_at');

// 			if ($examination->save())
// 			{
// 				Session::set_flash('success', 'Updated examination #' . $id);

// 				Response::redirect('examination');
// 			}

// 			else
// 			{
// 				Session::set_flash('error', 'Could not update examination #' . $id);
// 			}
// 		}

// 		else
// 		{
// 			if (Input::method() == 'POST')
// 			{
// 				$examination->examination_name = $val->validated('examination_name');
// 				$examination->deleted_at = $val->validated('deleted_at');

// 				Session::set_flash('error', $val->error());
// 			}

// 			$this->template->set_global('examination', $examination, false);
// 		}

// 		$this->template->title = "Examinations";
// 		$this->template->content = View::forge('examination/edit');

// 	}

// 	public function action_delete($id = null)
// 	{
// 		is_null($id) and Response::redirect('examination');

// 		if ($examination = Model_Examination::find($id))
// 		{
// 			$examination->delete();

// 			Session::set_flash('success', 'Deleted examination #'.$id);
// 		}

// 		else
// 		{
// 			Session::set_flash('error', 'Could not delete examination #'.$id);
// 		}

// 		Response::redirect('examination');

// 	}

}
