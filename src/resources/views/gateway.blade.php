<style>
    .section {
        width: 50%;
        max-width: 400px;
        padding: 20px;
        text-align: center;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>

<div>

    <div class="section">
        <h1>
            {{number_format($order->total)}}
            Toman
        </h1>

        <p>Do you sure for purchase this item?</p>

        <br>
        <hr>
        <br>

        <div style="display: flex; justify-content: center">
            <form action="{{config('app.website') . "/api/order/$order->id/verify"}}" method="post">
                <button type="submit">cancel</button>
            </form>

            <form action="{{config('app.website') . "/api/order/$order->id/verify"}}" method="post" style="margin-left: 25px">
                <input type="hidden" hidden value="{{$order->id}}" name="fake_gateway">
                <button type="submit">confirm</button>
            </form>
        </div>
    </div>
</div>
