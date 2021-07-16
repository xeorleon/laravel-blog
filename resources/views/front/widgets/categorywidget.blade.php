@isset($categories)
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                Kategoriler
            </div>

            <ul class="list-group">
                @foreach($categories as $category)
                    <li class="list-group-item d-inline-flex justify-content-between align-items-center
                    @if(Request::segment(2) == $category->slug) active @endif">
                        <a  @if(Request::segment(2) != $category->slug) href="{{route('category', $category->slug)}}" @endif>{{$category->name}}</a>
                        <span class="badge bg-danger">{{$category->articleCount()}}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endisset
