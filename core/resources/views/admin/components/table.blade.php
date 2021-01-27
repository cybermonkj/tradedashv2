<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<div class="table table-striped table-hover">
    <thead>
        <tr>
            {{-- <th scope="col">#</th> --}}
            <th scope="col">ID Number</th>
            <th scope="col">Coupon Code</th>
            <th scope="col">Status</th>
            <th scope="col">Date Created</th>
            <th scope="col">Date Updated</th>
        </tr>
    </thead>

    <tbody>
        @foreach($coupons as $coupon)
            <tr>
                <td>{{ $coupon->id }}</td>
                <td>{{ $coupon->coupon_code }}</td>
                <td>
                    @if ($coupon->is_used == true)
                        <span>Used</span>
                    @endif
                    @if($coupon->is_used == false)
                        <span>Not Used</span>
                    @endif
                </td>
                <td>{{ $coupon->created_at }}</td>
                <td>{{ $coupon->updated_at }}</td>
            </tr>
        @endforeach
    </tbody>
</div>