<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo __('strings.register') . ' - ' . __('strings.website') ?></title>
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
  <link rel="stylesheet" href="{{ asset('css/form.css') }}">
  <link rel="stylesheet" href="{{ asset('css/validations.css') }}">
  <link rel="stylesheet" href="{{ asset('css/header.css') }}">
  <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
  <link rel="stylesheet" href="{{ asset('css/success.css') }}">
  <link rel="stylesheet" href="{{ asset('css/toggle.css') }}">
</head>

<body>
    <x-header />
    <div class="wrapper">
        @yield('content')
    </div>
    <x-footer />
    <script>
        document.documentElement.setAttribute("theme", "dark");

        const toggle = document.querySelector("#toggle");
        const sunIcon = document.querySelector(".toggle .bxs-sun");
        const moonIcon = document.querySelector(".toggle .bx-moon");

        toggle.addEventListener("change", (e) => {
          if (e.target.checked) {
            document.documentElement.setAttribute("theme", "dark");
          } else {
            /* While page in dark mode and checkbox is
            checked then theme back to change light*/
            document.documentElement.setAttribute("theme", "light");
          }
        });
    </script>
</body>

</html>
