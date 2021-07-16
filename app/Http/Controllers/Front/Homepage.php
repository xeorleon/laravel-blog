<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Config;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Page;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
class Homepage extends Controller
{
    public function __construct()
    {
        if(Config::find(1)->active == 0){
            return redirect()->to('site-bakimda')->send();
        }
        view()->share('pages', Page::whereStatus(1)->orderBy('order', 'ASC')->get());
        view()->share('categories', Category::whereStatus(1)->inRandomOrder()->get());
    }

    public function index()
    {

        $data['articles'] = Article::with('getCategory')->whereStatus(1)->whereHas('getCategory', function (Builder $query){
            $query->whereStatus(1);
        })->orderBy('created_at', 'DESC')->paginate(10);
        $data['articles']->withPath(url('sayfa'));
        return view('front.homepage', $data);
    }

    public function single($category, $slug)
    {
        $category = Category::whereSlug($category)->whereStatus(1)->first() ?? abort(403, 'Boyle bir kategori bulunamadi');
        $article = Article::whereSlug($slug)->whereStatus(1)->whereCategoryId($category->id)->first() ?? abort(403, 'Böyle bir yazi bulunamadi');
        $data['article'] = $article;
        $article->increment('hit');
        return view('front.single', $data);
    }

    public function category($slug)
    {
        $category = Category::whereSlug($slug)->whereStatus(1)->first() ?? abort(403, 'Boyle bir kategori bulunamadi');
        $data['articles'] = Article::where('category_id', $category->id)->whereStatus(1)->orderBy('created_at', 'DESC')->paginate(1);
        $data['category'] = $category;
        return view('front.category', $data);
    }

    public function page($slug)
    {
        $page = Page::whereSlug($slug)->whereStatus(1)->first() ?? abort(403, 'Boyle bir sayfa bulunamadı.');
        $data['page'] = $page;

        return view('front.page', $data);
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function contactpost(Request $request)
    {
        $rules = [
            'name' => 'required|min:5',
            'email' => 'required|email',
            'topic' => 'required',
            'message' => 'required|min:10'
        ];
        $validate = Validator::make($request->post(), $rules);
        if ($validate->fails()) {
            print_r($validate->errors()->first('message'));
            return redirect()->route('contact')->withErrors($validate)->withInput();
        }
        //Ornek SMTP mail gonderisi .env dosyasindan SMTP Mail ayarlarını yap.
        Mail::send([],[], function ($message) use($request){
                $message->from('iletisim@laravelblog.com', 'Laravel Blog');
                $message->to('blog@gmail.com');
                $message->subject($request->name . " iletişimden mesaj gönderdi");
                $message->setbody('Mesajı Gönderen : ' . $request->name . '<br> Mesajı Gönderen Mail : '
                    .$request->email.'<br/>'.'Mesaj Konusu : '
                    .$request->topic.'<br/>'.'Mesaj : '.$request->message.'<br/><br/>'
                    .'Mesaj Gönderilme Tarihi : '.now().'','text/html');
        });
        //Veri Tabanına Kayıt Kısmı
        //$contact = new Contact;
        //$contact->name= $request->name;
        //$contact->email =$request->mail;
        //$contact->topic= $request->topic;
        //$contact->message= $request->message;
        //$contact->save();
        return redirect()->route('contact')->with('success', 'Mesajınız bize iletildi. Teşekkür ederiz!');
    }
}
