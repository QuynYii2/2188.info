<ul class="submenu dropdown-menu" style="position: relative; margin-top: -36px; border: none; padding-left: 10px">

    @php

    @endphp
    @foreach($subcategories as $subcategory)
    <li>{{ ($subcategory->name) }}
        @if($subcategory->children->count() > 0)
            @include('frontend.layouts.partials.subcategories', ['subcategories' => $subcategory->children])
        @endif
    </li>
    @endforeach
</ul>