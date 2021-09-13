<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul>
                    @foreach ($masterDocs as $key => $docs)
                    <li>{{ $docs->title }}: {{ round($results[$key] * 100) }}%</li>
                    @endforeach
                </ul>

                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead>
                            <th>Term</th>
                            @foreach ($masterDocs as $doc)
                            <th>{{ $doc->title  }} - TF IDF</th>
                            @endforeach
                        </thead>
                        <tbody>
                            @foreach ($words as $key => $word)
                            <tr>
                                <td>{{ $word }}</td>
                                @foreach ($samples as $sample)
                                <td>{{ $sample[$key] }}</td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Total</td>
                                @foreach ($samples as $sample)
                                @php
                                $total = 0;
                                @endphp
                                @foreach ($sample as $sam)
                                @php $total += $sam @endphp
                                @endforeach
                                <td>{{ $total }}</td>
                                @endforeach
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>

</body>

</html>
