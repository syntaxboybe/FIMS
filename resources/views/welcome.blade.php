<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'FIMS') }} - Farm Information Management System</title>

        <!-- Favicon -->
        @php
            $faviconUrl = \App\Helpers\SettingsHelper::getFavicon();
        @endphp
        @if ($faviconUrl)
            <link rel="icon" href="{{ $faviconUrl }}" type="image/x-icon">
            <link rel="shortcut icon" href="{{ $faviconUrl }}" type="image/x-icon">
        @endif

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=jetbrains-mono:400,500,600,700" rel="stylesheet" />
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <!-- CSS & JS -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        @endif

        <style>
            :root {
                /* Catppuccin Frappé colors */
                --rosewater: #f2d5cf;
                --flamingo: #eebebe;
                --pink: #f4b8e4;
                --mauve: #ca9ee6;
                --red: #e78284;
                --maroon: #ea999c;
                --peach: #ef9f76;
                --yellow: #e5c890;
                --green: #a6d189;
                --teal: #81c8be;
                --sky: #99d1db;
                --sapphire: #85c1dc;
                --blue: #8caaee;
                --lavender: #babbf1;
                --text: #c6d0f5;
                --subtext1: #b5bfe2;
                --subtext0: #a5adce;
                --overlay2: #949cbb;
                --overlay1: #838ba7;
                --overlay0: #737994;
                --surface2: #626880;
                --surface1: #51576d;
                --surface0: #414559;
                --base: #303446;
                --mantle: #292c3c;
                --crust: #232634;
            }

            body {
                font-family: 'JetBrains Mono', monospace;
                background-color: var(--base);
                color: var(--text);
            }

            .font-sans {
                font-family: 'Instrument Sans', sans-serif;
            }

            .font-mono {
                font-family: 'JetBrains Mono', monospace;
            }

            .terminal {
                background-color: var(--mantle);
                border-radius: 8px;
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
                overflow: hidden;
            }

            .terminal-header {
                background-color: var(--crust);
                padding: 0.5rem 1rem;
                display: flex;
                align-items: center;
                justify-content: space-between;
                border-top-left-radius: 8px;
                border-top-right-radius: 8px;
            }

            .terminal-controls {
                display: flex;
                gap: 8px;
            }

            .terminal-control {
                width: 12px;
                height: 12px;
                border-radius: 50%;
            }

            .terminal-control-close {
                background-color: var(--red);
            }

            .terminal-control-minimize {
                background-color: var(--yellow);
            }

            .terminal-control-maximize {
                background-color: var(--green);
            }

            .terminal-title {
                color: var(--subtext0);
                font-size: 0.85rem;
            }

            .terminal-content {
                padding: 1.5rem;
                overflow-y: auto;
                min-height: 300px;
            }

            .prompt {
                color: var(--green);
                margin-right: 0.5rem;
            }

            .cursor {
                display: inline-block;
                width: 8px;
                height: 18px;
                background-color: var(--text);
                animation: blink 1s step-end infinite;
                vertical-align: middle;
                margin-left: 2px;
            }

            @keyframes blink {
                0%, 100% { opacity: 1; }
                50% { opacity: 0; }
            }

            .command {
                margin-bottom: 1rem;
            }

            .command-input {
                display: flex;
                align-items: center;
                margin-bottom: 0.5rem;
            }

            .command-output {
                color: var(--subtext1);
                padding-left: 1.5rem;
                margin-bottom: 1rem;
                white-space: pre-wrap;
            }

            .highlight-blue {
                color: var(--blue);
            }

            .highlight-mauve {
                color: var(--mauve);
            }

            .highlight-green {
                color: var(--green);
            }

            .highlight-peach {
                color: var(--peach);
            }

            .highlight-teal {
                color: var(--teal);
            }

            .highlight-yellow {
                color: var(--yellow);
            }

            .highlight-red {
                color: var(--red);
            }

            .highlight-flamingo {
                color: var(--flamingo);
            }

            /* Feature cards */
            .feature-card {
                background-color: var(--surface0);
                border-radius: 8px;
                border: 1px solid var(--surface1);
                transition: all 0.3s ease;
            }

            .feature-card:hover {
                transform: translateY(-5px);
                border-color: var(--lavender);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            }

            /* Button styles */
            .btn {
                background-color: var(--surface1);
                color: var(--text);
                padding: 0.5rem 1rem;
                border-radius: 6px;
                transition: all 0.3s ease;
                font-weight: 500;
                border: 1px solid var(--surface2);
            }

            .btn:hover {
                background-color: var(--surface2);
            }

            .btn-primary {
                background-color: var(--blue);
                color: var(--crust);
                border: none;
            }

            .btn-primary:hover {
                background-color: var(--sapphire);
            }

            .btn-secondary {
                background-color: transparent;
                border: 1px solid var(--lavender);
                color: var(--lavender);
            }

            .btn-secondary:hover {
                background-color: rgba(186, 187, 241, 0.1);
            }

            .animated-text {
                overflow: hidden;
                border-right: 2px solid var(--green);
                white-space: nowrap;
                animation: typing 3.5s steps(40, end), blink-caret 0.75s step-end infinite;
            }

            @keyframes typing {
                from { width: 0 }
                to { width: 100% }
            }

            @keyframes blink-caret {
                from, to { border-color: transparent }
                50% { border-color: var(--green) }
            }

            /* Responsive design */
            @media (max-width: 768px) {
                .terminal {
                    margin: 1rem;
                }

                .command-output {
                    padding-left: 0.5rem;
                }
            }
        </style>
    </head>
    <body class="min-h-screen">
        <!-- Header/Nav -->
        <header class="bg-opacity-90 backdrop-filter backdrop-blur-lg fixed top-0 w-full z-50" style="background-color: var(--crust)">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center">
                            <span class="text-2xl font-bold highlight-green">FIMS</span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        @if (Route::has('login'))
                            <div class="hidden sm:flex sm:items-center sm:ml-6">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="text-sm highlight-blue hover:text-opacity-80 transition-colors duration-300">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="text-sm highlight-blue hover:text-opacity-80 transition-colors duration-300 px-4 py-2">Log in</a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="ml-4 text-sm btn btn-primary">Register</a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <section class="pt-24 pb-16 sm:pt-32 sm:pb-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:grid lg:grid-cols-2 lg:gap-8 items-center">
                    <div class="mb-10 lg:mb-0">
                        <h1 class="text-4xl sm:text-5xl font-bold font-sans leading-tight mb-4">
                            Farm <span class="highlight-blue">Information</span> Management <span class="highlight-green">System</span>
                        </h1>
                        <p class="text-lg mb-8" style="color: var(--subtext1)">
                            A comprehensive CLI-inspired solution for modern farm management.
                        </p>
                        <div class="flex flex-wrap gap-4">
                            <a href="{{ route('login') }}" class="btn btn-primary">
                                Get Started
                            </a>
                            <a href="#features" class="btn btn-secondary">
                                Learn More
                            </a>
                        </div>
                    </div>
                    <div class="relative lg:mt-0">
                        <div class="terminal">
                            <div class="terminal-header">
                                <div class="terminal-controls">
                                    <div class="terminal-control terminal-control-close"></div>
                                    <div class="terminal-control terminal-control-minimize"></div>
                                    <div class="terminal-control terminal-control-maximize"></div>
                                </div>
                                <div class="terminal-title">farm@fims:~</div>
                                <div class=""></div>
                            </div>
                            <div class="terminal-content">
                                <!-- Command 1 -->
                                <div class="command">
                                    <div class="command-input">
                                        <span class="prompt">farm@fims:~$</span>
                                        <span class="highlight-blue">./welcome.sh</span>
                                    </div>
                                    <div class="command-output">
<span class="highlight-green">Welcome to the Farm Information Management System!</span>
Version 1.0.0 - Running on Laravel {{ app()->version() }}
                                    </div>
                                </div>

                                <!-- Command 2 -->
                                <div class="command">
                                    <div class="command-input">
                                        <span class="prompt">farm@fims:~$</span>
                                        <span class="highlight-blue">fims --list-modules</span>
                                    </div>
                                    <div class="command-output">
<span class="highlight-yellow">Available Modules:</span>
- <span class="highlight-teal">Livestock Management</span>
- <span class="highlight-teal">Crop Planning</span>
- <span class="highlight-teal">Financial Tracking</span>
- <span class="highlight-teal">Task Management</span>
- <span class="highlight-teal">Data Analytics</span>
- <span class="highlight-teal">Mobile Access</span>
                                    </div>
                                </div>

                                <!-- Command 3 -->
                                <div class="command">
                                    <div class="command-input">
                                        <span class="prompt">farm@fims:~$</span>
                                        <span class="highlight-blue">fims --get-stats</span>
                                    </div>
                                    <div class="command-output">
<span class="highlight-mauve">System Statistics:</span>
Data Accuracy: <span class="highlight-green">100%</span>
Time Saved: <span class="highlight-green">30%</span>
Data Accessibility: <span class="highlight-green">24/7</span>
Active Users: <span class="highlight-green">500+</span>
                                    </div>
                                </div>

                                <!-- Command 4 with typing animation -->
                                <div class="command">
                                    <div class="command-input">
                                        <span class="prompt">farm@fims:~$</span>
                                        <span class="highlight-blue animated-text">fims --start</span>
                                        <span class="cursor"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-16" style="background-color: var(--crust)">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold mb-4 font-sans">Powerful <span class="highlight-mauve">Features</span></h2>
                    <p class="max-w-2xl mx-auto text-lg" style="color: var(--subtext1)">
                        Everything you need to manage your farm efficiently in one platform
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="feature-card p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 rounded-md flex items-center justify-center" style="background-color: rgba(166, 209, 137, 0.2)">
                                <span class="text-xl highlight-green">★</span>
                            </div>
                            <h3 class="text-xl font-semibold ml-3 highlight-green">Livestock Management</h3>
                        </div>
                        <p style="color: var(--subtext1)">
                            <span class="highlight-blue">$</span> track --animal-health --breeding --lineage<br>
                            Track all your animals with detailed records of health, breeding, productivity, and lineage information.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="feature-card p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 rounded-md flex items-center justify-center" style="background-color: rgba(229, 200, 144, 0.2)">
                                <span class="text-xl highlight-yellow">⊞</span>
                            </div>
                            <h3 class="text-xl font-semibold ml-3 highlight-yellow">Crop Planning</h3>
                        </div>
                        <p style="color: var(--subtext1)">
                            <span class="highlight-blue">$</span> plan --planting-schedule --track-growth<br>
                            Plan planting schedules, track growth stages, and manage harvests across all your fields and crops.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="feature-card p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 rounded-md flex items-center justify-center" style="background-color: rgba(239, 159, 118, 0.2)">
                                <span class="text-xl highlight-peach">$</span>
                            </div>
                            <h3 class="text-xl font-semibold ml-3 highlight-peach">Financial Tracking</h3>
                        </div>
                        <p style="color: var(--subtext1)">
                            <span class="highlight-blue">$</span> analyze --income --expenses --profit<br>
                            Monitor income, expenses, and profitability with detailed financial reports and forecasting tools.
                        </p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="feature-card p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 rounded-md flex items-center justify-center" style="background-color: rgba(140, 170, 238, 0.2)">
                                <span class="text-xl highlight-blue">✓</span>
                            </div>
                            <h3 class="text-xl font-semibold ml-3 highlight-blue">Task Management</h3>
                        </div>
                        <p style="color: var(--subtext1)">
                            <span class="highlight-blue">$</span> task --create --assign --prioritize<br>
                            Organize and assign farm tasks, set priorities, and track completion of daily activities.
                        </p>
                    </div>

                    <!-- Feature 5 -->
                    <div class="feature-card p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 rounded-md flex items-center justify-center" style="background-color: rgba(202, 158, 230, 0.2)">
                                <span class="text-xl highlight-mauve">◉</span>
                            </div>
                            <h3 class="text-xl font-semibold ml-3 highlight-mauve">Data Analytics</h3>
                        </div>
                        <p style="color: var(--subtext1)">
                            <span class="highlight-blue">$</span> visualize --trends --insights --metrics<br>
                            Make informed decisions with powerful analytics, trends, and performance insights.
                        </p>
                    </div>

                    <!-- Feature 6 -->
                    <div class="feature-card p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 rounded-md flex items-center justify-center" style="background-color: rgba(129, 200, 190, 0.2)">
                                <span class="text-xl highlight-teal">◎</span>
                            </div>
                            <h3 class="text-xl font-semibold ml-3 highlight-teal">Mobile Access</h3>
                        </div>
                        <p style="color: var(--subtext1)">
                            <span class="highlight-blue">$</span> connect --mobile --anywhere --anytime<br>
                            Access your farm data anytime, anywhere on any device with our responsive mobile-friendly design.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="py-16" style="background-color: var(--mantle)">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold mb-4 font-sans">Farmer <span class="highlight-blue">Testimonials</span></h2>
                    <p class="max-w-2xl mx-auto text-lg" style="color: var(--subtext1)">
                        Real feedback from our command line farmers
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Testimonial 1 -->
                    <div class="terminal p-4">
                        <div class="terminal-header mb-3">
                            <div class="terminal-controls">
                                <div class="terminal-control terminal-control-close"></div>
                                <div class="terminal-control terminal-control-minimize"></div>
                                <div class="terminal-control terminal-control-maximize"></div>
                            </div>
                            <div class="terminal-title">testimonial@john-smith</div>
                            <div class=""></div>
                        </div>
                        <div class="p-3">
                            <p class="highlight-green mb-3"># Dairy Farmer</p>
                            <p style="color: var(--subtext1)">
                                "FIMS has completely transformed how I manage my dairy farm. The livestock tracking alone has saved me countless hours and improved my herd's health significantly."
                            </p>
                        </div>
                    </div>

                    <!-- Testimonial 2 -->
                    <div class="terminal p-4">
                        <div class="terminal-header mb-3">
                            <div class="terminal-controls">
                                <div class="terminal-control terminal-control-close"></div>
                                <div class="terminal-control terminal-control-minimize"></div>
                                <div class="terminal-control terminal-control-maximize"></div>
                            </div>
                            <div class="terminal-title">testimonial@maria-johnson</div>
                            <div class=""></div>
                        </div>
                        <div class="p-3">
                            <p class="highlight-yellow mb-3"># Crop Farmer</p>
                            <p style="color: var(--subtext1)">
                                "The crop planning tools have helped me maximize my yields and reduce waste. I can now make data-driven decisions about what to plant and when."
                            </p>
                        </div>
                    </div>

                    <!-- Testimonial 3 -->
                    <div class="terminal p-4">
                        <div class="terminal-header mb-3">
                            <div class="terminal-controls">
                                <div class="terminal-control terminal-control-close"></div>
                                <div class="terminal-control terminal-control-minimize"></div>
                                <div class="terminal-control terminal-control-maximize"></div>
                            </div>
                            <div class="terminal-title">testimonial@robert-davis</div>
                            <div class=""></div>
                        </div>
                        <div class="p-3">
                            <p class="highlight-blue mb-3"># Mixed Farmer</p>
                            <p style="color: var(--subtext1)">
                                "Having all my farm data in one place has streamlined my operations. The financial tracking has been particularly valuable for securing loans and planning expansions."
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-16" style="background-color: var(--base)">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="terminal mx-auto max-w-3xl">
                    <div class="terminal-header">
                        <div class="terminal-controls">
                            <div class="terminal-control terminal-control-close"></div>
                            <div class="terminal-control terminal-control-minimize"></div>
                            <div class="terminal-control terminal-control-maximize"></div>
                        </div>
                        <div class="terminal-title">farm@fims:~/get-started</div>
                        <div class=""></div>
                    </div>
                    <div class="terminal-content text-center p-8">
                        <h2 class="text-2xl font-bold mb-4 highlight-mauve font-sans">Ready to transform your farm management?</h2>
                        <p class="mb-8 text-lg" style="color: var(--subtext1)">
                            Join hundreds of farmers who are already using our system to optimize their operations.
                        </p>

                        <div class="command-input justify-center mb-8">
                            <span class="prompt">farm@fims:~/get-started$</span>
                            <span class="highlight-blue">./install.sh</span>
                            <span class="cursor"></span>
                        </div>

                        <div class="flex flex-wrap justify-center gap-4">
                            <a href="{{ route('login') }}" class="btn btn-primary">
                                Get Started Today
                            </a>
                            <a href="#" class="btn btn-secondary">
                                Contact Us
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer style="background-color: var(--crust)" class="py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center" style="color: var(--overlay1)">
                    <p class="mb-2 flex items-center justify-center font-mono">
                        <span class="highlight-green mr-2">~</span> Crafted with <span class="highlight-red mx-1">♥</span> for the modern farmer
                    </p>
                    <p>&copy; {{ date('Y') }} Farm Information Management System. All rights reserved.</p>
                </div>
            </div>
        </footer>

        <script>
            // Optional: Add typing animation for additional elements
            document.addEventListener('DOMContentLoaded', () => {
                // You can add more interactive terminal features here if needed
            });
        </script>
    </body>
</html>
