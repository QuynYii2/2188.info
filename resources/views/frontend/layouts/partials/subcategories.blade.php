<ul class="submenu dropdown-menu">
    @foreach($subcategories as $subcategory)
    <li>{{ $subcategory->name }}
        @if($subcategory->children->count() > 0)
            @include('frontend.layouts.partials.subcategories', ['subcategories' => $subcategory->children])
        @endif
    </li>
    @endforeach
</ul>