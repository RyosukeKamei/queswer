<?php
class Controller_Events extends Controller_Template
{

	/**
	 * action_index
	 * イベント一覧
	 */
	public function action_index()
	{
		$data['events'] = Model_Event::find('all');
		$this->template->title = "イベント一覧";
		$this->template->content = View::forge('events/index', $data);

	}

	/**
	 * action_create
	 * イベント作成
	 */
	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Event::validate('create');

			if ($val->run())
			{
				$event = Model_Event::forge(array(
					'examination_id' => Input::post('examination_id'),
					'round_id' => Input::post('round_id'),
					'start_datetime' => Input::post('start_datetime'),
					'finish_datetime' => Input::post('finish_datetime'),
				));

				if ($event and $event->save())
				{
					Session::set_flash('success', 'Added event #'.$event->id.'.');

					Response::redirect('events');
				}

				else
				{
					Session::set_flash('error', 'イベントを追加できませんでした。');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "イベント追加";
		$this->template->content = View::forge('events/create');

	}

	/**
	 * action_edit
	 * イベント編集
	 * 
	 * @param int $id イベントID
	 */
	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('events');

		if ( ! $event = Model_Event::find($id))
		{
			Session::set_flash('error', 'イベントがありません。 #'.$id);
			Response::redirect('events');
		}

		$val = Model_Event::validate('edit');

		if ($val->run())
		{
			$event->examination_id  = Input::post('examination_id');
			$event->round_id        = Input::post('round_id');
			$event->start_datetime  = Input::post('start_datetime');
			$event->finish_datetime = Input::post('finish_datetime');

			if ($event->save())
			{
				Session::set_flash('success', 'イベントを更新しました。 #' . $id);

				Response::redirect('events');
			}

			else
			{
				Session::set_flash('error', 'イベントを更新できませんでした。 #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$event->start_datetime = $val->validated('start_datetime');
				$event->finish_datetime = $val->validated('finish_datetime');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('event', $event, false);
		}

		$this->template->title = "Events";
		$this->template->content = View::forge('events/edit');

	}

	/**
	 * action_ranking
	 * イベントの結果を表示
	 * 
	 * @param int $id イベントID
	 */
	public function action_ranking($event_id = null)
	{
		/*
		 * nullはないけど
		 */
		is_null($event_id) and Response::redirect('events');
		
		/*
		 * イベントの属性情報を取得
		 */
		$data['event_infos'] = Model_Event::get_event_infos($event_id);
		
		/*
		 * イベンごとのランキングを取得
		 */
		$data['event_rankings'] = Model_Event::get_event_ranking($event_id);
		
		$this->template->title = "イベントランキング";
		$this->template->content = View::forge('events/ranking', $data);
	
	}
	
	/*
	 * action_view
	 * イベント表示
	 * 使わないのでコメントアウト
	 */
// 	public function action_view($id = null)
// 	{
// 		is_null($id) and Response::redirect('events');
	
// 		if ( ! $data['event'] = Model_Event::find($id))
// 		{
// 			Session::set_flash('error', 'Could not find event #'.$id);
// 			Response::redirect('events');
// 		}
	
// 		$this->template->title = "Event";
// 		$this->template->content = View::forge('events/view', $data);
	
// 	}

	/*
	 * action_delete
	 * イベント削除
	 * 使わない
	 */
// 	public function action_delete($id = null)
// 	{
// 		is_null($id) and Response::redirect('events');

// 		if ($event = Model_Event::find($id))
// 		{
// 			$event->delete();

// 			Session::set_flash('success', 'Deleted event #'.$id);
// 		}

// 		else
// 		{
// 			Session::set_flash('error', 'Could not delete event #'.$id);
// 		}

// 		Response::redirect('events');

// 	}

}
