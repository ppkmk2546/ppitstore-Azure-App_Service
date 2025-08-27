<div class="all-category">
    <h3 class="cat-heading"><i class="fa fa-bars" aria-hidden="true"></i>CATEGORIES</h3>
    <ul class="main-category">
        @foreach($categories as $category)
        <li {{count($category->subCategories) > 0 ? 'has-child-cate':''}}>
            <a href="{{route('product.category',['category_slug'=>$category->slug])}}">{{$category->name}}
                @if(count($category->subCategories) > 0)<i class="fa fa-angle-right" aria-hidden="true"></i>@endif
            </a>
            @if(count($category->subCategories) > 0)
                <ul class="sub-category">
                    @foreach($category->subCategories as $scategory)
                        <li><a href="{{route('product.category',['category_slug'=>$category->slug,'scategory_slug'=>$scategory->slug])}}">{{$scategory->name}}</a></li>
                    @endforeach
                </ul>
            @endif
        </li>
        @endforeach
    </ul>
</div>
