@props([
    'page' => null,
    'availablePages' => collect(),
    'content' => '',
    'headings' => collect(),
    'breadcrumbs' => collect(),
    'showBreadcrumbs' => true,
    'showPagesList' => true,
    'showPageLinks' => false,
    'showQuickLinks' => true,
    'currentPage' => null,
    'class' => '',
    'contentClass' => '',
    'sidebarClass' => '',
])

<!-- Breadcrumbs -->
@if($showBreadcrumbs && $breadcrumbs)
    <x-ui.breadcrumb :crumbs="$breadcrumbs" />
@endif

<div class="flex flex-col lg:flex-row gap-2 min-h-screen {{ $class }}">

    @if($showPagesList)
        <!-- Help Pages List View -->
        <div class="mt-2 w-full">
            <div class="prose-sm prose-slate dark:prose-invert">
                <h1 class="text-3xl font-bold text-blue-900 dark:text-blue-200 mb-6">Help & Documentation</h1>
                
                @if($availablePages->count() > 0)
                    @foreach($availablePages as $category => $categoryPages)
                        <div class="mb-8">
                            <!-- Category Header -->
                            <div class="mb-4 pb-2 border-b-2 border-blue-200 dark:border-blue-700">
                                <h2 class="text-xl font-bold text-blue-900 dark:text-blue-200 flex items-center">
                                    @if($category === 'General Documentation')
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                                        </svg>
                                    @endif
                                    {{ $category }}
                                    <span class="ml-2 text-sm font-normal text-gray-500 dark:text-gray-400">({{ $categoryPages->count() }} {{ Str::plural('page', $categoryPages->count()) }})</span>
                                </h2>
                            </div>
                            
                            <!-- Category Pages Grid -->
                            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                                @foreach($categoryPages as $helpPage)
                                    <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6 hover:shadow-md transition-shadow">
                                        <h3 class="text-lg font-semibold text-blue-900 dark:text-blue-200 mb-2">
                                            {{ $helpPage['title'] }}
                                        </h3>
                                        <a href="{{ route('help', ['page' => $helpPage['slug']]) }}" 
                                           class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium">
                                            Read more
                                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-12">
                        <div class="text-gray-500 dark:text-gray-400">
                            <h3 class="text-lg font-medium mb-2">No help pages found</h3>
                            <p>No help documentation is currently available.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @else
        <!-- Single Page Content View -->
        <article class="{{ $contentClass }}">
            {!! $content !!}
        </article>

        <!-- Sidebar -->
        @if($showPageLinks || $showQuickLinks)
            <aside class="{{ $sidebarClass }}" aria-label="HelpSidebar">
                
                <!-- Available Pages -->
                @if($showPageLinks && $availablePages->flatten()->count() > 1)
                    <div class="mb-6">
                        <span class="text-blue-900 dark:text-blue-200 font-bold">Help Pages</span>
                        <ul class="px-1 mt-2">
                            @foreach ($availablePages as $category => $categoryPages)
                                @if($availablePages->count() > 1)
                                    <li class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mt-3 mb-1">
                                        {{ $category }}
                                    </li>
                                @endif
                                @foreach($categoryPages as $helpPage)
                                    <li class="text-sm py-1 rounded hover:bg-gray-200 dark:text-slate-100 dark:hover:bg-gray-800 {{ $helpPage['slug'] === $currentPage ? 'bg-blue-100 dark:bg-blue-900 font-semibold' : '' }}">
                                        <a href="{{ route('help', ['page' => $helpPage['slug']]) }}">{{ $helpPage['title'] }}</a>
                                    </li>
                                @endforeach
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Quick Links (Table of Contents) -->
                @if($showQuickLinks && count($headings) > 0)
                    <div>
                        <span class="text-md text-blue-900 dark:text-blue-200 font-bold">Quick Links</span>
                        <ul class="px-1 mt-2">
                            @foreach ($headings as $heading)
                                @php
                                    $indent = match ($heading['tag']) {
                                        'h2' => 1,
                                        'h3' => 2,
                                        'h4' => 3,
                                        'h5' => 4,
                                        default => 1,
                                    };
                                    $css = $heading['tag'] === 'h2' ? 'font-bold' : '';
                                @endphp
                                <li class="text-sm ml-{{ $indent }} py-1 rounded hover:bg-gray-200 dark:text-slate-100 dark:hover:bg-gray-800 {{ $css }}">
                                    <a href="#{{ $heading['id'] }}">{{ $heading['text'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </aside>
        @endif
    @endif

</div>
