@extends('dashboard.layout')

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('EST & PAT Tokens') }}
        </h2>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <h3 class="text-lg font-medium text-gray-900 mb-6">Understanding Our Token Ecosystem</h3>

            <div class="space-y-8">
                <!-- Energy Steward Token (EST) -->
                <div class="border-l-4 border-green-500 pl-6">
                    <div class="flex items-center mb-4">
                        <div class="p-3 bg-green-100 rounded-full mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-900">Energy Steward Token (EST)</h4>
                            <p class="text-sm text-gray-600">Recognition for community participation</p>
                        </div>
                    </div>

                    <div class="prose prose-gray max-w-none">
                        <p class="text-gray-700 mb-4">
                            <strong>What is EST?</strong> Energy Steward Tokens are special recognition tokens gifted to community members who actively contribute to the energy commons ecosystem.
                        </p>

                        <p class="text-gray-700 mb-4">
                            <strong>How do you earn EST?</strong> Users receive EST tokens from stewards as rewards for:
                        </p>

                        <ul class="list-disc list-inside text-gray-700 mb-4 space-y-1">
                            <li>Reporting power outages and energy-related issues promptly</li>
                            <li>Actively participating in community visibility and awareness activities</li>
                            <li>Helping maintain the energy infrastructure through responsible reporting</li>
                        </ul>

                        <p class="text-gray-700 mb-4">
                            <strong>Why EST matters:</strong> These tokens represent your commitment to community energy resilience. They serve as a digital badge of honor for those who help keep the lights on for everyone.
                        </p>

                        <div class="bg-green-50 p-4 rounded-lg">
                            <p class="text-sm text-green-800">
                                <strong>Community Impact:</strong> EST tokens help build a culture of proactive energy management, where every community member becomes a steward of shared resources.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Power Access Token (PAT) -->
                <div class="border-l-4 border-blue-500 pl-6">
                    <div class="flex items-center mb-4">
                        <div class="p-3 bg-blue-100 rounded-full mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-900">Power Access Token (PAT)</h4>
                            <p class="text-sm text-gray-600">Bonus tokens for blockchain-powered purchases</p>
                        </div>
                    </div>

                    <div class="prose prose-gray max-w-none">
                        <p class="text-gray-700 mb-4">
                            <strong>What is PAT?</strong> Power Access Tokens are bonus energy units awarded when you choose to power your home using Cardano blockchain technology.
                        </p>

                        <p class="text-gray-700 mb-4">
                            <strong>How do you earn PAT?</strong> PAT tokens are automatically credited to your account whenever you purchase power units using ADA (Cardano cryptocurrency).
                        </p>

                        <ul class="list-disc list-inside text-gray-700 mb-4 space-y-1">
                            <li>Buy power units through the "Pay with Ada" option</li>
                            <li>Receive extra light unit tokens as a bonus</li>
                            <li>Support decentralized energy infrastructure</li>
                        </ul>

                        <p class="text-gray-700 mb-4">
                            <strong>Why PAT matters:</strong> These tokens incentivize the adoption of blockchain-based energy transactions, creating a more transparent and efficient energy marketplace while rewarding early adopters.
                        </p>

                        <div class="bg-blue-50 p-4 rounded-lg">
                            <p class="text-sm text-blue-800">
                                <strong>Future Benefits:</strong> PAT tokens may unlock premium features, priority access to energy services, or special community governance rights as the ecosystem grows.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Token Usage Overview -->
                <div class="border-t pt-6">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4">How to Use Your Tokens</h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h5 class="font-medium text-gray-900 mb-2">Current Usage</h5>
                            <ul class="text-sm text-gray-700 space-y-1">
                                <li>• EST: Community recognition and status</li>
                                <li>• PAT: Bonus energy units for purchases</li>
                                <li>• Both tokens contribute to your energy commons reputation</li>
                            </ul>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h5 class="font-medium text-gray-900 mb-2">Future Possibilities</h5>
                            <ul class="text-sm text-gray-700 space-y-1">
                                <li>• Governance voting rights</li>
                                <li>• Priority energy allocation</li>
                                <li>• Exclusive community benefits</li>
                                <li>• Token trading marketplace</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<parameter name="filePath">/opt/lampp/htdocs/energy-commons/resources/views/est-pat/index.blade.php