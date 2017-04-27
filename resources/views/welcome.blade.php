<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
</head>
<body>

<div class="container">

    <div class="row">
        <div class="col-md-12">
            <table class="table" id="products">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Buy</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

</div><!-- /.container -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function(){
        var table = $('#products').DataTable({
            "ajax": "/api/products",
            "columns": [
                { "data": "id" },
                { "data": "name" },
                { "data": "price" }
            ],
            "columnDefs": [ {
                "targets": 3,
                "data": null,
                "defaultContent": "<button type='button' class='js-buy' data-product-id=''>Buy!</button>"
            }]
        });

        $('#products tbody').on('click', 'button', function () {
            var row = table.row($(this).parents('tr'));
            var data = row.data();
            $.ajax({
                url: '/api/products/' + data.id + '/buy',
                method: 'post',
                success: function () {
                    row.remove().draw();
                }
            });
        });
    });
</script>

</body>
</html>