<?php
/**
 * Controller_Keyword
 * キーワード
 * 
 * 
 * 
 * @author sr2smail
 *
 */
class Controller_Keyword extends Controller_Template
{

	/**
	 * action_index
	 * キーワード画面の一覧
	 * 
	 * 権限は管理者のみ
	 */
    public function action_index()
	{
		$data['keywords'] = Model_Keyword::find('all');
		$this->template->title = "Keywords";
		$this->template->content = View::forge('keyword/index', $data);

	}

	/**
	 * action_view
	 * キーワード画面の詳細（閲覧のみ）
	 * 
	 * すべての権限で参照可能
	 * 
	 * @param string $id
	 */
	public function action_view($keyword_id = null)
	{
		is_null($keyword_id) and Response::redirect('keyword');

		if ( ! $data['keyword'] = Model_Keyword::find($keyword_id))
		{
			Session::set_flash('error', 'キーワードがみつまりませんでした。 番号'.$keyword_id);
			/*
			 * @todo
			 * リダイレクト先は要検討
			 */
			Response::redirect('keyword');
		}
		
		/*
		 * 小項目のキーワードリンクのためデータを取得
		 * first_category_idで取得できる
		 * データがない場合は何も表示しない
		 */
		//-- 小項目 firstcategory_idを取得
		$keywordcategory_where['keyword_id'] = $keyword_id;
		$data['keyword_datas'] = Model_Keywordcategory::get_keywordcategories(
		        $keywordcategory_where
		        , 1 /*get_one 1行*/
		);
		$keywordcategory_where = null;
		
		//-- 小項目ごとのキーワードを取得
		$keywordcategory_where['firstcategory_id'] = $data['keyword_datas']->firstcategory_id;
		$data['keywordcategories'] = Model_Keywordcategory::get_keywordcategories(
		        $keywordcategory_where
		        , 0 /*get 複数行*/
		);
		$keywordcategory_where = null;
		
		/*
		 * タイトルはキーワード
		 */
		$this->template->title = $data['keyword']->keyword;
		
		/*
		 * HTMLを表示するために、第3引数はfalse
		 */
		$this->template->content = View::forge('keyword/view', $data, false);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Keyword::validate('create');

			if ($val->run())
			{
				$keyword = Model_Keyword::forge(array(
					'keyword' => Input::post('keyword'),
					'desctiption' => Input::post('desctiption'),
					'deleted_at' => Input::post('deleted_at'),
				));

				if ($keyword and $keyword->save())
				{
					Session::set_flash('success', 'Added keyword #'.$keyword->id.'.');

					Response::redirect('keyword');
				}

				else
				{
					Session::set_flash('error', 'Could not save keyword.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Keywords";
		$this->template->content = View::forge('keyword/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('keyword');

		if ( ! $keyword = Model_Keyword::find($id))
		{
			Session::set_flash('error', 'Could not find keyword #'.$id);
			Response::redirect('keyword');
		}

		$val = Model_Keyword::validate('edit');

		if ($val->run())
		{
			$keyword->keyword = Input::post('keyword');
			$keyword->desctiption = Input::post('desctiption');
			$keyword->deleted_at = Input::post('deleted_at');

			if ($keyword->save())
			{
				Session::set_flash('success', 'Updated keyword #' . $id);

				Response::redirect('keyword');
			}

			else
			{
				Session::set_flash('error', 'Could not update keyword #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$keyword->keyword = $val->validated('keyword');
				$keyword->desctiption = $val->validated('desctiption');
				$keyword->deleted_at = $val->validated('deleted_at');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('keyword', $keyword, false);
		}

		$this->template->title = "Keywords";
		$this->template->content = View::forge('keyword/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('keyword');

		if ($keyword = Model_Keyword::find($id))
		{
			$keyword->delete();

			Session::set_flash('success', 'Deleted keyword #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete keyword #'.$id);
		}

		Response::redirect('keyword');

	}

}
