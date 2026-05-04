<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courier Management System - Fast, Reliable Delivery Tracking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        .font-display { font-family: 'Space Grotesk', sans-serif; }
        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
            background-attachment: fixed;
        }
        .glass {
            @apply rounded-2xl border border-white/10 bg-white/5 shadow-2xl backdrop-blur-xl;
        }
        .gradient-text {
            background: linear-gradient(135deg, #06b6d4, #0ea5e9, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .glow {
            box-shadow: 0 0 40px rgba(6, 182, 212, 0.3);
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .float { animation: float 3s ease-in-out infinite; }
    </style>
</head>
<body class="text-white">
    <!-- Navbar -->
    <nav class="sticky top-0 z-50 backdrop-blur-xl border-b border-white/10 bg-slate-950/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center font-display font-black text-white shadow-lg shadow-cyan-500/30">
                        ⚡
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-widest text-cyan-400">Courier System</p>
                        <p class="text-lg font-bold">SwiftShip</p>
                    </div>
                </div>
                <div class="hidden md:flex items-center gap-8">
                    <a href="#features" class="text-slate-300 hover:text-white transition">Features</a>
                    <a href="#how-it-works" class="text-slate-300 hover:text-white transition">How It Works</a>
                </div>
                <div class="flex gap-4">
                    <a href="{{ route('login') }}" class="px-6 py-2 rounded-lg border border-white/20 text-white hover:bg-white/5 transition">Login</a>
                    <a href="{{ route('register') }}" class="px-6 py-2 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold hover:shadow-lg hover:shadow-cyan-500/30 transition">Get Started</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center px-4 overflow-hidden">
        <!-- Animated Background -->
        <div class="absolute inset-0 -z-10">
            <div class="absolute top-20 left-10 w-72 h-72 bg-cyan-500/20 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 right-10 w-72 h-72 bg-blue-500/20 rounded-full blur-3xl animate-pulse"></div>
        </div>

        <div class="max-w-7xl w-full mx-auto">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="space-y-8">
                    <div>
                        <h1 class="text-6xl md:text-7xl font-display font-black mb-6 leading-tight">
                            Real-Time <span class="gradient-text">Courier Tracking</span>
                        </h1>
                        <p class="text-xl text-slate-400 mb-8">
                            Manage shipments, track deliveries, and connect with your logistics network. Everything you need in one powerful platform.
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('register') }}" class="px-8 py-4 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-bold hover:shadow-xl hover:shadow-cyan-500/30 transition text-center">
                            Start Free Trial
                        </a>
                        <a href="#how-it-works" class="px-8 py-4 rounded-lg border-2 border-cyan-500/30 text-white font-bold hover:border-cyan-500/60 transition text-center">
                            Learn More
                        </a>
                    </div>

                    <div class="grid grid-cols-3 gap-4 pt-4">
                        <div class="glass p-4">
                            <p class="text-2xl font-bold gradient-text">50K+</p>
                            <p class="text-sm text-slate-400">Shipments Tracked</p>
                        </div>
                        <div class="glass p-4">
                            <p class="text-2xl font-bold gradient-text">99.9%</p>
                            <p class="text-sm text-slate-400">Uptime</p>
                        </div>
                        <div class="glass p-4">
                            <p class="text-2xl font-bold gradient-text">24/7</p>
                            <p class="text-sm text-slate-400">Support</p>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <div class="glass p-8 float">
                        <div class="space-y-6">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center text-2xl shadow-lg shadow-cyan-500/30">📦</div>
                                <div>
                                    <p class="font-semibold">Smart Tracking</p>
                                    <p class="text-sm text-slate-400">Real-time updates</p>
                                </div>
                            </div>
                            <hr class="border-white/10">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center text-2xl shadow-lg shadow-purple-500/30">📊</div>
                                <div>
                                    <p class="font-semibold">Analytics</p>
                                    <p class="text-sm text-slate-400">Detailed reports</p>
                                </div>
                            </div>
                            <hr class="border-white/10">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center text-2xl shadow-lg shadow-green-500/30">✅</div>
                                <div>
                                    <p class="font-semibold">Automation</p>
                                    <p class="text-sm text-slate-400">Save time & money</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-24 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-5xl font-display font-black mb-4">Powerful Features</h2>
                <p class="text-xl text-slate-400">Everything you need to manage couriers like a pro</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="glass p-8 hover:shadow-xl hover:shadow-cyan-500/20 transition">
                    <div class="text-4xl mb-4">🚀</div>
                    <h3 class="text-2xl font-bold mb-4">Live Tracking</h3>
                    <p class="text-slate-400">Track every shipment in real-time with GPS updates, location history, and delivery status notifications.</p>
                </div>

                <div class="glass p-8 hover:shadow-xl hover:shadow-blue-500/20 transition">
                    <div class="text-4xl mb-4">👥</div>
                    <h3 class="text-2xl font-bold mb-4">User Management</h3>
                    <p class="text-slate-400">Manage admins, agents, and customers with role-based access control. Secure and scalable permissions.</p>
                </div>

                <div class="glass p-8 hover:shadow-xl hover:shadow-purple-500/20 transition">
                    <div class="text-4xl mb-4">📊</div>
                    <h3 class="text-2xl font-bold mb-4">Reports & Analytics</h3>
                    <p class="text-slate-400">Generate comprehensive reports by date, city, and shipment type. Export to Excel with one click.</p>
                </div>

                <div class="glass p-8 hover:shadow-xl hover:shadow-green-500/20 transition">
                    <div class="text-4xl mb-4">💬</div>
                    <h3 class="text-2xl font-bold mb-4">SMS Notifications</h3>
                    <p class="text-slate-400">Automated SMS alerts for shipment booking, delivery, and status updates. Keep customers informed.</p>
                </div>

                <div class="glass p-8 hover:shadow-xl hover:shadow-pink-500/20 transition">
                    <div class="text-4xl mb-4">🔒</div>
                    <h3 class="text-2xl font-bold mb-4">Security</h3>
                    <p class="text-slate-400">Enterprise-grade security with encrypted data, secure authentication, and audit logs for compliance.</p>
                </div>

                <div class="glass p-8 hover:shadow-xl hover:shadow-yellow-500/20 transition">
                    <div class="text-4xl mb-4">⚡</div>
                    <h3 class="text-2xl font-bold mb-4">Fast & Reliable</h3>
                    <p class="text-slate-400">99.9% uptime guarantee with lightning-fast performance. Always available when you need it.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="py-24 px-4 bg-gradient-to-b from-slate-950 to-slate-950/50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-5xl font-display font-black mb-4">How It Works</h2>
                <p class="text-xl text-slate-400">Simple 4-step process to get started</p>
            </div>

            <div class="grid md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center text-3xl font-bold mx-auto mb-6 shadow-lg shadow-cyan-500/30">1</div>
                    <h3 class="text-xl font-bold mb-3">Sign Up</h3>
                    <p class="text-slate-400">Create your account in seconds. No credit card required.</p>
                </div>

                <div class="text-center">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center text-3xl font-bold mx-auto mb-6 shadow-lg shadow-purple-500/30">2</div>
                    <h3 class="text-xl font-bold mb-3">Add Shipments</h3>
                    <p class="text-slate-400">Create new shipments with automatic tracking number generation.</p>
                </div>

                <div class="text-center">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center text-3xl font-bold mx-auto mb-6 shadow-lg shadow-green-500/30">3</div>
                    <h3 class="text-xl font-bold mb-3">Track & Update</h3>
                    <p class="text-slate-400">Update shipment status and send automatic notifications.</p>
                </div>

                <div class="text-center">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-yellow-500 to-orange-600 flex items-center justify-center text-3xl font-bold mx-auto mb-6 shadow-lg shadow-yellow-500/30">4</div>
                    <h3 class="text-xl font-bold mb-3">Generate Reports</h3>
                    <p class="text-slate-400">Export comprehensive reports and analytics anytime.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="py-24 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-5xl font-display font-black mb-4">Simple Pricing</h2>
                <p class="text-xl text-slate-400">Choose the plan that fits your needs</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="glass p-8">
                    <h3 class="text-2xl font-bold mb-2">Starter</h3>
                    <p class="text-slate-400 mb-6">Perfect for small businesses</p>
                    <p class="text-4xl font-bold mb-2">₹999<span class="text-lg text-slate-400">/month</span></p>
                    <ul class="space-y-4 mb-8 text-slate-300">
                        <li>✓ Up to 100 shipments</li>
                        <li>✓ Basic tracking</li>
                        <li>✓ Email support</li>
                        <li>✓ Monthly reports</li>
                    </ul>
                    <button class="w-full px-6 py-3 rounded-lg border border-white/20 text-white hover:bg-white/5 transition">Choose Plan</button>
                </div>

                <div class="glass p-8 border-2 border-cyan-500/50 relative">
                    <div class="absolute -top-4 left-1/2 -translate-x-1/2 px-4 py-1 bg-gradient-to-r from-cyan-500 to-blue-600 rounded-full text-sm font-semibold">POPULAR</div>
                    <h3 class="text-2xl font-bold mb-2">Professional</h3>
                    <p class="text-slate-400 mb-6">For growing teams</p>
                    <p class="text-4xl font-bold mb-2">₹2,999<span class="text-lg text-slate-400">/month</span></p>
                    <ul class="space-y-4 mb-8 text-slate-300">
                        <li>✓ Unlimited shipments</li>
                        <li>✓ Real-time tracking</li>
                        <li>✓ SMS notifications</li>
                        <li>✓ Advanced reports</li>
                        <li>✓ Priority support</li>
                    </ul>
                    <button class="w-full px-6 py-3 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold hover:shadow-lg hover:shadow-cyan-500/30 transition">Choose Plan</button>
                </div>

                <div class="glass p-8">
                    <h3 class="text-2xl font-bold mb-2">Enterprise</h3>
                    <p class="text-slate-400 mb-6">Custom for large scale</p>
                    <p class="text-4xl font-bold mb-2">Custom<span class="text-lg text-slate-400">Pricing</span></p>
                    <ul class="space-y-4 mb-8 text-slate-300">
                        <li>✓ Everything in Pro</li>
                        <li>✓ Dedicated account</li>
                        <li>✓ Custom integration</li>
                        <li>✓ 24/7 phone support</li>
                        <li>✓ SLA guarantee</li>
                    </ul>
                    <button class="w-full px-6 py-3 rounded-lg border border-white/20 text-white hover:bg-white/5 transition">Contact Sales</button>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 px-4">
        <div class="max-w-4xl mx-auto glass p-16 text-center">
            <h2 class="text-5xl font-display font-black mb-6">Ready to Transform Your Logistics?</h2>
            <p class="text-xl text-slate-400 mb-8">Join thousands of businesses already using SwiftShip to streamline their courier operations.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="px-8 py-4 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-bold hover:shadow-xl hover:shadow-cyan-500/30 transition">
                    Start Your Free Trial
                </a>
                <button class="px-8 py-4 rounded-lg border-2 border-cyan-500/30 text-white font-bold hover:border-cyan-500/60 transition">
                    Schedule Demo
                </button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-white/10 bg-slate-950/50 backdrop-blur py-12 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center font-display font-black text-white">⚡</div>
                        <p class="font-bold">SwiftShip</p>
                    </div>
                    <p class="text-slate-400 text-sm">Fast, reliable courier management</p>
                </div>
            </div>
            <div class="border-t border-white/10 pt-8 text-center text-slate-400 text-sm">
                <p>&copy; 2026 SwiftShip. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    </script>
</body>
</html>
