<?php
/**
 * Controller_Organization
 * 試験団体（IPAなど）
 * 増減がほとんどない
 * ↓
 * コメントアウト
 * 
 * @author sr2smail
 *
 */
// class Controller_Organization extends Controller_Template
// {

// 	public function action_index()
// 	{
// 		$data['organizations'] = Model_Organization::find('all');
// 		$this->template->title = "Organizations";
// 		$this->template->content = View::forge('organization/index', $data);

// 	}

// 	public function action_view($id = null)
// 	{
// 		is_null($id) and Response::redirect('organization');

// 		if ( ! $data['organization'] = Model_Organization::find($id))
// 		{
// 			Session::set_flash('error', 'Could not find organization #'.$id);
// 			Response::redirect('organization');
// 		}

// 		$this->template->title = "Organization";
// 		$this->template->content = View::forge('organization/view', $data);

// 	}

// 	public function action_create()
// 	{
// 		if (Input::method() == 'POST')
// 		{
// 			$val = Model_Organization::validate('create');

// 			if ($val->run())
// 			{
// 				$organization = Model_Organization::forge(array(
// 					'organization_name' => Input::post('organization_name'),
// 					'deleted_at' => Input::post('deleted_at'),
// 				));

// 				if ($organization and $organization->save())
// 				{
// 					Session::set_flash('success', 'Added organization #'.$organization->id.'.');

// 					Response::redirect('organization');
// 				}

// 				else
// 				{
// 					Session::set_flash('error', 'Could not save organization.');
// 				}
// 			}
// 			else
// 			{
// 				Session::set_flash('error', $val->error());
// 			}
// 		}

// 		$this->template->title = "Organizations";
// 		$this->template->content = View::forge('organization/create');

// 	}

// 	public function action_edit($id = null)
// 	{
// 		is_null($id) and Response::redirect('organization');

// 		if ( ! $organization = Model_Organization::find($id))
// 		{
// 			Session::set_flash('error', 'Could not find organization #'.$id);
// 			Response::redirect('organization');
// 		}

// 		$val = Model_Organization::validate('edit');

// 		if ($val->run())
// 		{
// 			$organization->organization_name = Input::post('organization_name');
// 			$organization->deleted_at = Input::post('deleted_at');

// 			if ($organization->save())
// 			{
// 				Session::set_flash('success', 'Updated organization #' . $id);

// 				Response::redirect('organization');
// 			}

// 			else
// 			{
// 				Session::set_flash('error', 'Could not update organization #' . $id);
// 			}
// 		}

// 		else
// 		{
// 			if (Input::method() == 'POST')
// 			{
// 				$organization->organization_name = $val->validated('organization_name');
// 				$organization->deleted_at = $val->validated('deleted_at');

// 				Session::set_flash('error', $val->error());
// 			}

// 			$this->template->set_global('organization', $organization, false);
// 		}

// 		$this->template->title = "Organizations";
// 		$this->template->content = View::forge('organization/edit');

// 	}

// 	public function action_delete($id = null)
// 	{
// 		is_null($id) and Response::redirect('organization');

// 		if ($organization = Model_Organization::find($id))
// 		{
// 			$organization->delete();

// 			Session::set_flash('success', 'Deleted organization #'.$id);
// 		}

// 		else
// 		{
// 			Session::set_flash('error', 'Could not delete organization #'.$id);
// 		}

// 		Response::redirect('organization');

// 	}

// }
