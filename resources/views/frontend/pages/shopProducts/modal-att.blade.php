<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-show-att">
    Xem thuộc tính
</button>

<div class="modal fade" id="modal-show-att" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col"></th>
                        @foreach($listAtt as $att)
                            <th scope="col">{{ $att->name }}</th>
                        @endforeach
                        <th scope="col">Giá gốc</th>
                        <th scope="col">Giá khuyến mại</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $listKeys = array_keys($listAtt);
                    @endphp
                    @if (sizeof($listKeys) > 2)
                        @foreach ($listProperties[$listKeys[0]] as $num1)
                            @foreach ($listProperties[$listKeys[1]] as $num2)
                                    @php
                                        $pr1 = \App\Models\Properties::where('id', $num1)->first(['id', 'name']);
                                        $pr2 = \App\Models\Properties::where('id', $num2)->first(['id', 'name']);
                                    @endphp
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td>{{ $pr1->name }}</td>
                                        <td>{{ $pr2->name }}</td>
                                        <td>1</td>
                                        <td>1</td>
                                    </tr>
                            @endforeach
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
