<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Apotek Alfina Rizqy')</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary: #A80505;
      --primary-dark: #6C0000;
      --soft-bg: #F8FAFC;
    }
    body { font-family: 'Poppins', sans-serif; }
    .no-scrollbar::-webkit-scrollbar {
      display: none;
    }
    .no-scrollbar {
      -ms-overflow-style: none;
      scrollbar-width: none;
    }
    #navbar, .product-card { transform: translateZ(0); }
    .clamp-12 {
      display: -webkit-box;
      -webkit-line-clamp: 12;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
  </style>

  <script src="{{ asset('/js/index.js') }}" defer></script>
  <script src="{{ asset('js/detail_product.js') }}" defer></script>
</head>

<body class="text-slate-800">

  @include('partials.navbar')

  <div class="h-20"></div>

  <main>
    @yield('content')
  </main>

  @include('partials.footer')

</body>
</html>
