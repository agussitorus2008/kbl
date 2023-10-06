<table class="table table-hover border">
    <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Kode</th>
            <th scope="col">Besar Diskon</th>
            <th scope="col">Batas Penggunaan</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($coupons as $c)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$c->code}}</td>
                <td>{{$c->discount}}</td>
                <td>{{$c->limit}}</td>
                @if ($c->used == false)
                    <td class="text-warning">Belum Digunakan</td>
                @else
                    <td class="text-success">Sudah Digunakan</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
{{$coupons->links('components.pagination')}}