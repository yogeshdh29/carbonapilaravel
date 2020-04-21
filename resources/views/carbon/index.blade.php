<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Carbon API</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            <main class="py-2">
                <div class="container">
                    <form action="/carbons" method="post" class="pb-5">
                    {{ csrf_field() }}
                    @foreach($errors->all() as $error)
                        <li>{{ $error }} </li>
                    @endforeach
                        <p>Activity:</p>
                        <div class="input-group pb-2">
                            <input type="number" name="activity" min="1" required="required">
                            {{ $errors->first('activity') }}
                        </div>
                        <p>Activity Type:</p>
                        <div class="input-group pb-2">
                                <select name="activities" id="activities" class="form-control" required>
                                    <option value="" >--SELECT--</option>
                                    @foreach($activitie as $act)
                                        <option value="{{ $act }}">{{ $act }}</option>
                                    @endforeach    
                                </select>
                        </div>
                        <p>Fuel Type:</p>
                        <div class="input-group pb-1">
                                <select name="fuels" id="fuels" class="form-control">
                                    <option value="" selected>--SELECT--</option>
                                    @foreach($fuel as $fue)
                                        <option value="{{ $fue }}">{{ $fue }}</option>
                                    @endforeach    
                                </select>
                        </div>
                        <p>Mode Of Transport:</p>
                        <div class="input-group pb-1">
                                <select name="modes" id="modes" class="form-control">
                                    <option value="" selected>--SELECT--</option>
                                    @foreach($mode as $mo)
                                        <option value="{{ $mo }}">{{ $mo }}</option>
                                    @endforeach    
                                </select>
                        </div>
                        <p>Country:</p>
                        <div class="input-group pb-4">
                                <select name="countries" id="countries" class="form-control" required>
                                    <option value="">--SELECT--</option>
                                    @foreach($country as $cou)
                                        <option value="{{ $cou }}">{{ $cou }}</option>
                                    @endforeach    
                                </select>
                        </div>
                        <div class="input-group pb-2" style="padding-top: 15px">
                            <button type="submit" class="btn btn-warning">Calculate</button>
                        </div>                                  
                    </form>

                </div>
            </main>        
        </div>
    </body>
</html>
