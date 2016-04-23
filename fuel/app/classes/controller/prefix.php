<?php
class Controller_Prefix extends Controller_Template
{

	public function action_index()
	{
		$data['prefixes'] = Model_Prefix::find('all');
		$this->template->title = "Prefixes";
		$this->template->content = View::forge('prefix/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('prefix');

		if ( ! $data['prefix'] = Model_Prefix::find($id))
		{
			Session::set_flash('error', 'Could not find prefix #'.$id);
			Response::redirect('prefix');
		}

		$this->template->title = "Prefix";
		$this->template->content = View::forge('prefix/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Prefix::validate('create');

			if ($val->run())
			{
				$prefix = Model_Prefix::forge(array(
					'prefix_name' => Input::post('prefix_name'),
					'deleted_at' => Input::post('deleted_at'),
				));

				if ($prefix and $prefix->save())
				{
					Session::set_flash('success', 'Added prefix #'.$prefix->id.'.');

					Response::redirect('prefix');
				}

				else
				{
					Session::set_flash('error', 'Could not save prefix.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Prefixes";
		$this->template->content = View::forge('prefix/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('prefix');

		if ( ! $prefix = Model_Prefix::find($id))
		{
			Session::set_flash('error', 'Could not find prefix #'.$id);
			Response::redirect('prefix');
		}

		$val = Model_Prefix::validate('edit');

		if ($val->run())
		{
			$prefix->prefix_name = Input::post('prefix_name');
			$prefix->deleted_at = Input::post('deleted_at');

			if ($prefix->save())
			{
				Session::set_flash('success', 'Updated prefix #' . $id);

				Response::redirect('prefix');
			}

			else
			{
				Session::set_flash('error', 'Could not update prefix #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$prefix->prefix_name = $val->validated('prefix_name');
				$prefix->deleted_at = $val->validated('deleted_at');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('prefix', $prefix, false);
		}

		$this->template->title = "Prefixes";
		$this->template->content = View::forge('prefix/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('prefix');

		if ($prefix = Model_Prefix::find($id))
		{
			$prefix->delete();

			Session::set_flash('success', 'Deleted prefix #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete prefix #'.$id);
		}

		Response::redirect('prefix');

	}

}
