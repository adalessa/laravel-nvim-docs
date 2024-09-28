@extends('_layouts.master')

@section('body')
<section class="container max-w-6xl mx-auto px-6 py-10 md:py-12">
    <div class="flex flex-col-reverse mb-10 lg:flex-row lg:mb-24">
        <div class="mt-8">
            <h1 id="intro-docs-template">{{ $page->siteName }}</h1>

            <h2 id="intro-powered-by-jigsaw" class="font-light mt-4">{{ $page->siteDescription }}</h2>

            <p class="text-lg">Have access to all laravel tools in your editor. <br class="hidden sm:block">Code faster and with a better integration.</p>

            <div class="flex my-10">
                <a href="/docs/getting-started" title="{{ $page->siteName }} getting started" class="bg-blue-500 hover:bg-blue-600 font-normal text-white hover:text-white rounded mr-4 py-2 px-6">Get Started</a>

                <a href="https://github.com/adalessa/laravel.nvim" title="Laravel NVIM" class="bg-gray-300 hover:bg-gray-600 text-blue-900 font-normal hover:text-white rounded py-2 px-6">Source Code</a>
            </div>
        </div>

        <img src="{{url('/assets/img/logo-large.svg')}}" alt="{{ $page->siteName }} large logo" class="mx-auto mb-6 lg:mb-0 ">
    </div>

    <hr class="block my-8 border lg:hidden">

    <div class="md:flex -mx-4">
        <div class="mb-8 mx-3 px-2 md:w-1/3">
            <img src="{{ url('/assets/img/icon-window.svg')}}" class="h-12 w-12" alt="window icon">

            <h3 id="intro-laravel" class="text-2xl text-blue-900 mb-0">Dedicated Pickers <br>Integration with telecope</h3>

            <p>Telescoep is one of the most famous plugins of neovim, the plugin makes use of it to run commands, list routes, and more integrations.</p>
        </div>

        <div class="mb-8 mx-3 px-2 md:w-1/3">
            <img src="{{ url('/assets/img/icon-terminal.svg')}}" class="h-12 w-12" alt="terminal icon">

            <h3 id="intro-markdown" class="text-2xl text-blue-900 mb-0">Artisan Integration</h3>

            <p>Not just from the pickers artisan is on user commands and api, that allows to cool features on the plugin</p>
        </div>

        <div class="mx-3 px-2 md:w-1/3">
            <img src="{{ url('/assets/img/icon-stack.svg')}}" class="h-12 w-12" alt="stack icon">

            <h3 id="intro-mix" class="text-2xl text-blue-900 mb-0">Environment Detection <br>run as your application does it</h3>

            <p>There are many ways to run your application, native, docker, sail and even more. The plugin allows to run the commands in the same way.</p>
        </div>
    </div>
</section>
@endsection
