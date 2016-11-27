<?php
class Controller_Cards extends Controller_Template
{

	public function action_index()
	{
		$data['cards'] = Model_Card::find('all');
		$this->template->title = "Cards";
		$this->template->content = View::forge('cards/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('cards');

		if ( ! $data['card'] = Model_Card::find($id))
		{
			Session::set_flash('error', 'Could not find card #'.$id);
			Response::redirect('cards');
		}

		$this->template->title = "Card";
		$this->template->content = View::forge('cards/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Card::validate('create');

			if ($val->run())
			{
				$card = Model_Card::forge(array(
					'card_name' => Input::post('card_name'),
					'point_distribution' => Input::post('point_distribution'),
					'topcategory_id' => Input::post('topcategory_id'),
				));

				if ($card and $card->save())
				{
					Session::set_flash('success', 'Added card #'.$card->id.'.');

					Response::redirect('cards');
				}

				else
				{
					Session::set_flash('error', 'Could not save card.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Cards";
		$this->template->content = View::forge('cards/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('cards');

		if ( ! $card = Model_Card::find($id))
		{
			Session::set_flash('error', 'Could not find card #'.$id);
			Response::redirect('cards');
		}

		$val = Model_Card::validate('edit');

		if ($val->run())
		{
			$card->card_name = Input::post('card_name');
			$card->point_distribution = Input::post('point_distribution');
			$card->topcategory_id = Input::post('topcategory_id');

			if ($card->save())
			{
				Session::set_flash('success', 'Updated card #' . $id);

				Response::redirect('cards');
			}

			else
			{
				Session::set_flash('error', 'Could not update card #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$card->card_name = $val->validated('card_name');
				$card->point_distribution = $val->validated('point_distribution');
				$card->topcategory_id = $val->validated('topcategory_id');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('card', $card, false);
		}

		$this->template->title = "Cards";
		$this->template->content = View::forge('cards/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('cards');

		if ($card = Model_Card::find($id))
		{
			$card->delete();

			Session::set_flash('success', 'Deleted card #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete card #'.$id);
		}

		Response::redirect('cards');

	}

}
