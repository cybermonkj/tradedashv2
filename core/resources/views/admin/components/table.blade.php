<style>
    .table__container {
        
    }

    .table__heading {
        
    }

    .table__main {
        width: 100%;
        
        display: grid;
        grid-template-columns: 1fr 2fr;
        grid-template-rows: repeat(1, fr);
        grid-template-areas: 
            "header content"
        ;
    }
    .table__header {
        
    }

    .table__row--header {
        display: flex;
        flex-direction: column;
    }

    .table__row--header th {
        grid-area: header;
        height: 4rem;
        width: 150px;
        /* width: calc(100% / 6); */
        /* border: 1px solid red; */

        display: flex;
        align-items: center;
        justify-content: flex-start;

        text-transform: capitalize;
    }

    .table__row--content {
        display: flex;
        flex-direction: column;
    }

    .table__row--content td {
        grid-area: content;
        height: 4rem;
        width: 16.67%;
        width: calc(100% / 6);
        
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    .table__body {
        width: 100%;
    }

    .table__data .d-grid button {
        margin-bottom: 2px;
    }

    @media only screen and (min-width: 768px) {
        .table__main {
            grid-template-columns: 1fr;
            grid-template-rows: repeat(2, 1fr);
            grid-template-areas: 
                "header"
                "content"
            ;
        }

        .table__row--header {
            flex-direction: row;
        }

        .table__row--header th {
            justify-content: space-evenly;

            width: 100%;
            height: 4rem;
        }

        .table__row--content {
            flex-direction: row;
            width: 100%; 
        }

        .table__row--content td {
            justify-content: center;
            width: 100%;
            height: 3rem;
        }
    }
</style>


<div class="table__container">
    
    <table class="table__main">
        <thead class="table__header">
            <tr class="table__row--header">
                <th class="fw-bold">ID Number</th>
                <th class="fw-bold">Coupon Code</th>
                <th class="fw-bold">Status</th>
                <th class="fw-bold">Date Created</th>
                <th class="fw-bold">Date Used</th>
                {{-- <th class="fw-bold">Actions</th> --}}
            </tr>
        </thead>

        <tbody class="table__body">
            @foreach($coupons as $coupon)
                <tr class="table__row--content">
                    <td class="table__data fw-normal">{{ $coupon->id }}</td>
                    <td class="table__data fw-normal">{{ $coupon->coupon_code }}</td>
                    <td class="table__data fw-normal">
                        @if ($coupon->is_used == true)
                            <span>Used</span>
                        @endif
                        @if($coupon->is_used == false)
                            <span>Not Used</span>
                        @endif
                    </td>
                    <td class="table__data fw-normal">{{ $coupon->created_at }}</td>
                    <td class="table__data fw-normal">{{ $coupon->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>