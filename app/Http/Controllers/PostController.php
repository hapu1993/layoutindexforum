<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Post;
use App\Tagpost;
use Auth;
use Response;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());

        // insert new post to table
        $post = new Post();
        $post->subject = $request->subject;
        $post->description = $request->description;
        $post->status = 1;
        $post->user_id = Auth::user()->id;
        $post->save();

        // insert tags into table
        foreach ($request->tags as $key => $tag) {
            // check tag already exit or not
            $exist_tags = Tag::where('name', 'like', '%' . $tag . '%')
            ->whereStatus(1)
            ->first();

            if (empty($exist_tags)) {
                $tag_table = new Tag();
                $tag_table->name = $tag;
                $tag_table->status = 1;
                $tag_table->save();

                $tagpost = new Tagpost();
                $tagpost->post_id = $post->id;
                $tagpost->tag_id = $tag_table->id;
                $tagpost->save();

            }
            else{
                $tagpost = new Tagpost();
                $tagpost->post_id = $post->id;
                $tagpost->tag_id = $exist_tags->id;
                $tagpost->save();
            }
            
        }
        return Response::json(['msg' => 'Post Submitted Successfully'], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::with('posttags','posttags.tags')->find($id);

        return $post;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // dd($request->all());
        $post = Post::find($id);
        $post->subject = $request->subject;
        $post->description = $request->description;
        $post->status = 0;
        $post->user_id = Auth::user()->id;
        $post->save();


        // get post tag 
        $posttags = Tagpost::where('post_id',$id);

        // tag deleting (make sure tag not tagging to another post)
        if (isset($posttags)) {
           foreach ($posttags as $key => $posttag) {
            if ($posttag->tags->getConnectedPostCount($id) == 0) {
                $posttag->tags->delete();
            }

        }
        $posttags->delete();
        }
        
        
         foreach ($request->tags as $key => $tag) {
            // check tag already exit or not
             $exist_tags = Tag::where('name', 'like', '%' . $tag . '%')
            ->whereStatus(1)
            ->first();


            if (empty($exist_tags)) {
                $tag_table = new Tag();
                $tag_table->name = $tag;
                $tag_table->status = 1;
                $tag_table->save();

                $tagpost = new Tagpost();
                $tagpost->post_id = $post->id;
                $tagpost->tag_id = $tag_table->id;
                $tagpost->save();

            }
            else{
                $tagpost = new Tagpost();
                $tagpost->post_id = $post->id;
                $tagpost->tag_id = $exist_tags->id;
                $tagpost->save();
            }
            
        }
        return Response::json(['msg' => 'Post Updated Successfully'], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);

        $post = Post::find($id);

        if (isset($post->posttags)) {
           foreach ($post->posttags as $key => $posttag) {
            if ($posttag->tags->getConnectedPostCount($id) == 0) {
                $posttag->tags->delete();
            }
            $posttag->delete();
        }

    }

    // $post->posttags->delete();
    $post->delete();
    return Response::json(['msg' => 'Post Deleted Successfully'], 200);
}

    public function getdatafortag()
    {
        $tags = Tag::get();
        $names = [];

        foreach ($tags as $key => $tag) {
            $names[] = $tag->name;
        }
        return json_encode($names);
    }
}
