<style>
    .pager {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .pager span {
        border: 1px solid #dee2e6;
        padding: 4px 8px;
        cursor: pointer;
    }

    .pg-goto {
        padding: 4px 8px;
        border-color: #dee2e6;
        color: #007bff;
    }

    .pg-normal {
        color: #0056b3;
        text-decoration: none;
        background-color: #e9ecef;
        border-color: #dee2e6;
    }

    .pg-selected {
        z-index: 1;
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }
</style>
<table class="table mt-3" id="tableUser">
    <tbody id="tbody-user">
    <tr>
        <th scope="col" class="cursor-pointer">#</th>
        <th scope="col" class="cursor-pointer">FullName</th>
        <th scope="col" class="cursor-pointer">Email</th>
        <th scope="col" class="cursor-pointer">Phone</th>
        <th scope="col" class="cursor-pointer">Company Name</th>
        <th scope="col" class="cursor-pointer">Member</th>
        <th scope="col" class="cursor-pointer">Category</th>
        <th scope="col" class="cursor-pointer">Region</th>
        <th scope="col" class="cursor-pointer">Status</th>
        <th scope="col" class="cursor-pointer">Action</th>
    </tr>
    @if(!$users->isEmpty())
        @foreach($users as $user)
            @php
                $memberPerson = \App\Models\MemberRegisterPersonSource::where('email', $user->email)
                    ->where('status', \App\Enums\MemberRegisterPersonSourceStatus::ACTIVE)
                    ->first();
                $company = null;
                if ($memberPerson){
                    $company = \App\Models\MemberRegisterInfo::find($memberPerson->member_id);
                }
            @endphp
            <tr>
                <td scope="row">
                    {{ $loop->index + 1 }}
                </td>
                <td>
                    {{$user->name}}
                </td>
                <td>
                    {{$user->email}}
                </td>
                <td>
                    {{$user->phone}}
                </td>
                <td>
                    @if($company)
                        {{ $company->name_en }}
                    @endif
                </td>
                <td>
                    {{$user->member}}
                </td>
                @php
                    $cateName = null;
                    if ($company){
                        $list_categories = \App\Models\Category::whereIn('id', explode(',', $company->category_id))
                        ->where('status', \App\Enums\CategoryStatus::ACTIVE)
                        ->get();
                        foreach ($list_categories as $item){
                            if ($cateName){
                                $cateName = $cateName .','. $item->name;
                            } else{
                                 $cateName = $item->name;
                            }
                        }
                    }
                @endphp
                <td>
                    {{ $cateName }}
                </td>
                <td>
                    {{$user->region}}
                </td>
                <td>
                    {{$user->status}}
                </td>
                <td>
                    <div class="d-flex align-items-center list-icon-action">
                        @if($company)
                            <a href="{{route('stand.register.member.index', $company->id)}}"
                               class="iconView">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                        @endif
                        <a href="{{route('admin.private.update.users', $user->id)}}"
                           class="iconDetail">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{route('admin.delete.users', $user->id)}}" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn iconDelete">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
<script>
    $('table#tableUser').each(function () {
        var $table = $(this);
        var itemsPerPage = 50;
        var currentPage = 0;
        var pages = Math.ceil($table.find("tr:not(:has(th))").length / itemsPerPage);
        $table.bind('repaginate', function () {
            if (pages > 1) {
                var pager;
                if ($table.next().hasClass("pager"))
                    pager = $table.next().empty(); else
                    pager = $('<div class="pager" style="padding-top: 20px; direction:ltr; " align="center"></div>');

                $('<button class="pg-goto"></button>').text(' « First ').bind('click', function () {
                    currentPage = 0;
                    $table.trigger('repaginate');
                }).appendTo(pager);

                $('<button class="pg-goto"> « Prev </button>').bind('click', function () {
                    if (currentPage > 0)
                        currentPage--;
                    $table.trigger('repaginate');
                }).appendTo(pager);

                var startPager = currentPage > 2 ? currentPage - 2 : 0;
                var endPager = startPager > 0 ? currentPage + 3 : 5;
                if (endPager > pages) {
                    endPager = pages;
                    startPager = pages - 5;
                    if (startPager < 0)
                        startPager = 0;
                }

                for (var page = startPager; page < endPager; page++) {
                    $('<span id="pg' + page + '" class="' + (page == currentPage ? 'pg-selected' : 'pg-normal') + '"></span>').text(page + 1).bind('click', {
                        newPage: page
                    }, function (event) {
                        currentPage = event.data['newPage'];
                        $table.trigger('repaginate');
                    }).appendTo(pager);
                }

                $('<button class="pg-goto"> Next » </button>').bind('click', function () {
                    if (currentPage < pages - 1)
                        currentPage++;
                    $table.trigger('repaginate');
                }).appendTo(pager);
                $('<button class="pg-goto"> Last » </button>').bind('click', function () {
                    currentPage = pages - 1;
                    $table.trigger('repaginate');
                }).appendTo(pager);

                if (!$table.next().hasClass("pager"))
                    pager.insertAfter($table);
            }

            $table.find(
                'tbody tr:not(:has(th))').hide().slice(currentPage * itemsPerPage, (currentPage + 1) * itemsPerPage).show();
        });

        $table.trigger('repaginate');
    });
</script>
