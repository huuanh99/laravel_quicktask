<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Login V19</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->

    <link rel="stylesheet" type="text/css"
        href="{{ asset('resources/css/util.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('resources/css/main.css') }}">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
                <form class="login100-form validate-form" method="POST" action="{{ route('editNote') }}">
                    @csrf
                    <span class="login100-form-title p-b-33">
                        {{ trans('message.edit') }}
                    </span>
                    <div class="wrap-input100 validate-input">
                        <input type="hidden" name="id" value="{{ $note->id }}">
                        <input class="input100" type="text" name="content"
                            value="{{ $note->content }}" required>
                        <span class="focus-input100-1"></span>
                        <span class="focus-input100-2"></span>
                    </div>
                    <div class="container-login100-form-btn m-t-20">
                        <input type="submit" value="OK" name="update" class="login100-form-btn">
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script src="js/main.js"></script>

</body>

</html>
