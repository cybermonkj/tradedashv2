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
        width: calc(100% / 6%);

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
        width: calc(100% / 6%);
        
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    .table__body {
        width: 100%;
    }

    .table__data {
        
    }

    @media screen and (min-width: 768px) {
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


<div class="tabl__container">
    <div class="table__heading">Codes</div>
    <table class="table__main">
        <thead class="table__header">
            <tr class="table__row--header">
                <th class="fw-bold">ID Number</th>
                <th class="fw-bold">Coupon Code</th>
                <th class="fw-bold">Status</th>
                <th class="fw-bold">Date Created</th>
                <th class="fw-bold">Date Updated</th>
                <th class="fw-bold">Actions</th>
            </tr>
        </thead>

        <tbody class="table__body">
            <tr class="table__row--content">
                <td class="table__data fw-normal">1</td>
                <td class="table__data fw-normal">7Ur83Gy4</td>
                <td class="table__data fw-normal">Sold</td>
                <td class="table__data fw-normal">Date</td>
                <td class="table__data fw-normal">Date</td>
                <td class="table__data fw-normal">
                    <div class="gap-2 d-grid">
                        <button type="button" class="btn btn-danger btn-sm">Delete</button>
                        <button type="button" class="btn btn-primary btn-sm">Update</button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>