<div class="flex items-center hover:opacity-90 transition-opacity">
    <svg width="40" height="40" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg" class="hover:scale-105 transition-transform duration-200">
        <defs>
            <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" style="stop-color:#7367c2;stop-opacity:1" />
                <stop offset="100%" style="stop-color:#4b3f87;stop-opacity:1" />
            </linearGradient>
            <!-- Add subtle inner shadow -->
            <filter id="inner-shadow">
                <feOffset dx="0" dy="1" />
                <feGaussianBlur stdDeviation="1" result="offset-blur" />
                <feComposite operator="out" in="SourceGraphic" in2="offset-blur" result="inverse" />
                <feFlood flood-color="black" flood-opacity="0.2" result="color" />
                <feComposite operator="in" in="color" in2="inverse" result="shadow" />
                <feComposite operator="over" in="shadow" in2="SourceGraphic" />
            </filter>
        </defs>
        <rect width="40" height="40" rx="8" fill="url(#grad1)" filter="url(#inner-shadow)" />
        <!-- Centered Book Icon -->
        <g transform="translate(8, 8) scale(0.6)">
            <path d="M0,0 Q10,-12 20,0 Q30,-12 40,0" stroke="#44d3dc" stroke-width="3" fill="none" stroke-linecap="round"/>
            <path d="M0,0 L0,40 Q10,28 20,40 Q30,28 40,40 L40,0" stroke="#44d3dc" stroke-width="3" fill="none" stroke-linecap="round"/>
            <line x1="10" y1="8" x2="10" y2="32" stroke="#44d3dc" stroke-width="3" stroke-linecap="round"/>
            <line x1="30" y1="8" x2="30" y2="32" stroke="#44d3dc" stroke-width="3" stroke-linecap="round"/>
        </g>
    </svg>

    <div class="ms-2 grid flex-1 text-start hidden md:block">
        <span class="truncate leading-none font-semibold text-base">{{ config('app.name') }}</span>
    </div>
</div>
