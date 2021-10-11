<?php

namespace App\Http\Controllers;

use App\Http\Resources\articleResource;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("index");
    }

    public function getArticles()
    {
        $articles = Article::get()->all();
        foreach($articles as $article){
            $subjects = [];
            foreach($article->tags as $tag){
                array_push($subjects, $tag->subject);
            }
            $article->tags = $subjects;
        }
        return $articles;
    }

    public function getArticleInfo(Article $article)
    {
        return [
            "article" => $article,
            "comments" => $article->comments->load("replies")
        ];
    }

    public function postComment(Request $request)
    {

        $comment = Comment::create([
            "username" => $request->name,
            "body" => $request->body,
            "article_id" => $request->articleId
        ]);

        $comment->save();

        return $comment->load("replies");
    }

    public function postReply(Request $request)
    {

        $reply = Reply::create([
            "username" => $request->name,
            "body" => $request->body,
            "comment_id" => $request->commentId
        ]);

        $reply->save();

        return $reply;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        // $tags = Tag::all();
        // foreach($request->tags as $tag){
        //     dd($tag);
        // }

        $article = Article::create([
            "title" => $request->title,
            "description" => $request->description,
            "body" => $request->body,
            "imageUrl" => $request->imageUrl,
            "pepe" => $request->body
        ]);

        dd($article->pepe);
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
