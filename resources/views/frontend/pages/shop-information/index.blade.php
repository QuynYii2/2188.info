<style>
    .shop-page__info {
        padding: 1.25rem 0;
        box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
    }

    .section-seller-overview-horizontal {
        display: flex;
        overflow: hidden;
    }

    .section-seller-overview-horizontal__leading {
        position: relative;
        width: 24.375rem;
        overflow: hidden;
        border-radius: .25rem;
        height: 8.4375rem;
    }

    .section-seller-overview-horizontal__seller-info-list {
        flex: 1;
        display: flex;
        flex-wrap: wrap;
        padding-left: 1.875rem;
        background-color: #fff;
        align-items: flex-start;
    }

    .section-seller-overview-horizontal__leading-background {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        background-position: 50%;
        background-size: cover;
        background-repeat: no-repeat;
        filter: blur(2px);
        margin: -4px;
        background-repeat-x: no-repeat;
        background-repeat-y: no-repeat;
    }

    .section-seller-overview-horizontal__leading-background-mask {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        background-color: rgba(0, 0, 0, .6);
    }

    .section-seller-overview-horizontal__leading-content {
        position: absolute;
        top: .625rem;
        left: 1.25rem;
        right: .875rem;
        bottom: .625rem;
    }

    .section-seller-overview__item {
        display: flex;
        align-items: center;
        padding: .625rem 0;
        flex: 1;
    }

    .section-seller-overview__item--clickable {
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    .section-seller-overview-horizontal .section-seller-overview__item {
        display: flex;
        padding-top: .625rem;
        padding-bottom: .625rem;
        flex: none;
        flex-basis: 30%;
        overflow: hidden;
    }

    .section-seller-overview-horizontal__seller-portrait {
        display: flex;
    }

    .section-seller-overview-horizontal__buttons {
        position: relative;
        display: flex;
        margin-top: .625rem;
    }

    .section-seller-overview__item-icon-wrapper {
        display: flex;
        align-items: center;
        box-sizing: border-box;
        margin-left: .625rem;
        margin-right: .625rem;
        font-size: .9375rem;
    }

    .section-seller-overview-horizontal .section-seller-overview__item div {
        display: inline-block;
    }

    .section-seller-overview__item-text {
        text-transform: capitalize;
        display: flex;
        align-items: center;
    }

    .section-seller-overview-horizontal__portrait-info {
        margin-top: .625rem;
        margin-left: .625rem;
        color: #fff;
        position: relative;
        overflow: hidden;
    }

    .section-seller-overview-horizontal__button {
        flex: 1;
        padding-right: .625rem;
    }

    .shopee-svg-icon {
        display: inline-block;
        width: 1em;
        height: 1em;
        fill: currentColor;
        position: relative;
    }

    svg:not(:root) {
        overflow: hidden;
    }

    .section-seller-overview-horizontal .section-seller-overview__item svg {
        stroke: #000;
    }

    .section-seller-overview__item-text-value {
        color: #ee4d2d;
    }

    .section-seller-overview__item-text-value {
        color: #d0011b;
    }

    .shopee-avatar {
        display: inline-block;
        width: 1.875rem;
        height: 1.875rem;
        position: relative;
        border-radius: 50%;
        border: .0625rem solid rgba(0, 0, 0, .09);
        box-sizing: border-box;
    }

    .UgJq78 .wEpezN {
        display: block;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
        height: 5rem;
        width: 5rem;
        box-sizing: border-box;
        border-width: .25rem;
        border-color: hsla(0, 0%, 100%, .4);
    }

    .section-seller-overview-horizontal__portrait-name {
        font-size: 1.25rem;
        line-height: 1.5rem;
        max-height: 3rem;
        font-weight: 500;
        margin-bottom: .3125rem;
        margin-top: 0;
        word-wrap: break-word;
        overflow: hidden;
        display: -webkit-box;
        text-overflow: ellipsis;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
    }

    .section-seller-overview-horizontal__portrait-status {
        font-size: .75rem;
    }

    .shopee-button-outline {
        outline: none;
        cursor: pointer;
        border: 1px solid rgb(255 255 255);
        font-size: .875rem;
        font-weight: 300;
        line-height: 0;
        letter-spacing: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color .1s cubic-bezier(.4, 0, .6, 1);
        border-radius: 2px;
        background: transparent;
        color: rgb(255 255 255);
    }

    .shopee-button-outline--fill {
        width: 100%;
        height: 100%;
        padding-top: 0;
        padding-bottom: 0;
    }

    .section-seller-overview-horizontal__button > .shopee-button-outline {
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        border-color: #fff;
        text-transform: uppercase;
        font-size: .75rem;
        font-weight: 500;
        padding: .3125rem 0;
        box-sizing: border-box;
    }

    .shopee-button-outline--complement:hover {
        color: #00bfa5;
        border-color: #00bfa5;
    }

    .section-seller-overview-horizontal__button > .shopee-button-outline:hover {
        color: #fff;
        border-color: #fff;
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .05);
    }

    .section-seller-overview-horizontal .section-seller-overview__inline-icon {
        vertical-align: top;
    }

    .section-seller-overview-horizontal .section-seller-overview__inline-icon--help {
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
        color: rgba(0, 0, 0, .54);
        margin-left: 3px;
    }

    .shopee-avatar__placeholder {
        width: 100%;
        position: relative;
        padding-top: 100%;
        background-color: #f5f5f5;
        border-radius: 50%;
        overflow: hidden;
    }

    img {
        border: 0;
    }

    .shopee-avatar__img {
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-radius: 50%;
    }

    .section-seller-overview-horizontal__active-time {
        vertical-align: middle;
        font-size: .75rem;
        color: hsla(0, 0%, 100%, .7);
        margin: .3125rem 0 .375rem;
    }

    .section-seller-overview-horizontal__icon {
        display: flex;
        align-items: center;
        justify-content: center;
        padding-right: .625rem;
        font-size: .9375rem;
    }

    .shopee-avatar__placeholder .icon-headshot {
        stroke: #c6c6c6;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 1.5rem;
        font-weight: 400;
        line-height: 2rem;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .section-seller-overview-horizontal__icon .icon-plus-sign {
        font-size: .625rem;
    }

    .productView-description {
        width: 100%;
    }
</style>
@extends('frontend.layouts.master')

@section('title', 'Information Shop')

@section('content')
    <div class="shop-page__info">
        <div class="section-seller-overview-horizontal container max-width">
            <div class="section-seller-overview-horizontal__leading row">
                <div class="section-seller-overview-horizontal__leading-background">
                </div>
                <div class="section-seller-overview-horizontal__leading-background-mask">
                </div>
                <div class="section-seller-overview-horizontal__leading-content">
                    <div class="section-seller-overview-horizontal__seller-portrait UgJq78">
                        <div class="shopee-avatar wEpezN">
                            <div class="shopee-avatar__placeholder">
                                <svg enable-background="new 0 0 15 15" viewBox="0 0 15 15" x="0" y="0"
                                     class="shopee-svg-icon icon-headshot">
                                    <g>
                                        <circle cx="7.5" cy="4.5" fill="none" r="3.8" stroke-miterlimit="10">
                                        </circle>
                                        <path d="m1.5 14.2c0-3.3 2.7-6 6-6s6 2.7 6 6" fill="none" stroke-linecap="round"
                                              stroke-miterlimit="10">
                                        </path>
                                    </g>
                                </svg>
                            </div>
                            <img class="shopee-avatar__img"
                                 src="https://down-ws-vn.img.susercontent.com/02cc55b581a1da07745c4e19070c0f16_tn">
                        </div>
                        <div class="section-seller-overview-horizontal__portrait-info">
                            <h1 class="section-seller-overview-horizontal__portrait-name">
                                {{ $sellerInfo->name ?? 'Shop Name'}}
                            </h1>
                            <div class="section-seller-overview-horizontal__portrait-status">
                                <div class="section-seller-overview-horizontal__active-time">
                                    {{ __('home.Online 4 minutes ago') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section-seller-overview-horizontal__buttons">
                        <a class="section-seller-overview-horizontal__button">
                            @if(Auth::check())
                                @if(Auth::user()->id == $id)
                                    <button disabled class="shopee-button-outline
                                    shopee-button-outline--complement
                                    shopee-button-outline--fill text-secondary">
                                  <span class="section-seller-overview-horizontal__icon">
                                    <svg enable-background="new 0 0 10 10" viewBox="0 0 10 10" x="0" y="0"
                                         class="shopee-svg-icon icon-plus-sign">
                                      <polygon
                                              points="10 4.5 5.5 4.5 5.5 0 4.5 0 4.5 4.5 0 4.5 0 5.5 4.5 5.5 4.5 10 5.5 10 5.5 5.5 10 5.5">
                                      </polygon>
                                    </svg>
                                  </span>
                                        {{ __('home.Follow') }}
                                    </button>
                                @else
                                    @php
                                        $companyPersonFollow = \App\Models\MemberRegisterPersonSource::where('email', Auth::user()->email)->first();
                                        $companyPersonSource = \App\Models\MemberRegisterPersonSource::where('email', $user->email)->first();
                                        $followed = null;
                                        $companySource = null;
                                        $companyFollow = null;
                                        if ($companyPersonFollow && $companyPersonSource){
                                               $companyFollow = \App\Models\MemberRegisterInfo::find($companyPersonFollow->member_id);
                                               $companySource = \App\Models\MemberRegisterInfo::find($companyPersonSource->member_id);
                                             $followed = \App\Models\MemberPartner::where([
                                                ['company_id_follow', $companyFollow->id],
                                                ['company_id_source', $companySource->id],
                                                ['status', \App\Enums\MemberPartnerStatus::ACTIVE]
                                            ])->first();
                                        }
                                    @endphp
                                    @if($companySource)
                                        @if(!$followed)
                                            <form action="{{route('stands.register.member')}}" method="post">
                                                @csrf
                                                <input type="text" name="company_id_source"
                                                       value="{{$companySource->id}} "
                                                       hidden>
                                                <button type="submit" class="shopee-button-outline
                                                shopee-button-outline--complement
                                                shopee-button-outline--fill">
                                                <span class="section-seller-overview-horizontal__icon">
                                                <svg enable-background="new 0 0 10 10" viewBox="0 0 10 10" x="0" y="0"
                                                     class="shopee-svg-icon icon-plus-sign">
                                                  <polygon
                                                          points="10 4.5 5.5 4.5 5.5 0 4.5 0 4.5 4.5 0 4.5 0 5.5 4.5 5.5 4.5 10 5.5 10 5.5 5.5 10 5.5">
                                                  </polygon>
                                                </svg>
                                              </span>
                                                    {{ __('home.Follow') }}
                                                </button>
                                            </form>
                                        @else
                                            <form method="post"
                                                  action="{{ route('stands.unregister.member', $companySource->id) }}">
                                                @csrf
                                                <input type="text" name="company_id_source"
                                                       value="{{$companySource->id}} "
                                                       hidden>
                                                <button type="submit" class="shopee-button-outline
                                                shopee-button-outline--complement
                                                shopee-button-outline--fill">
                                                <span class="section-seller-overview-horizontal__icon">
                                                <svg enable-background="new 0 0 10 10" viewBox="0 0 10 10" x="0" y="0"
                                                     class="shopee-svg-icon icon-plus-sign">
                                                  <polygon
                                                          points="10 4.5 5.5 4.5 5.5 0 4.5 0 4.5 4.5 0 4.5 0 5.5 4.5 5.5 4.5 10 5.5 10 5.5 5.5 10 5.5">
                                                  </polygon>
                                                </svg>
                                              </span>
                                                    {{ __('home.Unfollow') }}
                                                </button>
                                            </form>
                                        @endif
                                    @endif
                                @endif
                            @endif

                        </a>
                        <a href="{{route('chat.message.show')}}" class="section-seller-overview-horizontal__button">
                            <button class="shopee-button-outline shopee-button-outline--complement shopee-button-outline--fill">
                                  <span class="section-seller-overview-horizontal__icon">
                                    <svg viewBox="0 0 16 16" class="shopee-svg-icon">
                                      <g fill-rule="evenodd">
                                        <path d="M15 4a1 1 0 01.993.883L16 5v9.932a.5.5 0 01-.82.385l-2.061-1.718-8.199.001a1 1 0 01-.98-.8l-.016-.117-.108-1.284 8.058.001a2 2 0 001.976-1.692l.018-.155L14.293 4H15zm-2.48-4a1 1 0 011 1l-.003.077-.646 8.4a1 1 0 01-.997.923l-8.994-.001-2.06 1.718a.5.5 0 01-.233.108l-.087.007a.5.5 0 01-.492-.41L0 11.732V1a1 1 0 011-1h11.52zM3.646 4.246a.5.5 0 000 .708c.305.304.694.526 1.146.682A4.936 4.936 0 006.4 5.9c.464 0 1.02-.062 1.608-.264.452-.156.841-.378 1.146-.682a.5.5 0 10-.708-.708c-.185.186-.445.335-.764.444a4.004 4.004 0 01-2.564 0c-.319-.11-.579-.258-.764-.444a.5.5 0 00-.708 0z">
                                        </path>
                                      </g>
                                    </svg>
                                  </span>
                                {{ __('home.chat') }}
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="section-seller-overview-horizontal__seller-info-list">
                <div class="section-seller-overview__item section-seller-overview__item--clickable">
                    <div class="section-seller-overview__item-icon-wrapper">
                        <svg enable-background="new 0 0 15 15" viewBox="0 0 15 15" x="0" y="0" stroke-width="0"
                             class="shopee-svg-icon">
                            <path d="m13 1.9c-.2-.5-.8-1-1.4-1h-8.4c-.6.1-1.2.5-1.4 1l-1.4 4.3c0 .8.3 1.6.9 2.1v4.8c0 .6.5 1 1.1 1h10.2c.6 0 1.1-.5 1.1-1v-4.6c.6-.4.9-1.2.9-2.3zm-11.4 3.4 1-3c .1-.2.4-.4.6-.4h8.3c.3 0 .5.2.6.4l1 3zm .6 3.5h.4c.7 0 1.4-.3 1.8-.8.4.5.9.8 1.5.8.7 0 1.3-.5 1.5-.8.2.3.8.8 1.5.8.6 0 1.1-.3 1.5-.8.4.5 1.1.8 1.7.8h.4v3.9c0 .1 0 .2-.1.3s-.2.1-.3.1h-9.5c-.1 0-.2 0-.3-.1s-.1-.2-.1-.3zm8.8-1.7h-1v .1s0 .3-.2.6c-.2.1-.5.2-.9.2-.3 0-.6-.1-.8-.3-.2-.3-.2-.6-.2-.6v-.1h-1v .1s0 .3-.2.5c-.2.3-.5.4-.8.4-1 0-1-.8-1-.8h-1c0 .8-.7.8-1.3.8s-1.1-1-1.2-1.7h12.1c0 .2-.1.9-.5 1.4-.2.2-.5.3-.8.3-1.2 0-1.2-.8-1.2-.9z">
                            </path>
                        </svg>
                    </div>
                    <div class="section-seller-overview__item-text">
                        <div class="section-seller-overview__item-text-name">
                            {{ __('home.Product Name') }}:&nbsp;
                        </div>
                        <div class="section-seller-overview__item-text-value">
                            {{ ($countProductBySeller->countProduct) }}
                        </div>
                    </div>
                </div>
                <div class="section-seller-overview__item section-seller-overview__item--clickable">
                    <div class="section-seller-overview__item-icon-wrapper">
                        <svg enable-background="new 0 0 15 15" viewBox="0 0 15 15" x="0" y="0"
                             class="shopee-svg-icon icon-rating">
                            <polygon fill="none"
                                     points="7.5 .8 9.7 5.4 14.5 5.9 10.7 9.1 11.8 14.2 7.5 11.6 3.2 14.2 4.3 9.1 .5 5.9 5.3 5.4"
                                     stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
                            </polygon>
                        </svg>
                    </div>
                    <div class="section-seller-overview__item-text">
                        <div class="section-seller-overview__item-text-name">
                            {{ __('home.review') }}:&nbsp;
                        </div>
                        <div class="section-seller-overview__item-text-value">
                            {{ $averageRatingsFormatted }}({{ $totalRatings }})
                        </div>
                    </div>
                </div>
                <div class="section-seller-overview__item">
                    <div class="section-seller-overview__item-text">
                        <div class="section-seller-overview__item-icon-wrapper">
                            <svg enable-background="new 0 0 15 15" viewBox="0 0 15 15" x="0" y="0"
                                 class="shopee-svg-icon icon-rating">
                                <polygon fill="none"
                                         points="7.5 .8 9.7 5.4 14.5 5.9 10.7 9.1 11.8 14.2 7.5 11.6 3.2 14.2 4.3 9.1 .5 5.9 5.3 5.4"
                                         stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
                                </polygon>
                            </svg>
                        </div>
                        <div class="section-seller-overview__item-text-name">
                            {{ __('home.Chat response rate') }}:&nbsp;
                        </div>
                        <div class="section-seller-overview__item-text-value">
                            {{ __('home.99% (within hours)') }}
                            <div class="section-seller-overview__inline-icon section-seller-overview__inline-icon--help">
                                <svg width="10" height="10">
                                    <g fill="currentColor" fill-rule="nonzero" color="currentColor" stroke-width="0">
                                        <path d="M5 10A5 5 0 1 1 5 0a5 5 0 0 1 0 10zM5 .675a4.325 4.325 0 1 0 0 8.65 4.325 4.325 0 0 0 0-8.65z">
                                        </path>
                                        <path d="M6.235 5.073c.334-.335.519-.79.514-1.264a1.715 1.715 0 0 0-.14-.684 1.814 1.814 0 0 0-.933-.951A1.623 1.623 0 0 0 5 2.03a1.66 1.66 0 0 0-.676.14 1.772 1.772 0 0 0-.934.948c-.093.219-.14.454-.138.691a.381.381 0 0 0 .106.276c.07.073.168.113.27.11a.37.37 0 0 0 .348-.235c.02-.047.031-.099.03-.15a1.006 1.006 0 0 1 .607-.933.954.954 0 0 1 .772.002 1.032 1.032 0 0 1 .61.93c.003.267-.1.525-.288.716l-.567.537c-.343.35-.514.746-.514 1.187a.37.37 0 0 0 .379.382c.1.002.195-.037.265-.108a.375.375 0 0 0 .106-.274c0-.232.097-.446.29-.642l.568-.534zM5 6.927a.491.491 0 0 0-.363.152.53.53 0 0 0 0 .74.508.508 0 0 0 .726 0 .53.53 0 0 0 0-.74A.491.491 0 0 0 5 6.927z">
                                        </path>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section-seller-overview__item">
                    <div class="section-seller-overview__item-icon-wrapper">
                        <svg enable-background="new 0 0 15 15" viewBox="0 0 15 15" x="0" y="0" class="shopee-svg-icon">
                            <g>
                                <circle cx="6.8" cy="4.2" fill="none" r="3.8" stroke-miterlimit="10">
                                </circle>
                                <polyline fill="none" points="9.2 12.5 11.2 14.5 14.2 11" stroke-linecap="round"
                                          stroke-linejoin="round" stroke-miterlimit="10">
                                </polyline>
                                <path d="m .8 14c0-3.3 2.7-6 6-6 2.1 0 3.9 1 5 2.6" fill="none" stroke-linecap="round"
                                      stroke-miterlimit="10">
                                </path>
                            </g>
                        </svg>
                    </div>
                    <div class="section-seller-overview__item-text">
                        <div class="section-seller-overview__item-text-name">
                            {{ __('home.join') }}:&nbsp;
                        </div>
                        <div class="section-seller-overview__item-text-value">
                            {{ __('home.6 years ago') }}
                        </div>
                    </div>
                </div>
                <div class="section-seller-overview__item">
                    <div class="section-seller-overview__item-icon-wrapper">
                        <svg enable-background="new 0 0 15 15" viewBox="0 0 15 15" x="0" y="0" class="shopee-svg-icon">
                            <g>
                                <circle cx="6.8" cy="4.2" fill="none" r="3.8" stroke-miterlimit="10">
                                </circle>
                                <polyline fill="none" points="9.2 12.5 11.2 14.5 14.2 11" stroke-linecap="round"
                                          stroke-linejoin="round" stroke-miterlimit="10">
                                </polyline>
                                <path d="m .8 14c0-3.3 2.7-6 6-6 2.1 0 3.9 1 5 2.6" fill="none" stroke-linecap="round"
                                      stroke-miterlimit="10">
                                </path>
                            </g>
                        </svg>
                    </div>
                    <div class="section-seller-overview__item-text">
                        <div class="section-seller-overview__item-text-name">
                            {{ __('home.Người theo dõi') }}:&nbsp;
                        </div>
                        <div class="section-seller-overview__item-text-value">
                            @php
                                $member_partners = null;
                                $member_partners = \App\Models\MemberPartner::where([
                                    ['company_id_source','=',$company->id],
                                    ['status', \App\Enums\MemberPartnerStatus::ACTIVE]
                                    ])->get()
                            @endphp
                            @if(!$member_partners)
                                0
                            @else
                                {{$member_partners->count()}}
                            @endif

                        </div>
                    </div>
                </div>
                <div class="section-seller-overview__item">
                    <div class="section-seller-overview__item-icon-wrapper">
                        <svg enable-background="new 0 0 15 15" viewBox="0 0 15 15" x="0" y="0" class="shopee-svg-icon">
                            <g>
                                <circle cx="6.8" cy="4.2" fill="none" r="3.8" stroke-miterlimit="10">
                                </circle>
                                <polyline fill="none" points="9.2 12.5 11.2 14.5 14.2 11" stroke-linecap="round"
                                          stroke-linejoin="round" stroke-miterlimit="10">
                                </polyline>
                                <path d="m .8 14c0-3.3 2.7-6 6-6 2.1 0 3.9 1 5 2.6" fill="none" stroke-linecap="round"
                                      stroke-miterlimit="10">
                                </path>
                            </g>
                        </svg>
                    </div>

                    <div class="section-seller-overview__item-text">
                        <div class="section-seller-overview__item-text-name">
                            {{ __('home.join') }}:&nbsp;
                        </div>
                        <div class="section-seller-overview__item-text-value">
                            @if(!$shopInformation)
                                0
                            @else
                                {{$shopInformation->industry_year}} {{ __('home.Năm trong ngành') }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="container-fluid">
            <div class="row">

                <div class="productView-description">
                    <div class="tab-content container-fluid" id="myTabContent">
                        <div class="tab-pane fade show active" id="product" role="tabpanel"
                             aria-labelledby="profile-tab">
                            @include('frontend.pages.shop-information.product-member')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        var more = "{{ __('home.Show More') }}";
        var less = "{{ __('home.Show Less') }}";
    </script>
    <script src="{{asset('js/frontend/pages/shop-infomation/index.js')}}"></script>
@endsection
