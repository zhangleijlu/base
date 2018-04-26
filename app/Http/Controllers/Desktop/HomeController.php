<?php

namespace App\Http\Controllers\Desktop;

use Illuminate\Http\Request;

use Crypt;
use Auth;
use App\Jobs\ChangeLocale;
use Douyasi\Models\Article;
use Douyasi\Models\ArticleDate;
use Douyasi\Models\Category;
use Douyasi\Models\ArticlesUser;

class HomeController extends FrontController
{

    /**
     * 博客首页
     */
    public function getIndex()
    {
       // ArticleDate::setTable(date("Ym"));
    //    $ol_darticles = Article::orderBy('created_at', 'desc')->simplePaginate(3); var_dump($ol_darticles);
        $articel = new ArticleDate();
        $articel->setTable( date("Ym") );
        $articles = $articel->orderBy('created_at', 'desc')->simplePaginate(3);
        return view('desktop.index', compact('articles'));
    }

    /**
     * 博客文章
     */
    public function getArticle( $cslug,$slug)
    {
        $category = Category::where('slug', '=', $cslug)->first();
        $articleModel = new Article();
        $articleModel->setTable($slug);
        if ($category) {
            $article =
                $articleModel->where('slug', '=', $slug)->first();
            if ($article) {
                return view('desktop.detail', compact('article', 'category'));
            } else {
                return abort(404);
            }
        } else {
            return abort(404);
        }
    }

    /**
     * 博客分类
     */
    public function getCategory($slug)
    {
        $category = Category::where('slug', '=', $slug)->first();
        if ($category) {
            $query = Article::where('cid', '=', $category->id)
                            ->orderBy('created_at', 'desc');
            $count = $query->count();
            $articles = $query->simplePaginate(6);
            return view('desktop.category', compact('articles', 'category', 'count'));
        } else {
            return abort(404);
        }
    }

    /**
     * 博客分类
     */
    public function getUser($uid)
    {
        $user = Users::where('id', '=', $uid)->first();
        $ArticlesUser = new ArticlesUser();
        if ($user) {
            $ArticlesUser->setTable($uid);
            $query = $ArticlesUser->where('uid', '=', $uid)
                ->orderBy('created_at', 'desc');
            $count = $query->count();
            $articles = $query->simplePaginate(6);
            return view('desktop.category', compact('articles', 'category', 'count'));
        } else {
            return abort(404);
        }
    }

    /**
     * YASCMF landing page
     */
    public function getLandingPage()
    {
        return view('desktop.landing-page');
    }

    /**
     * Change Language
     */
    public function getLang(ChangeLocale $changeLocale)
    {
        $this->dispatch($changeLocale);

        return redirect()->back();
    }

}
