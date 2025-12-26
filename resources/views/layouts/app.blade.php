<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'إبراهيم حمزة - مطور ويب محترف | تطوير أنظمة ومواقع إلكترونية' }}</title>
    <meta name="description" content="{{ $description ?? 'مطور ويب محترف متخصص في تصميم وتطوير الأنظمة والمواقع الإلكترونية بأحدث التقنيات. خدمات شاملة تشمل تطوير أنظمة ويب، متاجر إلكترونية، تصميم UI/UX، وتطوير RESTful APIs.' }}">
    <meta name="keywords" content="تطوير ويب, مطور ويب, Laravel, React, تصميم مواقع, متاجر إلكترونية, PHP, UI/UX, APIs, قواعد البيانات">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#7E69AB">
    
    <meta property="og:title" content="إبراهيم حمزة - مطور ويب محترف">
    <meta property="og:description" content="تصميم وتطوير أنظمة ومواقع إلكترونية احترافية بأحدث التقنيات">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="ar_AR">
    
    <link rel="canonical" href="{{ url()->current() }}">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <div class="min-h-screen">
        {{ $slot }}
    </div>
    
    @livewireScripts
</body>
</html>

