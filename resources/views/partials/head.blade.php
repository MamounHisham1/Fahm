<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $title ?? config('app.name') }}</title>

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

@vite(['resources/css/app.css', 'resources/js/app.js'])

<script>
    // Force light mode only - disable dark mode entirely
    document.documentElement.classList.remove('dark');
    document.documentElement.classList.add('light');
    
    // Prevent dark mode from being applied
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    document.documentElement.classList.add('light');
                }
            }
        });
    });
    
    observer.observe(document.documentElement, {
        attributes: true,
        attributeFilter: ['class']
    });
    
    // Override Flux dark mode detection
    document.addEventListener('DOMContentLoaded', function() {
        if (window.Flux) {
            window.Flux.appearance = 'light';
            window.Flux.dark = false;
        }
        
        // Force remove dark class again after Flux loads
        setTimeout(() => {
            document.documentElement.classList.remove('dark');
            document.documentElement.classList.add('light');
        }, 100);
    });
</script>
