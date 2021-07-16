@if(count($articles)>0)
    @foreach($articles as $article)
        <div class="post-preview">
            <a href="{{route('single',[$article->getCategory->slug,$article->slug])}}">
                <h4 class="post-title">{{$article->title}}</h4>
                <img class="img-fluid" src="{{asset($article->image)}}" style="height: 100%;width: 100%;"/>

                <h5 class="post-subtitle">{{strip_tags(str_limit($article->content,100))}}</h5>
            </a>
            <p class="post-meta d-flex align-items-center justify-content-between">
                    <span>Kategori <a href="#" class="badge bg-primary link-dark"
                                      style="text-decoration: none;">{{$article->getCategory->name}}</a></span>
                <span>{{$article->created_at->diffForHumans()}}</span>
            </p>
        </div>
        <!-- Divider-->
        @if(!$loop->last)
            <hr class="my-4"/>
        @endif
    @endforeach
    <div class="d-flex justify-content-center">{{$articles->links("pagination::bootstrap-4")}}</div>
@else
    <div class="alert alert-warning">Bu kategoriye ait henüz bir yazı eklenmedi.</div>

@endif
