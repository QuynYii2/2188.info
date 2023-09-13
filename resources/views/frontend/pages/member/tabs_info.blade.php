@php
    $listCategory = $company->category_id;
    $arrayCategory  = explode(',', $listCategory);
@endphp
<div class="row m-0">
    <div class="col-md-6 border">
        <div class="row">
            <div class="col-md-12 border" style="border-right: 1px solid white!important">
                <div class="mt-2">
                    <h5 class="mb-3">
                        {{ ($company->name) }}
                    </h5>
                </div>
            </div>
            <div class="row p-2">
                <div class="col-md-6">
                    <div class="mt-2">
                        <div class="mb-3 size"><b>{{ __('home.Company code') }}: </b> {{ ($company->code_business) }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mt-2">
                        <div class="mb-3 size"><b>{{ __('home.Elite enterprise') }}: </b> {{ ($company->member) }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mt-2">
                        <div class="mb-3 size"><b>{{ __('home.Membership classification') }}: </b> {{ ($company->member) }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mt-2">
                        <div class="mb-3 size"><b>{{ __('home.Customer rating score') }}: </b></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 border">
        <div class="row">
            <div class="col-md-12 border" style="border-left: 1px solid white!important">
                <div class="mt-2">
                    <h5 class="mb-3">{{ __('home.Specified products') }}</h5>
                </div>
            </div>
            @php
                $listCategory = $company->category_id;
                $arrayCategory = explode(',', $listCategory);
            @endphp
            <div class="col-12">
                <div class="row">
                    @foreach($arrayCategory as $itemArrayCategory)
                        @php
                            $category = \App\Models\Category::find($itemArrayCategory);
                        @endphp
                        <div class="col-md-6">
                            <div class="mt-2 d-flex">
                                <a href="{{route('category.show', $category->id)}}" class="mb-3 size">
                                    @if(locationHelper() == 'kr')
                                        {{ ($category->name_ko) }}
                                    @elseif(locationHelper() == 'cn')
                                        {{ ($category->name_zh) }}
                                    @elseif(locationHelper() == 'jp')
                                        {{ ($category->name_ja) }}
                                    @elseif(locationHelper() == 'vi')
                                        {{ ($category->name_vi) }}
                                    @else
                                        {{ ($category->name_en) }}
                                    @endif
                                    <i class="fa-solid fa-angle-right"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
