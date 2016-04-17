<?php
class Controller_Admin extends Controller_Template
{

	public function action_index()
	{
		$data['admins'] = Model_Admin::find('all');
		$this->template->title = "Admins";
		$this->template->content = View::forge('admin/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('admin');

		if ( ! $data['admin'] = Model_Admin::find($id))
		{
			Session::set_flash('error', 'Could not find admin #'.$id);
			Response::redirect('admin');
		}

		$this->template->title = "Admin";
		$this->template->content = View::forge('admin/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Admin::validate('create');

			if ($val->run())
			{
				$admin = Model_Admin::forge(array(
					'user_id' => Input::post('user_id'),
					'password' => Input::post('password'),
					'examination_id' => Input::post('examination_id'),
					'deleted_at' => Input::post('deleted_at'),
				));

				if ($admin and $admin->save())
				{
					Session::set_flash('success', 'Added admin #'.$admin->id.'.');

					Response::redirect('admin');
				}

				else
				{
					Session::set_flash('error', 'Could not save admin.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Admins";
		$this->template->content = View::forge('admin/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('admin');

		if ( ! $admin = Model_Admin::find($id))
		{
			Session::set_flash('error', 'Could not find admin #'.$id);
			Response::redirect('admin');
		}

		$val = Model_Admin::validate('edit');

		if ($val->run())
		{
			$admin->user_id = Input::post('user_id');
			$admin->password = Input::post('password');
			$admin->examination_id = Input::post('examination_id');
			$admin->deleted_at = Input::post('deleted_at');

			if ($admin->save())
			{
				Session::set_flash('success', 'Updated admin #' . $id);

				Response::redirect('admin');
			}

			else
			{
				Session::set_flash('error', 'Could not update admin #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$admin->user_id = $val->validated('user_id');
				$admin->password = $val->validated('password');
				$admin->examination_id = $val->validated('examination_id');
				$admin->deleted_at = $val->validated('deleted_at');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('admin', $admin, false);
		}

		$this->template->title = "Admins";
		$this->template->content = View::forge('admin/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('admin');

		if ($admin = Model_Admin::find($id))
		{
			$admin->delete();

			Session::set_flash('success', 'Deleted admin #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete admin #'.$id);
		}

		Response::redirect('admin');

	}

}
