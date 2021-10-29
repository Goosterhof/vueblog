<?php

namespace App\Http\Controllers;

use App\Http\Resources\articleResource;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * TODO :: unused method, can be removed
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("index");
    }

    public function getArticles()
    {
        // TODO :: no need to do get and all, cause they both get all.
        $articles = Article::get()->all();

        // TODO :: can use a resource here to make this cleaner
        foreach($articles as $article){
            $subjects = [];
            foreach($article->tags as $tag){
                array_push($subjects, $tag->subject);
            }
            $article->tags = $subjects;
        }
        return $articles;
    }

    public function getUserArticles(User $user)
    {
        // TODO :: can immediatly return the $articles
        $articles = Article::get()->where('author', $user->username);
        return $articles;
    }

    public function getArticleInfo(Article $article)
    {
        return [
            "article" => $article,
            "comments" => $article->comments->load("replies")
        ];
    }

    // TODO :: missing validation, can be done in a Form Request Validation: https://laravel.com/docs/8.x/validation#form-request-validation
    public function postComment(Request $request)
    {

        $comment = Comment::create([
            "username" => $request->name,
            "body" => $request->body,
            "article_id" => $request->articleId
        ]);

        // TODO :: no need to save, because you use create, which saves automatically
        $comment->save();

        return $comment->load("replies");
    }

    // TODO :: missing validation, can be done in a Form Request Validation: https://laravel.com/docs/8.x/validation#form-request-validation
    public function postReply(Request $request)
    {

        $reply = Reply::create([
            "username" => $request->name,
            "body" => $request->body,
            "comment_id" => $request->commentId
        ]);

        // TODO :: no need to save, because you use create, which saves automatically
        $reply->save();

        return $reply;

    }

    public function getTags(){
        // TODO :: no need to do get and all, cause they both get all.
        return Tag::get()->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        // TODO :: no need to do get and all, cause they both get all.
        $tags = Tag::get()->all();

        // TODO :: it's easier if you send the id's from the frontend to the backend, so you don't need to look them up
        $tagIds = [];
        foreach($request->tags as $subject){
            foreach($tags as $tag){
                if($subject == $tag->subject){
                    array_push($tagIds, $tag->id);
                }
            }
        }

        $article = Article::create([
            "author" => $request->author,
            "title" => $request->title,
            "description" => $request->description,
            "body" => $request->body,
            "imageUrl" => $request->imageUrl,
        ]);

        $article->tags()->sync($tagIds);

        // TODO :: no need to save, because you use create, which saves automatically
        $article->save();


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
