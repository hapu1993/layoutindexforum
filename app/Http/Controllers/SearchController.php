<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;

class SearchController extends Controller
{
    //
	public function getData()
	{
		$search_tag = $_GET['tag'];
		$search_key_word = $_GET['key_word'];

		$posts = Post::whereStatus(1);
		$tags = Tag::get();
		if(isset($search_tag) && !empty($search_tag)){
			$posts =$posts->whereHas('posttags', function ($query) use ($search_tag){
				$query->whereHas('tags', function ($query) use ($search_tag){
					$query->where('name', $search_tag);
				});	
			});	
		}
		
		if(isset($search_key_word) && !empty($search_key_word)){
				// dd('Hello');
			$posts =$posts->Where('subject', 'like', '%' . $search_key_word . '%')
			->orWhere('description', 'like', '%' . $search_key_word . '%')
			->orwhereHas('posttags', function ($query) use ($search_key_word){
				$query->whereHas('tags', function ($query) use ($search_key_word){
					$query->where('name', $search_key_word);
				});	
			});	

		 }
		 $posts = $posts->get();




		return view('search-result',compact('posts','tags'));
	}
}
