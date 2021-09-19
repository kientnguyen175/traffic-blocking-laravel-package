<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Traffic Blocking</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <style>
        .wrapper {
            height: 100vh;
            display: flex;
            align-items: center;
        }
        .select2-search__field {
            text-align: center;
            margin-left: 2.5px !important;
        }
        .select2-search__field:focus::placeholder {
            color: transparent;
        }
        .select2-container {
            width: 50% !important;
        }
        .select2-selection__choice {
            margin-left: 2.5px !important;
        }
        .size {
            width: 50%;
        }
        #key {
            border: 1px #aaaaaa solid;
            border-radius: 4px;
            padding: 5px;
            height: 32px;
        }
        #key:focus {
            outline: 0;
            border-color: #000000;
        }
        #key:focus::placeholder {
            color: inherit;
        }
        .error {
            color: #ff0000;
        }
        .success {
            color: #008000;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="card text-center"> 
                <div class="card-header">Blocked Countries</div>
                <div class="card-body">
                    <form action="{{ URL::route('megaads.traffic-blocking.update') }}" method="post">
                        <select id="blockedCountries" 
                            name="blockedCountries[]" 
                            multiple="multiple">
                            @foreach (Config::get('packages.megaads.traffic-blocking.countries.list') ?? Config::get('packages/megaads/traffic-blocking/countries.list') as $countryCode => $countryName)
                                <option value="{{ $countryCode }}"
                                    @if (in_array($countryCode, $blockedCountries))
                                        selected
                                    @endif
                                >{{ $countryName }}</option>
                            @endforeach
                        </select>
                        <br><br>
                        <input id="key"
                            class="size text-center"
                            type="password" 
                            name="key" 
                            placeholder="Type key"
                            onfocus="this.placeholder=''"
                            onblur="this.placeholder='Type key'"
                            required>
                        <div>
                            <small class="error">{{ Session::get('keyError') ? 'Incorrect Key!' : '' }}</small>
                            <small class="success">{{ Session::get('success') ? 'Successfully!' : '' }}</small>
                        </div>
                        <br>
                        <button class="btn btn-primary" type="submit">Save</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#blockedCountries').select2({
                placeholder: "Search and select countries",
            });
        });
    </script>
</body>
</html>
