<ul class="submenu dropdown-menu">
    @foreach($subcategories as $subcategory)
    <li>{{ $subcategory->name }}
        @if($subcategory->children->count() > 0)
            @include('frontend.categories.partials.subcategories', ['subcategories' => $subcategory->children])
        @endif
    </li>
    @endforeach
</ul>